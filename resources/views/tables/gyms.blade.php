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

@section('table-content')
<center>
    <div role="alert" class="alert col-md-8" id="msg" style="display: none;"></div>
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
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="gym-moadal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deleting a Gym</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure?
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
    var table;
    $(function() {
        table = $('#gym-table').DataTable({
            processing: true,
            serverSide: true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: "{{ route('gyms.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'creator',
                    name: 'creator'
                },
                {
                    data: 'city_manager',
                    name: 'city_manager'
                },
                {
                    data: 'cover_img',
                    name: 'cover_img',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
    $('#gyms').addClass('active');

    function getRowId() {
        $('#gym-moadal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            id = button.data('id');
        });
    }
    getRowId();
    $(".delete_btn").on('click', (e) => {
        e.preventDefault();
        $('#gym-moadal').modal('toggle');
        var url = "{{ route('gyms.destroy',['gym' => 1])}}";
        url = url.split("/")
        url[url.length - 1] = id;
        url = url.join("/");
        var msgDiv = $("#msg");
        $.ajax({
            url: url,
            type: 'DELETE',
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
    });
</script>
@endsection