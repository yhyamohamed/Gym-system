<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTrainingPackageRequest;
use Illuminate\Http\Request;
use App\Models\TrainingPackage;

class TrainingPackageController extends Controller
{
    /**
     * Get all training packages.
     *
     */
    public function index() {

        $trainingPackages = TrainingPackage::all();
        
        return view('tables.training_packages', compact('trainingPackages'));
    }

    /**
     * Create a new training package.
     *
     */
    public function store(StoreUpdateTrainingPackageRequest $request) {

        TrainingPackage::create($request->all());

        return redirect()->route('tables.training_packages');
    }

    /**
     * Update a training package.
     * 
     */
    public function update(StoreUpdateTrainingPackageRequest $request, TrainingPackage $trainingPackage) {

        $trainingPackage->update($request->all());

        return redirect()->route('tables.training_packages');
    }

    /**
     * Delete a training package.
     *
     */
    public function destroy(TrainingPackage $trainingPackage) {

        $trainingPackage->delete();

        return redirect()->route('tables.training_packages');
    }
}
