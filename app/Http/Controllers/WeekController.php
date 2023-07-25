<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeWeekRequest;
use App\Http\Resources\getAllWeeksForSelecetResource;
use App\Http\Requests\updateWeekRequest;
use App\Http\Resources\WeekAuthedResource;
use App\Http\Resources\WeekContentResource;
use App\Http\Resources\WeekResource;
use App\Models\Homeworks;
use App\Models\LevelData;
use App\Models\Materials;
use App\Models\Questions;
use App\Models\Quizzes;
use App\Models\UserHomeworks;
use App\Models\UserQuizzes;
use App\Models\UserVideos;
use App\Models\UserWeeks;
use App\Models\Videos;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WeekController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WeekResource::collection(
            Weeks::get()
        );  
    }

    public function getAllWeeksForSelecet()
    {
        return getAllWeeksForSelecetResource::collection(
            Weeks::get()
        ); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeWeekRequest $request)
    {
        $request->validated($request->all());

        $week = Weeks::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'img' => '',
            'level' => $request->level,
        ]);
        if($request->hasFile('img')){
            $week['img'] = $request->file('img')->store('weeks', 'public');
            $week->save();
        }
        $level = LevelData::find($week->level);
        $level->weeks = Weeks::where('level', $week->level)->count();
        $level->save();
        return $this->success(new WeekResource($week), 'Week Created Successfully.', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $week = Weeks::find($id);
        if (!Weeks::where('id', $id)->exists())
            return $this->error('', 'Not Found', 404);
        return new WeekResource($week);
    }

    public function showLevelWeeks($id)
    {
        if ($id < 1 || $id > 3)
            return $this->error('', 'Week Not Found..', 404);
        if($id == 1){
            return $this->success(WeekResource::collection(
                Weeks::where('level', $id)->get()
            ), 'الصف الأول الثانوى', 200);
        }
        else if($id == 2){
            return $this->success(WeekResource::collection(
                Weeks::where('level', $id)->get()
            ), 'الصف الثانى الثانوى', 200);
        }
        else if($id == 3){
            return $this->success(WeekResource::collection(
                Weeks::where('level', $id)->get()
            ), 'الصف الثالث الثانوى', 200);
        }
    }

    public function showAuthWeeks(){
        // return Weeks ::where('level', Auth::user()->level)->get();
        return WeekAuthedResource::collection(
            Weeks::where('level', Auth::user()->level)->get()
        );
        
    }

        public function getContent($id){
        $user = Auth::user();
        $data = [];
        $time = date('Y-m-d H:i:s', time());

        $data["quizzes"] = $quizzes = Quizzes::where('week_id', $id)->get();
        foreach($data["quizzes"] as $quiz){
            $userQuiz = UserQuizzes::where('users_id', $user->id)->where('quizzes_id', $quiz->id);
            // return $userQuiz->first();
                $quiz["noQuestions"] = $quiz->noquestions;
                if($userQuiz->exists() && $userQuiz->first()->state == 1 && $quiz->answerTime == 0){
                        $quiz["score"] = $userQuiz->first()->score;
                }
                else if($userQuiz->exists() && strtotime($userQuiz->first()->created_at) + 60 * $quiz->minutes < time()){
                    if($quiz->answerTime == 1 && $quiz->end > $time){
                        $quiz["score"] = "";
                    }
                    else
			$quiz["score"] = $userQuiz->first()->score;
                }
                else
                    $quiz["score"] = "";       
}
        
        $data["videos"] = $videos = Videos::where('week_id', $id)->get();
        foreach($data["videos"] as $video){
            $userVideo = UserVideos::where('user_id', $user->id)->where('video_id', $video->id);
            if($userVideo->exists())
                $video["count"] = $userVideo->first()->count;
            else 
                $video["count"] = "";

        }

        $data["homeworks"] = $homeorks = Homeworks::where('week_id', $id)->get();
        foreach($data["homeworks"] as $homework){
            $userHomework = UserHomeworks::where('users_id', $user->id)->where('homeworks_id', $homework->id);
            $homework["noQuestions"] = $homework->questions()->count();
            if($userHomework->exists() && strtotime($userHomework->first()->created_at) + 60 * $homework->minutes < time())
                $homework["score"] = $userHomework->first()->score;
            else 
                $homework["score"] = "";
        }

        $data["materials"] = $materials = Materials::where('week_id', $id)->get();
        $data["data"] = Weeks::find($id);
        $data["data"]["videoMinutes"] = Videos::where('week_id', $id)->sum('video_dauration');
        UserWeeks::where('user_id', $user->id)->where('week_id', $id)->exists()? $data["data"]["Owned"] = true : $data["data"]["Owned"] = false;
        return $data;
    }

    //is not logged in
    public function getWeekContent($id){
        $data = [];

        $data["quizzes"] = $quizzes = Quizzes::where('week_id', $id)->get();

        
        $data["videos"] = $videos = Videos::where('week_id', $id)->get();


        $data["homeworks"] = $homeorks = Homeworks::where('week_id', $id)->get();


        $data["materials"] = $materials = Materials::where('week_id', $id)->get();
        $data["data"] = Weeks::find($id);
        $data["data"]["videoMinutes"] = Videos::where('week_id', $id)->sum('video_dauration');
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWeek(updateWeekRequest  $request, $id)
    {
        $week = Weeks::find($id);
        $week->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'level' => $request->level,]);
        if($request->hasFile('img')){
            $week['img'] = $request->file('img')->store('weeks', 'public');
            $week->save();
        }
        return $this->success(new WeekResource($week), 'Week Updated Successfully.', 200);
    }    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weeks $week)
    {
        $week->delete();
        return $this->success('', 'Week Deleted succesfuly.', 200);
    }

    
    public function sort($id)
    {
        $week = Weeks::find($id);
        $videos = Videos::where('week_id', $id)->get();
        $homeworks = Homeworks::where('week_id', $id)->get();
        $quizzes = Quizzes::where('week_id', $id)->get();
        $materials = Materials::where('week_id', $id)->get();

        $data = [];

        // Iterate through each video and add to the data array
        foreach ($videos as $video) {
            $data[] = [
                "type" => "video",
                "id" => $video->id,
                "name" => $video->title,
                "sort" => $video->sort,
            ];
        }
        
        // Iterate through each quiz and add to the data array
        foreach ($quizzes as $quiz) {
            $data[] = [
                "type" => "quiz",
                "id" => $quiz->id,
                "name" => $quiz->title,
                "sort" => $quiz->sort,
            ];
        }
        
        // Iterate through each homework and add to the data array (if needed)
        foreach ($homeworks as $homework) {
            $data[] = [
                "type" => "homework",
                "id" => $homework->id,
                "name" => $homework->title,
                "sort" => $homework->sort,
            ];
        }
        
        // Iterate through each material and add to the data array (if needed)
        foreach ($materials as $material) {
            $data[] = [
                "type" => "material",
                "id" => $material->id,
                "name" => $material->title,
                "sort" => $material->sort,
            ];
        }

        $dataCollection = new Collection($data);
        $data = $dataCollection->sortBy('sort')->values()->all();
        // return $data;
        return view('courses.week-sort', compact('data', 'week', 'videos', 'homeworks', 'quizzes', 'materials'));
    }


    public function submitSort(Request $request)
    {
        // return $request;

        for($i=0;$i<count($request->sort);$i++)
        {
            $type = $request->item_type[$i];
            $id = $request->item_id[$i];
            $sort = $request->sort[$i];
            if($type == "video"){
                $video = Videos::find($id);
                $video->sort = $sort;
                $video->save();
            }elseif($type == "quiz"){
                $quiz = Quizzes::find($id);
                $quiz->sort = $sort;
                $quiz->save();
            }elseif($type == "homework"){
                $homework = Homeworks::find($id);
                $homework->sort = $sort;
                $homework->save();
            }elseif($type == "material"){
                $material = Materials::find($id);
                $material->sort = $sort;
                $material->save();
            }
        }

        $course_id = Weeks::find($request->week_id);
        $course_id = $course_id->courses[0]['id'];
        return redirect('/courses/'.$course_id.'/content');
    }

}
