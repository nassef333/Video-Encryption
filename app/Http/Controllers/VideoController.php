<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Http\Resources\UserVideosEnrollResource;
use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoWatchersResource;
use App\Jobs\videoStreamingProcess;
use App\Models\LevelData;
use App\Models\UserVideos;
use App\Models\Videos;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generateEmbedUrl($video_path)
    {
        return $video_path;
        $zone_url = 'https://myweb.b-cdn.net';
        $expires_seconds = 300; // Set the expiration to 5 minutes (adjust as needed)

        // Add your token authentication key here.
        $security_key = '68f7fbad-8c96-4af0-94d5-f25a498220e4';

        $expires = time() + $expires_seconds;
        $hash_base = $security_key . $video_path . $expires;
        $token = md5($hash_base, true);
        $token = base64_encode($token);
        $token = strtr($token, '+/', '-_');
        $token = str_replace('=', '', $token);

        return response()->json([
            'secure_url' => "{$zone_url}{$video_path}?token={$token}&expires={$expires}",
        ]);
    }

    public function stream($key)
    {
        $video = Videos::where('hashed_key', $key)->first();
        if ($video) {
            $links = $video->hashed_links;
            return view('videos\stream', compact('links', 'video'));
        } else {
            return "incorrect link";
        }
    }


    public function index(Request $request)
    {
        $searchTerm = $request->query('searchTerm');

        if ($searchTerm) return $this->search($request);

        $videos = Videos::paginate(20);

        return view('videos.index', compact('searchTerm', 'videos'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $videos = Videos::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', "%$searchTerm%")
                ->orWhere('iframe', 'like', "%$searchTerm%")
                ->orWhere('type', 'like', "%$searchTerm%");
        })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);

        return view('videos.index', compact('searchTerm', 'videos'));
    }


    public function edit(Videos $video)
    {
        $weeks = Weeks::all();
        return view('videos.edit', compact('video', 'weeks'));
    }


    public function create(Request $request)
    {
        $weeks = Weeks::all();
        return view('videos.create', compact('weeks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {

        $request->validated();

        if (!Weeks::find($request->week_id))
            return $this->error('', 'Week Not Found... ', 404);

        $video = Videos::create([
            'iframe' => $request->iframe,
            'noviews' => $request->noviews,
            'minutes_views' => $request->minutes_views,
            'type' => $request->type,
            'video_dauration' => $request->video_dauration,
            // 'video_path' => $request->video_path,
            'title' => $request->title,
            'week_id' => $request->week_id,
            'level' => $request->level,
        ]);

        if ($request->hasFile('video_file')) {
            $video['video_path'] = $request->file('video_file')->store('uploads', 'local');
            $video->save();
        }

        $level = LevelData::find($video->level);
        if ($level) {
            $level->videos = Videos::where('level', $video->level)->count();
            $level->save();
        }

        dispatch(new videoStreamingProcess($video->id));
        return redirect('videos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //this function enrolls user a week
    public function show($id)
    {

        if (!Videos::where('id', $id)->exists())
            return $this->error('', 'This Video is not found...', 404);

        $video = Videos::find($id);
        return new VideoResource($video);
    }

    public function showLevelVideos($id)
    {
        if ($id < 1 || $id > 3)
            return $this->error('', 'Not Found', 404);
        return VideoResource::collection(
            Videos::where('level', $id)->get()
        );
    }

    public function getVideoWatchers($id)
    {
        return VideoWatchersResource::collection(
            Videos::find($id)->users()->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $video)
    {
        $video->update($request->all());
        return redirect('videos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $video)
    {
        $video->delete();
        $level = LevelData::find($video->level);
        $level->videos = Videos::where('level', $video->level)->count();
        $level->save();
        return $this->success('', 'Video has been deleted succesfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearStudent($id)
    {
        $studentVideo = UserVideos::find($id);

        if ($studentVideo) {
            $studentVideo->delete();
            return response()->json(['message' => 'Student Video deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student Video not found'], 404);
        }
    }

    public function VideosStudents(Request $request, $video_id)
    {
        $searchTerm = $request->query('searchTerm');

        if ($searchTerm) return $this->searchVideosStudents($request, $video_id);

        $students = Videos::where('id', $video_id)->first()->users()->paginate(20);
        return view('videos.students', compact('students'));
    }

    public function searchVideosStudents(Request $request, $course_id)
    {
        $searchTerm = $request->query('searchTerm');

        // Split the search term into fname and lname
        $nameParts = explode(' ', $searchTerm);
        $fname = $nameParts[0] ?? '';
        $lname = $nameParts[1] ?? '';

        $students = Videos::where('id', $course_id)->first()->users()
            ->where(function ($query) use ($fname, $lname, $searchTerm) {
                $query->where(function ($query) use ($fname, $lname) {
                    $query->where('fname', 'like', "%$fname%")
                        ->where('lname', 'like', "%$lname%");
                })
                    ->orWhere('phone', 'like', "%$searchTerm%")
                    ->orWhere('pphone', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);

        return view('videos.students', compact('students', 'searchTerm'));
    }
}
