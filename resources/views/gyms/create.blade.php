@extends('layouts.admin')
@section('title')
Create Gym
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('gyms.index') }}">Gyms</a></li>
<li class="breadcrumb-item active">Create Gym</li>
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
                    <h3 class="card-title">Add Gym</h3>
                </div>
                <form method="POST" action="{{ route('gyms.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Creator</label>
                            <input name="creator" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">City Manger:</label>
                            <select name="city_manager_id" class="form-control">
                                @foreach ($cityMangers as $cityManger)
                                <option value="{{ $cityManger->id }}">{{ $cityManger->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label" for="customFile @error('fileUpload') is-invalid @enderror">Upload Cover Image</label>
                                <input type="file" name="cover_img" class="form-control" id="customFile" />
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#user-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $('#gyms').addClass('active');
</script>
@endsection