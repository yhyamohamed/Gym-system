<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTrainingPackageRequest;
use Illuminate\Http\Request;
use App\Models\TrainingPackage;
use App\Models\Gym;
use DataTables;

class TrainingPackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingPackage::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function ($row) {
                    $data = number_format(($row->price) / 100, 2, '.', ' ') . "$";
                    return $data;
                })
                ->addColumn('gym', function ($row) {
                    $data = $row->gym->name;
                    return $data;
                })
                ->addColumn('cover_img', function ($row) {
                    $src = "/$row->cover_img";
                    return '<img src="' . $src . '" style="width:200px;height:100px;" />';
                })
                ->addColumn('created_at', function ($row) {
                    $data = $row->created_at->format('y-m-d');
                    return $data;
                })
                ->addColumn('action', function ($row) {
                    return '<center>
                    <a href="' . route('training_packages.edit', ['trainingPackage' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#training-package-moadal"
                    data-id=' . $row->id . '>
                    Delete
                    </button>
                    </center>';
                })
                ->rawColumns(['price', 'gym', 'created_at', 'action'])
                ->make(true);
        }
        return view('tables.training_packages');
    }

    public function create()
    {
        $gyms = Gym::all();

        return view('training_packages.create', compact('gyms'));
    }


    public function store(StoreUpdateTrainingPackageRequest $request)
    {

        TrainingPackage::create($request->all());

        TrainingPackage::create([
            'name' => $request->name,
            'price' => number_format(($request->price) * 100, 2, '.', ''),
            'total_sessions' => $request->total_sessions,
            'gym_id' => $request->gym_id,
        ]);

        return redirect()->route('training_packages.index');
    }

    /**
     * edit a gym.
     * 
     */
    public function edit(TrainingPackage $trainingPackage)
    {

        return view(
            'training_packages.edit',
            [
                'trainingPackage' => $trainingPackage,
            ]
        );
    }

    /**
     * Update a training package.
     * 
     */
    public function update(StoreUpdateTrainingPackageRequest $request, TrainingPackage $trainingPackage)
    {

        $trainingPackage->update([
            'name' => $request->name,
            'price' => number_format(($request->price) * 100, 2, '.', ''),
            'total_sessions' => $request->total_sessions,
            'gym_id' => $request->gym_id,
        ]);

        return redirect()->route('training_packages.index');
    }

    /**
     * Delete a training package.
     *
     */
    public function destroy(TrainingPackage $trainingPackage)
    {
        if ($trainingPackage) {
            $deleted = $trainingPackage->delete();
            if ($deleted) {
                return response()->json([
                    'message' => 'user no. ' . $trainingPackage->id . ' deleted',
                ], 200);
            } else {
                return response()->json(["message" => "Something went wrong"], 400);
            }
        } else {
            return response()->json([
                'message' => 'Can\'t Find this Training Package',
            ], 404);
        }
    }
}
