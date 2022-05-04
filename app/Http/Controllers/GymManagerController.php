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

class GymManagerController extends Controller
{
    public function index()
    {
        $gym_managers = GymManager::all();
        return view('tables.gym_managers', [
            'gym_managers' => $gym_managers,
        ]);
    }

    public function create()
    {
        $gyms=Gym::all();

       return view('gym_managers.create',[
           'gyms' => $gyms
        ]); 
     }

    public function store(StoreGymManagerRequest $request)
    {   if ($request->hasFile('fileUpload')) {
        $image=$request->file('fileUpload');
        $name = $image->getClientOriginalName();
        $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        GymManager::create([
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password'=> Hash::make($request->password),
            'gym_id' =>$request['gym_id'],
            'avatar'=>$name,
            
        ]);
        
    }
        return redirect()->route('gym_managers.index');
       
    }
    public function edit($gym_managerId)
    {
        $gym_managers=GymManager::find($gym_managerId);
        $gyms=Gym::all();
        return view('gym_managers.edit',
         ['gym_managers' => $gym_managers, 'gyms' => $gyms]);
    }

    public function update(UpdateGymManagerRequest $request ,$gym_managerId)

    { 
        $gym_manager=GymManager::find($gym_managerId);
        if($gym_manager){
            $name = $gym_manager->avatar;
            // dd($name);

            if ($request->hasFile('fileUpload')) {

                if ($name != null) {
                    File::delete(public_path( Storage::url($gym_manager->avatar)));
                    
                }
                $image=$request->file('fileUpload');
                $name = $image->getClientOriginalName();
                $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
            }

           $gym_manager->update([
                'name' =>  $request['name'],
                'email' =>  $request['email'],
                'password'=> $request['password'],
                'gym_id' =>$request['gym_id'],
                'avatar'=>$name,
            
            ]);
    }
        return redirect()->route('gym_managers.index');

    }

    public function destroy($gym_managerId){
        GymManager::where('id', $gym_managerId)->delete();
        return redirect()->route('gym_managers.index');

    }

}
