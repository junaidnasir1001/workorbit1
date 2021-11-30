@extends('admin.layouts.app')
@section('title', 'Staff')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Shift List
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                   data-target="#add_modal"><i
                        class="fa fa-plus"></i> Add Shift</a>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Staff Number</th>
                    <th>Subcontractor</th>
                    <th>designation</th>
                    <th>Phone Number</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Pay Rate</th>
                    <th>SIA Number</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!--Add Modal -->
    <form action="{{route('admin.shift.store')}}" method="post" id="add_form">
        @csrf
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Shift</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_site_id" class="">Site</label>
                                    <select name="add_site_id" id="add_site_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select site</option>
                                        @foreach($sites as $site)
                                            <option value="{{$site->id}}">{{$site->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_sub_contractor_id" class="">Site Type</label>
                                    <select name="add_sub_contractor_id" id="add_sub_contractor_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select site type</option>
                                        @foreach($site_types as $site_type)
                                            <option value="{{$site_type->id}}">{{$site_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_time_in" class="required">Time In</label>
                                    <input type="time" class="form-control"
                                           name="add_time_in"
                                           id="add_time_in">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_time_out" class="required">Time Out</label>
                                    <input type="time" class="form-control"
                                           name="add_time_out"
                                           id="add_time_out">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_break_time_start" class="required">Break Time Start</label>
                                    <input type="time" class="form-control"
                                           name="add_break_time_start"
                                           id="add_break_time_start">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_break_time_end" class="required">Break Time End</label>
                                    <input type="time" class="form-control"
                                           name="add_break_time_end"
                                           id="add_break_time_end">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_start_date" class="">Shift Start Date</label>
                                    <input type="date" class="form-control"
                                           name="add_start_date"
                                           id="add_start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_end_date" class="">Shift End Date</label>
                                    <input type="date" class="form-control"
                                           name="add_end_date"
                                           id="add_end_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_working_days" class="">Working Days</label>
                                    <input type="number" class="form-control" placeholder="Enter Working Days"
                                           name="add_working_days"
                                           id="add_working_days" min="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_instructions" class="">Instructions</label>
                                    <textarea class="form-control" rows="5" cols="50" maxlength="50" id="add_instructions"
                                              name="add_instructions"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Staff</th>
                                        <th>Pay Rate</th>
                                        <th>Shift Schedule</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select name="staff_id[]" id="" class="form-control select2">
                                                <option value="" selected disabled> select staff</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="enter payrate">
                                        </td>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Staff Time In</th>
                                                    <th>Staff Time Out</th>
                                                    <th>Staff Break Start</th>
                                                    <th>Staff Break End</th>
                                                </tr>
                                                </thead>
                                                <tr>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                               name="add_staf_time_in[]">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                               name="add_staff_time_out[]">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                               name="add_staff_break_time_start[]">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                               name="add_staff_break_time_end[]">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3">
                                            <button class="btn btn-primary">Add more</button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Edit Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="old_profile_path" name="old_profile_path">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
            var table = $("#dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('admin.staff.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "first_name"},
                    {"data": "profile_path", orderable: false, searchable: false},
                    {"data": "staff_number"},
                    {"data": "sub_contractor_id"},
                    {"data": "designation_id"},
                    {"data": "phone_number"},
                    {"data": "mobile_number"},
                    {"data": "email"},
                    {"data": "pay_rate"},
                    {"data": "sia_number"},
                    {"data": "is_active"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                    "targets": [6, 7, 8],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');
            $('#add_form').validate({
                rules: {
                    add_first_name: "required",
                    add_last_name: "required",
                    add_designation_id: "required",
                    add_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
                    },
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
                    url: '{{route('admin.staff.store')}}',
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
                    edit_first_name: "required",
                    edit_last_name: "required",
                    edit_designation_id: "required",
                    edit_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
                    },
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
                var route = "{{route('admin.staff.update',['staff'=>':staff'])}}";
                route = route.replace(':staff', id);
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
            $('#edit_first_name').val(data.first_name);
            $('#edit_last_name').val(data.last_name);
            $('#edit_sub_contractor_id').val(data.sub_contractor_id).trigger('change');
            $('#edit_designation_id').val(data.designation_id).trigger('change');
            $('#edit_phone_number').val(data.phone_number);
            $('#edit_mobile_number').val(data.mobile_number);
            $('#edit_email').val(data.email);
            $('#edit_staff_number').val(data.staff_number);
            $('#edit_sia_number').val(data.sia_number);

            $('#old_profile_path').val(data.profile_path);
            $('#img_div').html('<img src="' + data.profile_path + '" alt="" style="height: 200px"/>');

            $('#edit_pay_rate').val(data.pay_rate);

            if (data.is_active === 1) {
                $('#edit_is_active').attr('checked', true);
            } else {
                $('#edit_is_active').attr('checked', false);
            }

            $('#hidden_id').val(data.id);
            $('#edit_modal').modal('show');
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
