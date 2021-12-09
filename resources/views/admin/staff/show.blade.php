@extends('admin.layouts.app')
@section('title', 'Staff Details')

@section('content')
    <!-- Default box -->
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" id="profile_path"
                             src="{{asset($staff->profile_path)}}"
                             alt="Staff profile picture">
                    </div>

                    <h3 class="profile-username text-center" id="name">{{$staff->full_name}}</h3>

                    <p class="text-muted text-center" id="designation">{{$staff->designation->name??''}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Phone number</b> <a class="float-right"><small
                                    id="phone_number">{{$staff->phone_number}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile Number</b> <a class="float-right"><small
                                    id="mobile_number">{{$staff->mobile_number}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right"><small id="email">{{$staff->email}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>SIA Number</b> <a class="float-right"><small
                                    id="sia_number">{{$staff->sia_number}}
                                </small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Staff Number</b> <a class="float-right"><small
                                    id="staff_number">{{$staff->staff_number}}
                                </small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Sub Contractor</b> <a class="float-right"><small
                                    id="sub_contractor">{{$staff->sub_contractor->name??''}}
                                </small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Pay Rate</b> <a class="float-right"><small
                                    id="pay_rate">{{$staff->pay_rate}}</small></a>
                        </li>
                    </ul>
                    @if(hasPermission('edit_staff'))
                    <a href="javascript:;" class="btn btn-primary btn-block" data-toggle="modal"
                       data-target="#edit_modal"><b><i class='far fa-edit'></i></b></a>
                       @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Details</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#expertise" data-toggle="tab">Expertise</a></li>
                        <li class="nav-item"><a class="nav-link" href="#background" data-toggle="tab">Background</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#health" data-toggle="tab">Health</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#notes" data-toggle="tab">Notes</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#contact_persons" data-toggle="tab">Contact
                                Person</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
                        <li class="nav-item"><a class="nav-link" href="#vetting" data-toggle="tab">Vetting</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="details">
                            @include('admin.staff._include.personal_details')
                            @include('admin.staff._include.bank_details')
                            @include('admin.staff._include.passport_details')
                            @include('admin.staff._include.emergency_contacts')
                        </div>
                        <div class="tab-pane" id="expertise">
                            @include('admin.staff._include.certificate')
                            @include('admin.staff._include.training')
                        </div>
                        <div class="tab-pane" id="background">
                            @include('admin.staff._include.employment')
                            @include('admin.staff._include.education')
                            @include('admin.staff._include.personal_references')
                        </div>
                        <div class="tab-pane" id="health">
                            @include('admin.staff._include.health_information')
                            @include('admin.staff._include.staff_appearance')
                        </div>
                        <div class="tab-pane" id="notes">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Note</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                @if(hasPermission('add_staff_note'))
                                    <form id="add_notes_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Enter note</label>
                                                    <textarea name="description" id="description" cols="30" rows="10"
                                                              class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @if(hasPermission('staff_note_list'))
                            <div id="notes_div">

                            </div>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="contact_persons">
                            @include('admin.staff.contact_person.index')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="documents">
                            @include('admin.staff.document.index')
                        </div>
                        <div class="tab-pane" id="vetting">
                            @include('admin.staff.vetting.index')
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

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
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter First Name"
                                           name="edit_first_name"
                                           id="edit_first_name" value="{{$staff->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_last_name" class="required">Last Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Last Name"
                                           name="edit_last_name"
                                           id="edit_last_name" value="{{$staff->last_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_staff_number" class="">Staff Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Staff Number"
                                           name="edit_staff_number"
                                           id="edit_staff_number" value="{{$staff->staff_number}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_sub_contractor_id" class="">Sub Contractor</label>
                                    <select name="edit_sub_contractor_id" id="edit_sub_contractor_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select sub contractor</option>
                                        @foreach($sub_contractors as $sub_contractor)
                                            <option value="{{$sub_contractor->id}}"
                                                {{$staff->sub_contractor_id==$sub_contractor->id?'selected':''}}
                                            >{{$sub_contractor->name}}</option>
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
                                            <option value="{{$designation->id}}"
                                                {{$staff->designation_id==$designation->id?'selected':''}}
                                            >{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_phone_number" class="">Phone Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Phone Number"
                                           name="edit_phone_number"
                                           id="edit_phone_number" value="{{$staff->phone_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile_number" class="">Mobile Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Mobile Number"
                                           name="edit_mobile_number"
                                           id="edit_mobile_number" value="{{$staff->mobile_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email" class="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="edit_email"
                                           id="edit_email" value="{{$staff->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="number" class="form-control" placeholder="Rate Format (1.00)"
                                           name="edit_pay_rate"
                                           id="edit_pay_rate" pattern="\d+(\.\d{2})?" value="{{$staff->pay_rate}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_sia_number" class="">SIA Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter SIA Number"
                                           name="edit_sia_number"
                                           id="edit_sia_number" value="{{$staff->sia_number}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Staff Profile</label>
                                    <div id="img_div">
                                        <img id="edit_profile_image" src="{{asset($staff->profile_path)}}" alt="" style="height: 200px">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="" id="edit_profile_path" name="edit_profile_path">
                                    </div>
                                    <p><small class="cr-file-description">image size should be less than 2mb</small></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_is_active"
                                           name="edit_is_active" {{$staff->is_active==1?'checked':''}}>
                                    <label class="form-check-label" for="edit_is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="old_profile_path" name="old_profile_path"
                               value="{{$staff->profile_path}}">
                        <input type="hidden" id="hidden_id" name="hidden_id" value="{{$staff->id}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            getNoteList();
            var staff_id = "{{$staff->id}}";

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
                    add_designation_id: {
                        required: true,
                    },
                    add_profile_path: {
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
                var route = "{{route('admin.staff.update',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);

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
                        //console.info(response);
                        swal.close();
                        alertMsg(response.message, response.status);
                        $('#edit_modal').modal('hide');
                        var staff = response.staff;
                        var designation = response.designation;
                        var sub_contractor = response.sub_contractor;
                        $('#name').text(staff.first_name + ' ' + staff.last_name);
                        $('#designation').text(designation.name || '');
                        $('#phone_number').text(staff.phone_number);
                        $('#mobile_number').text(staff.mobile_number);
                        $('#email').text(staff.email);
                        $('#sia_number').text(staff.sia_number);
                        $('#staff_number').text(staff.staff_number);
                        if (sub_contractor != null) {
                            $('#sub_contractor').text(sub_contractor.name || '');
                        }
                        $('#pay_rate').text(staff.pay_rate);
                        $('#profile_path').attr('src', staff.profile_path);
                        $('#edit_profile_image').attr('src', staff.profile_path);

                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#add_notes_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.staff.notes.save',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        $('#add_notes_form')[0].reset();
                        alertMsg(response.message, response.status);
                        getNoteList();
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#staff_details_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.staff_details.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        $('#add_notes_form')[0].reset();
                        alertMsg(response.message, response.status);
                        getNoteList();
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#bank_details_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.bank_details.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        $('#add_notes_form')[0].reset();
                        alertMsg(response.message, response.status);
                        getNoteList();
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#passport_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.staff_passport.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        $('#add_notes_form')[0].reset();
                        alertMsg(response.message, response.status);
                        getNoteList();
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });
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
                            $('#em_dt').DataTable().ajax.reload();
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
        $(document).on('click', '.remove-note', function () {
            var id = $(this).data('note-id');
            $.ajax({
                type: 'POST',
                url: "{{route('admin.staff.notes.delete')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {

                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        });

        function getNoteList() {
            var staff = "{{$staff->id}}";
            var route = "{{route('admin.staff.notes.list',['staff'=>':staff'])}}";
            route = route.replace(':staff', staff);
            $.ajax({
                type: 'GET',
                url: route,
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#notes_div').html(response);
                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        }
    </script>

    {{--Emergency Contact Script--}}
    <script>
        $(document).ready(function () {

            var staff_id = "{{$staff->id}}";
            console.info(staff_id);
            var route = "{{route('admin.staff_emergency_contact.list',['staff'=>':staff'])}}";
            list_route = route.replace(':staff', staff_id);
            $("#em_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": list_route,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "phone"},
                    {"data": "relation"},
                    {"data": "address"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [3],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_em_form').validate({
                rules: {
                    add_em_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_em_phone: {
                        required: true,
                        maxlength: 30,
                    },
                    add_em_relation: {
                        required: false,
                        maxlength: 30,
                    },
                    add_em_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    add_em_address: {
                        required: false,
                        maxlength: 100,
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
            $('#add_em_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_em_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_emergency_contact.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#em_dt').DataTable().ajax.reload();
                        $('#add_em_form')[0].reset();
                        $('#add_em_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_em_form').validate({
                rules: {
                    edit_em_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_em_phone: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_em_relation: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_em_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_em_address: {
                        required: false,
                        maxlength: 100,
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
            $('#edit_em_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_em_form').valid()) {
                    return false;
                }
                var id = $('#hidden_id').val();
                var route = "{{route('admin.staff_emergency_contact.update',['staff'=>':staff','staff_emergency_contact'=>":staff_emergency_contact"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':staff_emergency_contact', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        $('#em_dt').DataTable().ajax.reload();
                        $('#edit_em_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_em_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_em_name').val(data.name);
            $('#edit_em_phone').val(data.phone);
            $('#edit_em_address').val(data.address);
            $('#edit_em_postal_code').val(data.postal_code);
            $('#edit_em_relation').val(data.relation);

            $('#hidden_id').val(data.id);
            $('#edit_em_modal').modal('show');
        });

    </script>
    {{--/Emergency Contact Script--}}

    {{--Certificate Script--}}
    <script>
        $(document).ready(function () {

            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            var route = "{{route('admin.staff_certificate.list',['staff'=>':staff'])}}";
            staff_certificate_list_route = route.replace(':staff', staff_id);
            $("#c_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": staff_certificate_list_route,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "number"},
                    {"data": "expiry_date"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_c_form').validate({
                rules: {
                    add_c_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_c_number: {
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
            $('#add_c_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_c_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_certificate.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#c_dt').DataTable().ajax.reload();
                        $('#add_c_form')[0].reset();
                        $('#add_c_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_c_form').validate({
                rules: {
                    edit_c_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_c_number: {
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
            $('#edit_c_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_c_form').valid()) {
                    return false;
                }
                var id = $('#hidden_c_id').val();
                var route = "{{route('admin.staff_certificate.update',['staff'=>':staff','staff_certificate'=>":staff_certificate"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':staff_certificate', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        $('#c_dt').DataTable().ajax.reload();
                        $('#edit_c_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_c_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_c_name').val(data.name);
            $('#edit_c_number').val(data.number);
            $('#edit_c_expiry_date').val(data.expiry_date);

            $('#hidden_c_id').val(data.id);
            $('#edit_c_modal').modal('show');
        });
        $(document).on('submit', '.delete_c_form', function (e) {
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
                            $('#c_dt').DataTable().ajax.reload();
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
    {{--/Certificate Contact Script--}}

    {{--Training Script--}}
    <script>
        $(document).ready(function () {

            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            var route = "{{route('admin.staff_training.list',['staff'=>':staff'])}}";
            staff_training_list_route = route.replace(':staff', staff_id);
            $("#training_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": staff_training_list_route,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "training_provider_name"},
                    {"data": "course_name"},
                    {"data": "certificate_obtained"},
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_training_form').validate({
                rules: {
                    add_training_provider_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_training_course_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_training_certificate_obtained: {
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
            $('#add_training_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_training_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_training.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#training_dt').DataTable().ajax.reload();
                        $('#add_training_form')[0].reset();
                        $('#add_training_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_training_form').validate({
                rules: {
                    edit_training_provider_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_training_course_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_training_certificate_obtained: {
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
            $('#edit_training_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_training_form').valid()) {
                    return false;
                }
                var id = $('#hidden_training_id').val();
                var route = "{{route('admin.staff_training.update',['staff'=>':staff','staff_training'=>":staff_training"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':staff_training', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        $('#training_dt').DataTable().ajax.reload();
                        $('#edit_training_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_training_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_training_provider_name').val(data.training_provider_name);
            $('#edit_training_course_name').val(data.course_name);
            $('#edit_training_certificate_obtained').val(data.certificate_obtained);
            $('#edit_training_start_date').val(data.start_date);
            $('#edit_training_end_date').val(data.end_date);

            $('#hidden_training_id').val(data.id);
            $('#edit_training_modal').modal('show');
        });
        $(document).on('submit', '.delete_training_form', function (e) {
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
                            $('#training_dt').DataTable().ajax.reload();
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
    {{--/Training Script--}}

    {{--Employment Script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            var route = "{{route('admin.staff_employment.list',['staff'=>':staff'])}}";
            staff_employment_route = route.replace(':staff', staff_id);
            $("#employment_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": staff_employment_route,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "company_name"},
                    {"data": "job_title"},
                    {"data": "address"},
                    {"data": "postal_code"},
                    {"data": "contact_person"},
                    {"data": "contact_phone"},
                    {"data": "email"},
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {"data": "reason_for_leaving"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [3, 4, 5, 6, 7, 8, 9, 10],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_employment_form').validate({
                rules: {
                    add_employment_company_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_employment_job_title: {
                        required: true,
                        maxlength: 30,
                    },
                    add_employment_address: {
                        required: false,
                        maxlength: 100,
                    },
                    add_employment_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    add_employment_contact_person: {
                        required: false,
                        maxlength: 30,
                    },
                    add_employment_contact_phone: {
                        required: false,
                        maxlength: 30,
                    },
                    add_employment_email: {
                        required: false,
                        email: true,
                    },
                    add_employment_reason_for_leaving: {
                        required: false,
                        maxlength: 30,
                    },
                    add_employment_end_date: {
                        required: false,
                        greaterThan: "#add_employment_start_date"
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
            $('#add_employment_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_employment_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_employment.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#employment_dt').DataTable().ajax.reload();
                        $('#add_employment_form')[0].reset();
                        $('#add_employment_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_employment_form').validate({
                rules: {
                    edit_employment_company_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_employment_job_title: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_employment_address: {
                        required: false,
                        maxlength: 100,
                    },
                    edit_employment_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_employment_contact_person: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_employment_contact_phone: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_employment_email: {
                        required: false,
                        email: true,
                    },
                    edit_employment_reason_for_leaving: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_employment_end_date: {
                        required: false,
                        greaterThan: "#edit_employment_start_date"
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
            $('#edit_employment_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_employment_form').valid()) {
                    return false;
                }
                var id = $('#hidden_employment_id').val();
                var route = "{{route('admin.staff_employment.update',['staff'=>':staff','staff_employment'=>":staff_employment"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':staff_employment', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        $('#employment_dt').DataTable().ajax.reload();
                        $('#edit_employment_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_employment_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_employment_company_name').val(data.company_name);
            $('#edit_employment_job_title').val(data.job_title);
            $('#edit_employment_address').val(data.address);
            $('#edit_employment_postal_code').val(data.postal_code);
            $('#edit_employment_contact_person').val(data.contact_person);
            $('#edit_employment_contact_phone').val(data.contact_phone);
            $('#edit_employment_email').val(data.email);
            $('#edit_employment_start_date').val(data.start_date);
            $('#edit_employment_end_date').val(data.end_date);
            $('#edit_employment_reason_for_leaving').val(data.reason_for_leaving);

            $('#hidden_employment_id').val(data.id);
            $('#edit_employment_modal').modal('show');
        });
        $(document).on('submit', '.delete_employment_form', function (e) {
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
                            $('#employment_dt').DataTable().ajax.reload();
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
    {{--/Employment Script--}}

    {{--Education Script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            var staff_education_route = "{{route('admin.staff_education.list',['staff'=>':staff'])}}";
            staff_education_route = staff_education_route.replace(':staff', staff_id);
            $("#education_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": staff_education_route,
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "institution"},
                    {"data": "speciality"},
                    {"data": "degree_obtained"},
                    {"data": "city"},
                    {"data": "country"},
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [4, 5, 6, 7],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_education_form').validate({
                rules: {
                    add_education_institution: {
                        required: true,
                        maxlength: 30,
                    },
                    add_education_speciality: {
                        required: true,
                        maxlength: 30,
                    },
                    add_education_degree_obtained: {
                        required: false,
                        maxlength: 30,
                    },
                    add_education_city: {
                        required: false,
                        maxlength: 30,
                    },
                    add_education_country: {
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
            $('#add_education_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_education_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_education.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#education_dt').DataTable().ajax.reload();
                        $('#add_education_form')[0].reset();
                        $('#add_education_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_education_form').validate({
                rules: {
                    edit_education_institution: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_education_speciality: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_education_degree_obtained: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_education_city: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_education_country: {
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
            $('#edit_education_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_education_form').valid()) {
                    return false;
                }
                var id = $('#hidden_education_id').val();
                var edit_education_route = "{{route('admin.staff_education.update',['staff'=>':staff','staff_education'=>":staff_education"])}}";
                edit_education_route = edit_education_route.replace(':staff', staff_id);
                edit_education_route = edit_education_route.replace(':staff_education', id);
                console.log(edit_education_route);

                $.ajax({
                    type: 'POST',
                    url: edit_education_route,
                    data: new FormData(this),
                    contentType: false,
                    data_type: 'json',
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        loader();
                    },
                    success: function (response) {
                        //console.info(response);
                        swal.close();
                        $('#education_dt').DataTable().ajax.reload();
                        $('#edit_education_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_education_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_education_institution').val(data.institution);
            $('#edit_education_speciality').val(data.speciality);
            $('#edit_education_degree_obtained').val(data.degree_obtained);
            $('#edit_education_city').val(data.city);
            $('#edit_education_country').val(data.country);
            $('#edit_education_start_date').val(data.start_date);
            $('#edit_education_end_date').val(data.end_date);


            $('#hidden_education_id').val(data.id);
            $('#edit_education_modal').modal('show');
        });
        $(document).on('submit', '.delete_education_form', function (e) {
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
                            $('#education_dt').DataTable().ajax.reload();
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
    {{--/Education Script--}}

    {{--Personal Reference Script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            var staff_personal_reference_route = "{{route('admin.staff_personal_reference.list',['staff'=>':staff'])}}";
            staff_personal_reference_route = staff_personal_reference_route.replace(':staff', staff_id);
            $("#personal_references_dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": staff_personal_reference_route,
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
                    {"data": "address"},
                    {"data": "postal_code"},
                    {"data": "phone"},
                    {"data": "occupation"},
                    {"data": "how_long_know"},
                    {"data": "relation"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": [],
                "columnDefs": [{
                    "targets": [2, 3, 4, 5, 6, 7, 8],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');

            $('#add_personal_references_form').validate({
                rules: {
                    add_personal_references_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_personal_references_email: {
                        required: false,
                        email: true,
                    },
                    add_personal_references_address: {
                        required: false,
                        maxlength: 100,
                    },
                    add_personal_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    add_personal_phone: {
                        required: false,
                        maxlength: 30,
                    },
                    add_personal_references_occupation: {
                        required: false,
                        maxlength: 30,
                    },
                    add_personal_references_how_long_know: {
                        required: false,
                        maxlength: 30,
                    },
                    add_personal_references_relation: {
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
            $('#add_personal_references_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_personal_references_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff_personal_reference.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        $('#personal_references_dt').DataTable().ajax.reload();
                        $('#add_personal_references_form')[0].reset();
                        $('#add_personal_references_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_personal_references_form').validate({
                rules: {
                    edit_personal_references_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_personal_references_email: {
                        required: false,
                        email: true,
                    },
                    edit_personal_references_address: {
                        required: false,
                        maxlength: 100,
                    },
                    edit_personal_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_personal_phone: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_personal_references_occupation: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_personal_references_how_long_know: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_personal_references_relation: {
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
            $('#edit_personal_references_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_personal_references_form').valid()) {
                    return false;
                }
                var id = $('#hidden_personal_references_id').val();
                var edit_route = "{{route('admin.staff_personal_reference.update',['staff'=>':staff','staff_personal_reference'=>":staff_personal_reference"])}}";
                edit_route = edit_route.replace(':staff', staff_id);
                edit_route = edit_route.replace(':staff_personal_reference', id);


                $.ajax({
                    type: 'POST',
                    url: edit_route,
                    data: new FormData(this),
                    contentType: false,
                    data_type: 'json',
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        loader();
                    },
                    success: function (response) {
                        //console.info(response);
                        swal.close();
                        $('#personal_references_dt').DataTable().ajax.reload();
                        $('#edit_personal_references_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_personal_references_data', function () {
            var data = $(this).data('params');
            // console.log(data);
            $('#edit_personal_references_name').val(data.name);
            $('#edit_personal_references_email').val(data.email);
            $('#edit_personal_references_address').val(data.address);
            $('#edit_personal_postal_code').val(data.postal_code);
            $('#edit_personal_phone').val(data.phone);
            $('#edit_personal_references_occupation').val(data.occupation);
            $('#edit_personal_references_how_long_know').val(data.how_long_know);
            $('#edit_personal_references_relation').val(data.relation);


            $('#hidden_personal_references_id').val(data.id);
            $('#edit_personal_references_modal').modal('show');
        });
        $(document).on('submit', '.delete_personal_references_form', function (e) {
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
                            $('#personal_references_dt').DataTable().ajax.reload();
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
    {{--/Personal Reference Script--}}

    {{--Health Information Script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            $('#staff_health_information_form').on('submit', function (e) {
                e.preventDefault();

                var route = "{{route('admin.staff_health_information.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });
        });
    </script>
    {{--/Health Information Script--}}

    {{--Staff Appearence Script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            // console.info(staff_id);
            $('#staff_appearance_form').on('submit', function (e) {
                e.preventDefault();

                var route = "{{route('admin.staff_appearance.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });
        });
    </script>
    {{--/Staff Appearerence Script--}}

    {{--Contact Person script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            getContactPersonList();

            $('#add_contact_person_form').validate({
                rules: {
                    add_contact_person_job_title: {
                        required: true,
                        maxlength: 30,
                    },
                    add_contact_person_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_contact_person_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_contact_person_email: {
                        required: false,
                        email: true,
                    },
                    add_contact_person_address: {
                        required: false,
                        maxlength: 100,
                    },
                    add_contact_person_postal_code: {
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
            $('#add_contact_person_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_contact_person_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff.contact_person.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        getContactPersonList();
                        $('#add_contact_person_form')[0].reset();
                        $('#add_contact_person_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_contact_person_form').validate({
                rules: {
                    edit_contact_person_job_title: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_contact_person_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_contact_person_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_contact_person_email: {
                        required: false,
                        email: true,
                    },
                    edit_contact_person_address: {
                        required: false,
                        maxlength: 100,
                    },
                    edit_contact_person_postal_code: {
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
            $('#edit_contact_person_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_contact_person_form').valid()) {
                    return false;
                }
                var id = $('#hidden_contact_person_id').val();
                var route = "{{route('admin.staff.contact_person.update',['staff'=>':staff','contact_person'=>":contact_person"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':contact_person', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        getContactPersonList();
                        $('#edit_contact_person_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_contact_person_data', function () {
            $('#edit_contact_person_title').val($(this).data('title'));
            $('#edit_contact_person_name').val($(this).data('name'));
            $('#edit_contact_person_job_title').val($(this).data('job-title'));
            $('#edit_contact_person_phone_number').val($(this).data('phone-number'));
            $('#edit_contact_person_email').val($(this).data('email'));
            $('#edit_contact_person_address').val($(this).data('address'));
            $('#edit_contact_person_postal_code').val($(this).data('postal-code'));

            $('#hidden_contact_person_id').val($(this).data('id'));
            $('#edit_contact_person_modal').modal('show');
        });
        $(document).on('submit', '.delete_contact_person_form', function (e) {
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
                            getContactPersonList();
                            alertMsg(response.message, 'error');
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

        function getContactPersonList() {
            var id = "{{$staff->id}}";

            var route = "{{route('admin.staff.contact_person.list',['staff'=>':staff'])}}";
            route = route.replace(':staff', id);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
                    id: id
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#contact_person_body').html(response);
                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        }
    </script>
    {{--/Contact Person Script--}}

    {{--Document Person script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            getDocumentList();

            $('#add_document_form').validate({
                rules: {
                    add_document_file_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_document_file_path: "required",
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
            $('#add_document_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_document_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff.document.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        getDocumentList();
                        $('#add_document_form')[0].reset();
                        $('#add_document_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_document_form').validate({
                rules: {
                    edit_document_file_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_document_file_path: "required",
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
            $('#edit_document_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_document_form').valid()) {
                    return false;
                }
                var id = $('#hidden_document_id').val();
                var route = "{{route('admin.staff.document.update',['staff'=>':staff','document'=>":document"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':document', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        getDocumentList();
                        $('#edit_document_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_document_data', function () {
            $('#edit_document_file_name').val($(this).data('name'));
            $('#hidden_document_id').val($(this).data('id'));
            $('#hidden_document_old_file_path').val($(this).data('old-file-path'));
            $('#edit_document_modal').modal('show');
        });
        $(document).on('submit', '.delete_document_form', function (e) {
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
                            getDocumentList();
                            alertMsg(response.message, 'error');
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

        function getDocumentList() {
            var id = "{{$staff->id}}";

            var route = "{{route('admin.staff.document.list',['staff'=>':staff'])}}";
            route = route.replace(':staff', id);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
                    id: id
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#document_body').html(response);
                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        }
    </script>
    {{--/Document Person Script--}}

    {{--Vetting script--}}
    <script>
        $(document).ready(function () {
            var staff_id = "{{$staff->id}}";
            getStaffVattingList();

            $('#add_vetting_form').validate({
                rules: {
                    add_vetting_id: "required",
                    add_document_file_path: "required",
                    add_status: "required",
                    add_note: {
                        required: false,
                        maxlength: 100,
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
            $('#add_vetting_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_vetting_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.staff.staff_vetting.store',['staff'=>':staff'])}}";
                route = route.replace(':staff', staff_id);
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
                        //console.info(response);
                        swal.close();
                        getStaffVattingList();
                        $('#add_vetting_form')[0].reset();
                        $('#add_vetting_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_staff_vetting_form').validate({
                rules: {
                    edit_staff_vetting_id: "required",

                    edit_staff_vetting_status: "required",
                    edit_staff_vetting_note: {
                        required: false,
                        maxlength: 100,
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
            $('#edit_staff_vetting_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_staff_vetting_form').valid()) {
                    return false;
                }
                var id = $('#hidden_staff_vetting_id').val();
                var route = "{{route('admin.staff.staff_vetting.update',['staff'=>':staff','staff_vetting'=>":staff_vetting"])}}";
                route = route.replace(':staff', staff_id);
                route = route.replace(':staff_vetting', id);
                console.log(route);

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
                        //console.info(response);
                        swal.close();
                        getStaffVattingList();
                        $('#edit_staff_vetting_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

        });
        $(document).on('click', '.edit_staff_vetting_data', function () {
            $('#edit_staff_vetting_id').val($(this).data('vetting-id'));
            $('#edit_staff_vetting_note').val($(this).data('note'));
            $('#edit_staff_vetting_status').val($(this).data('status'));
            $('#hidden_staff_vetting_id').val($(this).data('id'));
            $('#edit_staff_vetting_modal').modal('show');
        });

        $(document).on('submit', '.delete_staff_vetting_form', function (e) {
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
                            getStaffVattingList();
                            alertMsg(response.message, 'error');
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

        function getStaffVattingList() {
            var id = "{{$staff->id}}";
            var route = "{{route('admin.staff.staff_vetting.list',['staff'=>':staff'])}}";
            route = route.replace(':staff', id);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
                    id: id
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#staff_vetting_body').html(response);
                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        }
        ///////////// Enter Only text //////////////
        $(document).ready(function (){
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
    {{-- /Vetting Person Script--}}
@endpush
