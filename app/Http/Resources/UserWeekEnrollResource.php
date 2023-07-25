<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserWeekEnrollResource extends JsonResource
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
                'week_id' => (string)$this->week_id,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
