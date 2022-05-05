<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCityManagerRequest;
use App\Http\Requests\UpdateCityManagerRequest;

class CityManagerController extends Controller
{
    public function index()
    {
        $city_managers = CityManager::all();
        return view('tables.city_managers', [
            'city_managers' => $city_managers,
        ]);
    }

    public function create()
    {
        

       return view('city_managers.create'); 
     }

    public function store(StoreCityManagerRequest $request)
    {   if ($request->hasFile('fileUpload')) {
        $image=$request->file('fileUpload');
        $name = $image->getClientOriginalName();
        $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
        CityManager::create([
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password'=> Hash::make($request->password),
            'avatar'=>$name,
            
        ]);
        
    }
        return redirect()->route('city_managers.index');
       
    }
    public function edit($city_managerId)
    {
        $city_managers=CityManager::find($city_managerId);
        return view('city_managers.edit',
         ['city_managers' => $city_managers]);
    }

    public function update(UpdateCityManagerRequest $request ,$city_managerId)

    { 
        $city_manager=CityManager::find($city_managerId);
        if($city_manager){
            $name = $city_manager->avatar;
            // dd($name);

            if ($request->hasFile('fileUpload')) {

                if ($name != null) {
                    File::delete(public_path( Storage::url($city_manager->avatar)));
                    
                }
                $image=$request->file('fileUpload');
                $name = $image->getClientOriginalName();
                $imagePath = $request->file('fileUpload')->storeAs('public/images/',$name);
            }

           $city_manager->update([
                'name' =>  $request['name'],
                'email' =>  $request['email'],
                'password'=> $request['password'],
                'avatar'=>$name,
            
            ]);
    }
        return redirect()->route('city_managers.index');

    }

    // public function destroy($city_managerId){
    //     CityManager::where('id', $city_managerId)->delete();
    //     return redirect()->route('city_managers.index');

    // }
    public function destroy($city_managerId){
        $city_manager = CityManager::find(11);
        if($city_manager){
            $deleted=$city_manager->delete();
        }else{
            return response()->json(["message"=> "could't find this manager"] ,400);
        }
        if($deleted){
            return response()->json(["message"=> "manager no. ".$city_managerId." deleted"] ,200);
        }else{
            return response()->json(["message"=> "something went wrong"] ,400);
        }
        
        
    }

}
