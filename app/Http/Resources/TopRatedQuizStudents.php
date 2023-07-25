<?php

namespace App\Http\Resources;

use App\Models\Users;
use Illuminate\Http\Resources\Json\JsonResource;

class TopRatedQuizStudents extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Users::find($this->users_id);
        return [
            "id" => $user->id,
            "name" => $user->fname.' '.$user->lname,
            "government" => $user->government,
	    "phone" => $user->email,
	    "parent phone" => $user->pphone,
            "score" => $this->score,
            "time" => $this->created_at,
        ];
    }
}
