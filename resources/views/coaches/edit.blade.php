@extends('layouts.admin')
@section('title')
edit coach
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
                <h3 class="card-title">Edit Coach</h3>
              </div>
<form method="POST" action=" {{ route('coaches.update', ['coach' => $coaches->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body"> 
            <input type="hidden" name="coach_id"  value="{{ $coaches->id }}" />

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $coaches->name }}">
                @error('name')
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
    $(function() {

    $('#coaches').addClass('active');
  </script>
  @endsection