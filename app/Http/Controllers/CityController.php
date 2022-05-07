<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityManager;
use App\Http\Resources\CityManagerResource;
use DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->ajax()) {

            
            $data = CityManagerResource::collection(CityManager::all(['id', 'NID']));
            dd($data);
            // return DataTables::of($data)
            //     ->addIndexColumn()
            //     ->make(true);
            return view('tables.cities');
        // }
    }
}
