<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUpdateRequest;

class UserController extends Controller
{

    public function index()
    {

        return User::all();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        //NOTE : creating token is done in the user resource to send it bk
        return new UserResource($user);
    }

    public function store(Request $request, StoreUserRequest $userRequest)
    {
        $hashedPass = Hash::make($request->password);
        $request->merge(['password' => $hashedPass]);
        //TO DO validate request via storePostRequest
        return User::create($request->except('password_confirmation'));
    }


    public function show(User $user)
    {
        return $user;
    }


    public function update(StoreUpdateRequest $request, User $user)
    {

        $isupdated = $user->update($request->all());
        if ($isupdated)
            return response()->json(['updated' => $isupdated], 200);
        else
            return response()->json(['updated' => $isupdated], 500);
    }


    public function destroy($id)
    {
        //
    }
}
