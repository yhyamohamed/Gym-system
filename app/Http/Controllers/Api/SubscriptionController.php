<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrainingPackageUser;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    /**
     * Stripe webhook endpoint.
     * 
     */
    public function checkoutEndpoint(Request $request) {

        if ($request->has('data.object.payment_link')) {

            $subscription = TrainingPackageUser::where('payment_link_id', $request->input('data.object.payment_link'))->first();

            if($request->input('data.object.payment_status') == 'paid') {
                $subscription->payment_status = 'paid';
            } else {
                $subscription->payment_status = 'failed';
            }

            $subscription->save();
        }
    }
}
