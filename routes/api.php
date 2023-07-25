<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HomeworkQuestionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHomeworkController;
use App\Http\Controllers\UserQuizController;
use App\Http\Controllers\UserVideosEnrollController;
use App\Http\Controllers\UserWeekEnrollController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WeekController;
use App\Models\User_weeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Public Routes
Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::resource('/level', LevelController::class)->only('index');
    Route::get('/show-level-weeks/{id}',  [WeekController::class, 'showLevelWeeks']);
    Route::get('/week-unAuth-content/{id}',  [WeekController::class, 'getWeekContent']);
});
Route::get('/', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/top-rated-in-quiz/{id}', [UserQuizController::class, 'topRated']);    Route::resource('/user/weeks', WeekController::class);
    Route::post('/codes/charge', [CodeController::class, 'charge']);
    Route::resource('/user/enrollWeek', UserWeekEnrollController::class)->only('show');
    Route::resource('/user/enrollVideo',  UserVideosEnrollController::class);
    Route::get('/my-videos',  [UserVideosEnrollController::class, 'myVideos']);
    Route::get('/video-data/{id}',  [UserVideosEnrollController::class, 'SpecificVideoData']);
    Route::post('/user/placeComment/{id}', [CommentController::class, 'placeComment']);
    Route::get('/user/comment_delete/{id}', [CommentController::class, 'delete']);
    Route::post('/user/place-reply/{id}', [CommentController::class, 'placeReply']);
    Route::get('/my-quizzes', [UserQuizController::class, 'myQuizzes']);
    Route::get('/my-homeworks', [UserHomeworkController::class, 'myHomeworks']);
    Route::get('/my-videos', [UserVideosEnrollController::class, 'myVideos']);
    Route::get('/quiz-enroll/{id}', [UserQuizController::class, 'userEnrollQuiz']);
    Route::get('/homework-enroll/{id}', [UserHomeworkController::class, 'userEnrollHomework']);
    Route::POST('/submit-quiz-question/{id}/{question_id}', [UserQuizController::class, 'submitQuestion']);
    Route::POST('/submit-homework-question/{id}/{question_id}', [UserHomeworkController::class, 'submitQuestion']);
    Route::get('/quiz-model-answer/{id}', [UserQuizController::class, 'getAnswers']);
    Route::get('/homework-model-answer/{id}', [UserHomeworkController::class, 'getAnswers']);
    Route::get('/Auth', [UserController::class, 'getAuth']);
    Route::PATCH('/edit-info', [UserController::class, 'editInfo']);
    Route::get('/my-statistics', [UserController::class, 'myStatistics']);
    Route::get('/my-codes', [CodeController::class, 'myCodes']);
    Route::get('/auth-weeks',  [WeekController::class, 'showAuthWeeks']);
    Route::get('/week-content/{id}',  [WeekController::class, 'getContent']);
    Route::get('/my-weeks',  [UserWeekEnrollController::class, 'myWeeks']);
    Route::resource('/materials',  MaterialController::class)->only('find');
    Route::get('finish-quiz/{id}', [UserQuizController::class, 'finish']);

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
            Route::patch('/update-admin/{id}',  [UserController::class, 'update_admin']);
            Route::delete('/delete-admin/{id}',  [UserController::class, 'destroyAdmin']);
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
        'message' => 'Not Founded route',
    ], 404);
});



