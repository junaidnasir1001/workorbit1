@extends('admin.layouts.app')
@section('title', 'Staff')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Staff List
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                @if(hasPermission('add_staff'))
                    <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                       data-target="#add_modal"><i
                            class="fa fa-plus"></i> Add Staff</a>
                @endif
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(hasPermission('staff_list'))
                <table id="dt" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Staff Mobile Number</th>
                        <th>Subcontractor</th>
                        <th>designation</th>
                        <th>Phone Number</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Pay Rate</th>
                        <th>SIA Number</th>
                        <th>Status</th>
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
    <form action="{{route('admin.staff.store')}}" method="post" id="add_form">
        @csrf
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_first_name" class="required">First Name</label>
                                    <input maxlength="31" type="text" class="form-control"
                                           placeholder="Enter First Name"
                                           name="add_first_name"
                                           id="add_first_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_last_name" class="required">Last Name</label>
                                    <input maxlength="31" type="text" class="form-control"
                                           placeholder="Enter Last Name"
                                           name="add_last_name"
                                           id="add_last_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_staff_number" class="">Staff Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Staff Number"
                                           name="add_staff_number"
                                           id="add_staff_number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_sub_contractor_id" class="">Sub Contractor</label>
                                    <select name="add_sub_contractor_id" id="add_sub_contractor_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select sub contractor</option>
                                        @foreach($sub_contractors as $sub_contractor)
                                            <option value="{{$sub_contractor->id}}">{{$sub_contractor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_designation_id" class="required">Designation</label>
                                    <select name="add_designation_id" id="add_designation_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_phone_number" class="">Phone Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Phone Number"
                                           name="add_phone_number"
                                           id="add_phone_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_mobile_number" class="">Mobile Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Mobile Number"
                                           name="add_mobile_number"
                                           id="add_mobile_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_email" class="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="add_email"
                                           id="add_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="number" class="form-control"
                                           placeholder="Pay Rate Format (1.00)"
                                           name="add_pay_rate"
                                           id="add_pay_rate" pattern="\d+(\.\d{2})?">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_sia_number" class="">SIA Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter SIA Number"
                                           name="add_sia_number"
                                           id="add_sia_number">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="button" id="verify_sia" class="btn btn-primary m-2">Verify</button>
                            </div>
                            <div class="col-md-4">
                                <label>Staff Profile</label>
                                <div class="custom-file">
                                    <input type="file" class="" id="add_profile_path" name="add_profile_path">
                                </div>
                                <p><small class="cr-file-description">image size should be less than 2mb</small></p>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="add_is_active"
                                               name="add_is_active">
                                        <label class="form-check-label" for="add_is_active">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="" id="sia_details_invalid" style="display: none;">
                                    <h3 style="text-align: center; color: red;">Record Not Found</h3>
                                </div>
                                <div class=""  style="display: none;" id="sia_details">
                                    <div class="row"  >
                                        <div class="col-md-7">
                                            <label>First Name: <span id="sia_fname"></span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Surname: <span id="sia_surname"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label>Licence number: <span id="sia_licence_number"></span></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Role: <span id="sia_role"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label>Licence sector: <span id="sia_licence_sector"></span></label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label>Expiry date: <span id="sia_expiry_date"></span></label>
                                        </div>
                                    </div>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_first_name" class="required">First Name</label>
                                    <input maxlength="31" type="text" class="form-control"
                                           placeholder="Enter First Name"
                                           name="edit_first_name"
                                           id="edit_first_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_last_name" class="required">Last Name</label>
                                    <input maxlength="31" type="text" class="form-control"
                                           placeholder="Enter Last Name"
                                           name="edit_last_name"
                                           id="edit_last_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_staff_number" class="">Staff Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Staff Number"
                                           name="edit_staff_number"
                                           id="edit_staff_number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_sub_contractor_id" class="">Sub Contractor</label>
                                    <select name="edit_sub_contractor_id" id="edit_sub_contractor_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select sub contractor</option>
                                        @foreach($sub_contractors as $sub_contractor)
                                            <option value="{{$sub_contractor->id}}">{{$sub_contractor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_designation_id" class="required">Designation</label>
                                    <select name="edit_designation_id" id="edit_designation_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_phone_number" class="">Phone Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Phone Number"
                                           name="edit_phone_number"
                                           id="edit_phone_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile_number" class="">Mobile Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Mobile Number"
                                           name="edit_mobile_number"
                                           id="edit_mobile_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email" class="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="edit_email"
                                           id="edit_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="number" class="form-control"
                                           placeholder="Pay Rate Format (1.00)"
                                           name="edit_pay_rate"
                                           id="edit_pay_rate" pattern="\d+(\.\d{2})?">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_sia_number" class="">SIA Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter SIA Number"
                                           name="edit_sia_number"
                                           id="edit_sia_number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Staff Profile</label>
                                    <div id="img_div"></div>
                                    <div class="custom-file">
                                        <input type="file" class="" id="edit_profile_path" name="edit_profile_path">
                                    </div>
                                    <p><small class="cr-file-description">image size should be less than 2mb</small></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_is_active"
                                           name="edit_is_active">
                                    <label class="form-check-label" for="edit_is_active">Active</label>
                                </div>
                            </div>
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
                    add_first_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_last_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_designation_id: {
                        required: true,
                    },
                    add_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
                    },
                    add_staff_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_mobile_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_email: {
                        required: false,
                        email: true,
                    },
                    add_pay_rate: {
                        required: false,
                        maxlength: 30,
                    },
                    add_sia_number: {
                        required: false,
                        maxlength: 30,
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
                    edit_first_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_last_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_designation_id: {
                        required: true,
                    },
                    edit_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
                    },
                    edit_staff_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_mobile_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_email: {
                        required: false,
                        email: true,
                    },
                    edit_pay_rate: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_sia_number: {
                        required: false,
                        maxlength: 30,
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
            let url = "{{url('')}}"
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
            $('#img_div').html('<img src="' +url+ data.profile_path + '" alt="" style="height: 200px"/>');

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
        ///////////// Enter Only text //////////////
        $(document).ready(function () {
            $(".entertxtOnly").keypress(function (e) {
                var k;
                document.all ? k = e.keyCode : k = e.which;
                return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
            });
        });
        ///////////// Enter Only Number //////////////
        $(document).ready(function () {
            //called when key is pressed in textbox
            $(".EnterOnlyNumber").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
        });
    </script>


@endpush
