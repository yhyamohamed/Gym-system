@extends('layouts.admin')
@section('title')
Gym Mangers Table
@endsection

@section('page-header')
All Gym Managers
<a href="{{ route('gym_managers.create') }}" class="mt-4 btn btn-success">Create Gym Manager</a>
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
        <table id="gym_managers-table" class="table table-bordered">
          <thead>
            <tr>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>created-at</th>
              <th>gym_id</th>
              <th>profile image</th>
              <th>Actions</th>
            </tr>
          <tbody>
          @foreach ($gym_managers as $gym_manager)
                        <tr>
                            <td>{{ $gym_manager->id }}</td>
                            <td>{{ $gym_manager->name }}</td>
                            <td>{{ $gym_manager->email }}</td>
                            <td>{{ $gym_manager->created_at }}</td>
                            <td>{{ $gym_manager->gym->id}}</td>
                            <td><img src="{{ asset('storage/images/'.$gym_manager->avatar) }}" style="width:50px;height:50px;"/></td>
                            
                            <td>
                                <center>
                                    <a href="{{ route('gym_managers.edit', ['gym_manager' => $gym_manager->id]) }}" class="btn btn-primary">Edit</a>
                                    <form style="display: inline" method="POST" action="{{ route('gym_managers.destroy', ['gym_manager' => $gym_manager->id]) }}">
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

      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
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
      $('#gym_managers-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
    $('#gym-managers').addClass('active');
  </script>
  @endsection
