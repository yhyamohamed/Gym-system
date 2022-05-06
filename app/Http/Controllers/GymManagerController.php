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
use DataTables;

class GymManagerController extends Controller
{
    public function index(Request $request)
    {if ($request->ajax()) {
        $data = GymManager::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($row) {
                $data = $row->created_at->format('y-m-d');
                return $data;
            })
            ->addColumn('image', function ($row) {
                $src = asset('storage/images/'. $row->profile_image);
                return '<img src="' . $src . '" style="width:50px;height:50px;" />';
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('gym_managers.edit', ['gym_manager' => $row->id]) . '" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                data-bs-target="#usermoadal"
                data-id=' . $row->id .'>
                delete
                    </button>
                    ';
            
            })
            ->rawColumns(['image', 'action','date'])
            ->make(true);
    }
    return view('tables.gym_managers');
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

    // public function destroy($gym_managerId){
    //     GymManager::where('id', $gym_managerId)->delete();
    //     return redirect()->route('gym_managers.index');

    // }
    public function destroy($gym_managerId){
        $gym_manager = GymManager::find($gym_managerId);
        if($gym_manager){
            $deleted=$gym_manager->delete();
        }else{
            return response()->json(["message"=> "could't find this manager"] ,400);
        }
        if($deleted){
            return response()->json(["message"=> "manager no. ".$gym_managerId." deleted"] ,200);
        }else{
            return response()->json(["message"=> "something went wrong"] ,400);
        }
        
        
    }


}
