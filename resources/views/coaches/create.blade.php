@extends('layouts.admin')
@section('title')
create coach
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
                <h3 class="card-title">Add Coach</h3>
              </div>
              
<form method="POST" action="{{ route('coaches.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body"> 
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
    $('#coaches').addClass('active');
  </script>
  @endsection