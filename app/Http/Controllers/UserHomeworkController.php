<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnrollHomewrokResource;
use App\Http\Resources\HomeworkStudentsResource;
use App\Http\Resources\ModelAnswerResource;
use App\Models\HomeworkQuestions;
use App\Models\Homeworks;
use App\Models\SolvedHomeworks;
// use App\Models\UserHomeworks;
use App\Models\UserWeeks;
use App\Models\UserHomeworks;
use App\Models\Users;
use App\Traits\HttpResponses;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeworkController extends Controller
{
    use HttpResponses;

    //for admin
    public function studentHomeworks($id)
    {
        if (!User::where('id', $id)->exists())
            return $this->error('', 'User Not Found...', 404);
        return $this->success(Users::find($id)->homeworks, 'User Found.', 200);
    }

    //for user
    public function myHomeworks()
    {
        return $this->success(Auth::user()->homeworks, 'ok.', 200);
    }

    public function HomeworkStudents($id)
    {   
        if (!Homeworks::where('id', $id)->exists())
            return $this->error('', 'Homeework Not Found...', 404);
        return $this->success(HomeworkStudentsResource::collection(
            Homeworks::find($id)->users
        ), 'Homework Found.', 200);
    }

    private function addTime($timestamp, $minutes_to_add)
    {
        $datetime = new DateTime($timestamp);
        $interval = new DateInterval("PT{$minutes_to_add}M");
        $datetime->add($interval);
        $formatted_timestamp = $datetime->format('Y-m-d\TH:i:s.u\Z');
        return $formatted_timestamp;
    }
    
    public function userEnrollHomework($id)
    {
        if(!Homeworks::where('id', $id)->exists())
            return $this->error('', 'Week not found...', 401); 
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', Homeworks::find($id)->week->id)->exists())
            return $this->error('', 'You Have not Enrolled This Week yet...', 402);

        $time = date('Y-m-d H:i:s', time());    
        $valid = Homeworks::find($id);
        if($valid->start > $time || $valid->end < $time)
            return $this->error('', 'This Homework has been Ended', 403);
        $user = Auth::user();
        foreach ($user->homeworks as $homework) {
            if ($homework->id == $id) {
                 if ($homework->start < $time and $homework->end > $time) {
                    if (date('Y-m-d H:i:s', strtotime($homework->pivot->created_at) + 60 * $homework->minutes) > $time) {
                        $questions = Homeworks::find($id)->questions;
                        foreach($questions as $question){
                            $choosen = SolvedHomeworks::where('user_id', Auth::user()->id)->where('homework_id', $id)->where('question_id', $question->id);
                            if(!$choosen->exists())
                                $question["choosen"] = 0;
                            else
                                $question["choosen"] = $choosen->first()->choosen;
                        }
                        //->shuffle()
                        return $this->success(EnrollHomewrokResource::collection(
                        $questions
                        ), strtotime($homework->pivot->created_at) + 60 * $homework->minutes - strtotime($time), 200);                   
                    }
                    return $this->error('', 'Time Limit Out...', 403);
                } else {
                    return $this->error('', 'This Homework has been Ended', 403);
                }
                return $this->error('', 'You have Enrolled this Homework before...', 405);
            }
        }        
        $questions = Homeworks::find($id)->questions;
        $newUserHomework = new UserHomeworks;
        $newUserHomework->users_id = Auth::user()->id;
        $newUserHomework->homeworks_id = $id;
        $newUserHomework->score = 0;
        $newUserHomework->save();
        foreach ($questions as $question) {
            $solvedHomework = new SolvedHomeworks;
            $solvedHomework->user_id = Auth::user()->id;
            $solvedHomework->question_id = $question->id;
            $solvedHomework->homework_id = $id;
            $solvedHomework->true = $question->answer;
            $solvedHomework->degree = HomeworkQuestions::where('homework_id', $id)->where('question_id', $question->id)->first()->degree;
            $solvedHomework->choosen = 0;
            $solvedHomework->save();
        }
        return $this->success($questions, 60 * Homeworks::find($id)->minutes, 200);
    }

    public function submitQuestion(Request $request, $id, $question_id)
    {
        // return 'hamadaa';
        //$validated_data = $request->validate([
        //    'choosen' => ['required', 'numeric'],
        //]);

        // return $request->choosen;
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', Homeworks::find($id)->week->id)->exists())
            return $this->error('', 'You Have not Enrolled This Week yet...', 401);

        $oldQuestion = SolvedHomeworks::where('user_id', Auth::user()->id)->where('homework_id', $id)->where('question_id', $question_id);
        $solvedHomework = $oldQuestion->first();
        $solvedHomework->choosen = $request->choosen;
        $solvedHomework->save();

        $userHomework = UserHomeworks::where('users_id', Auth::user()->id)->where('homeworks_id', $id)->first();
        $score = SolvedHomeworks::whereColumn('true', 'choosen')->where('user_id', Auth::user()->id)->where('homework_id', $id)->sum('degree');
        $userHomework->score = $score;
        $userHomework->save();
        return $this->success('', 'Answer Sent Successfully.', 200);
    }


    public function getAnswers($id)
    {
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', Homeworks::find($id)->week->id)->exists())
            return $this->error('', 'You Have not Enrolled This Week yet...', 401);

        $user_homework = UserHomeworks::where('users_id', Auth::user()->id)->where('homeworks_id', $id);
        if(!$user_homework->exists())
            return $this->error('', 'You Have not Enrolled This Question yet...', 401);

        $time = date('Y-m-d H:i:s', time());
        $homeworkTime = Homeworks::find($id)->minutes;
        $endTime = date('Y-m-d H:i:s', strtotime($user_homework->first()->created_at) + 60 * $homeworkTime);

        if ($time > $endTime) {
            
             $questions = Homeworks::find($id)->questions;
                foreach($questions as $question){
                    $solvedHomework = SolvedHomeworks::where('user_id', Auth::user()->id)->where('homework_id', $id)->where('question_id', $question->id);
                    if(!$solvedHomework->exists())
                        $question["choosen"] = 0;
                    else
                        $question["choosen"] = $solvedHomework->first()->choosen;
                }
                return $this->success(        
                    ModelAnswerResource::collection($questions),
                    'data sent successfully',
                    200);
            
        }
        return $this->error('', 'Homework Not Finished Yet', 401);
    }

    public function getUserAnswers($id)
    {
            $user_homework = UserHomeworks::find($id);
            $user_id = $user_homework->users_id;
            $homework_id = $user_homework->homeworks_id;
             $questions = Homeworks::find($homework_id)->questions;
                foreach($questions as $question){
                    $solvedHomework = SolvedHomeworks::where('user_id', $user_id)->where('homework_id', $homework_id)->where('question_id', $question->id);
                    if(!$solvedHomework->exists())
                        $question["choosen"] = 0;
                    else
                        $question["choosen"] = $solvedHomework->first()->choosen;
                }
                return $this->success(        
                    ModelAnswerResource::collection($questions),
                    'data sent successfully',
                    200);
            
        
        return $this->error('', 'Homework Not Finished Yet', 401);
    }

    public function clearStudent($userId, $id)
    {
        $userHomework = Userhomeworks::where('users_id', $userId)->where('homeworks_id', $id);
        $userHomework->delete();
        $solvedQuestions = Solvedhomeworks::where('user_id', $userId)->where('homework_id', $id);
        $solvedQuestions->delete();
        return $this->success('', 'User Cleared Successfully', 200);
    }
}
