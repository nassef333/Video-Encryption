<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Http\Requests\updateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Materials;
use App\Models\UserWeeks;
use App\Models\Weeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MaterialResource::collection(
            Materials::get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        $request->validated($request->all());

        $material = Materials::create([
            'week_id' => $request->week_id,
            'title' => $request->title,
            'cdn' => $request->file('cdn')->store('materials', 'public'),
        ]);
        return $this->success($material, 'Material Added Successfully.', '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return 1;
        if (!Materials::where('id', $id)->exists())
            return $this->error('', 'Not Found', '404');
        $week_id = Materials::where('id', $id)->first()->week_id;
        // return $week_id;
        // return User_weeks::where('user_id', Auth::user()->id)->where('week_id', $week_id)->get();
        if (!UserWeeks::where('user_id', Auth::user()->id)->where('week_id', $week_id)->exists()) {
            return $this->error('', 'You Have not enrolled this week...', '401');
        }
        return MaterialResource::collection(
            Materials::where('id', $id)->get()
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMaterial(updateMaterialRequest $request, $id)
    {
        $exists = Materials::where('id', $id);
        if (!$exists->exists())
            return $this->error('', 'Material Not Found', 404);
        $material = $exists->first();
        $material->update(['title' => $request->title]);
        if($request->hasFile('cdn')){
            $material['cdn'] = $request->file('cdn')->store('Homeworks', 'public');
            $material->save();
        }
        return $this->success(new MaterialResource($material), 'Material Updated Successfully.', 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materials $material)
    {
        $material->delete();
        return $this->success('', 'Material deleted Successfully.', 200);
    }
}
