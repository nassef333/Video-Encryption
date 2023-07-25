<?php

namespace App\Http\Controllers;

use App\Models\LevelData;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function getYear($id)
    {
        $year = LevelData::find($id);
        return view('yearContent', compact('year'));
    }
}
