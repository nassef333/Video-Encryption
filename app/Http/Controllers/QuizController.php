<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuizResource;
use App\Http\Resources\VideoResource;
use App\Models\LevelData;
use App\Models\Questions;
use App\Models\Quizquestions;
use App\Models\Quizzes;
use App\Models\UserQuizzes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $date = "11/11/2024 05:40 AM"
        return QuizResource::collection(
            Quizzes::get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request)
    {
	$request->validated($request->all());
        $quiz = Quizzes::create([
            'week_id' => $request->week_id,
            'title' => $request->title,
            'minutes' => $request->minutes,
            'degree' => $request->degree,
            'mindegree' => $request->mindegree,
            'answerTime' => $request->answerTime,
            'start' => date('Y-m-d H:i:s', strtotime($request->start)),
            'end' => date('Y-m-d H:i:s', strtotime($request->end)),
            'level' => $request->level,
            'noquestions' => $request->noquestions,
            'prize' => $request->prize,
            'prizeDegree' => $request->prizeDegree,
            'cdn' => '',
        ]);
        if($request->hasFile('cdn')){
            $quiz['cdn'] = $request->file('cdn')->store('quizzes', 'public');
            $quiz->save();
        }
        $level = LevelData::find($quiz->level);
        $level->quizzes = Quizzes::where('level', $quiz->level)->count();
        $level->save();
        return $this->success(new QuizResource($quiz), 'Quiz Created Successfully.', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quizzes $quiz)
    {
        if (!$quiz->exists())
            return $this->error('', 'Not Found...', 401);
        return new QuizResource($quiz);
    }

    public function showLevelQuizzes($id)
    {
        if ($id < 1 || $id > 3)
            return $this->error('', 'Not Found', 404);
        return QuizResource::collection(
            Quizzes::where('level', $id)->get()
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quizzes $quiz)
    {
        // return $request;
        $quiz->update($request->all());
        if($request->hasFile('cdn')){
            $quiz['cdn'] = $request->file('cdn')->store('quizzes', 'public');
            $quiz->save();
        }
        return $this->success(new QuizResource($quiz), 'Quiz Updated Successfully.', 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quizzes $quiz)
    {
        $quiz->delete();
        $level = LevelData::find($quiz->level);
        $level->quizzes = Quizzes::where('level', $quiz->level)->count();
        $level->save();
        return $this->success('', 'Quiz Deleted succesfuly.', 200);
    }

    public function clearStudent($id)
    {
        $studentQuiz = UserQuizzes::find($id);
    
        if ($studentQuiz) {
            $studentQuiz->delete();
            return response()->json(['message' => 'Student Exam deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student Exam not found'], 404);
        }
    }

    public function examsStudents(Request $request, $quiz_id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchQuizStudents($request, $quiz_id);
        
        $students = Quizzes::where('id', $quiz_id)->first()->users()->paginate(20);
        return view('courses.quiz-students', compact('students'));
    }

    public function searchQuizStudents(Request $request, $quiz_id)
    {
        $searchTerm = $request->query('searchTerm');
    
        // Split the search term into fname and lname
        $nameParts = explode(' ', $searchTerm);
        $fname = $nameParts[0] ?? '';
        $lname = $nameParts[1] ?? '';
    
        $students = Quizzes::where('id', $quiz_id)->first()->users()
            ->where(function ($query) use ($fname, $lname, $searchTerm) {
                $query->where(function ($query) use ($fname, $lname) {
                    $query->where('fname', 'like', "%$fname%")
                          ->where('lname', 'like', "%$lname%");
                })
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->orWhere('pphone', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['courses.quiz-students' => $searchTerm]);
    
        return view('courses.quiz-students', compact('students', 'searchTerm'));
    }

    // public function examsQuestions($quiz_id)
    // {
    //     $quiz = Quizzes::find($quiz_id);
    //     $questions = $quiz->questions()->paginate(20);
    //     return view('questions.quiz-questions', compact('questions'));
    // }

    public function examsQuestions(Request $request, $quiz_id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchQuestion($request, $quiz_id);
        
        $quiz = Quizzes::find($quiz_id);
        $questions = $quiz->questions()->paginate(20);
        return view('questions.quiz-questions', compact('questions'));
    }

    public function searchQuestion(Request $request, $quiz_id)
    {
        $searchTerm = $request->query('searchTerm');
        $questions = $quiz = Quizzes::find($quiz_id)->questions()
            ->where(function ($query) use ($searchTerm) {
                $query->where('question', 'like', "%$searchTerm%")
                    ->orWhere('lesson', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('questions.quiz-questions', compact('questions'));
    }
}
