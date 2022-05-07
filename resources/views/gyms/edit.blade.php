@extends('layouts.admin')
@section('title')
Edit Gym
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('gyms.index') }}">Gyms</a></li>
<li class="breadcrumb-item active">Edit Gym</li>
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
          <h3 class="card-title">Edit Gym</h3>
        </div>
        <form method="POST" action=" {{ route('gyms.update', ['gym' => $gym->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <input type="hidden" name="gym_id" value="{{ $gym->id }}" />
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Name</label>
              <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $gym->name }}">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">City Manger</label>
              <select name="city_manager_id" class="form-control">
              <option value="{{ $gym['city_manager_id'] }}" selected hidden>{{ $gym->city_manager->name }}</option>
                @foreach ($cityMangers as $cityManger)
                <option value="{{ $cityManger->city_managers->first()->id  }}">{{ $cityManger->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3" >
                <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload Cover Image</label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="file" name="cover_img" class="form-control " id="customFile" value= "{{ $gym->cover_img}} "/>  
                    </div>                  
                    <div class="col-sm-6">
                            <img src="/{{ $gym->cover_img }}"  style="width:300px;height:250px;"/>
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
  $('#gyms').addClass('active');
</script>
@endsection