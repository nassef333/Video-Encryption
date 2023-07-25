<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeworkRequest;
use App\Http\Resources\HomeworkResource;
use App\Models\Homeworks;
use App\Models\UserHomeworks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class HomeworkController extends Controller
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
        return HomeworkResource::collection(
            Homeworks::get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeworkRequest $request)
    {
	$request->validated($request->all());
        $homework = Homeworks::create([
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
            'cdn' => '',
        ]);
        if($request->hasFile('cdn')){
            $homework['cdn'] = $request->file('cdn')->store('homeworks', 'public');
            $homework->save();
        }
        return $this->success(new HomeworkResource($homework), 'Homework Created Successfully.', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Homeworks $homework)
    {
        if (!$homework->exists())
            return $this->error('', 'Not Found...', 401);
        return new HomeworkResource($homework);
    }

    public function showLevelHomeworks($id)
    {
        if ($id < 1 || $id > 3)
            return $this->error('', 'Not Found', 404);
        return HomeworkResource::collection(
            Homeworks::where('level', $id)->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homeworks $homework)
    {
        // return $request;
        $homework->update($request->all());
        if($request->hasFile('cdn')){
            $homework['cdn'] = $request->file('cdn')->store('homeworks', 'public');
            $homework->save();
        }
        return $this->success(new HomeworkResource($homework), 'Homework Updated Successfully.', 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homeworks $homework)
    {
        $homework->delete();
        return $this->success('', 'Homework Deleted succesfuly.', 200);
    }

    public function clearStudent($id)
    {
        $studentHomework = UserHomeworks::find($id);
    
        if ($studentHomework) {
            $studentHomework->delete();
            return response()->json(['message' => 'Student Homework deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student Homework not found'], 404);
        }
    }

    public function homeworkStudents(Request $request, $homework_id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchQuizStudents($request, $homework_id);
        
        $students = Homeworks::where('id', $homework_id)->first()->users()->paginate(20);
        return view('courses.homework-students', compact('students'));
    }

    public function searchQuizStudents(Request $request, $homework_id)
    {
        $searchTerm = $request->query('searchTerm');
    
        // Split the search term into fname and lname
        $nameParts = explode(' ', $searchTerm);
        $fname = $nameParts[0] ?? '';
        $lname = $nameParts[1] ?? '';
    
        $students = Homeworks::where('id', $homework_id)->first()->users()
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
    
        return view('homework.students', compact('students', 'searchTerm'));
    }
}
