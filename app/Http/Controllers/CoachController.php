<?php

namespace App\Http\Controllers;
use App\Models\Coach;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;

use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return view('tables.coaches', [
            'coaches' => $coaches,
        ]);
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
        Coach::where('id', $coachId)->delete();
        return redirect()->route('coaches.index');

    }
}
