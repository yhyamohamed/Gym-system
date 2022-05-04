<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTrainingSessionRequest;
use App\Models\TrainingSession;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    /**
     * Get all training sessions.
     *
     */
    public function index() {

        $trainingSessions = TrainingSession::all();

        return view('tables.training_sessions', compact('trainingSessions'));
    }

    /**
     * Create a new training session.
     *
     */
    public function store(StoreUpdateTrainingSessionRequest $request) {
        
        TrainingSession::create($request->all());

        return redirect()->route('tables.training_sessions');
    }

    /**
     * Update a training session.
     * 
     */
    public function update(StoreUpdateTrainingSessionRequest $request, TrainingSession $trainingSession) {

        $trainingSession->update($request->all());

        return redirect()->route('tables.training_sessions');
    }

    /**
     * Delete a training session.
     *
     */
    public function destroy(TrainingSession $trainingSession) {

        $trainingSession->delete();
        
        return redirect()->route('tables.training_sessions');
    }
}
