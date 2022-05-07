@extends('layouts.admin')
@section('title')
Buy Package For User
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('subscriptions.index') }}">Subscriptions</a></li>
<li class="breadcrumb-item active">Buy Package For User</li>
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
                <form method="POST" action="{{ route('subscriptions.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Subscriber</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Training Package</label>
                            <select name="training_package_id" class="form-control">
                                @foreach ($trainingPackages as $trainingPackage)
                                <option value="{{ $trainingPackage->id }}">{{ $trainingPackage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
                            <select name="gym_id" class="form-control">
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