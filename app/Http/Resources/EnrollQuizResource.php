<?php

namespace App\Http\Resources;

use App\Models\SolvedQuizzes;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollQuizResource extends JsonResource
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
            'img' => $this->img,
            'question' => $this->question,
            'level' => $this->level,
            'c1' => $this->c1,
            'c1_img' => $this->c1_img,
            'c2' => $this->c2,
            'c2_img' => $this->c2_img,
            'c3' => $this->c3,
            'c3_img' => $this->c3_img,
            'c4' => $this->c4,
            'c4_img' => $this->c4_img,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'choosen' => $this->choosen,
            'pivot' => [
                'degree' => $this->degree,
            ],
        ];
    }
}
