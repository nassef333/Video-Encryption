<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginUserRequest;
use App\Http\Requests\storeUserRequest;
use App\Models\LevelData;
use App\Models\Users;
use App\Traits\HttpResponses;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function adminLogin(Request $request)
    { 
        $validated_data = $request->validate([
            'email' => ['required', 'numeric', 'digits:11'],
            'password' => ['required','min:6' , 'max:255',]
        ],[
            'email.required' => 'مينفعش رقم الموبايل يبقى فاضي',
            'email.numeric' => 'اتأكد من رقم موبايلك تانى',
            'email.digits' => 'اتأكد من رقم موبايلك تانى',

            'password.required' => 'كلمة المرور مطلوبة',
            'password.max' => 'اقصى عدد للحروف 255 حرف فقط',
            'password.min' => 'لازم الباسورد يكون 6 حروف او اكتر',
        ]);


        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors([
                'message' => 'خطأ في رقم الهاتف او كلمة السر',
            ]);        
        }
        
        if(Users::where('email', $request->email)->where('approved', 0)->exists()){
                        return redirect()->back()->withErrors([
                'message' => 'حسابك محظور.. يرجي التواصل مع الأدمن',
            ]); 
        }
        $user = Users::where('email', $request->email)->first();
        return redirect('/');
        
    }

    public function login(Request $request)
    { 
        $validated_data = $request->validate([
            'email' => ['required', 'numeric', 'digits:11'],
            'password' => ['required','min:6' , 'max:255',]
        ],[
            'email.required' => 'مينفعش رقم الموبايل يبقى فاضي',
            'email.numeric' => 'اتأكد من رقم موبايلك تانى',
            'email.digits' => 'اتأكد من رقم موبايلك تانى',

            'password.required' => 'كلمة المرور مطلوبة',
            'password.max' => 'اقصى عدد للحروف 255 حرف فقط',
            'password.min' => 'لازم الباسورد يكون 6 حروف او اكتر',
        ]);


        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', ' يوجد خطأ في رقم الهاتف او كلمة السر', 401);
        }
        
        if(Users::where('email', $request->email)->where('approved', 0)->exists())
        return $this->error('', 'حسابك معموله بلوك ياريت تكلمنا في اسرع وقت!!', 402);   

        $user = Users::where('email', $request->email)->first();
        return $user;
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->fname . ' ' . $user->lname)->plainTextToken
        ],'Logged In');
        
    }
    public function register(Request $request)
    {

        $validated_data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users', 'numeric', 'digits:11'],
            'phone' => ['required', 'unique:users', 'email', 'max:255',],
            'pphone' => ['required', 'numeric', 'digits:11'],
            'government' => ['required', 'max:255',],
            'level' => ['required', 'max:255', ],
            'password' => ['required', 'confirmed', 'max:255', 'min:6']
        ],[ 
            'fname.required' => 'مينفعش اسمك يبقى فاضي',
            'fname.string' => 'اسمك لازم يبقي حروف بس',
            'fname.max' => 'الأسم الأول يجب ان يكون اقل من 255 حرف',

            'lname.required' => 'مينفعش الاسم التاني يبقى فاضي',
            'lname.string' => 'الاسم التاني لازم يبقي حروف بس',
            'lname.max' => 'الأسم الأخير يجب ان يكون اقل من 255 حرف',

            'email.required' => 'ماينفعش رقم موبايلك يكون فاضي كده',
            'email.unique' => 'رقم الموبايل ده متسجل قبل كده',
            'email.numeric' => 'اتأكد من رقم الموبايل تاني',
            'email.digits' => 'اتأكد من رقم الموبايل تاني',

            'pphone.required' => 'ماينفعش رقم موبايل ولي الأمر يكون فاضي كده',
            'pphone.numeric' => 'اتأكد من رقم الموبايل تاني',
            'pphone.digits' => 'اتأكد من رقم الموبايل تاني',


            'phone.required' => 'ماينفعش ايميلك يكون فاضي كده',
            'phone.unique' => 'البريد الالكتروني مسجل من قبل',
            'phone.max' => 'اقصي عدد يتسعه البريد الالكتروني 255 حرف',
            'phone.email' => 'اتأكد من البريد الالكتروني تاني',
            
            'government.required' => 'اختار محافظتك',
            
            'level.required' => 'اختار المرحلة الدراسية',

            'password.required' => 'ماينفعش الباسورد يكون فاضي',
            'password.confirmed' => 'الباسورد مختلف.. اتأكد تاني',
            'password.max' => 'اقصى عدد للحروف 255 حرف فقط',
            'password.min' => 'لازم الباسورد يكون 6 حروف او اكتر ',
        ]);

        $user = Users::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'pphone' => $request->pphone,
            'government' => $request->government,
            'level' => $request->level,
            'password' => Hash::make($request->password)
        ]);
        $level = LevelData::find($user->level);
        $level->students = Users::where('level', $user->level)->count();
        $level->save();
        return $this->success([
            'user' => $user, 
        ],'Account Created sucessfully');
          
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
