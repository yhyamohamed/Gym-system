@extends('layouts.admin')
@section('title')
Attendance Table
@endsection

@section('page-header')
All Attendance
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Attendance</li>
@endsection

@section('content')
<center>
    <div role="alert" class="alert col-md-8" id="msg" style="display: none;"></div>
</center>
<div class="row">
    <div class="col-12">
        <div class="card">
            {{-- <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="attendances-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Training Session Name</th>
                            <th>Attendance Time</th>
                            <th>Attendance Date</th>
                            <th>Gym</th>
                            <th>City</th>
                        </tr>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@section('dataTable-scripts')
<script>
    var table;
    $(function() {
        table = $('#attendances-table').DataTable({
            processing: true,
            serverSide: true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: "{{ route('attendances.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'user_email',
                    name: 'user_email'
                },
                {
                    data: 'training_session_name',
                    name: 'training_session_name'
                },
                {
                    data: 'attendance_time',
                    name: 'attendance_time'
                },
                {
                    data: 'attendance_date',
                    name: 'attendance_date'
                },
                {
                    data: 'gym',
                    name: 'gym'
                },
                {
                    data: 'city',
                    name: 'city',
                },
            ]
        });
    });
    $('#attendance').addClass('active');
</script>
@endsection