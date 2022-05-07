@extends('layouts.admin')
@section('title')
Edit Training Package
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('training_packages.index') }}">Training Packages</a></li>
<li class="breadcrumb-item active">Edit Training Package</li>
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
          <h3 class="card-title">Edit Training Package</h3>
        </div>
        <form method="POST" action=" {{ route('training_packages.update', ['trainingPackage' => $trainingPackage->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <input type="hidden" name="trainingPackage_id" value="{{ $trainingPackage->id }}" />
            <input type="hidden" name="gym_id" value="{{ $trainingPackage->gym_id }}" />
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Name</label>
              <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $trainingPackage->name }}">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Price</label>
              <input name="price" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ number_format(($trainingPackage->price)/100, 2, '.', '') }}">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Total Sessions</label>
              <input name="total_sessions" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $trainingPackage->total_sessions }}">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
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