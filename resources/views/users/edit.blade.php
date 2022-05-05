@extends('layouts.admin')
@section('title')
edit user
@endsection




@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('content')

<div class="container-fluid offset-md-2">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
<form method="POST" action=" {{ route('users.update', ['user' => $users->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body"> 
            <input type="hidden" name="user_id"  value="{{ $users->id }}" />

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $users->name }}">
                @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            
            <div class="mb-3">
               
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $users->email }}">
                @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $users->password }}">
                @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Date Of Birth</label>
                <input name="date_of_birth" type="date" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $users->date_of_birth }}" >
                @error('date_of_birth')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Gender</label>
                <select name="gender" class="form-control">
                    
                    <option value="{{ $users->gender }}">{{ $users->gender }}</option>
                    @if(($users->gender)=='male'){
                    <option value="female">female </option>
                    }
                    @else {
                        <option value="male">male </option>
                    }
                    @endif

                </select>
             
            </div>

            <div class="mb-3" >
                <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload image</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="file" name="fileUpload" class="form-control " id="customFile" value= "{{ $users->profile_image}} "/>  
                    </div>                  
                    <div class="col-sm-6">
                            <img src="{{ asset('storage/images/'.$users->profile_image) }}"  style="width:50px;height:50px;"/>
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
    $('#users').addClass('active');
  </script>
  @endsection