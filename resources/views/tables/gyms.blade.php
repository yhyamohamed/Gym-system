@extends('layouts.admin')
@section('title')
Gyms Table
@endsection

@section('page-header')
All Gyms
<br />
<a href="{{ route('gyms.create') }}" class="btn btn-success">Create Gym</a>
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Gyms</li>
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
                <table id="gym-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Creator</th>
                            <th>City Manger</th>
                            <th>Cover Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    <tbody>
                        @foreach ($gyms as $gym)
                        <tr class="gymRow{{$gym->id}}">
                            <td>{{ $gym->id }}</td>
                            <td>{{ $gym->name }}</td>
                            <td>{{ $gym->creator }}</td>
                            <td>{{ $gym->city_manager->name }}</td>
                            <td width=20%>
                                <img class="img-fluid" src="/{{ $gym->cover_img }}" alt="">
                            </td>
                            <td>{{ \Carbon\Carbon::parse( $gym->created_at )->toDateString(); }}</td>
                            <td>
                                <center>
                                    <a href="{{ route('gyms.edit', ['gym' => $gym->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" id="{{ $gym->id }}" class="btn btn-danger delete_btn">Delete</a>
                                    <!-- <form style="display: inline" method="POST" action="{{ route('gyms.destroy', ['gym' => $gym->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure?');" class="btn btn-danger">Delete</button>
                                    </form> -->
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
        $(".delete_btn").on('click', (e) => {
            e.preventDefault();
            // var id = $(this).attr("id");//undefined
            var id = $(e.target).attr("id");
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'delete',
                    url: "{{ route('gyms.destroy', ['gym' => $gym->id]) }}", // Remove id 
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': id,
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#deleted_msg').show();
                            $('.gymRow' + data.id).remove();
                        }
                    },
                    error: function(reject) {}
                });
            }
        });
    </script>
    @endsection