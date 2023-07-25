<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Homeworks;
use App\Models\LevelData;
use App\Models\Materials;
use App\Models\Quizzes;
use App\Models\Users;
use App\Models\UserWeeks;
use App\Models\Videos;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->search($request);
        
        $courses = Course::paginate(20);
    
        return view('courses.index', compact('searchTerm', 'courses'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $courses = Course::where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('level', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('courses.index', compact('searchTerm', 'courses'));
    }

    public function yearCourses(Request $request, $id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchYearCourses($request, $id);
        
        $courses = Course::where('level', $id)->paginate(20);
    
        return view('courses.index', compact('searchTerm', 'courses'));
    }

    public function searchYearCourses(Request $request, $id)
    {
        $searchTerm = $request->query('searchTerm');
        $courses = Course::where('level', $id)->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('level', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('courses.index', compact('searchTerm', 'courses'));
    }

    public function addExistWeek($id)
    {
        $weeks = Weeks::all();
        return view('courses.add-exist-week', compact('weeks', 'id'));
    }

    public function submitExistWeek(Request $request)
    {
        // return $request;
        DB::table('course_weeks')->insert([
            'course_id' => $request->courseId,
            'weeks_id' => $request->weeks_id,
        ]);
        return redirect('/courses/' . $request->courseId . '/content');
    }

    public function removeCourseWeek($course_id, $weeks_id)
    {
        DB::table('course_weeks')
            ->where('course_id', $course_id)
            ->where('weeks_id', $weeks_id)
            ->delete();
    
        return redirect('/courses/' . $course_id . '/content');
    }
    
    

    public function publish($id)
    {
        $course = Course::findOrFail($id);
        $course->is_published = 1 - $course->is_published;
        $course->save();
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function create(Request $request)
    {
        return view('courses.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'img' => '',
            'price' => $request->price,
            'level' => $request->level,
        ]);
        
        if($request->hasFile('img')){
            $course['img'] = $request->file('img')->store('courses', 'public');
            $course->save();
        }
        // return $course;
        $level = LevelData::find($course->level);
        $level->courses = Course::where('level', $course->level)->count();
        $level->save();
        return redirect('/courses/year/'.$course->level);
    }

    public function weekContent($course_id) 
    {
        $course = Course::find($course_id);
        $videos = Videos::where('week_id', $course_id)->get();
        $exams = Quizzes::where('week_id', $course_id)->get();
        $homeworks = Homeworks::where('week_id', $course_id)->get();
        $materials = Materials::where('week_id', $course_id)->get();
        return view('courses.week_content', compact('course', 'videos', 'exams', 'homeworks', 'materials'));
    }
    
    public function CourseContent($id)
    {
        $course = Course::find($id);
        $weeks = $course->weeks;
        return view('courses.course_content', compact('course', 'weeks'));
    }

    public function addVideo()
    {
        return view('courses.add-video');
    }

    public function storeVideo(Request $request)
    {
        $level = Weeks::find($request->week_id)->level;
        $video = Videos::create([
            'iframe' => $request->iframe,
            'noviews' => $request->noviews,
            'minutes_views' => $request->minutes_views,
            'type' => $request->type,
            'video_dauration' => $request->video_dauration,
            'title' => $request->title,
            'week_id' => $request->week_id,
            'level' => $level,
        ]);
        $level = LevelData::find($video->level);
        $level->videos = Videos::where('level', $video->level)->count();
        $level->save();
        return redirect("/weeks/{$video->week_id}/content");
    }

    public function addQuiz()
    {
        return view('courses.add-quiz');
    }

    public function storeQuiz(Request $request)
    {
        // return $request;
        $level = Weeks::find($request->week_id)->level;
        $quiz = Quizzes::create([
            'title' => $request->title,
            'img' => '',
            'minutes' => $request->minutes,
            'start' => $request->start,
            'end' => $request->end,
            'level' => $level,
            'week_id' => $request->week_id,
            'answerTime' => $request->answerTime,
            'prize' => $request->prize,
            'prizeDegree' => $request->prizeDegree,
            'is_random' => $request->is_random,
        ]);

        if($request->hasFile('img')){
            $quiz['img'] = $request->file('img')->store('quizzes', 'public');
            $quiz->save();
        }
        return $this->success($quiz, "Quiz Stored.", 200);
    }

    public function addMaterial()
    {
        return view('courses.add-material');
    }

    public function storeMaterial(Request $request)
    {
        $material = Materials::create([
            'week_id' => $request->week_id,
            'cdn' => '',
            'title' => $request->title,
        ]);

        if($request->hasFile('cdn')){
            $material['cdn'] = $request->file('cdn')->store('materials', 'public');
            $material->save();
        }
        return redirect("/weeks/{$material->week_id}/content");
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
	//return $request;
        $course = Course::find($id);
        // return $question;
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'img' => '',
            'price' => $request->price,
            'level' => $request->level,
        ]);
        
        if($request->hasFile('img')){
            $course['img'] = $request->file('img')->store('courses', 'public');
            $course->save();
        }
        return redirect('/courses');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        $level = LevelData::find($course->level);
        $level->courses = Course::where('level', $course->level)->count();
        $level->save();
        return $this->success('', 'Course Deleted succesfuly.', 200);
    }


    public function addWeek($id)
    {
        return view('courses.add-week', compact('id'));
    }

    public function storeWeek(Request $request)
    {
        $level = Course::find($request->courseId)->level;
        $week = Weeks::create([
            'name' => $request->name,
            'level' => $level,
        ]);

        DB::table('course_weeks')->insert([
            'course_id' => $request->courseId,
            'weeks_id' => $week->id,
        ]);

        return redirect("/courses/{$request->course_id}/content");
    }

    public function clearStudent($id){
        $studentWeek = UserWeeks::find($id);
    
        if ($studentWeek) {
            $studentWeek->delete();
            return response()->json(['message' => 'Student week deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student week not found'], 404);
        }
    }

    // public function CourseStudents($course_id)
    // {
    //     $students = Course::where('id', $course_id)->first()->students()->paginate(20);
    //     return view('courses.students', compact('students'));
    // }

    public function CourseStudents(Request $request, $course_id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchCourseStudents($request, $course_id);
        
        $students = Course::where('id', $course_id)->first()->students()->paginate(20);
        return view('courses.students', compact('students'));
    }

    public function searchCourseStudents(Request $request, $course_id)
    {
        $searchTerm = $request->query('searchTerm');
    
        // Split the search term into fname and lname
        $nameParts = explode(' ', $searchTerm);
        $fname = $nameParts[0] ?? '';
        $lname = $nameParts[1] ?? '';
    
        $students = Course::where('id', $course_id)->first()->students()
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
    
        return view('courses.students', compact('students', 'searchTerm'));
    }
    


    

}
