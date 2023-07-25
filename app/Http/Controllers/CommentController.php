<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comments;
use App\Models\Userweeks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentResource::collection(
            Comments::where('parent_comment', 0)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function placeComment(CommentRequest $request, $id)
    {
        $request->validated($request->all());

        $comment = Comments::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'video_id' => $id,
            'img' => '',
        ]);
        if($request->hasFile('img')){
            $comment['img'] = $request->file('img')->store('comments', 'public');
            $comment->save();
        }
        return $this->success(new CommentResource($comment), 'Comment Sent Successfully', '200');
    }    
    public function placeReply(CommentRequest $request, $id)
    {
        $request->validated($request->all());
        $comment = Comments::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'img' => $request->img,
            'parent_comment'=> $id,
        ]);
        return $this->success('', 'Reply Sent Successfully', '200');
    }



    public function delete($id)
    {
        if(!Comments::where('id', $id)->where('user_id', Auth::user()->id)->exists())
            return $this->error('', 'An Error has occured...', 401);
        $comment = Comments::where('id', $id)->where('user_id', Auth::user()->id);
        $comment->delete();
        return $this->success('', 'Comment Has Been Successfully deleted.',200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        if (!Comments::where('id', $id)->exists())
            return $this->error('', 'Not Found', '404');
            
        return CommentResource::collection(
            Comments::where('video_id', $id)->where('parent_comment', 0)->get()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Comments::where('id', $id)->exists())
            return $this->error('', 'An Error has occured...', 401);
        $comment = Comments::find($id);
        $comment->delete();
            return $this->success('', 'Comment Has Been Successfully deleted.',200);
    }
}
