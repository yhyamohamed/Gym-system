@extends('layouts.admin')
@section('title')
Create Training Packages
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('training_packages.index') }}">Training Packages</a></li>
<li class="breadcrumb-item active">Create Training Packages</li>
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
                    <h3 class="card-title">Add Training Packages</h3>
                </div>
                <form method="POST" action="{{ route('training_packages.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                            <input name="price" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Total Sessions</label>
                            <input name="total_sessions" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
                            <select name="gym_id" class="form-control">
                                @foreach ($gyms as $gym)
                                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('dataTable-scripts')
<script>
    $('#training_packages').addClass('active');
</script>
@endsection