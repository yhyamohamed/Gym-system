<?php

namespace App\Http\Resources;
use App\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class GymManagerResource extends JsonResource
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
            'name'=> $this->name,
            'id' => $this->id,
            'email'=>$this->email,
            'created_at'=>$this->created_at->format('y-m-d'),
            'profile_image'=>$this->profile_image,
            'gym_name'=> $this->gym_managers->first(),
        ];

    }
}
