<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HomeworkQuestionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHomeworkController;
use App\Http\Controllers\UserQuizController;
use App\Http\Controllers\UserVideosEnrollController;
use App\Http\Controllers\UserWeekEnrollController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WeekController;
use App\Http\Controllers\YearController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(["middleware" => "guest"], function () {
    Route::view('/login', 'auth.login')->name('login')->name('loginForm');
    Route::post('/loginRequest', [AuthController::class, 'adminLogin'])->name('login.submit');
});


Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin/logout', [AuthController::class, 'logout']);
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    
        //user
        Route::resource('/users', UserController::class);
        Route::get('/approve-user/{id}',  [UserController::class, 'approveUser']);
        Route::get('/users/{user_id}/profile',  [UserController::class, 'userStatistics']);
    
        //questions
        Route::resource('/questions', QuestionController::class);

        //videos
        Route::resource('/videos',  VideoController::class);

        //transactions
        Route::resource('transactions', TransactionController::class);

        //Codes
        Route::resource('codes', CodeController::class);
        Route::get('clear-code/{code_id}', [CodeController::class, 'clear']);

        //courses
        Route::resource('courses', CourseController::class);
        Route::get('publish-course/{course_id}', [CourseController::class, 'publish']);
        Route::get('courses/{course_id}/content', [CourseController::class, 'CourseContent']);
        Route::get('add-exist-week/{week_id}', [CourseController::class, 'addExistWeek']);
        Route::get('course/{course_id}/week/{Week_id}/clear', [CourseController::class, 'removeCourseWeek']);
        Route::post('submit-exist-week', [CourseController::class, 'submitExistWeek']);
        Route::get('weeks/{week_id}/content', [CourseController::class, 'WeekContent']);
        Route::get('courses/{course_id}/students', [CourseController::class, 'CourseStudents']);
        Route::get('/courses/students/clear/{id}', [CourseController::class, 'clearStudent']);
        Route::get('videos/{course_id}/students', [VideoController::class, 'VideosStudents']);
        Route::get('/videos/students/clear/{id}', [VideoController::class, 'clearStudent']);
        Route::get('exams/{course_id}/students', [QuizController::class, 'examsStudents']);
        Route::get('exams/{course_id}/questions', [QuizController::class, 'examsQuestions']);
        Route::get('/exams/students/clear/{id}', [QuizController::class, 'clearStudent']);
        Route::get('homeworks/{course_id}/students', [HomeworkController::class, 'homeworkStudents']);
        Route::get('/homeworks/students/clear/{id}', [HomeworkController::class, 'clearStudent']);
        Route::get('course/{course_id}/week/create', [CourseController::class, 'addWeek']);
        Route::post('submitWeek', [CourseController::class, 'storeWeek']);
        Route::get('week/{course_id}/video/create', [CourseController::class, 'addVideo']);
        Route::post('submitVideo', [CourseController::class, 'storeVideo']);
        Route::get('week/{week_id}/materials/create', [CourseController::class, 'addMaterial']);
        Route::post('submitMaterial', [CourseController::class, 'storeMaterial']);
        Route::get('week/{week_id}/quiz/create', [CourseController::class, 'addQuiz']);
        Route::post('submitQuiz', [CourseController::class, 'storeQuiz']);
        Route::get('quiz/{quiz_id}/question/create', [QuestionController::class, 'create']);
        Route::post('submitQuizQuestion', [QuestionController::class, 'store']);
        Route::get('years/{year_id}', [YearController::class, 'getYear']);
        Route::get('/students/year/{year_id}', [UserController::class, 'yearStudents']);
        Route::get('/courses/year/{year_id}', [CourseController::class, 'yearCourses']);
        Route::get('week/{week_id}/sort', [WeekController::class, 'sort']);
        Route::post('sort', [WeekController::class, 'submitSort']);
        //weeks
        Route::resource('weeks', WeekController::class);

        Route::resource('/quizzes',  QuizController::class);
        Route::resource('/homeworks',  HomeworkController::class);
        Route::resource('/materials',  MaterialController::class);

        Route::get('/admins', [UserController::class, 'admins'])->name('admins');
        Route::get('/admins/{admin_id}/edit', [UserController::class, 'editAdmin']);
        Route::put('/update-admin/{id}',  [UserController::class, 'update_admin']);
        Route::get('admin/store', [UserController::class, 'addAdmin']);
        Route::post('admin/submit', [UserController::class, 'store']);
        Route::get('/admin/{id}/destroy',  [UserController::class, 'destroyAdmin']);



        Route::post('/edit-question/{id}', [QuestionController::class, 'updateQuestion']);
        Route::resource('/quiz-questions', QuizQuestionController::class);
        Route::resource('/homework-questions', HomeworkQuestionController::class);
        Route::post('/edit-quiz-questions/{id}', [QuizQuestionController::class, 'editData']);
        Route::post('/edit-homework-questions/{id}', [HomeworkQuestionController::class, 'editData']);
        Route::get('/get-quiz-checked/{id}', [QuizQuestionController::class, 'getChecked']);
        Route::get('/get-homework-checked/{id}', [HomeworkQuestionController::class, 'getChecked']);
        Route::resource('/messages', MessageController::class);

        Route::get('/weekStudents/{id}', [UserWeekEnrollController::class, 'weekStudents']);
        Route::resource('/deleteWeekUser', UserWeekEnrollController::class);
        Route::get('/getVideoWatchers/{id}',  [VideoController::class, 'getVideoWatchers']);
        Route::get('/clearUserWatches/{id}', [UserVideosEnrollController::class, 'clearUserWatches']);
        Route::resource('/comments',  CommentController::class);
    
        Route::get('/get-students-level/{id}',  [UserController::class, 'getLevelStudents']);
        Route::post('/update-material/{id}',  [MaterialController::class, 'updateMaterial']);
        // Route::resource('/weeks', WeekController::class);
        Route::post('/update-week/{id}', [WeekController::class, 'updateWeek']);
        Route::get('/weeks-selection', [WeekController::class, 'getAllWeeksForSelecet']);
        Route::resource('/level', LevelController::class)->only('show');
        Route::get('/student-quizzes/{id}', [UserQuizController::class, 'studentQuizzes']);
        Route::get('/student-homeworks/{id}', [UserHomeworkController::class, 'studentHomeworks']);
        Route::get('/quiz-student/{id}', [UserQuizController::class, 'quizStudents']);
        Route::get('/homework-student/{id}', [UserHomeworkController::class, 'homeworkStudents']);
        Route::get('/clear-student-quiz/{user_id}/{id}', [UserQuizController::class, 'clearStudent']);
        Route::get('/clear-student-homework/{user_id}/{id}', [UserHomeworkController::class, 'clearStudent']);
        Route::get('/show-level-users/{id}',  [UserController::class, 'getLevelStudents']);
        Route::get('/show-level-questions/{id}',  [QuestionController::class, 'showLevelQuestions']);
        Route::get('/show-level-quizzes/{id}',  [QuizController::class, 'showLevelQuizzes']);
        Route::get('/show-level-homeworks/{id}',  [HomeworkController::class, 'showLevelHomeworks']);
        Route::get('/show-level-videos/{id}',  [VideoController::class, 'showLevelVideos']);
        Route::get('/user-statistics/{id}',  [UserController::class, 'userStatistics']);
        Route::get('/user-weeks/{id}',  [UserWeekEnrollController::class, 'userWeeks']);
        Route::get('/user-quiz-model-answer/{id}', [UserQuizController::class, 'getUserAnswers']);
        Route::get('/user-homework-model-answer/{id}', [UserHomeworkController::class, 'getUserAnswers']);
        Route::resource('/user',  UserController::class);
        Route::get('/refresh-quiz/{id}', [UserQuizController::class, 'refreshDegrees']);
});




Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin
    Route::group(['middleware' => 'IsAdminMiddleware'], function () {
        //Normal Admin
        Route::resource('/questions', QuestionController::class);
        Route::post('/edit-question/{id}', [QuestionController::class, 'updateQuestion']);
        Route::resource('/quiz-questions', QuizQuestionController::class);
        Route::resource('/homework-questions', HomeworkQuestionController::class);
        Route::post('/edit-quiz-questions/{id}', [QuizQuestionController::class, 'editData']);
        Route::post('/edit-homework-questions/{id}', [HomeworkQuestionController::class, 'editData']);
        Route::get('/get-quiz-checked/{id}', [QuizQuestionController::class, 'getChecked']);
        Route::get('/get-homework-checked/{id}', [HomeworkQuestionController::class, 'getChecked']);
        Route::resource('/messages', MessageController::class);
        Route::resource('/videos',  VideoController::class);
        Route::resource('/quizzes',  QuizController::class);
        Route::resource('/homeworks',  HomeworkController::class);
        Route::get('/weekStudents/{id}', [UserWeekEnrollController::class, 'weekStudents']);
        Route::resource('/deleteWeekUser', UserWeekEnrollController::class);
        Route::get('/getVideoWatchers/{id}',  [VideoController::class, 'getVideoWatchers']);
        Route::get('/clearUserWatches/{id}', [UserVideosEnrollController::class, 'clearUserWatches']);
        Route::resource('/comments',  CommentController::class);
        Route::resource('/user',  UserController::class)->except('store');
        Route::get('/approve-user/{id}',  [UserController::class, 'approveUser']);
        Route::get('/approve-admin/{id}',  [UserController::class, 'approveUser']);
        Route::get('/disapprove-user/{id}',  [UserController::class, 'disapproveUser']);
        Route::get('/get-students-level/{id}',  [UserController::class, 'getLevelStudents']);
        Route::resource('/materials',  MaterialController::class);
        Route::post('/update-material/{id}',  [MaterialController::class, 'updateMaterial']);
        // Route::resource('/weeks', WeekController::class);
        Route::post('/update-week/{id}', [WeekController::class, 'updateWeek']);
        Route::get('/weeks-selection', [WeekController::class, 'getAllWeeksForSelecet']);
        Route::resource('/level', LevelController::class)->only('show');
        Route::get('/student-quizzes/{id}', [UserQuizController::class, 'studentQuizzes']);
        Route::get('/student-homeworks/{id}', [UserHomeworkController::class, 'studentHomeworks']);
        Route::get('/quiz-student/{id}', [UserQuizController::class, 'quizStudents']);
        Route::get('/homework-student/{id}', [UserHomeworkController::class, 'homeworkStudents']);
        Route::get('/clear-student-quiz/{user_id}/{id}', [UserQuizController::class, 'clearStudent']);
        Route::get('/clear-student-homework/{user_id}/{id}', [UserHomeworkController::class, 'clearStudent']);
        Route::get('/show-level-users/{id}',  [UserController::class, 'getLevelStudents']);
        Route::get('/show-level-questions/{id}',  [QuestionController::class, 'showLevelQuestions']);
        Route::get('/show-level-quizzes/{id}',  [QuizController::class, 'showLevelQuizzes']);
        Route::get('/show-level-homeworks/{id}',  [HomeworkController::class, 'showLevelHomeworks']);
        Route::get('/show-level-videos/{id}',  [VideoController::class, 'showLevelVideos']);
        Route::get('/user-statistics/{id}',  [UserController::class, 'userStatistics']);
        Route::get('/user-weeks/{id}',  [UserWeekEnrollController::class, 'userWeeks']);
        Route::get('/user-quiz-model-answer/{id}', [UserQuizController::class, 'getUserAnswers']);
        Route::get('/user-homework-model-answer/{id}', [UserHomeworkController::class, 'getUserAnswers']);
        Route::resource('/user',  UserController::class);
        Route::get('/refresh-quiz/{id}', [UserQuizController::class, 'refreshDegrees']);


        //Super Admin
        Route::group(['middleware' => 'IsSuperAdminMiddleware'], function () {
        //Super Admin
            Route::resource('/codes', CodeController::class);
            Route::post('/charge-with-admin/{id}', [CodeController::class, 'chargeWithAdmin']);
            Route::get('/codes/clear/{id}', [CodeController::class, 'clear']);
            Route::post('/codes/search', [CodeController::class, 'search']);
            Route::get('/admins',  [UserController::class, 'admins']);
            Route::get('/show-admins/{id}',  [UserController::class, 'showAdmins']);
            Route::get('/approve-admin/{id}',  [UserController::class, 'approveAdmin']);
            Route::get('/disapprove-admin/{id}',  [UserController::class, 'disapproveAdmin']);





            //Owner
            Route::group(['middleware' => 'IsOwnerMiddleware'], function () {
                //Owner

                });
            });
        });
} );


Route::fallback(function () {
    return response()->json([
        'status' => '404',
        'message' => 'Not Found...',
    ], 404);
});

