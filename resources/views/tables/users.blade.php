@extends('layouts.admin')
@section('title')
users Table
@endsection

@section('page-header')
All Users
<br />
<a href="{{ route('users.create') }}" class="mt-4 btn btn-success">Create User</a>
@endsection


@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active">Users</li>
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
          </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="usermoadal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">deleting user NO. </h5>
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

      </div>


    </div>
    <!-- /.card -->
  </div>
</div>

@endsection
@section('dataTable-scripts')
<script>
  var table
  $(function() {
    table = $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      ajax: "{{ route('users.index') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'gender',
          name: 'gender'
        },
        {
          data: 'date_of_birth',
          name: 'date_of_birth'
        },
        {
          data: 'date',
          name: 'date'
        },
        {
          data: 'image',
          name: 'image',
          orderable: false,
          searchable: false
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });
    table.column(0).visible(false);
    $('#users').addClass('active');
    var ids = null;

    function getRowId() {
      $('#usermoadal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        id = button.data('id'); // Extract info from data-* attributes
        ids = id;
      });
    }
    getRowId();

    $(".delete_btn").on('click', (e) => {
      e.preventDefault();
      test = "{{ route('users.destroy',['user' => 10])}}";
      url = test.split("/")
      url[url.length - 1] = id;
      url = url.join("/");
      $('#usermoadal').modal('toggle');
      let msgDiv = $("#msg")
      $.ajax({
        url: url,
        type: "DELETE",
        data: {
          '_token': "{{csrf_token()}}",
        },
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
        error: function(error) {
          err = JSON.parse(error.responseText);
          msgDiv.css({
            "color": "#721c24",
            "background-color": "#f8d7da",
            "border-color": "#f5c6cb"
          });
          msgDiv.addClass("alert-danger").html(err.message).show();
        }
      });
    })

  });
</script>

@endsection