<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = false;

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
            'name' => $this->name,
            'email' => $this->email,
            'english_level' => $this->english_level,
            'technical_skills' => $this->technical_skills,
            'cv_link' => $this->cv_link,
            'is_admin' => $this->is_admin,
            'is_super_admin' => $this->is_super_admin,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
