<?php

namespace App\Http\Resources;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class VideoWatchersResource extends JsonResource
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
            'id' => (string)$this->pivot->id,
            'attributes' => [
                'user_name' => (string)$this->fname.' '.$this->lname,
                'count' => (string)$this->pivot->count,
                'created_at' => Carbon::parse($this->pivot->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->pivot->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
