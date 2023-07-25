<?php

namespace App\Http\Resources;

use App\Models\Homeworks;
use App\Models\Questions;
use App\Models\Quizzes;
use App\Models\Users;
use App\Models\Videos;
use App\Models\Weeks;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->name,
            'students' => $this->students,
            'weeks' => $this->weeks,
            'quizzes' => $this->quizzes,
            'questions' => $this->questions,
            'homeworks' => $this->homeworks,
            'videos' => $this->videos,
            'lastUpdate' => $this->updated_at,
        ];
    }
}
