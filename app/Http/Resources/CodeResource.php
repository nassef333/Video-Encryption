<?php

namespace App\Http\Resources;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $user = Users::where('id', $this->user_id)->first();
        // $name = "";
        // if ($user) $name = $user->fname . ' ' . $user->lname;

        return [
            'id' => (string)$this->id,
            'admin' => $this->admin,
            'value' => (string)$this->value,
            'code' => $this->code,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
        ];
    }
}
