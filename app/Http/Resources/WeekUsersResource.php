<?php

namespace App\Http\Resources;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WeekUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return $this->user_id;
        // $user = Users::find($this->user_id);
        // return $user;
        // return $this;
        return [
            'id' => $this->pivot->id,
            'attributes' => [
                'user_id' => $this->pivot->user_id,
                'phone' => $this->email,
                'name' => $this->fname . ' ' . $this->lname,
                'created_at' => Carbon::parse($this->pivot->created_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
