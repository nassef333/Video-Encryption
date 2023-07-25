<?php

namespace App\Http\Controllers;

use App\Http\Resources\MyWeeksResource;
use App\Http\Resources\UserWeekEnrollResource;
use App\Http\Resources\WeekUsersResource;
use App\Models\UserWeeks;
use App\Models\Users;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWeekEnrollController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserWeekEnrollResource::collection(
            UserWeeks::get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //this function enrolls user a week
    public function show($id)
    {

        if (empty(Weeks::find($id)))
        return $this->error('', 'This Week is not found...', 404);

        $user = Auth::user();
        $weekData = Weeks::find($id);

        if ($user->balance >= $weekData->price && !UserWeeks::where('user_id', $user->id)->where('week_id', $weekData->id)->exists()) {
            $newBalance = $user->balance - $weekData->price;
            $foundUser = Users::find($user->id);
            $newBalance = $user->balance - $weekData->price;
            $foundUser->update(['balance' => $newBalance]);
            $data = UserWeeks::create([
                'user_id' => Auth::user()->id,
                'week_id' => $weekData->id 
            ]);



            return $this->success([
            'message' => 'You have been successfully enrolled this week.',
            'data' => response()->json($data)
            ]);
        } else
        if($user->balance <= $weekData->price)
            return $this->error('', 'Sorry, Please Charge Your wallet...', 404);
        if(UserWeeks::where('user_id', $user->id)->where('week_id', $weekData->id)->exists())
            return $this->error('', 'You have been enrolled this Week before...', 401);


    }


    public function weekStudents($id)
    {
        $week = Weeks::find($id);
        return WeekUsersResource::collection(
            $week->students
        );
    }

    public function myWeeks(){
        return MyWeeksResource::collection(
            Auth::user()->weeks
        );
    }

    public function userWeeks($id){
        return MyWeeksResource::collection(
            Users::find($id)->weeks
        );
    }
    public function destroy($id)
    {
        UserWeeks::find($id)->delete();
        return $this->success('', 'Deleted succesfuly.', 200);
    }
}
