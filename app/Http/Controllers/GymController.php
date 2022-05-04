<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Gym;

class GymController extends Controller
{
    /**
     * Get all gyms.
     *
     */
    public function index() {
        
        $gyms = Gym::all();

        return view('tables.gyms', compact('gyms'));
    }

    /**
     * Create a new gym.
     *
     */
    public function store(StoreGymRequest $request) {

        $path = $request->file('cover_img')->store('public/gyms');
        
        Gym::create([
            'name' => $request->name,
            'creator' => $request->creator,
            'cover_img' => str_replace('public', 'storage', $path),
            'city_manager_id' => $request->city_manager_id,
        ]);

        return redirect()->route('tables.gyms');
    }

    /**
     * Update a gym.
     * 
     */
    public function update(UpdateGymRequest $request, Gym $gym) {

        $gym->update([
            'name' => $request->name,
            'creator' => $request->creator,
            'city_manager_id' => $request->city_manager_id,
        ]);

        if($request->hasFile('cover_img')) {
            Storage::delete(str_replace('storage', 'public', $gym->cover_img));
            $path = $request->file('cover_img')->store('public/gyms');
            $gym->cover_img = str_replace('public', 'storage', $path);
            $gym->save();
        }

        return redirect()->route('tables.gyms');
    }

    /**
     * Delete a gym.
     *
     */
    public function destroy(Gym $gym) {
        
        Storage::delete(str_replace('storage', 'public', $gym->cover_img));
        $gym->delete();

        return redirect()->route('tables.gyms');
    }
}
