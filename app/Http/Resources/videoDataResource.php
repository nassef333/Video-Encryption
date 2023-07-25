<?php

namespace App\Http\Resources;

use App\Models\Videos;
use Illuminate\Http\Resources\Json\JsonResource;

class videoDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //this resource returns data of own specific enrolled video
        // return 'hmamada';
        // return Videos::find($this->video_id);
        $video = Videos::find($this->video_id);
        return[
            'id' => (string)$this->id,
            'attributes' => [
                'count' => $this->count,
                'noviews' => $video->noviews,
                'video_dauration' => $video->video_dauration,
                'first_view' => $video->created_at,
                'last_view' => $video->updated_at,
            ]
        ];
    }
}
