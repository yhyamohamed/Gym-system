@extends('layouts.admin')
@section('title')
coaches Table
@endsection

@section('page-header')
All Coaches
<a href="{{ route('coaches.create') }}" class="mt-4 btn btn-success">Create Coach</a>

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
        <table id="coach-table" class="table table-bordered">
          <thead>
            <tr>
              <th>id</th>
              <th>name</th>
              <th>Actions</th>
            </tr>
          <tbody>
          @foreach ($coaches as $coach)
                        <tr>
                            <td>{{ $coach->id }}</td>
                            <td>{{ $coach->name }}</td>
                            
                            <td>
                                <center>
                                <a href="{{ route('coaches.edit', ['coach' => $coach->id]) }}" class="btn btn-primary">Edit</a>
                                    <form style="display: inline" method="POST" action="{{ route('coaches.destroy', ['coach' => $coach->id]) }}">
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
    $('#users').addClass('active');
  </script>
  @endsection
