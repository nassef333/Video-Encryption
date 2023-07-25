<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizStudentsResource extends JsonResource
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
            'id' => $this->pivot->id,
            'student_id' => $this->id,
            'quiz_id' => $this->pivot->quizzes_id,
            'name' => $this->fname.' '.$this->lname,
            'phone' => $this->email,
            'pphone' => $this->pphone,
            'degree' => $this->pivot->score,
            'government' => $this->government,
        ];    }
}
