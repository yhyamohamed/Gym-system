<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTrainingPackageRequest;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\TrainingPackage;
use App\Models\Gym;

class TrainingPackageController extends Controller
{
   
    public function index()
    {

        $trainingPackages = TrainingPackage::all();

        return view('tables.training_packages', compact('trainingPackages'));
    }

    public function create()
    {
        $gyms = Gym::all();

        return view('training_packages.create', compact('gyms'));
    }

    
    public function store(StoreUpdateTrainingPackageRequest $request)
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        $stripeProduct = $stripe->products->create([
            'name' => $request->name,
        ]);

        $data = $request->all();

        $data['stripe_product_id'] = $stripeProduct->id;

        TrainingPackage::create($data);

        return redirect()->route('training_packages.index');
    }

    /**
     * edit a gym.
     * 
     */
    public function edit(TrainingPackage $trainingPackage)
    {

        return view(
            'training_packages.edit',
            [
                'trainingPackage' => $trainingPackage,
            ]
        );
    }

    /**
     * Update a training package.
     * 
     */
    public function update(StoreUpdateTrainingPackageRequest $request, TrainingPackage $trainingPackage)
    {
      
        $trainingPackage->update([
            'name' => $request->name,
            'price' => number_format(($request->price)*100, 2, '.', ''),
            'total_sessions' => $request->total_sessions,
            'gym_id' => $request->gym_id,
        ]);

        return redirect()->route('training_packages.index');
    }

    /**
     * Delete a training package.
     *
     */
    public function destroy(Request $request, TrainingPackage $trainingPackage)
    {
        $trainingPackage_ = TrainingPackage::find($request->id);
        $trainingPackage_->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Deleted',
            'id' => $request->id,
        ]);
        // $trainingPackage->delete();

        // return redirect()->route('tables.training_packages');
    }
}
