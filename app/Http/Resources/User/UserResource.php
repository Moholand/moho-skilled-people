<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Skill\SkillResource;
use App\Http\Resources\Country\CountryResource;
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
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'country_id' => $this->country_id,
            'country' => new CountryResource($this->country),
            'skills' => SkillResource::collection($this->skills)
        ];
    }
}
