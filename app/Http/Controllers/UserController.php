<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserShowResource;
use App\Models\Codes;
use App\Models\LevelData;
use App\Models\Questions;
use App\Models\Quizzes;
use App\Models\SolvedHomeworks;
use App\Models\SolvedQuizzes;
use App\Models\UserQuizzes;
use App\Models\Users;
use App\Models\UserVideos;
use App\Models\UserWeeks;
use App\Models\Videos;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Admins Accounts
    public function index(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->search($request);
        
        $users = Users::where('role', 0)->paginate(20);
    
        return view('users.index', compact('searchTerm', 'users'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $users = Users::where('role', 0)
            ->where(function ($query) use ($searchTerm) {
                $query->where('fname', 'like', "%$searchTerm%")
                    ->orWhere('lname', 'like', "%$searchTerm%")
                    ->orWhere('id', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('users.index', compact('searchTerm', 'users'));
    }

    public function yearStudents(Request $request, $id)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchYearStudents($request,$id);
        
        $users = Users::where('level', $id)->where('role', 0)->paginate(20);
    
        return view('users.index', compact('searchTerm', 'users'));
    }

    public function searchYearStudents(Request $request, $id)
    {
        $searchTerm = $request->query('searchTerm');
        $users = Users::where('level', $id)->where('role', 0)
            ->where(function ($query) use ($searchTerm) {
                $query->where('fname', 'like', "%$searchTerm%")
                    ->orWhere('lname', 'like', "%$searchTerm%")
                    ->orWhere('id', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('users.index', compact('searchTerm', 'users'));
    }
    

    public function edit($id)
    {
        $user = Users::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function editAdmin($id)
    {
        $user = Users::findOrFail($id);
        return view('admins.edit', compact('user'));
    }
    
    public function getLevelStudents($id)
    {
        return UserShowResource::collection(
            Users::where('role', 0)->where('level', $id)->get() // 0-> user
        );
    }

    //Admins Accounts
    public function admins(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->searchAdmins($request);
        
        $users = Users::where('role', '>',0)->paginate(20);
    
        return view('admins.index', compact('users'));
    }

    public function searchAdmins(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $users = Users::where('role', '>',0)
            ->where(function ($query) use ($searchTerm) {
                $query->where('fname', 'like', "%$searchTerm%")
                    ->orWhere('lname', 'like', "%$searchTerm%")
                    ->orWhere('id', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
            return view('admins.index', compact('users'));
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //admin create admin
    public function store(UserRequest $request)
    {
        $request->validated($request->all());
        $user = Users::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admins');  
    }

    public function addAdmin()
    {
        return view('admins.add-admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Users::where('id', $id)->where('role', 0)->exists())
            return $this->error('', 'Not Found', 401);
        return new UserResource(Users::where('role', 0)->find($id));
    }    

    public function showAdmins($id)
    {
        if (!Users::where('id', $id)->where('role', '>', 0)->exists())
            return $this->error('', 'Not Found', 401);
        return new AdminResource(Users::where('role', '>',0)->where('role', '<', 9)->find($id));
    }

    public function showLevelUsers($id)
    {
        if ($id > 3 || $id < 1)
            return $this->error('', 'Not Found', 401);
        // return "hamada";
        return UserShowResource::collection(
            Users::where('role', 0)->where('level', $id)->get() // 0-> user
        );  
    }

    public function myStatistics(){
        $user = Auth::user();
        $weekData = LevelData::find($user->level);
        $data = [];

        //الدرجات اللي جبتها فالكويزات
        $data["myDegrees"] = UserQuizzes::where('users_id', $user->id)->where('updated_at', '<', Carbon::parse('-12 hours'))->sum('score');
        
        //مجموع درجات الكويزات ال دخلتها

        $allQuizzesDegrees = 0;
        foreach($user->quizzes as $quiz){
            $allQuizzesDegrees += $quiz->degree;
        }
        $data["standardDegree"] = $allQuizzesDegrees;

        //عدد الأسابيع اللي اشتريتها
        $weeks = UserWeeks::where('user_id', $user->id)->count();
        $data["numOfMyWeeks"] = $weeks; 

        //عدد الاسألة المحلولة اجمالا
        $numberOfQuestions = SolvedQuizzes::where('user_id', $user->id)->count() + SolvedHomeworks::where('user_id', $user->id)->count();
        $data["allSolvedQuizzes"] = $numberOfQuestions; 

        //عدد الكويزات ال دخلتها
        $numberOfEnrolleQuizzes = UserQuizzes::where('users_id', $user->id)->count();
        $data["numOfMyQuizzes"] = $numberOfEnrolleQuizzes;

        //عدد الكويزات اللي في السيستم )(السنه بتاعتي)
        $numOfQuizzes = Quizzes::where('level', $user->level)->count();
        $data["numOfAllQuizzes"] = $numOfQuizzes;

        //عدد الفيديوهات اللي شوفتها
        $numberOfEnrolledVideos = UserVideos::where('user_id', $user->id)->count();
        $data["viewedVideos"] = $numberOfEnrolledVideos;

        //عدد مرات مشاهدة الفيديوهات
        $numberOfWatchingVideos = UserVideos::where('user_id', $user->id)->sum('count');
        $data["numberOfWatchingVideos"] = $numberOfWatchingVideos;

        //عدد الفيديوهات في المنصة للسنة بتاعتي
        $numberOfVideos = Videos::where('level', $user->level)->count();
        $data["numberOfVideos"] = $numberOfVideos;

        //عدد الاكواد المستخدمة
        $numberOfCodes = Codes::where('user_id', $user->id)->count();
        $data["numberOfCodes"] = $numberOfCodes;
        
        return $data;
    }

    public function userStatistics($id){
        $user = Users::find($id);
        $courses = $user->weeks;
        $exams = $user->quizzes;
        return view('users.profile', compact('user', 'courses', 'exams'));
    }

    public function getAuth(){
        return Auth::user();
    }

    public function editInfo(Request $request){
        $user = Users::find(Auth::user()->id);
        $user->update($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        return new UserResource($user);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'numeric', 'digits:11'],
            'phone' => ['required', 'email', 'max:255',],
            'pphone' => ['required', 'numeric', 'digits:11'],
            'government' => ['required', 'max:255',],
            'level' => ['required', 'max:255', ],
            'password' => ['required', 'confirmed', 'max:255',]
        ],[
            'fname.required' => 'الأسم الأول مطلوب',
            'fname.string' => 'الأسم الأول يجب ان يحتوى على حروف فقط',
            'fname.max' => 'الأسم الأول يجب ان يكون اقل من 255 حرف',

            'lname.required' => 'الأسم الأول مطلوب',
            'lname.string' => 'الأسم الأخير يجب ان يحتوى على حروف فقط',
            'lname.max' => 'الأسم الأخير يجب ان يكون اقل من 255 حرف',

            'email.required' => 'رقم الهاتف مطلوب',
            'email.unique' => 'رقم الهاتف مسجل من قبل',
            'email.numeric' => 'رقم الهاتف يجب ان يحتوى على 11 رقم فقط',
            'email.digits' => 'رقم الهاتف يجب ان يحتوى على 11 رقم فقط',

            'pphone.required' => 'رقم هاتف ولى الأمر مطلوب',
            'pphone.unique' => 'رقم هاتف ولى الأمر مسجل من قبل',
            'pphone.numeric' => 'رقم هاتف ولى الأمر يجب ان يحتوى على 11 رقم فقط',
            'pphone.digits' => 'رقم هاتف ولى الأمر يجب ان يحتوى على 11 رقم فقط',

            'phone.required' => 'البريد الالكتروني مطلوب',
            'phone.unique' => 'البريد الالكتروني مسجل من قبل',
            'phone.max' => 'اقصي عدد يتسعه البريد الالكتروني 255 حرف',
            'phone.email' => 'ادخل البريد الالكتروني بصورة صحيحة',
            
            'government.required' => 'اختر المحافظة التابعة لك',
            
            'level.required' => 'اختر المرحلة الدراسية',

            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير مطابقة',
            'password.max' => 'اقصى عدد للحروف 255 حرف فقط',
        ]);
        if (!Users::where('id', $id)->where('role', 0)->exists())
            return $this->error('', 'Not Found', 401);
        $user = Users::find($id);
        $user->update($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        return redirect('/users');
    }

    public function update_admin(Request $request, $id)
    {
        if (!Users::where('id', $id)->where('role', '>', 0)->exists())
            return $this->error('', 'Not Found', 401);
        $user = Users::find($id);
        $user->update($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        return redirect('/admins');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Users::where('id', $id)->where('role', 0)->exists())
            return $this->error('', 'Not Found', 401);
        $user = Users::find($id);
        $user->delete();
        $level = LevelData::find($user->level);
        $level->students = Users::where('level', $user->level)->where('role', 0)->count();
        $level->save();
        return $this->success('', 'User Deleted succesfuly.', 200);
    }
    public function destroyAdmin($id)
    {
        $user = Users::find($id);
        $user->delete();
        return $this->success('', 'User Deleted succesfuly.', 200);
    }
    public function approveUser($id){
        if (!Users::where('id', $id)->where('role', 0)->exists())
            return $this->error('', 'Not Found', 401);

        $user = Users::find($id);
        $user->approved = 1 - $user->approved;
        $user->save();
        $token = PersonalAccessToken::where('tokenable_id', $id);
        $token->delete();
        return $this->success('', 'Status Changed', 200);
    }       
 
    public function approveAdmin($id){
        if (!Users::where('id', $id)->where('role', '>', 0)->exists())
            return $this->error('', 'Not Found', 401);
            
        $user = Users::find($id);
        $user->approved = 1 - $user->approved;
        $user->save();
        $token = PersonalAccessToken::where('tokenable_id', $id);
        $token->delete();
        return $this->success('', 'Status Changed', 200);
    }    

}
