<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\AttendanceResource;
use App\Models\TrainingSessionUser;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        // $user_sessions = $request->user()->training_sessions;
        // return  $user_sessions;
        // return ;
        return  AttendanceResource::collection(TrainingSessionUser::where('user_id', $request->user()->id)->get());
    }

    public function remainingSessions(Request $request)
    {
        // {total_training_sessions:1000 ,//training package
        //     remaining__training_sessions:300}training package user
    }
    public function store(Request $request)
    {
        //
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
