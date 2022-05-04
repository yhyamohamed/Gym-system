<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\TrainingPackage;
use App\Models\User;
class RemainingSessionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
     { 
        $package_id = $this->training_package_id;
        $package = TrainingPackage::find($package_id);
        
        return [
            'total_training_sessions' => $this->remaining_sessions,
            'remaining__training_sessions' => $package->total_sessions,
        ];
    }
}
