@extends('layouts.admin')
@section('title')
Training Sessions Table
@endsection

@section('page-header')
Training Sessions Schedule
<br />
<a href="{{ route('training_sessions.create') }}" class="btn btn-success m-2">Create Training Session</a>
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Training Session</li>
@endsection

@section('content')
<center>
    <div role="alert" class="alert col-md-8" id="msg" style="display: none;"></div>
</center>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="trainingSession-table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start At</th>
                            <th>Finish At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                 <!-- Modal -->
        <div class="modal fade" id="training-session-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleting training session NO.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    are you SURE ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" id="" class="btn btn-danger delete_btn">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dataTable-scripts')

<script type="text/javascript">
 var table;
    $(function () {
      
      table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          ajax: "{{ route('training_sessions.index') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'name', name: 'Name'},
              {data: 'start at', name: 'Start At'},
              {data: 'finish at', name: 'Finish At'},
              {data: 'action', name: 'Actions', orderable: false, searchable: false},
          ]
      });
    });
    $('#training_sessions').addClass('active');

    var ids =null ;
function getRowId() {
    $('#training-session-modal').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget) // Button that triggered the modal
       id = button.data('id'); // Extract info from data-* attributes
       console.log(id);
       ids = id;
           });
}
getRowId();
$(".delete_btn").on('click', (e) =>{
    e.preventDefault();
    test="{{ route('training_sessions.destroy',['trainingSession' => 10])}}";
    url=test.split("/")
    url[url.length-1]=id;
    url=url.join("/");
    var msgDiv = $("#msg");
    $('#training-session-modal').modal('toggle');
    $.ajax({
      url: url,
      type: "DELETE",
      data: {'_token': "{{csrf_token()}}", },
      success: function(data) {
            if (data.status) {
                msgDiv.css({
                    "color": "#155724",
                    "background-color": " #d4edda",
                    "border-color": "#c3e6cb"
                });
                msgDiv.addClass("alert-success").html(data.message).show();
                table.ajax.reload();
            } else {
                msgDiv.css({
                    "color": "#721c24",
                    "background-color": "#f8d7da",
                    "border-color": "#f5c6cb"
                });
                msgDiv.addClass("alert-danger").html(data.message).show();
            }
        },
        error: function(reject) {
            error = JSON.parse(reject.responseText);
            msgDiv.css({
                "color": "#721c24",
                "background-color": "#f8d7da",
                "border-color": "#f5c6cb"
            });
            msgDiv.addClass("alert-danger").html(error.message).show();
        }


    });
})

</script>

@endsection