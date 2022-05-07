@extends('layouts.admin')
@section('title')
    Revenue Table
@endsection

@section('page-header')
    Revenues
    <br />
@endsection

@section('left-breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Revenue</li>
@endsection

@section('content')
    <center>
        <div role="alert" class="alert col-md-8" id="msg" style="display: none;"></div>
    </center>

    <div class="container d-flex justify-content-center">
        <div class="card border-primary mb-3 text-center w-50">
            <div class="card-header fs-1 ">
                Revenue
            </div>
            <div class="card-body text-center">
                <p class="card-text fs-1">{{$totalRevenue}}</p>
            </div>
            <div class="card-footer text-muted"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="trainingSession-table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Package Name</th>
                                <th>Amount paid</th>
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
            $('#revenue').addClass('active');
        </script>
    @endsection
