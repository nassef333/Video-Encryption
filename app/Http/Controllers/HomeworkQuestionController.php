<?php

namespace App\Http\Controllers;

use App\Http\Resources\checkedQuestionsResource;
use App\Models\HomeworkQuestions;
// use App\Models\HomeworkQuestions;
use App\Models\Homeworks;
use App\Models\Questions;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class HomeworkQuestionController extends Controller
{
    use HttpResponses;

    public function show($id)
    {
        if (!Homeworks::where('id', $id)->exists())
            return $this->error('', 'Not Found', 404);
        return Homeworks::find($id)->questions;      
    }

    public function getChecked($id){
        $arr = [];
        $subArr = Homeworks::find($id)->questions;      
        
        $allQuestions = Questions::get();

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
            $quo = HomeworkQuestions::where('question_id', $question->id)->where('homework_id', $id);
            if(!$quo->exists());
            else{
                $question['degree'] = $quo->first()->degree;
            }
        }
        return checkedQuestionsResource::collection(
            $allQuestions->sortBy('state', SORT_REGULAR, true)
        );
    }

    public function editData(Request $request, $id)
    {
        // return $request;
        if (!Homeworks::where('id', $id)->exists())
            return $this->error('', 'Not Found', 404);
        if(empty($request->question_id))
            return $this->errror('', 'Data Not Sent...', 401);

        HomeworkQuestions::where('homework_id', $id)->delete();
        $questions = $request;
        $n = sizeof($questions->question_id);
        for ($i = 0; $i < $n; $i++) {
            $homework_question = new HomeworkQuestions;
            $homework_question->homework_id = $id;
            $homework_question->question_id = $questions->question_id[$i];
            $homework_question->degree = $questions->degree[$i];
            $homework_question->save();
        }
        $degree = HomeworkQuestions::where('homework_id', $id)->sum('degree');
        $newHomework = Homeworks::find($id);
        $newHomework->degree = $degree;
        $newHomework->mindegree = $degree/2;
        $newHomework->save();
        return $this->success('', 'Homework Created Successfully', 200);
    }
}
