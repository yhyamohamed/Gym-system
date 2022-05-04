<?php

namespace App\Http\Controllers;

use App\Models\TrainingSessionUser;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Get all attendance.
     * 
     */
    public function index() {

        $attendances = TrainingSessionUser::all();

        return view('tables.attendances', compact('attendances'));
    }
}
