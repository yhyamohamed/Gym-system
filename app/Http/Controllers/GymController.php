<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\CityManager;
use App\Models\User;
use DataTables;

class GymController extends Controller
{
    /**
     * Get all gyms.
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Gym::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('city_manager', function ($row) {
                    $data = $row->city_manager->user->name;
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
                    <a href="' . route('gyms.edit', ['gym' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#gym-moadal"
                    data-id=' . $row->id . '>
                    Delete
                    </button>
                    </center>';
                })
                ->rawColumns(['city_manager', 'cover_img', 'created_at', 'action'])
                ->make(true);
        }
        return view('tables.gyms');
    }

    /**
     * Create a new gym.
     *
     */
    public function create()
    {
        $cityMangers = User::where('position_id', 2)->get();

        return view('gyms.create', [
            'cityMangers' => $cityMangers,
        ]);
    }

    /**
     * Store a new gym.
     *
     */
    public function store(StoreGymRequest $request)
    {

        $path = $request->file('cover_img')->store('public/gyms');

        Gym::create([
            'name' => $request->name,
            'creator' => CityManager::find($request->city_manager_id)->user->name,
            'cover_img' => str_replace('public', 'storage', $path),
            'city_manager_id' => $request->city_manager_id,
        ]);

        return redirect()->route('gyms.index');
    }

    /**
     * edit a gym.
     *
     */
    public function edit(Gym $gym)
    {
        $cityMangers = User::where('position_id', 2)->get();

        return view(
            'gyms.edit',
            [
                'gym' => $gym,
                'cityMangers' => $cityMangers,
            ]
        );
    }

    /**
     * Update a gym.
     *
     */
    public function update(UpdateGymRequest $request, Gym $gym)
    {

        $gym->update([
            'name' => $request->name,
            'city_manager_id' => $request->city_manager_id,
        ]);

        if ($request->hasFile('cover_img')) {
            Storage::delete(str_replace('storage', 'public', $gym->cover_img));
            $path = $request->file('cover_img')->store('public/gyms');
            $gym->cover_img = str_replace('public', 'storage', $path);
            $gym->save();
        }

        return redirect()->route('gyms.index');
    }

    /**
     * Delete a gym.
     *
     */
    public function destroy($gymId)
    {
        $gym = Gym::find($gymId);
        if ($gym) {
            if ($gym->training_sessions()->count()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Can\'t delete a Gym that has a Session',
                ], 200);
            }
            $deleted = $gym->delete();

            if ($deleted) {
                Storage::delete(str_replace('storage', 'public', $gym->cover_img));
                return response()->json([
                    'status' => true,
                    'message' => 'Gym no. ' . $gym->id . ' deleted',
                ], 200);
            } else {
                return response()->json(["message" => "Something went wrong"], 400);
            }
        } else {
            return response()->json([
                'message' => 'Can\'t Find this Gym',
            ], 404);
        }
    }
}
