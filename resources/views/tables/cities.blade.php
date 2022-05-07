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
                <table id="cities-table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City Name</th>
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

var table;
    $(function () {
      table = $('#cities-table').DataTable({
          processing: true,
          serverSide: true,
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          ajax: "{{ route('cities.index') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'city_name', name: 'City Name'},
          ]
      });
    });
</script>
@endsection