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
<center>
    <div role="alert" class="alert  col-md-8" id="msg" style="display: none;"></div>

</center>
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
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                data-bs-target="#moadal{{ $coach->id }}">
                                delete
                                    </button>
                                </center>
                            </td>
                        </tr>
                        @endforeach
           
          </tbody>
        </table>
        @foreach ($coaches as $coach)
        <!-- Modal -->
        <div class="modal fade" id="moadal{{ $coach->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">deleting coach NO.{{ $coach->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        are you SURE ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="" id="{{ $coach->id }}" class="btn btn-danger delete_btn">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
      $('#coach-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
    $('#coaches').addClass('active');
    $(".delete_btn").on('click', (e) =>{
    
    e.preventDefault();
    var id = $(e.target).attr("id");
    $('#moadal' + id).modal('toggle');
    test="{{ route('coaches.destroy',['coach' => $coach->id])}}";
    url=test.split("/")
    url[url.length-1]=id;
    url=url.join("/");
    let msgDiv=$("#msg")
    


  //  console.log( url);
    
    $.ajax({
      url: url,
      type: "DELETE",
      data: {'_token': "{{csrf_token()}}", },
      success: function(data)  {
         
          msgDiv.css({"color": "#155724", "background-color": " #d4edda","border-color": "#c3e6cb"});
          msgDiv.addClass("alert-success").html(data.message).show();
          
        
        // table.ajax.reload(); 
      },
      error: function(error) {
        err=JSON.parse(error.responseText);
        coachtable=$("#coach-table").DataTable()
        coachtable.clear()
        // coachtable.ajax.reload()
        console.log()
        msgDiv.css({"color": "#721c24", "background-color": "#f8d7da","border-color": "#f5c6cb"});
        msgDiv.addClass("alert-danger").html(err.message).show();
      }
    });
            
 
});
  </script>
  @endsection
