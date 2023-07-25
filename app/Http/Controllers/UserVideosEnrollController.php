<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserVideosEnrollResource;
use App\Http\Resources\videoDataResource;
use App\Models\UserVideos;
use App\Models\UserWeeks;
use App\Models\Videos;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVideosEnrollController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserVideosEnrollResource::collection(
            UserVideos::where('user_id', Auth::user()->id)->get()
        );
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

        if (empty(Videos::find($id)))
            return $this->error('', 'This Video is not found...', 404);

        $user = Auth::user();
        $videoData = Videos::find($id);

        if (!UserWeeks::where('user_id', $user->id)->where('week_id', $videoData->week_id)->exists())
            return $this->error('', 'You are not registered this week...', 404);
        $userVideo = UserVideos::where('user_id', $user->id)->where('video_id', $videoData->id);
        if (!$userVideo->exists()) {
            $data = UserVideos::create([
                'user_id' => Auth::user()->id,
                'video_id' => $videoData->id,
                'count' => 1,
            ]);
            return $this->success($videoData, 'We hope you enjoy watching this video.', 200);
        }
        if ($userVideo->first()->count >= $videoData->noviews) {
            return $this->error('', 'You Have Exeeded Limit of watching...', 401);
        }
        // $date = date();
        // return strtotime(now()) - strtotime($userVideo->first()->updated_at);
        if ($userVideo->exists()) {
            if( (strtotime(now()) - strtotime($userVideo->first()->updated_at)) > 60*$videoData->minutes_views || $userVideo->first()->count < 1)
                $userVideo->update(['count' => $userVideo->first()->count + 1]);
            return $this->success($videoData, 'We hope you enjoy watching this video.', 200);
        }

    }

    public function myVideos(){
        return $this->success(UserVideos::where('user_id', Auth::user()->id)->get(), 'ok.', 200);
    }

    public function SpecificVideoData($id){
        if (empty(Videos::find($id)))
            return $this->error('', 'This Video is not found...', 404);
        
        $user = Auth::user();
        $videoData = Videos::find($id);
        // return $videoData;
        if (!UserWeeks::where('user_id', $user->id)->where('week_id', $videoData->week_id)->exists())
            return $this->error('', 'You are not registered this week...', 404);

            return videoDataResource::collection(
                UserVideos::where('user_id', $user->id)->where('video_id', $id)->get()
            );
        // return $this(, 'OK.', 200);
    }

    public function clearUserWatches($id)
    {
        UserVideos::find($id)->delete();
        return $this->success('', 'User Watches Cleared succesfuly.', 200);
    }
}
