<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;

class GymController extends Controller
{
    public function index()
    {
        $gyms = Gym::all();
        return view('tables.gyms', [
            'gyms' => $gyms,
        ]);
    }
}
