<?php

namespace App\Http\Controllers;

use App\Models\TrainingSessionUser;
use App\Models\User;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use DataTables;

class AttendanceController extends Controller
{
    /**
     * Get all attendance.
     * 
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingSessionUser::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    $data = User::find($row->user_id)->name;
                    return $data;
                })
                ->addColumn('user_email', function ($row) {
                    $data = User::find($row->user_id)->email;
                    return $data;
                })
                ->addColumn('training_session_name', function ($row) {
                    $data = TrainingSession::find($row->training_session_id)->name;
                    return $data;
                })
                ->addColumn('attendance_time', function ($row) {
                    $data = $row->created_at->format('g:i A');
                    return $data;
                })
                ->addColumn('attendance_date', function ($row) {
                    $data = $row->created_at->format('y-m-d');
                    return $data;
                })
                ->addColumn('gym', function ($row) {
                    $data = TrainingSession::find($row->training_session_id)->training_package->gym->name;
                    return $data;
                })
                ->addColumn('city', function ($row) {
                    $data = '-';
                    return $data;
                })
                ->rawColumns(['user_name', 'user_email', 'training_session_name', 'attendance_time', 'attendance_date', 'gym', 'city'])
                ->make(true);
        }
        return view('tables.attendances');
    }
}
