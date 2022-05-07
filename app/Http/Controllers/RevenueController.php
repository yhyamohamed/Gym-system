<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\TrainingPackage;
use App\Models\TrainingPackageUser;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class RevenueController extends Controller
{
    public function index(Request $request)
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

        $totalRevenue = "$" . number_format($allPurchases->sum('amount_paid') / 100, 2, '.', ',');

        if ($request->ajax()) {
            return DataTables::of($allPurchases)
            ->addIndexColumn()
            ->addColumn('user_name', function ($row) {
                $data = User::find($row->user_id)->name;
                return $data;
                })
            ->addColumn('training_package_name', function ($row) {
                $data = TrainingPackage::find($row->training_package_id)->name;
                return $data;
            })
            ->addColumn('email', function ($row) {
                $data = User::find($row->user_id)->email;
                return $data;
            })
            ->addColumn('amount_paid', function ($row) {
                $data = "$" . number_format(($row->amount_paid) / 100, 2, '.', ' ');
                return $data;
            })
            ->addColumn('created_at', function ($row) {
                $data = $row->created_at->toDateTimeString();
                return $data;
            })
            ->rawColumns(['user_name', 'training_package_name', 'email', 'amount_paid', 'created at'])
            ->make(true);
        }
            return view('tables.revenue', compact('totalRevenue'));
    }

}
