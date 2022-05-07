<?php

namespace App\Http\Resources;

use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        $training_session = TrainingSession::find($this->training_session_id);
        return [
            'id' => $this->id,
            'training_session_name' => $training_session->name,
            'gym_name' => $training_session->gyms(),
            'attendance_date' => $this->created_at->format('Y-m-d'),
            'attendance_time' =>  $this->created_at->isoFormat('hh:mm A'),
        ];
    }
}
