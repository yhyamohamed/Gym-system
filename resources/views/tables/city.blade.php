@extends('layouts.admin')
@section('title')
City Table
@endsection

@section('page-header')
Cities
<br />
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Cities</li>
@endsection

@section('content')
<center>
    <div role="alert" class="alert col-md-8" id="msg" style="display: none;"></div>
</center>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="trainingSession-table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection

@section('dataTable-scripts')
<script>
$('#cities').addClass('active');
</script>
@endsection