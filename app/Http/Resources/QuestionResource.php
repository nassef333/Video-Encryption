<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'id' => (string) $this->id,
            'attributes' => [
                'img' => $this->img,
                'question' => $this->question,
                'level' => (string) $this->level,
                'c1' => $this->c1,
                'c1_img' => $this->c1_img,
                'c2' => $this->c2,
                'c2_img' => $this->c2_img,
                'c3' => $this->c3,
                'c3_img' => $this->c3_img,
                'c4' => $this->c4,
                'c4_img' => $this->c4_img,
                'answer' => $this->answer,
                'lesson' => $this->lesson,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
