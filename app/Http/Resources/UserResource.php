<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'fname' => $this->fname,
                'lname' => $this->lname,
                'email' => $this->email,
                'phone' => $this->phone,
                'pphone' => $this->pphone,
                'government' => $this->government,
                'level' => (string)$this->level,
                'approved' => (string)$this->approved,
                'role' => (string)$this->role,
                'balance' => (string)$this->balance,
            ]
        ];
    }
}
