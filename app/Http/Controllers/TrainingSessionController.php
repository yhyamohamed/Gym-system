<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTrainingSessionRequest;
use App\Models\TrainingSession;
use App\Models\Coach;
use App\Models\TrainingPackage;
use Illuminate\Http\Request;
use DataTables;

class TrainingSessionController extends Controller
{
    /**
     * Get all training sessions.
     *
     */
    // public function index() {

    //     $trainingSessions = TrainingSession::all();

    //     return view('tables.training_sessions', compact('trainingSessions'));
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingSession::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('start at', function ($row) {
                    $data = $row->start_at->toDayDateTimeString();
                    return $data;
                })
                ->addColumn('finish at', function ($row) {
                    $data = $row->finish_at->toDayDateTimeString();
                    return $data;
                })
                // ->addColumn('image', function ($row) {
                //     $src = asset('storage/images/'. $row->profile_image);
                //     return '<img src="' . $src . '" style="width:50px;height:50px;" />';
                // })
                ->addColumn('action', function ($row) {
                    return '<center>
                    <a href="' . route('training_sessions.edit', ['trainingSession' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#training-session-modal"
                    data-id=' . $row->id . '
                    >
                    Delete
                    </button>
                    </center>';      
                })
                ->rawColumns(['start at', 'finish at', 'action'])
                ->make(true);
        }
        return view('tables.training_sessions');
    }

    /**
     * Create a new training session.
     *
     */
    public function create()
    {
        $coaches = Coach::all();
        $trainingPackages = TrainingPackage::all();

        return view('training_sessions.create', compact('coaches', 'trainingPackages'));
    }

    /**
     * Store a new training session.
     *
     */
    public function store(StoreUpdateTrainingSessionRequest $request) {
        
        // Gym::create([
        //     'name' => $request->name,
        //     'creator' => $request->creator,
        //     'cover_img' => str_replace('public', 'storage', $path),
        //     'city_manager_id' => $request->city_manager_id,
        // ]);
        $trainingSession = new TrainingSession();
        // TrainingSession::create($request->all());
        $trainingSession -> id = 20;
        $trainingSession -> name = $request -> name;
        $trainingSession -> start_at = $request -> start_at;
        $trainingSession -> finish_at = $request -> finish_at;
        $trainingSession -> training_package_id = $request -> training_package_id;
        $trainingSession -> coaches() -> attach($request -> coaches);
        // 'name',
        // 'start_at',
        // 'finish_at',
        // 'gym_id',
        // 'training_package_id'

        return redirect()->route('training_sessions.index');
    }

    /**
     * edit training session.
     *
     */
    public function edit(TrainingSession $trainingSession)
    {
        $coaches = Coach::all();
        $trainingPackages = TrainingPackage::all();
        
        return view(
            'training_sessions.edit',
            [
                'trainingSession' => $trainingSession,
                'coaches' => $coaches,
                'trainingPackages' => $trainingPackages
            ]
        );
    }

    /**
     * Update a training session.
     * 
     */
    public function update(StoreUpdateTrainingSessionRequest $request, TrainingSession $trainingSession) {

        if($trainingSession->users()->count()) {
            return redirect()->back()->with('error', 'Can\'t update a training session that has users.');
        }

        $trainingSession->update($request->all());

        return redirect()->route('training_sessions.index');
    }

    /**
     * Delete a training session.
     *
     */
    public function destroy( $trainingSessionID) {

        $trainingSession = TrainingSession::find($trainingSessionID);
        
        if($trainingSession){
            if($trainingSession->users()->count()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Can\'t delete a Training session that has a user',
                ], 200);
            }
            $deleted = $trainingSession->delete();
            if($deleted){
                return response()->json([
                    'status' => true,
                    'message' => 'user no. ' . $trainingSession->id . ' deleted',
                ], 200);
                } else{
                return response()->json(["message"=> "something went wrong"], 400);
                }
            } else{
                return response()->json(["message"=> "could't find this training session"], 400);
            }
            

        $trainingSession->delete();

        return redirect()->route('tables.training_sessions');
    }

}
