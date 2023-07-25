<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeekContentResource extends JsonResource
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
            'quizzes' => $this->quizzes,
            'videos' => $this->videos,
            'homeworks' => $this->homeworks,
            'materials' => $this->materials,
            'data' => $this->data,
        ];
    }
}
