@extends('layouts.admin')
@section('title')
Edit Subscription
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('subscriptions.index') }}">Subscriptions</a></li>
<li class="breadcrumb-item active">Edit Subscription</li>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid offset-md-2">
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Buy Package For User</h3>
                </div>
                <form method="POST" action=" {{ route('subscriptions.update', ['subscription' => $subscription->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Subscriber</label>
                            <select name="user_id" class="form-control">
                                <option value="{{ $subscription['user_id'] }}" selected hidden>{{ $currentUser[$subscription['user_id']-1]->name }}</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Training Package</label>
                            <select name="training_package_id" class="form-control">
                                <option value="{{ $subscription['training_package_id'] }}" selected hidden>{{ $trainingPackages[$subscription['training_package_id']-1]->name }}</option>
                                @foreach ($trainingPackages as $trainingPackage)
                                <option value="{{ $trainingPackage->id }}">{{ $trainingPackage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
                            <select name="gym_id" class="form-control">
                                <option value="{{ $trainingPackages[$subscription['training_package_id']-1]->gym_id }}" selected hidden>{{ $gyms[($trainingPackages[$subscription['training_package_id']-1]->gym_id)-1]->name }}</option>
                                @foreach ($gyms as $gym)
                                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">Buy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('dataTable-scripts')
<script>
    $('#subscriptions').addClass('active');
</script>
@endsection