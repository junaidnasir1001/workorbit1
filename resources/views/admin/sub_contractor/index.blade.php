@extends('admin.layouts.app')
@section('title', 'Subcontractor')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subcontractor List
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                @if(hasPermission('add_subcontractor'))
                    <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                       data-target="#add_modal"><i
                            class="fa fa-plus"></i> Add Subcontractor</a>
                @endif
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(hasPermission('subcontractor_list'))
                <table id="dt" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Phone Number</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Registration Number</th>
                        <th>VAT Number</th>
                        <th>Postal Code/Zip Code</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Pay Rate</th>
                        <th>Website</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!--Add Modal -->
    <form action="{{route('admin.sub_contractor.store')}}" method="post" id="add_form">
        @csrf
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Subcontractor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly"
                                           placeholder="Subcontractor name"
                                           name="add_name"
                                           id="add_name">
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                    <label for="add_registration_number" class="">Registration Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Registration Number"
                                           name="add_registration_number"
                                           id="add_registration_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_vat_number" class="">VAT Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter VAT Number"
                                           name="add_vat_number"
                                           id="add_vat_number">
                                </div>
                            </div>
                            <div class="col-md-12">

                                <label>Client Profile</label>
                                <div class="custom-file">
                                    <input type="file" class="" id="add_profile_path" name="add_profile_path">
                                </div>
                                <p><small class="cr-file-description">image size should be less than 2mb</small></p>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_address" class="">Address</label>
                                    <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                           name="add_address"
                                           id="add_address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_postal_code" class="">Postal Code/Zip Code</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Postal Code"
                                           name="add_postal_code"
                                           id="add_postal_code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter City"
                                           name="add_city"
                                           id="add_city">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="add_country" class="">Country</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Country"
                                           name="add_country"
                                           id="add_country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_website" class="">Website</label>
                                    <input type="text" class="form-control" placeholder="Enter Website"
                                           name="add_website"
                                           id="add_website">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Pay Rate"
                                           name="add_pay_rate"
                                           id="add_pay_rate">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="add_is_active"
                                           name="add_is_active">
                                    <label class="form-check-label" for="add_is_active">Active</label>
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
                        <h5 class="modal-title" id="addModalLabel">Edit Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Client name"
                                           name="edit_name"
                                           id="edit_name">
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                    <label for="edit_registration_number" class="">Registration Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Registration Number"
                                           name="edit_registration_number"
                                           id="edit_registration_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_vat_number" class="">VAT Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter VAT Number"
                                           name="edit_vat_number"
                                           id="edit_vat_number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Profile</label>
                                    <div id="img_div"></div>
                                    <div class="custom-file">
                                        <input type="file" class="" id="edit_profile_path" name="edit_profile_path">
                                    </div>
                                    <p><small class="cr-file-description">image size should be less than 2mb</small></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_address" class="">Address</label>
                                    <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                           name="edit_address"
                                           id="edit_address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_postal_code" class="">Postal Code/Zip Code</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Postal Code"
                                           name="edit_postal_code"
                                           id="edit_postal_code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter City"
                                           name="edit_city"
                                           id="edit_city">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_country" class="">Country</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Country"
                                           name="edit_country"
                                           id="edit_country">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_website" class="">Website</label>
                                    <input type="text" class="form-control" placeholder="Enter Website"
                                           name="edit_website"
                                           id="edit_website">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                           placeholder="Enter Pay Rate"
                                           name="edit_pay_rate"
                                           id="edit_pay_rate">
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
                    "url": "{{ route('admin.sub_contractor.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "profile_path", orderable: false, searchable: false},
                    {"data": "phone_number"},
                    {"data": "mobile_number"},
                    {"data": "email"},
                    {"data": "registration_number"},
                    {"data": "vat_number"},
                    {"data": "postal_code"},
                    {"data": "city"},
                    {"data": "country"},
                    {"data": "pay_rate"},
                    {"data": "website"},
                    {"data": "is_active"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                    "targets": [8, 9, 10, 12],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');
            $('#add_form').validate({
                rules: {
                    add_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
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
                    add_registration_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_vat_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_address: {
                        required: false,
                        maxlength: 100,
                    },
                    add_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    add_city: {
                        required: false,
                        maxlength: 30,
                    },
                    add_country: {
                        required: false,
                        maxlength: 30,
                    },
                    add_website: {
                        required: false,
                        maxlength: 30,
                    },
                    add_pay_rate: {
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
                    url: '{{route('admin.sub_contractor.store')}}',
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
                        maxlength: 30,
                    },
                    add_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
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
                    edit_registration_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_vat_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_address: {
                        required: false,
                        maxlength: 100,
                    },
                    edit_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_city: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_country: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_website: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_pay_rate: {
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
                var route = "{{route('admin.sub_contractor.update',['sub_contractor'=>':sub_contractor'])}}";
                route = route.replace(':sub_contractor', id);
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
            $('#edit_phone_number').val(data.phone_number);
            $('#edit_mobile_number').val(data.mobile_number);
            $('#edit_email').val(data.email);
            $('#edit_registration_number').val(data.registration_number);
            $('#edit_vat_number').val(data.vat_number);
            $('#edit_postal_code').val(data.postal_code);
            $('#edit_city').val(data.city);
            $('#edit_country').val(data.country);
            $('#edit_address').val(data.address);
            $('#old_profile_path').val(data.profile_path);
            $('#img_div').html('<img src="' + data.profile_path + '" alt="" style="height: 200px"/>');
            $('#edit_website').val(data.website);
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
