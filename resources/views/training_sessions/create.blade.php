@extends('layouts.admin')
@section('title')
Create Training Sessions
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('training_sessions.index') }}">Training Sessions</a></li>
<li class="breadcrumb-item active">Create Training Session</li>
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
                    <h3 class="card-title">Add Training Sessions</h3>
                </div>
                <form method="POST" action="{{ route('training_sessions.store')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control datetimepicker" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Start At</label>
                            <input name="start_at" type="datetime-local" class="form-control datetimepicker" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Finish At</label>
                            <input name="finish_at" type="datetime-local" class="form-control datetimepicker" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Training Package</label>
                            <select name="training_package_id" class="form-control">
                                @foreach ($trainingPackages as $trainingPackage)
                                <option value="{{ $trainingPackage->id }}">{{ $trainingPackage->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="coachesList" class="form-label">Coach</label>
                            <select class="form-control js-example-basic-multiple" name="coaches[]" multiple="multiple" id="coachesList"">
                                @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                @endforeach
                            </select>
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
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        theme: "classic"
    });
    });
</script>

<script>
    $('#training_sessions').addClass('active');
</script>
@endsection
