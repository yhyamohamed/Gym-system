<?php

namespace App\Http\Controllers;
use App\Models\TrainingPackage;

use Illuminate\Http\Request;
use DB;

class RevnueController extends Controller
{
    public function index(){
        $revenue=TrainingPackage::where("gym_id",8)->get();
       $test=DB::table('training_packages')->whereExists(function($query)
        {
            $query->select(DB::price(1))
                  ->from('training_packages')
                  ->whereRaw('training_packages.gym_id = 8');
        })
        ->get();
        return $test;
    }
}
