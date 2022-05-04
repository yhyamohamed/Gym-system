@extends('layouts.admin')
@section('title')
edit Gym Manager
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
                <h3 class="card-title">Edit Gym Manager</h3>
              </div>
<form method="POST" action=" {{ route('gym_managers.update', ['gym_manager' => $gym_managers->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body"> 
            <input type="hidden" name="gym_manager_id"  value="{{ $gym_managers->id }}" />

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $gym_managers->name }}">
            </div>

            
            <div class="mb-3">
               
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $gym_managers->email }}">
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $gym_managers->password }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Gym ID</label>
                <select name="gym_id" class="form-control" >
                <option value="{{$gym_managers->gym->id}}" selected>{{$gym_managers->gym->id}}</option>
                    @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->id}}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3" >
                <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload image</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="file" name="fileUpload" class="form-control " id="customFile" value= "{{ $gym_managers->avatar}} "/>  
                    </div>                  
                    <div class="col-sm-6">
                            <img src="{{ asset('storage/images/'.$gym_managers->avatar) }}"  style="width:50px;height:50px;"/>
                    </div>
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