<?php

namespace App\Http\Resources;

use App\Models\UserWeeks;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class WeekAuthedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isEnrolled = 'true';
        if(!UserWeeks::where('week_id', $this->id)->where('user_id', Auth::user()->id)->exists())
            $isEnrolled = 'false';
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'price' => (string)$this->price,
                'img' => $this->img,
                'level' => $this->level,
                'Owned' => $isEnrolled,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
