<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeworkResource extends JsonResource
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
                'week_id' => $this->week_id,
                'title' => $this->title,
                'cdn' => $this->cdn,
                'degree' => (string)$this->degree,
                'mindegree' => (string)$this->mindegree,
                'minutes' => (string)$this->minutes,
                'level' => (string)$this->level,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
