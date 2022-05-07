@extends('layouts.admin')
@section('title')
Subscriptions
@endsection

@section('page-header')
All subscriptions
<br />
<a href="{{ route('subscriptions.create') }}" class="btn btn-success">Subscriptions</a>
@endsection

@section('left-breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Buy Package For User</li>
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
                <table id="subscriptions-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Training Package</th>
                            <th>Subscriber</th>
                            <th>Amount Paid</th>
                            <th>Remaining Sessions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    <tbody>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="subscription-moadal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deleting a Subscription</h5>
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
        table = $('#subscriptions-table').DataTable({
            processing: true,
            serverSide: true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: "{{ route('subscriptions.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'training_package',
                    name: 'training_package'
                },
                {
                    data: 'subscriber',
                    name: 'subscriber'
                },
                {
                    data: 'amount_paid',
                    name: 'amount_paid'
                },
                {
                    data: 'remaining_sessions',
                    name: 'remaining_sessions'
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
    $('#subscriptions').addClass('active');

    function getRowId() {
        $('#subscription-moadal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            id = button.data('id');
        });
    }
    getRowId();
    $(".delete_btn").on('click', (e) => {
        e.preventDefault();
        $('#subscription-moadal').modal('toggle');
        var url = "{{ route('subscriptions.destroy',['subscription' => 1])}}";
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
                msgDiv.css({
                    "color": "#155724",
                    "background-color": " #d4edda",
                    "border-color": "#c3e6cb"
                });
                msgDiv.addClass("alert-success").html(data.message).show();
                table.ajax.reload();
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