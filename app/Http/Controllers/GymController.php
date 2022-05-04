<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\CityManager;

class GymController extends Controller
{
    /**
     * Get all gyms.
     *
     */
    public function index()
    {

        $gyms = Gym::all();

        return view('tables.gyms', compact('gyms'));
    }

    /**
     * Create a new gym.
     *
     */
    public function create()
    {
        $cityMangers = CityManager::all();

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
            'creator' => $request->creator,
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
        $cityMangers = CityManager::all();

        return view('gyms.edit', [
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
            'creator' => $request->creator,
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
    public function destroy(Request $request, Gym $gym)
    {
        $gym_ = Gym::find($request->id);
        if($gym->training_sessions()->count()) {
            return response()->json([
                'status' => false,
                'Erorr' => 'cant delete a gym that has a session  ',
            ]); 
        }
        Storage::delete(str_replace('storage', 'public', $gym_->cover_img));
        $gym_->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Deleted',
            'id' => $request->id,
        ]);
    }
}
