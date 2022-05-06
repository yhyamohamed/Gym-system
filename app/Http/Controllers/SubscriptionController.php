<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateSubscriptionRequest;
use App\Models\TrainingPackage;
use App\Models\TrainingPackageUser;
use App\Models\User;
use App\Models\Gym;
use Stripe\StripeClient;
use Illuminate\Http\Request;
USE DataTables;

class SubscriptionController extends Controller
{
    /**
     * Get all subscriptions.
     * 
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingPackageUser::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('training_package', function ($row) {
                    $data = TrainingPackage::find($row->training_package_id)->name;
                    return $data;
                })
                ->addColumn('subscriber', function ($row) {
                    $data = User::find($row->user_id)->name;
                    return $data;
                })
                ->addColumn('created_at', function ($row) {
                    $data = $row->created_at->format('y-m-d');
                    return $data;
                })
                ->addColumn('action', function ($row) {
                    return '<center>
                    <a href="' . route('subscriptions.edit', ['subscription' => $row->id]) . '" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                    data-bs-target="#subscription-moadal"
                    data-id=' . $row->id . '>
                    Delete
                    </button>
                    </center>';
                })
                ->rawColumns(['training_package', 'subscriber', 'created_at', 'action'])
                ->make(true);
        }
        return view('tables.subscriptions');
    }

    /**
     * Create a new subscription.
     * 
     */

    public function create()
    {
        $users = User::where('position_id', 4)->get();
        $trainingPackages = TrainingPackage::all();
        $gyms = Gym::all();

        return view('subscriptions.create', [
            'users' => $users,
            'trainingPackages' => $trainingPackages,
            'gyms' => $gyms,
        ]);
    }
    public function store(StoreUpdateSubscriptionRequest $request)
    {

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
     * Edit a subscription.
     * 
     */
    public function edit(TrainingPackageUser $subscription)
    {
        $users = User::where('position_id', 4)->get();
        $currentUser = User::all();
        $trainingPackages = TrainingPackage::all();
        $gyms = Gym::all();
        return view(
            'subscriptions.edit',
            [
                'subscription' => $subscription,
                'users' => $users,
                'currentUser' => $currentUser,
                'trainingPackages' => $trainingPackages,
                'gyms' => $gyms
            ]
        );
    }

    /**
     * Update a subscription.
     * 
     */
    public function update(StoreUpdateSubscriptionRequest $request, TrainingPackageUser $subscription)
    {

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index');
    }

    /**
     * Delete a subscription.
     * 
     */
    public function destroy($subscriptionId)
    {
        $subscription = TrainingPackageUser::find($subscriptionId);
        if ($subscription) {
            $deleted = $subscription->delete();
            if ($deleted) {
                return response()->json([
                    'message' => 'Subscription no. ' . $subscription->id . ' deleted',
                ], 200);
            } else {
                return response()->json(["message" => "Something went wrong"], 400);
            }
        } else {
            return response()->json([
                'message' => 'Can\'t Find this Subscription',
            ], 404);
        }
    }
}
