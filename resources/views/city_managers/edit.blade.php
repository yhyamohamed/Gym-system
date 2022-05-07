@extends('layouts.admin')
@section('title')
edit City Manager
@endsection




@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('content')
{{-- @dd($city_managers); --}}
<div class="container-fluid offset-md-2">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit City Manager</h3>
              </div>
<form method="POST" action=" {{ route('city_managers.update', ['city_manager' => $city_managers->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body"> 
            <input type="hidden" name="city_manager_id"  value="{{ $city_managers->id }}" />

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $city_managers->name }}">
                @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            
            <div class="mb-3">
               
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $city_managers->email }}">
                @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $city_managers->password }}">
                @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">city</label>
              <input name="city_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $city_managers->city_managers->first()->city_name }}">
              @error('city_name')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>
            <div class="mb-3" >
                <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload image</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="file" name="fileUpload" class="form-control " id="customFile" value= "{{ $city_managers->profile_image}} "/>  
                    </div>                  
                    <div class="col-sm-6">
                            <img src="{{ asset('storage/images/'.$city_managers->profile_image) }}"  style="width:50px;height:50px;"/>
                    </div>
                    @error('fileUpload')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
    $('#city_managers').addClass('active');
  </script>
  @endsection