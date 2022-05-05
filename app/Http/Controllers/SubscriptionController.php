<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateSubscriptionRequest;
use App\Models\TrainingPackage;
use App\Models\TrainingPackageUser;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Get all subscriptions.
     * 
     */
    public function index() {

        $subscriptions = TrainingPackageUser::all();

        return view('tables.subscriptions', compact('subscriptions'));
    }

    /**
     * Create a new subscription.
     * 
     */
    public function store(StoreUpdateSubscriptionRequest $request) {

        $stripe = new StripeClient(config('services.stripe.secret'));

        $trainingPackage = TrainingPackage::find($request->training_package_id);

        $price = $stripe->prices->create([
            'unit_amount' => $trainingPackage->price,
            'currency' => 'usd',
            'product' => $trainingPackage->stripe_product_id,
        ]);

        $paymentLink = $stripe->paymentLinks->create([
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 1,
                ],
            ],
            'after_completion' => [
                'type' => 'redirect',
                'redirect' => [
                    'url' => route('training_packages.index'),
                ],
            ]
        ]);

        $data = $request->all();

        $data['amount_paid'] = $trainingPackage->price;

        $data['remaining_sessions'] = $trainingPackage->total_sessions;

        $data['payment_status'] = 'pending';

        $data['payment_link_id'] = $paymentLink->id;
        
        TrainingPackageUser::create($data);

        return redirect()->to($paymentLink->url);
    }

    /**
     * Update a subscription.
     * 
     */
    public function update(StoreUpdateSubscriptionRequest $request, TrainingPackageUser $subscription) {

        $subscription->update($request->all());

        return redirect()->route('tables.subscriptions');
    }

    /**
     * Delete a subscription.
     * 
     */
    public function destroy(TrainingPackageUser $subscription) {

        $subscription->delete();

        return redirect()->route('tables.subscriptions');
    }
}
