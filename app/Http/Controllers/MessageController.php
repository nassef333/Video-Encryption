<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Messages::all();
        return MessageResource::collection(
            Messages::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $request->validated($request->all());

        $message = Messages::create([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $request->phone,
        ]);

        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $message)
    {
        $message->delete();
        return $this->success('', 'Message Deleted succesfuly.', 200);
    }
}
