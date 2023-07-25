<?php

namespace App\Http\Resources;

use App\Models\Comments;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Users::find($this->user_id);
            return [
                'id' => (string) $this->id,
                'attributes' => [
                    'comment' => $this->comment,
                    'user_name' => $user->fname . ' ' . $user->lname,
                    'video_id' => (string) $this->video_id,
                    'img' => (string) $this->img,
                    'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                    'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
                    'replies' => Comments::where('parent_comment', $this->id)->get(),
                ]   
            ];
    }
}
