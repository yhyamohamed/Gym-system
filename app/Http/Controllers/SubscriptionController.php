<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateSubscriptionRequest;
use App\Models\TrainingPackageUser;
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

        TrainingPackageUser::create($request->all());

        return redirect()->route('tables.subscriptions');
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
