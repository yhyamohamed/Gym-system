@extends('layouts.admin')
@section('title')
GYMs Table
@endsection

@section('page-header')
All GYMs
@endsection


@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
@endsection


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            {{-- <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="gym-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Creator</th>
                            <th>City Manger</th>
                            <th>Cover Image</th>
                            <th>Actions</th>
                        </tr>
                    <tbody>
                        @foreach ($gyms as $gym)
                        <tr>
                            <td>{{ $gym->id }}</td>
                            <td>{{ $gym->name }}</td>
                            <td>{{ $gym->creator }}</td>
                            <td>{{ $gym->city_manager->name }}</td>
                            <td>
                                <img class="img-fluid" src="{{ $gym->cover_img }}" alt="">
                            </td>
                            <td>
                                <center>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <form style="display: inline" method="POST" action="#">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure?');" class="btn btn-danger">Delete</button>
                                    </form>
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
            $('#gym-table').DataTable({
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