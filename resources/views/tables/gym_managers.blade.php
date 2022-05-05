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
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                data-bs-target="#moadal{{ $gym_manager->id }}">
                                delete
                                    </button>
                                </center>
                            </td>
                        </tr>
                        @endforeach
           
          </tbody>
        </table>
        @foreach ($gym_managers as $gym_manager)
        <!-- Modal -->
        <div class="modal fade" id="moadal{{ $gym_manager->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">deleting manager NO.{{ $gym_manager->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        are you SURE ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="" id="{{ $gym_manager->id }}" class="btn btn-danger delete_btn">Delete</a>
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
      $('#gym_managers-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    $('#gym-managers').addClass('active');
    $(".delete_btn").on('click', (e) =>{
    
    e.preventDefault();
    var id = $(e.target).attr("id");
    $('#moadal' + id).modal('toggle');
    test="{{ route('gym_managers.destroy',['gym_manager' => $gym_manager->id])}}";
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
        managertable=$("#gym_managers-table").DataTable()
        managertable.clear()
        // managertable.ajax.reload()
        console.log()
        msgDiv.css({"color": "#721c24", "background-color": "#f8d7da","border-color": "#f5c6cb"});
        msgDiv.addClass("alert-danger").html(err.message).show();
      }
    });
            
 
});
  </script>
  @endsection
