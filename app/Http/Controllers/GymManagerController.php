<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymManager;
use App\Models\Gym;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\User;
use DataTables;

class GymManagerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('position_id', 3)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $data = $row->created_at->format('y-m-d');
                    return $data;
                })
                ->addColumn('image', function ($row) {
                    $src = asset('storage/images/' . $row->profile_image);
                    return '<img src="' . $src . '" style="width:50px;height:50px;" />';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('gym_managers.edit', ['gym_manager' => $row->id]) . '" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                data-bs-target="#usermoadal"
                data-id=' . $row->id . '>
                delete
                    </button>
                    ';
                })
                ->rawColumns(['image', 'action', 'date'])
                ->make(true);
        }
        return view('tables.gym_managers');
    }

    public function create()
    {
        $gyms = Gym::all();

        return view('gym_managers.create', [
            'gyms' => $gyms
        ]);
    }

    public function store(StoreGymManagerRequest $request)
    {
        if ($request->hasFile('fileUpload')) {
            $image = $request->file('fileUpload');
            $name = $image->getClientOriginalName();
            $imagePath = $request->file('fileUpload')->storeAs('public/images/', $name);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => $name,
                'position_id' => 3,
            ]);

            GymManager::create([
                'user_id' => $user->id,
                'gym_id' => $request['gym_id'],
            ]);
        }
        return redirect()->route('gym_managers.index');
    }
    public function edit($gym_managerId)
    {
        $gym_managers = User::find($gym_managerId);
        $gyms = Gym::all();
        return view(
            'gym_managers.edit',
            ['gym_managers' => $gym_managers, 'gyms' => $gyms]
        );
    }

    public function update(UpdateGymManagerRequest $request, $gym_managerId)
    {
        $user = User::find($gym_managerId);
        if ($user) {
            $name = $user->profile_image;
            // dd($name);

            if ($request->hasFile('fileUpload')) {

                if ($name != null) {
                    File::delete(public_path(Storage::url($user->profile_image)));
                }
                $image = $request->file('fileUpload');
                $name = $image->getClientOriginalName();
                $imagePath = $request->file('fileUpload')->storeAs('public/images/', $name);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => $name,
            ]);
            $gym_manager = GymManager::where('user_id', $user->id)->first();
            $gym_manager->update([
                'gym_id' => $request['gym_id'],
            ]);
        }
        return redirect()->route('gym_managers.index');
    }

    public function ban($gym_managerId)
    {
        $user = User::find($gym_managerId);
        $user->ban();
        return response()->json(['success' => 'Gym manager banned successfully.']);
    }

    public function unban($gym_managerId)
    {
        $user = User::find($gym_managerId);
        $user->unban();
        return response()->json(['success' => 'Gym manager unbanned successfully.']);
    }

    public function destroy($gym_managerId)
    {
        $user = User::find($gym_managerId);
        if ($user) {
            $gym_manager = GymManager::where('user_id', $user->id)->first();
            $gym_manager->delete();
            $deleted = $user->delete();
        } else {
            return response()->json(["message" => "could't find this manager"], 400);
        }
        if ($deleted) {
            return response()->json(["message" => "manager no. " . $gym_managerId . " deleted"], 200);
        } else {
            return response()->json(["message" => "something went wrong"], 400);
        }
    }
}
