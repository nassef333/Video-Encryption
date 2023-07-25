<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserVideosEnrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'user_id' => (string)Auth::user()->id,
                'video_id' => (string)$this->video_id,
                'count' => (string)$this->count,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
