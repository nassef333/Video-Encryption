<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\LevelData;
use App\Models\Questions;
use App\Models\QuizQuestions;
use App\Models\Quizzes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->search($request);
        
        $questions = Questions::paginate(20);
    
        return view('questions.index', compact('searchTerm', 'questions'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $questions = Questions::where(function ($query) use ($searchTerm) {
                $query->where('question', 'like', "%$searchTerm%")
                ->orWhere('lesson', 'like', "%$searchTerm%")
                ->orWhere('answer', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('questions.index', compact('searchTerm', 'questions'));
    }

    public function edit(Questions $question)
    {
        return view('questions.edit', compact('question'));
    }


    public function create(Request $request)
    {
        return view('questions.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $quiz = Quizzes::find((int)$request->quiz_id);
        $question = Questions::create([
            'img' => '',
            'question' => $request->question,
            'level' => $quiz->level,
            'c1' => $request->c1,
            'c1_img' => '',
            'c2' => $request->c2,
            'c2_img' => '',
            'c3' => $request->c3,
            'c3_img' => '',
            'c4' => $request->c4,
            'c4_img' => '',
            'answer' => $request->answer,
            'lesson' => $quiz->week->name,
        ]);

        // return $question;
        if($request->hasFile('img')){
            $question['img'] = $request->file('img')->store('questions', 'public');
            $question->save();
        }

        $quizQuestion = new QuizQuestions();
        $quizQuestion->quizzes_id = (int)$request->quiz_id;
        $quizQuestion->questions_id = $question->id;
        $quizQuestion->degree = $request->degree;
        $quizQuestion->save();

        $quiz->noquestions = QuizQuestions::where('quizzes_id', $quiz->id)->where('deleted_at', NULL)->count();
        $quiz->degree = QuizQuestions::where('quizzes_id', $quiz->id)->where('deleted_at', NULL)->sum('degree');
        $quiz->mindegree = $quiz->degree/2;
        $quiz->save();


        $level = LevelData::find($question->level);
        $level->questions = Questions::where('level', $question->level)->count();
        $level->save();
        return $this->success($question, "success", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Questions::where('id', $id)->exists())
            return $this->error('', 'Not Found', 404);
        $question = Questions::find($id);
        return new QuestionResource($question);
    }    
    
    public function showLevelQuestions($id)
    {
        if ($id < 1 || $id > 3)
        return $this->error('', 'Not Found', 404);
        return QuestionResource::collection(
            Questions::where('level', $id)->get()
        );
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Questions::find($id);
        $question->update(['question' => $request->question, 'level' => $request->level, 'c1' => $request->c1, 'c2' => $request->c2, 'c3' => $request->c3, 'c4' => $request->c4, 'answer' => $request->answer, 'lesson' => $request->lesson]);
        
        if($request->hasFile('img')){
            $question['img'] = $request->file('img')->store('questions', 'public');
            $question->save();
        }

        $quizQuestion = QuizQuestions::where('questions_id', $question->id)->first();
        return redirect('/exams/'.$quizQuestion->quizzes_id.'/questions');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $question)
    {
        $level = LevelData::find($question->level);
        $level->questions = Questions::where('level', $question->level)->count();
        $level->save();
        
        $quizQuestion = QuizQuestions::where('questions_id', $question->id)->first();
        $quiz = Quizzes::find($quizQuestion->quizzes_id);
        $quiz->noquestions = $quiz->noquestions-1;
        $quiz->degree = $quiz->degree - $quizQuestion->degree;
        $quiz->mindegree = $quiz->degree / 2;
        $quiz->save();
        $quizQuestion->delete();
        $question->delete();

        return $this->success('', 'Question Deleted succesfuly.', 200);
    }
}
