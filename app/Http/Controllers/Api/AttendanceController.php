<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\RemainingSessionsResource;
use App\Models\TrainingSessionUser;
use App\Models\TrainingPackageUser;
use App\Http\Requests\storeAttendanceRequest;
use App\Models\TrainingSession;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {   
        $userTrainingSession=TrainingSessionUser::where('user_id', $request->user()->id)->get();
      
        if($userTrainingSession){
            return  AttendanceResource::collection($userTrainingSession);
        }else{
            return response()->json(["message" => "you don't have any training sessions"], 409);
        }
        
    }

    public function remainingSessions(Request $request)
    {

        return RemainingSessionsResource::collection(TrainingPackageUser::where('user_id', $request->user()->id)->get());
    }
    public function store(storeAttendanceRequest $request)
    {
        //find training session 
        $training_session = TrainingSession::find($request->training_session_id);
        if ($training_session){
        $target_package =  $training_session->training_packages;
        //attend 
        $attend =  TrainingSessionUser::create($request->all());
        //minus remaining
        $target = TrainingPackageUser::where('training_package_id', $target_package->id)
            ->where('user_id', $attend->user_id)
            ->get()->first();
            $target->decrement('remaining_sessions');
            return ;
            
            return response()->json(['remaining_sessions' => $target->remaining_sessions], 200);
        }else{
            return response()->json(['Error' => 'some thing went wrong'], 500);
        }
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
