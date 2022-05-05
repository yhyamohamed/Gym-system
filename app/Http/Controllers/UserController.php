<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;



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
        
       return view('users.createuser'); 
     }

    public function store(StoreUserRequest $request)
    {   if ($request->hasFile('fileUpload')) {
        $image=$request->file('fileUpload');
        $name = $image->getClientOriginalName();
        $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        User::create([
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password'=> Hash::make($request->password),
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
        $user = User::find(11);
        if($user){
            $deleted=$user->delete();
        }else{
            return response()->json(["message"=> "could't find this user"] ,400);
        }
        if($deleted){
            return response()->json(["message"=> "user no. ".$userId." deleted"] ,200);
        }else{
            return response()->json(["message"=> "something went wrong"] ,400);
        }
        
        
    }



       
    
}
