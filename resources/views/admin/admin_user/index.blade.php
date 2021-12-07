@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
    <!-- Default box -->

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add User
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                @if(hasPermission('add_user'))
                <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                   data-target="#add_modal"><i
                        class="fa fa-plus"></i> Add User</a>
                        @endif
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        @if(hasPermission('user_list'))
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!--Add Modal -->
    <form action="" method="post" id="add_form">
        @csrf
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Name"
                                           name="add_name"
                                           id="add_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="add_email"
                                           id="add_email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_password" class="required">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Password"
                                           name="add_password"
                                           id="add_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_confirm_password" class="">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Confirm Password"
                                           name="add_confirm_password"
                                           id="add_confirm_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_type" class="required">User Type</label>
                                    <select name="add_type" id="add_type" class="form-control select2">
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="controller">Controller</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/Add Modal -->
    <!--Edit Modal -->
    <form method="post" id="edit_form">
        @csrf
        @method('PUT')
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Name"
                                           name="edit_name"
                                           id="edit_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="edit_email"
                                           id="edit_email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_type" class="required">User Type</label>
                                    <select name="edit_type" id="edit_type" class="form-control select2">
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="controller">Controller</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_password" class="required">Password</label>
                                    <input type="password" value="" class="form-control" placeholder="Enter Password"
                                           name="edit_password"
                                           id="edit_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_confirm_password" class="">Confirm Password</label>
                                    <input type="password" value="" class="form-control" placeholder="Enter Confirm Password"
                                           name="edit_confirm_password"
                                           id="edit_confirm_password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/Edit Modal -->
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".entertxtOnly").keypress(function (e) {
                var k;
                document.all ? k = e.keyCode : k = e.which;
                return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
            });
            var table = $("#dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('admin.admin_user.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "type"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                    "targets": [],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');
            $('#add_form').validate({
                rules: {
                    add_name: {
                        required: true,
                        maxlength: 30
                    },
                    add_email: {
                        required: true,
                        email: true
                    },
                    add_password : {
                        required: true,
                        minlength : 5
                    },
                    add_confirm_password : {
                        minlength : 5,
                        equalTo : "#add_password"
                    }
                },
                messages: {},
                errorElement: 'small',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('#add_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_form').valid()) {
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.admin_user.store')}}',
                    data: new FormData(this),
                    contentType: false,
                    data_type: 'json',
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        loader();
                    },
                    success: function (response) {
                        swal.close();
                        $('#dt').DataTable().ajax.reload(); // user paging is not reset on reload
                        alertMsg(response.message, response.status);
                        $('#add_form')[0].reset();
                        $('#add_modal').modal('hide');
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_form').validate({
                rules: {
                    edit_name: {
                        required: true,
                        maxlength: 30
                    },
                    edit_email: {
                        required: true,
                        email: true
                    },
                    edit_type: {
                        required: true,
                    },
                    edit_password : {
                        required: false,
                        minlength : 5
                    },
                    edit_confirm_password : {
                        minlength : 5,
                        equalTo : "#edit_password"
                    }
                },
                messages: {},
                errorElement: 'small',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('#edit_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_form').valid()) {
                    return false;
                }
                var id = $('#hidden_id').val();
                var route = "{{route('admin.admin_user.update',['admin_user'=>':admin_user'])}}";
                route = route.replace(':admin_user', id);
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: new FormData(this),
                    contentType: false,
                    data_type: 'json',
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        loader();
                    },
                    success: function (response) {
                        swal.close();
                        $('#dt').DataTable().ajax.reload();
                        alertMsg(response.message, response.status);
                        $('#edit_modal').modal('hide');
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });
        });

        $(document).on('click', '.edit_data', function () {
            var data = $(this).data('params');
            console.log(data);
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_type').val(data.type);


            $('#hidden_id').val(data.id);
            $('#edit_modal').modal('show');
            $('#edit_password').val('');
            $('#edit_confirm_password').val('');
        });

        $(document).on('submit', '.delete_form', function (e) {
            e.preventDefault();
            var route = $(this).attr('action');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: route,
                        data: new FormData(this),
                        contentType: false,
                        data_type: 'json',
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            loader();
                        },
                        success: function (response) {
                            swal.close();
                            alertMsg(response.message, 'error');
                            $('#dt').DataTable().ajax.reload();
                        },
                        error: function (xhr, error, status) {
                            swal.close();
                            var response = xhr.responseJSON;
                            alertMsg(response.message, 'error');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your Data is safe :)',
                        'error'
                    )
                }
            })
        });

    </script>

@endpush
