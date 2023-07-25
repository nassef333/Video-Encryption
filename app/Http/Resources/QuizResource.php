<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
                'minutes' => (string)$this->minutes,
                'degree' => (string)$this->degree,
                'mindegree' => (string)$this->mindegree,
		'noquestions' => (string)$this->noquestions,
                'answerTime' => (string)$this->answerTime,
                'start' => $this->start,
                'end' => $this->end,
                'level' => $this->level,
		'prize' => $this->prize,
		'prizeDegree' => $this->prizeDegree,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
