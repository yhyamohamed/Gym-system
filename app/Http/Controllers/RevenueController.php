<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\TrainingPackage;
use App\Models\TrainingPackageUser;
use App\Models\User;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if($user->hasRole('admin')){

            $allPurchases = TrainingPackageUser::where('payment_status', 'paid');

        } else if($user->hasRole('city_manager')){

            $cityManagerID = User::find($user->id)->city_managers()->first()->id;
            $cityPackagesIDs = Gym::where('city_manager_id', $cityManagerID)->with('training_packages')->get()->pluck('training_packages')->flatten()->pluck('id')->toArray();
            $allPurchases = TrainingPackageUser::where('payment_status', 'paid')->whereIn('training_package_id', $cityPackagesIDs);

        } else if($user->hasRole('gym_manager')){

            $gymManagerID = User::find($user->id)->gym_managers()->first()->id;
            $gymPackagesIDs = GymManager::find($gymManagerID)->gym()->with('training_packages')->get()->pluck('training_packages')->flatten()->pluck('id')->toArray();
            $allPurchases = TrainingPackageUser::where('payment_status', 'paid')->whereIn('training_package_id', $gymPackagesIDs);

        }

        $totalRevenue = $allPurchases->sum('amount_paid');

        return view('tables.revenue', compact('allPurchases', 'totalRevenue'));
    }
}
