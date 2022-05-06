<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainingPackage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use DataTables;


class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::all();
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
                    return '<center>
                    <a href="' . route('users.edit', ['user' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#usermoadal"
                    data-id=' . $row->id . '>
                    delete
                    </button>
                    </center>';
                })
                ->rawColumns(['image', 'action', 'date'])
                ->make(true);
        }
        return view('tables.users');
    }

    public function create()
    {

        return view('users.createuser');
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->hasFile('fileUpload')) {
            $image = $request->file('fileUpload');
            $name = $image->getClientOriginalName();
            $imagePath = $request->file('fileUpload')->storeAs('public/images/', $name);
            User::create([
                'name' =>  $request['name'],
                'email' =>  $request['email'],
                'password' => Hash::make($request->password),
                'date_of_birth' => $request['date_of_birth'],
                'gender' => $request['gender'],
                'profile_image' => $name,
                'role_id' => 4,
            ]);
        }
        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
        $users = User::find($userId);
        return view(
            'users.edit',
            ['users' => $users]
        );
    }

    public function update(UpdateUserRequest $request, $userId)

    {
        $user = User::find($userId);
        if ($user) {
            $name = $user->profile_image;


            if ($request->hasFile('fileUpload')) {

                if ($name != null) {
                    File::delete(public_path(Storage::url($user->profile_image)));
                }
                $image = $request->file('fileUpload');
                $name = $image->getClientOriginalName();
                $imagePath = $request->file('fileUpload')->storeAs('public/images/', $name);
            }

            $user->update([
                'name' =>  $request['name'],
                'email' =>  $request['email'],
                'password' => $request['password'],
                'date_of_birth' => $request['date_of_birth'],
                'gender' => $request['gender'],
                'profile_image' => $name,

            ]);
        }
        return redirect()->route('users.index');
    }
    public function destroy($userId)
    {
        $user = User::find($userId);
        if ($user) {
            if ($user->training_sessions()->count()) {
                return response()->json(["status" => false, "message" => "can't delete this user because still having sessions"], 200);
            }
            $deleted = $user->delete();
            if ($deleted) {
                return response()->json(["status" => true, "message" => "user no. " . $userId . " deleted"], 200);
            } else {
                return response()->json(["message" => "something went wrong"], 400);
            }
        } else {
            return response()->json(["message" => "could't find this user"], 400);
        }
    }
}
