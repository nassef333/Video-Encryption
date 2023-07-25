<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeworkStudentsResource extends JsonResource
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
            'name' => $this->fname.' '.$this->lname,
            'phone' => $this->email,
            'pphone' => $this->pphone,
            'degree' => $this->pivot->score,
            'government' => $this->government,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
