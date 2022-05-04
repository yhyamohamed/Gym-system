@extends('layouts.admin')
@section('title')
Training Packages Table
@endsection

@section('page-header')
All Training Package
<br />
<a href="{{ route('training_packages.create') }}" class="btn btn-success">Create Training Package</a>
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Training Package</li>
@endsection

@section('content')
<center>
    <div class="alert alert-success col-md-8" id="deleted_msg" style="display: none;">Deleted</div>
</center>
<div class="row">
    <div class="col-12">
        <div class="card">
            {{-- <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="trainingPackage-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Total Sessions</th>
                            <th>Gym</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    <tbody>
                        @foreach ($trainingPackages as $trainingPackage)
                        <tr class="trainingPackageRow{{$trainingPackage->id}}">
                            <td>{{ $trainingPackage->id }}</td>
                            <td>{{ $trainingPackage->name }}</td>
                            <td>{{ number_format(($trainingPackage->price)/100, 2, '.', ' ') }}$</td>
                            <td>{{ $trainingPackage->total_sessions }}</td>
                            <td>{{ $trainingPackage->gym->name }}</td>
                            <td>{{ \Carbon\Carbon::parse( $trainingPackage->created_at )->toDateString(); }}</td>
                            <td>
                                <center>
                                    <a href="{{ route('training_packages.edit', ['trainingPackage' => $trainingPackage->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" id="{{ $trainingPackage->id }}" class="btn btn-danger delete_btn">Delete</a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
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
            $('#trainingPackage-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $('#training_packages').addClass('active');
        $(".delete_btn").on('click', (e) => {
            e.preventDefault();
            // var id = $(this).attr("id");//undefined
            var id = $(e.target).attr("id");
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'delete',
                    url: "{{ route('training_packages.destroy', ['trainingPackage' => $trainingPackage->id]) }}", // Remove id 
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': id,
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#deleted_msg').show();
                            $('.trainingPackageRow' + data.id).remove();
                        }
                    },
                    error: function(reject) {}
                });
            }
        });
    </script>
    @endsection