<?php

namespace App\Http\Resources\Employer;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
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
            'company_name' => $this->company_name,
            'slug' => $this->slug,
            'company_email' => $this->company_email,
            'company_address' => $this->company_address,
            'users' => UserResource::collection($this->users)
        ];
    }
}
