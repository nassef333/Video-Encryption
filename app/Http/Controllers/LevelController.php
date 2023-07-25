<?php

namespace App\Http\Controllers;

use App\Http\Resources\LevelResource;
use App\Models\Homeworks;
use App\Models\LevelData;
use App\Models\Questions;
use App\Models\Quizzes;
use App\Models\Users;
use App\Models\Videos;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        return LevelResource::collection(
            LevelData::get()
        );
    }
    public function show($id)
    {
        $level = LevelData::find($id);
        return new LevelResource($level);
    }


}
