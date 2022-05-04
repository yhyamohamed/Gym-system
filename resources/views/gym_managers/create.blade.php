@extends('layouts.admin')
@section('title')
create gym manager
@endsection




@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
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
                <h3 class="card-title">Add Gym Manager</h3>
              </div>
              
<form method="POST" action="{{ route('gym_managers.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body"> 
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>

             <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Confirm-password</label>
                <input name="confirmation_password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Gym ID</label>
                <select name="gym_id" class="form-control">
                    @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->id}}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
            <div>
            <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload image</label>
            <input type="file" name="fileUpload" class="form-control" id="customFile" />
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