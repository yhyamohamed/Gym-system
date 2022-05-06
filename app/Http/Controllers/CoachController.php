<?php

namespace App\Http\Controllers;
use App\Models\Coach;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use Illuminate\Http\Request;
use DataTables;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        {if ($request->ajax()) {
            $data = Coach::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<center>
                    <a href="' . route('coaches.edit', ['coach' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#usermoadal"
                    data-id=' . $row->id .'>
                    delete
                    </button>
                    </center>';
                
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tables.coaches');
    }
}
    public function create()
    {

       return view('coaches.create'); 
     }

    public function store(StoreCoachRequest $request)
    {   
        Coach::create([
            'name' =>  $request['name'],
        ]);
    
        return redirect()->route('coaches.index');
       
    }
    public function edit($coachId)
    {
        $coaches=Coach::find($coachId);
        return view('coaches.edit',
         ['coaches' => $coaches]);
    }

    public function update(UpdateCoachRequest $request ,$coachId)

    { 
        $coach=Coach::find($coachId);
        if($coach){
           $coach->update([
                'name' =>  $request['name'],
            ]);
    }
        return redirect()->route('coaches.index');

    }

    public function destroy($coachId){
        $coach = Coach::find($coachId);
        if($coach){
            $deleted=$coach->delete();
        }else{
            return response()->json(["message"=> "could't find this coach"] ,400);
        }
        if($deleted){
            return response()->json(["message"=> "coach no. ".$coachId." deleted"] ,200);
        }else{
            return response()->json(["message"=> "something went wrong"] ,400);
        }
        
        
    }
}
