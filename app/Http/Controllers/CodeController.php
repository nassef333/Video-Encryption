<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeCodeRequest;
use App\Http\Resources\CodeResource as ResourcesCodeResource;
use App\Http\Resources\CodeResource;
use App\Models\Codes;
use App\Models\Users;
use App\Models\UserWeeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
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
        
        $codes = Codes::paginate(20);
    
        return view('codes.index', compact('searchTerm', 'codes'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $codes = Codes::where(function ($query) use ($searchTerm) {
                $query->where('code', 'like', "%$searchTerm%")
                ->orWhere('admin', 'like', "%$searchTerm%")
                ->orWhere('id', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('codes.index', compact('searchTerm', 'codes'));
    }

    public function create(Request $request)
    {
        return view('codes.create');
    }

    public function charge(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:255|alpha_num'
        ]);
        $user = Auth::user();

        if (Codes::where('code', $request->code)->exists()) {
            $code = Codes::where('code', $request->code)->first();
            if ($code->user_id === null) {
                $oldBalance = $user->balance;
                $newBalance = $oldBalance + $code->value;
                Users::find($user->id)->update(['balance' => $newBalance]);
                $code->update(['user_id' => $user->id, 'user_name' => $user->fname.' '.$user->lname]);
                // $code->update(['user_name' => Auth::user()->name]);
                return $this->success($code ,'Charge Completed Successfully.', 200);
            } else
                return $this->error('', 'This Code has been used before', 401);
        }
        else
            return $this->error('', 'Invalid Code', 404);
    }

    public function chargeWithAdmin(Request $request, $id)
    {
        $validatedData = $request->validate([
            'value' => 'required|max:255'
        ]);
        $user = Users::find($id);
        $user->balance = $request->value+$user->balance;
        $user->save();
        return $this->success($user, 'Wallet Charged Successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     private function generateCode()
     {
         $characters = '0123456789';
         $code = '';
         $length = 10;
         // Generate random characters
         for ($i = 0; $i < $length; $i++) {
             $index = rand(0, strlen($characters) - 1);
             $code .= $characters[$index];
         }
 
         // Check if the Code is unique
         while (Codes::where('code', $code)->exists()) {
             // Regenerate if the Order already exists in the database
             $code = '';
             for ($i = 0; $i < $length; $i++) {
                 $index = rand(0, strlen($characters) - 1);
                 $code .= $characters[$index];
             }
         }
 
         return $code;
     }
 
    public function store(storeCodeRequest $request)
    {
        $request->validated($request->all());
        $numberOfCodes = $request->numberOfCodes;
        $createdCodes = [];
        for ($i = $numberOfCodes; $i > 0; $i--) {
            $code = Codes::create([
                'value' => $request->value,
                'code' => $this->generateCode(),
                'admin' => Auth::user()->fname . ' ' . Auth::user()->lname,
            ]);
            array_push($createdCodes, $code);
        }
        return $this->success(CodeResource::collection(
            $createdCodes,
            'Codes Created Successfully.', 200
        ));
    }

    /**
     * Display the specified resource.
     * Show specifec user codes 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $codes = Codes::where('user_id', $id)->get();

        return CodeResource::collection(
            $codes
        );
    }

    public function myCodes(){
        if(!Codes::where('user_id', Auth::user()->id)->exists())
            if(Users::where('id', Auth::user()->id)->where('balance', 0)->exists())
                return $this->error('', 'You have no codes yet...', 404);

        return $this->success(CodeResource::collection(Codes::where('user_id', Auth::user()->id)->get()), Auth::user()->balance, 200);
    }

    // public function search(Request $request)
    // {

    //     $validated_data = $request->validate([
    //         'code' => ['required_without:id', 'max:255'],
    //         'id' => ['required_without:code', 'max:255'],
    //     ]);
    //     if ($validated_data["code"] == "" && $validated_data["id"] == "")
    //         return $this->error('', 'Please Enter Data...', 401);

    //     else if ($validated_data["code"] != ""){
    //         if (!Codes::where('code', $validated_data['code'])->exists())
    //             return $this->error('', 'User not found...', 401);

    //         $code = Codes::where('code', $request->code)->get();
    //         return $this->success(CodeResource::collection(
    //             $code
    //         ), 'Found.', 200);
    //     }
    //     else if ($validated_data["id"] != "")
    //     // if (!Users::where('id', $validated_data['id'])->exists())
    //     //     return $this->error('', 'User not found...', 401);

    //     $code = Codes::where('user_name','LIKE','%'.$request->id.'%')->orWhere('user_id',$request->id)->get();
    //     return $this->success(CodeResource::collection(
    //         $code
    //     ), 'Found.', 200);
    // }

    public function clear($id)
    {
        $code = Codes::find($id);
        $user_weeks = UserWeeks::where('codes_id', $code->id)->first();
        if(isset($user_weeks->codes_id)){
            $user_weeks->codes_id = NULL;
            $user_weeks->save();
        }
        header("Refresh:0; url=" . $_SERVER['HTTP_REFERER']);
        // return new CodeResource($code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = Codes::find($id);
        $code->delete();
        return $this->success('', 'Code Deleted succesfuly.', 200);
    }
}
