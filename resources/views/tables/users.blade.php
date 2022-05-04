@extends('layouts.admin')
@section('title')
<<<<<<< HEAD
users Table
=======
    users Table
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf
@endsection

@section('page-header')
All Users
<<<<<<< HEAD
<a href="{{ route('users.create') }}" class="mt-4 btn btn-success">Create User</a>
=======
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf
@endsection


@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
@endsection


@section('content')

<div class="row">
<<<<<<< HEAD
  <div class="col-12">
    <div class="card">
      {{-- <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div> --}}
      <!-- /.card-header -->
      <div class="card-body">
        <table id="user-table" class="table table-bordered">
          <thead>
            <tr>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>gender</th>
              <th>dateofbirth</th>
              <th>created-at</th>
              <th>profile image</th>
              <th>Actions</th>
            </tr>
          <tbody>
          @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->date_of_birth }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td><img src="{{ asset('storage/images/'.$user->profile_image) }}" style="width:50px;height:50px;"/></td>
                            
                            <td>
                                <center>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit</a>
                                    <form style="display: inline" method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
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
=======
    <div class="col-12">
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
        </div> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="user-table" class="table table-bordered">
            <thead>
                <tr>
                  <th>name</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
            <tbody>
                <tr>
                    <td>any thing</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>B for order</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>c for cat</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>d for you know</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf
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
<<<<<<< HEAD
    $('#users').addClass('active');
  </script>
  @endsection
=======
  </script>
@endsection
>>>>>>> 638077cbcd0c836b2fd1e8be51615d78277d4acf
