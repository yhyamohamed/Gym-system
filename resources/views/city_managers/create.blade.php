@extends('layouts.admin')
@section('title')
Create City Manager
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active"><a href="{{ route('city_managers.index') }}">City Managers</a></li>
<li class="breadcrumb-item active">Create City Manager</li>
@endsection

@section('content')

<div class="container-fluid offset-md-2">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add City Manager</h3>
              </div>
              
<form method="POST" action="{{ route('city_managers.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body"> 
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

             <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Confirm-password</label>
                <input name="confirmation_password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('confirmation_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">National Id</label>
                <input name="NID" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('NID')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">city</label>
              <input name="city_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
              @error('city_name')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>

            <div class="mb-3">
            <div>
            <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload image</label>
            <input type="file" name="fileUpload" class="form-control" id="customFile" />
            @error('fileUpload')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            
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
    $('#city-managers').addClass('active');
  </script>
  @endsection