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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gender'=>$this->gender,
            'date of birth'=>$this->date_of_birth,
            'profile_image'=>$this->profile_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'access_token' => $this->createToken($request->device_name)->plainTextToken,

        ];
    }
}
