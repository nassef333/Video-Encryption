<?php

namespace App\Http\Controllers;

use App\Http\Resources\checkedQuestionsResource;
use App\Http\Resources\QuestionResource;
use App\Models\LevelData;
use App\Models\Questions;
use App\Models\QuizQuestions;
use App\Models\QuizQuestions as ModelsQuizQuestions;
use App\Models\Quizzes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    use HttpResponses;

    public function show($id)
    {
        if (!Quizzes::where('id', $id)->exists())
            return $this->error('', 'Not Found', 404);
        return Quizzes::find($id)->questions;      
    }

    public function getChecked($id){
        $arr = [];
        $quiz = Quizzes::find($id);
        $subArr = $quiz->questions;      
        
        $allQuestions = Questions::where('level', $quiz->level)->get();

        foreach($allQuestions as $question){
            $question['state'] = '0';
            $question['degree'] = '';
        }
        foreach($allQuestions as $question){
            foreach($subArr as $sub){
                if($question['id'] == $sub['id']){
                    $question['state'] = '1';
                }
            }
        }
        foreach($allQuestions as $question){
            $quo = QuizQuestions::where('questions_id', $question->id)->where('quizzes_id', $id);
            if(!$quo->exists());
            else{
                $question['degree'] = $quo->first()->degree;
            }
        }
        return checkedQuestionsResource::collection(
            $allQuestions
        );
    }

    public function editData(Request $request, $id)
    {
        // return $request;
        $quiz = Quizzes::where('id', $id);
        if (!$quiz->exists())
            return $this->error('', 'Not Found', 404);
        if(empty($request->question_id))
            return $this->errror('', 'Data Not Sent...', 401);

        QuizQuestions::where('quizzes_id', $id)->delete();
        $questions = $request;
        $n = sizeof($questions->question_id);
        for ($i = 0; $i < $n; $i++) {
            $quiz_question = new Quizquestions;
            $quiz_question->quizzes_id = $id;
            $quiz_question->questions_id = $questions->question_id[$i];
            $quiz_question->degree = $questions->degree[$i];
            $quiz_question->save();
        }
        $quiz_level = $quiz->first()->level;
        $level = LevelData::find($quiz_level);
        $level->questions = Questions::where('level', $quiz_level)->count();
        $level->save();
        return $this->success('', 'Quiz Created Successfully', 200);
    }
}
