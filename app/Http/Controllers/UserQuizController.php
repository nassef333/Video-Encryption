<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnrollQuizResource;
use App\Http\Resources\ModelAnswerResource;
use App\Http\Resources\QuizStudentsResource;
use App\Http\Resources\TopRatedQuizStudents;
use App\Models\Questions;
use App\Models\Quizzes;
use App\Models\QuizQuestions;
use App\Models\SolvedQuizzes;
use App\Models\Users;
use App\Models\UserQuizzes;
use App\Models\UserWeeks;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserQuizController extends Controller
{
    use HttpResponses;

    //for admin
    public function studentQuizzes($id)
    {
        // return 'hamadaa';
        if (!User::where('id', $id)->exists())
            return $this->error('', 'User Not Found...', 404);
        return $this->success(Users::find($id)->quizzes, 'User Found.', 200);
    }

    //for user
    public function myQuizzes()
    {
        $myQuizzes = Auth::user()->quizzes;
        $quizzes = [];
        foreach($myQuizzes as $quiz){
            if($quiz->answerTime == 1 && $quiz->end > date('Y-m-d H:i:s', time()));
            else $quizzes[] = $quiz;
        }
        return $this->success($quizzes, 'ok.', 200);
    }
    

    public function QuizStudents($id)
    {
        if (!Quizzes::where('id', $id)->exists())
            return $this->error('', 'Quiz Not Found...', 404);
        return $this->success(QuizStudentsResource::collection(
            Quizzes::find($id)->users
        ), 'Quiz Found.', 200);
    }

    private function addTime($timestamp, $minutes_to_add)
    {
        $datetime = new DateTime($timestamp);
        $interval = new DateInterval("PT{$minutes_to_add}M");
        $datetime->add($interval);
        $formatted_timestamp = $datetime->format('Y-m-d\TH:i:s.u\Z');
        return $formatted_timestamp;
    }
    
public function userEnrollQuiz($id)
    {
        if(!Quizzes::where('id', $id)->exists())
            return $this->error('', 'Quiz not found...', 401); 
        // return Quizzes::find($id)->week->id;
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', Quizzes::find($id)->week->id)->exists())
            return $this->error('', 'You Have not Enrolled This Week yet...', 402);
	
            $userQuizzes = UserQuizzes::where('users_id', Auth::id())->where('quizzes_id', $id);
            if($userQuizzes->exists()) {
                if($userQuizzes->first()->state == 1){
                    return $this->error('', 'You Have Finished This Quiz...', 468);
                }
            }

        $time = date('Y-m-d H:i:s', time());    
        $valid = Quizzes::find($id);
        if($valid->start > $time )
            return $this->error('', 'This Quiz Not Started Yet', 449);

        if($valid->end < $time)
            return $this->error('', 'This Quiz has been Ended', 448);

        $user = Auth::user();
        // return $user->quizzes;
        foreach ($user->quizzes as $quiz) {
            if ($quiz->id == $id) {
                // echo 'Quiz started at ' . $quiz->start . ' and now time is ' . $time . ' and it will be available for ' . $quiz->end;
                // echo 'You have been enrolled this week on ' . date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)) . ' and it will be available for '. $quiz->minutes. ' minutes which means '. date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)+60*$quiz->minutes);
                if ($quiz->start < $time and $quiz->end > $time) {
                    if (date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at) + 60 * $quiz->minutes) > $time) {
                    //     //here we pass questions
                    //     return  [date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)),
                    //     date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at) + 60 * $quiz->minutes),
                    //     $time,
                    //     (strtotime($quiz->pivot->created_at) + 60 * $quiz->minutes - strtotime($time))
                    // ];

                    $userQuestions = SolvedQuizzes::where('quiz_id', $id)->where('user_id', Auth::user()->id);
                    $questions = [];
                    
                    foreach ($userQuestions->get() as $oneQuestion) {
                        $newQuestion = Questions::find($oneQuestion->question_id);
                        $newQuestion["degree"] = $oneQuestion->degree;
                        $newQuestion["choosen"] = $oneQuestion->choosen;
                        $questions[] = $newQuestion;
                    }
                    // return $questions;
                        $studentTime = strtotime($quiz->pivot->created_at) + 60 * $quiz->minutes - strtotime($time);
                        $quizTime = strtotime($quiz->end) - strtotime($time);
                        return $this->success(EnrollQuizResource::collection(
                        $questions
                        ), min($studentTime, $quizTime), 200);                      }
                    return $this->error('', 'Time Limit Out...', 403);
                } else {
                    return $this->error('', 'This Quiz has been Ended', 403);
                }
                return $this->error('', 'You have Enrolled this Quiz before...', 405);
            }
        }        
        //First time to enroll this question
        //initialize new user_quiz with degree and increment by time


        $quiz = Quizzes::find($id);
        // return $quiz;
        $questions = $quiz->questions->random($quiz->noquestions)->shuffle();
        $newUserQuiz = new UserQuizzes;
        $newUserQuiz->users_id = Auth::user()->id;
        $newUserQuiz->quizzes_id = $id;
        $newUserQuiz->score = 0;
        $newUserQuiz->save();
        // return $newUserQuiz;
        foreach ($questions as $question) {
            $solvedQuiz = new SolvedQuizzes;
            $solvedQuiz->user_id = Auth::user()->id;
            $solvedQuiz->question_id = $question->id;
            $solvedQuiz->choosen = "0";
            $solvedQuiz->quiz_id = $id;
            $solvedQuiz->true = $question->answer;
            $solvedQuiz->degree = QuizQuestions::where('quizzes_id', $id)->where('questions_id', $question->id)->first()->degree;
            $solvedQuiz->save();
        }
        // return Quizzes::find($id)->minutes;


                $studentTime = 60 * $quiz->minutes;
        $quizTime = strtotime($quiz->end) - strtotime($time);
        
        return $this->success($questions, min($studentTime, $quizTime), 200);
    }

    public function submitQuestion(Request $request, $id, $question_id)
    {
	//return $request;
        //$validated_data = $request->validate([
        //    'choosen' => ['required', 'numeric'],
        //]);
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', Quizzes::find($id)->week->id)->exists())
            return $this->error('', 'You Have not Enrolled This Week yet...', 401);

        $oldQuestion = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->where('question_id', $question_id);
        $solvedQuiz = $oldQuestion->first();
        $solvedQuiz->choosen = $request->choosen;
        $solvedQuiz->save();

        $userQuiz = UserQuizzes::where('users_id', Auth::user()->id)->where('quizzes_id', $id)->first();
        $score = SolvedQuizzes::whereColumn('true', 'choosen')->where('user_id', Auth::user()->id)->where('quiz_id', $id)->sum('degree');
        $userQuiz->score = $score;
        $userQuiz->save();
        return $this->success('', 'Data Send Successfully.', 200);
    }

    // public function getAnswers($id)
    // {
    //     $user_quiz = UserQuizzes::where('users_id', Auth::user()->id)->where('quizzes_id', $id);
    //     if(!$user_quiz->exists())
    //         return $this->error('', 'You Have not Enrolled This Quiz yet...', 401);

    //     $time = date('Y-m-d H:i:s', time());
    //     $quizTime = Quizzes::find($id)->minutes;
    //     $endTime = date('Y-m-d H:i:s', strtotime($user_quiz->first()->created_at) + 60 * $quizTime);

    //     if ($time > $endTime) {            
    //         $questions = [];
    //         $MyQuestions = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->get();

    //         foreach($MyQuestions as $MyQuestion) {
    //             $question = Questions::find($MyQuestion->question_id);
    //             $question["choosen"] = $MyQuestion->choosen;
    //             $question["degree"] = $MyQuestion->degree;
    //             $questions[] = $question;
    //         }

    //         foreach($questions as $question){
    //                 $solvedQuiz = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->where('question_id', $question->id);
    //                 if(!$solvedQuiz->exists())
    //                     $question["choosen"] = 0;
    //                 else
    //                     $question["choosen"] = $solvedQuiz->first()->choosen;
    //             }
    //             return $this->success(        
    //                 ModelAnswerResource::collection($questions),
    //                 'data sent successfully',
    //                 200);
            
    //     }
    //     return $this->error('', 'Quiz Not Finished Yet', 401);
    //     // return ['quiz Created at '.$user_quiz->first()->created_at , 'and still for '.$quizTime, ' and it means its'.$endTime, $time];
    //     // return $endTime;
    //     // date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)+60*$quiz->minutes)
    // }


        public function getAnswers($id)
    {
        $user_quiz = UserQuizzes::where('users_id', Auth::user()->id)->where('quizzes_id', $id);
        if(!$user_quiz->exists())
            return $this->error('', 'You Have not Enrolled This Quiz yet...', 401);
            
        $quiz = Quizzes::find($id);
        $time = date('Y-m-d H:i:s', time());
        $quizTime = $quiz->minutes;
        //end time for user (start + quiz time) 
        $endTime = date('Y-m-d H:i:s', strtotime($user_quiz->first()->created_at) + 60 * $quizTime);
        $whereToShow = $quiz->answerTime;
        //End of quiz
        $quizClosingIn = $quiz->end;
        // return $whereToShow;
        if($whereToShow == 0){
            if(UserQuizzes::where('users_id', Auth::id())->where('quizzes_id', $id)->first()->state == 1){
                $questions = [];
                $MyQuestions = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->get();
    
                foreach($MyQuestions as $MyQuestion) {
                    $question = Questions::find($MyQuestion->question_id);
                    $question["choosen"] = $MyQuestion->choosen;
                    $question["degree"] = $MyQuestion->degree;
                    $questions[] = $question;
                }
    
                foreach($questions as $question){
                        $solvedQuiz = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->where('question_id', $question->id);
                        if(!$solvedQuiz->exists())
                            $question["choosen"] = 0;
                        else
                            $question["choosen"] = $solvedQuiz->first()->choosen;
                    }
                    return $this->success(        
                        ModelAnswerResource::collection($questions),
                        'data sent successfully',
                        200);
            }
            else if ($time > $endTime) {       
                $questions = [];
                $MyQuestions = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->get();
    
                foreach($MyQuestions as $MyQuestion) {
                    $question = Questions::find($MyQuestion->question_id);
                    $question["choosen"] = $MyQuestion->choosen;
                    $question["degree"] = $MyQuestion->degree;
                    $questions[] = $question;
                }
    
                foreach($questions as $question){
                        $solvedQuiz = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->where('question_id', $question->id);
                        if(!$solvedQuiz->exists())
                            $question["choosen"] = 0;
                        else
                            $question["choosen"] = $solvedQuiz->first()->choosen;
                    }
                    return $this->success(        
                        ModelAnswerResource::collection($questions),
                        'data sent successfully',
                        200);
            }
            else 
            return $this->error('', 'Please Complete Quiz..', 468);
        }

        else if($whereToShow == 1){
            if ($time > $quizClosingIn) {            
                $questions = [];
            $MyQuestions = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->get();

            foreach($MyQuestions as $MyQuestion) {
                $question = Questions::find($MyQuestion->question_id);
                $question["choosen"] = $MyQuestion->choosen;
                $question["degree"] = $MyQuestion->degree;
                $questions[] = $question;
            }

            foreach($questions as $question){
                    $solvedQuiz = SolvedQuizzes::where('user_id', Auth::user()->id)->where('quiz_id', $id)->where('question_id', $question->id);
                    if(!$solvedQuiz->exists())
                        $question["choosen"] = 0;
                    else
                        $question["choosen"] = $solvedQuiz->first()->choosen;
                }
                return $this->success(        
                    ModelAnswerResource::collection($questions),
                    'data sent successfully',
                    200);
            }
            else 
            return $this->error('', 'Please Wait till Quiz Time Finish..', 469);
        }
        
        // return ['quiz Created at '.$user_quiz->first()->created_at , 'and still for '.$quizTime, ' and it means its'.$endTime, $time];
        // return $endTime;
        // date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)+60*$quiz->minutes)
    }    public function getUserAnswers($id)
    {
        $user_quiz = UserQuizzes::find($id);
        $user_id = $user_quiz->users_id;
        $quiz_id = $user_quiz->quizzes_id;

                $questions = [];
                $MyQuestions = SolvedQuizzes::where('user_id', $user_id)->where('quiz_id', $quiz_id)->get();

                foreach($MyQuestions as $MyQuestion) {
                    $question = Questions::find($MyQuestion->question_id);
                    $question["choosen"] = $MyQuestion->choosen;
                    $question["degree"] = $MyQuestion->degree;
                    $questions[] = $question;
                }

                return $this->success(        
                    ModelAnswerResource::collection($questions),
                    'data sent successfully',
                    200);
            
        
        return $this->error('', 'Quiz Not Finished Yet', 401);
        // return ['quiz Created at '.$user_quiz->first()->created_at , 'and still for '.$quizTime, ' and it means its'.$endTime, $time];
        // return $endTime;
        // date('Y-m-d H:i:s', strtotime($quiz->pivot->created_at)+60*$quiz->minutes)
    }

    public function topRated($id){
        $quiz = Quizzes::find($id);
        $time = date('Y-m-d H:i:s', time());
        $quizTime = $quiz->minutes;
        $topRating = UserQuizzes::where('score', '>=', $quiz->prizeDegree)->where('quizzes_id', $id)->orderBy('score')->orderBy('created_at', 'desc')->get();
	    $mydegree = UserQuizzes::where('quizzes_id', $id)->where('users_id', Auth::user()->id)->first();

	if ($mydegree === null)
    		$mydegree = 0;
	else
    		$mydegree = $mydegree->score;

    $topStudents = [];
	if($quiz->answerTime == 1 && $quiz->end > date('Y-m-d H:i:s', time())){
        $quiz['myDegree'] = 0;
    }
	else {
        foreach($topRating as $top){
            $endTime = date('Y-m-d H:i:s', strtotime($top->first()->created_at) + 60 * $quizTime);
            if ($time > $endTime)
                $topStudents[] = $top;
        }
        $quiz['myDegree'] = $mydegree;
    }
        return [$quiz, TopRatedQuizStudents::collection(
            array_reverse($topStudents)
        )];
    }
    public function clearStudent($userId, $id)
    {
        $userQuiz = UserQuizzes::where('users_id', $userId)->where('quizzes_id', $id);
        $userQuiz->delete();
        $solvedQuestions = SolvedQuizzes::where('user_id', $userId)->where('quiz_id', $id);
        $solvedQuestions->delete();
        return $this->success('', 'User Cleared Successfully', 200);
    }

    public function finish($id){
        $userQuiz = UserQuizzes::where('users_id', Auth::id())->where('quizzes_id', $id)->first();
        $userQuiz->state = 1;
        $userQuiz->save();
    }

    public function refreshDegrees($id){
        $usersQuizzes = UserQuizzes::where('quizzes_id', $id)->get();
        $solvedQuizzes = SolvedQuizzes::where('quiz_id', $id)->get();
        foreach($solvedQuizzes as $solvedQuiz){
            $true = Questions::find($solvedQuiz->question_id)->answer;
            $solvedQuiz->true = $true;
            $solvedQuiz->save();
        }
        foreach ($usersQuizzes as $userQuiz) {
            $score = SolvedQuizzes::whereColumn('true', 'choosen')
                        ->where('user_id', $userQuiz->users_id)
                        ->where('quiz_id', $id)
                        ->sum('degree');
            $userQuiz->score = $score;
            $userQuiz->save();
        }
        return $this->success($usersQuizzes, 'degrees updated successfully', 200);
    } 
}
