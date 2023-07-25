<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
                'iframe' => $this->iframe,
                'noviews' => (string)$this->noviews,
                'minutes_views' => (string)$this->minutes_views,
                'type' => $this->type,
                'video_dauration' => (string)$this->video_dauration,
                'title' => $this->title,
                'level' => $this->level,
                'week_id' => (string)$this->week_id,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
                'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
            ]
        ];
    }
}
