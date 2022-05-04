<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('tables.users', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $users=User::all();

       return view('users.createuser',[
           'users' => $users
        ]); 
     }

    public function store(StoreUserRequest $request)
    {   if ($request->hasFile('fileUpload')) {
        $image=$request->file('fileUpload');
        $name = $image->getClientOriginalName();
        $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        User::create([
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password'=> $request['password'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'profile_image'=>$name,
            
        ]);
    }
        return redirect()->route('users.index');
       
    }

    public function edit($userId)
    {
        $users=User::find($userId);
        return view('users.edit',
         ['users' => $users]);
    }

    public function update(UpdateUserRequest $request ,$userId)

    { 
        $user=User::find($userId);
        if($user){
            $name = $user->profile_image;
            // dd($name);

            if ($request->hasFile('fileUpload')) {

                if ($name != null) {
                    File::delete(public_path( Storage::url($user->profile_image)));
                    
                }
                $image=$request->file('fileUpload');
                $name = $image->getClientOriginalName();
                $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
            }

           $user->update([
                'name' =>  $request['name'],
                'email' =>  $request['email'],
                'password'=> $request['password'],
                'date_of_birth' => $request['date_of_birth'],
                'gender' => $request['gender'],
                'profile_image'=>$name,
            
            ]);
    }
        return redirect()->route('users.index');

    }

    public function destroy($userId){
        User::where('id', $userId)->delete();
        return redirect()->route('users.index');

    }


       
    
}
