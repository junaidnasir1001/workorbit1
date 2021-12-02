@extends('admin.layouts.app')
@section('title', 'Client Details')

@section('content')
    <!-- Default box -->
    <div class="row">

            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" id="profile_path"
                                src="{{asset($client->profile_path)}}"
                                alt="Client profile picture">
                        </div>

                        <h3 class="profile-username text-center" id="name">{{$client->name}}</h3>

                        <p class="text-muted text-center" id="city_country">{{$client->city.' ,'.$client->country}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Phone number</b> <a class="float-right"><small
                                        id="phone_number">{{$client->phone_number}}</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile Number</b> <a class="float-right"><small
                                        id="mobile_number">{{$client->mobile_number}}</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right"><small id="email">{{$client->email}}</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>Registration Number</b> <a class="float-right"><small
                                        id="registration_number">{{$client->registration_number}}
                                    </small></a>
                            </li>
                            <li class="list-group-item">
                                <b>VAT Number</b> <a class="float-right"><small
                                        id="vat_number">{{$client->vat_number}}
                                    </small></a>
                            </li>
                            <li class="list-group-item">
                                <b>Address</b> <a class="float-right"><small id="address">{{$client->address}}</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>Postal Code/Zip Code</b> <a class="float-right"><small
                                        id="postal_code">{{$client->postal_code}}</small></a>
                            </li>
                        </ul>
                        @if(hasPermission('edit_client'))
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
                        <li class="nav-item"><a class="nav-link active" href="#notes" data-toggle="tab">Notes</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Contact Person</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#sites" data-toggle="tab">Sites</a></li>
                        <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="notes">
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
                                @if(hasPermission('add_client_note'))
                                    <form id="add_notes_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Enter note</label>
                                                    <textarea name="description" id="description" cols="30" rows="10"
                                                              class="form-control" required maxlength="500"></textarea>
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
                            @if(hasPermission('client_note_list'))
                                <div id="notes_div">

                                </div>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            @include('admin.clients.contact_person.index')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="documents">
                            @include('admin.clients.document.index')
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="sites">
                            @include('admin.clients.site.index')
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
                                           id="edit_name" value="{{$client->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_phone_number" class="">Phone Number</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Phone Number"
                                           name="edit_phone_number"
                                           maxlength="31"
                                           id="edit_phone_number" value="{{$client->phone_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile_number" class="">Mobile Number</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Mobile Number"
                                           name="edit_mobile_number"
                                           maxlength="31"
                                           id="edit_mobile_number" value="{{$client->mobile_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email" class="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="edit_email"
                                           id="edit_email" value="{{$client->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_registration_number" class="">Registration Number</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Registration Number"
                                           name="edit_registration_number"
                                           maxlength="31"
                                          id="edit_registration_number" value="{{$client->registration_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_vat_number" class="">VAT Number</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter VAT Number"
                                           name="edit_vat_number"
                                           maxlength="31"
                                           id="edit_vat_number" value="{{$client->vat_number}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Profile</label>
                                    <div id="img_div">
                                        <img src="{{asset($client->profile_path)}}" alt="profile pic"
                                             style="height: 200px" id="edit_profile_image"/>
                                    </div>
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
                                           id="edit_address" value="{{$client->address}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_postal_code" class="">Postal Code/Zip Code</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Postal Code"
                                           name="edit_postal_code"
                                           maxlength="31"
                                           id="edit_postal_code" value="{{$client->postal_code}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter City"
                                           name="edit_city"
                                           id="edit_city" value="{{$client->city}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_country" class="">Country</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Country"
                                           name="edit_country"
                                           id="edit_country" value="{{$client->country}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="old_profile_path" name="old_profile_path"
                               value="{{$client->profile_path}}">
                        <input type="hidden" id="hidden_id" name="hidden_id" value="{{$client->id}}">
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
            getNoteList();
            var client_id = "{{$client->id}}";

            $('#edit_form').validate({
                rules: {
                    edit_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_email: {
                        required: false,
                        email: true,
                    },
                    edit_address: {
                        required: false,
                        maxlength: 100,
                    },
                    edit_profile_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 2,//file size in mb
                    },
                    edit_city: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_country: {
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
                    edit_registration_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_vat_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_postal_code: {
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
                var route = "{{route('admin.client.update',['client'=>':client'])}}";
                route = route.replace(':client', id);
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
                        console.info(response);
                        swal.close();
                        alertMsg(response.message, response.status);
                        $('#edit_modal').modal('hide');
                        var client = response.client;
                        $('#name').text(client.name);
                        $('#phone_number').text(client.phone_number);
                        $('#mobile_number').text(client.mobile_number);
                        $('#email').text(client.email);
                        $('#postal_code').text(client.postal_code);
                        $('#city_country').text(client.city + " ," + client.country);
                        $('#registration_number').text(client.registration_number);
                        $('#address').text(client.address);
                        $('#vat_number').text(client.vat_number);
                        $('#profile_path').attr('src', client.profile_path);
                        $('#edit_profile_image').attr('src', client.profile_path);
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
                var route = "{{route('admin.client.notes.save',['client'=>':client'])}}";
                route = route.replace(':client', client_id);
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
        $(document).on('click', '.remove-note', function () {
            var id = $(this).data('note-id');
            $.ajax({
                type: 'POST',
                url: "{{route('admin.client.notes.delete')}}",
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
            var client = "{{$client->id}}";
            var route = "{{route('admin.client.notes.list',['client'=>':client'])}}";
            route = route.replace(':client', client);
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

    {{--Contact Person script--}}
    <script>
        $(document).ready(function () {
            var client_id = "{{$client->id}}";
            getContactPersonList();

            $('#add_contact_person_form').validate({
                rules: {
                    add_contact_person_job_title: {
                        required: false,
                        maxlength: 30,
                    },
                    add_contact_person_title: {
                        required: false,
                        maxlength: 30,
                    },
                    add_contact_person_name: {
                        required: false,
                        maxlength: 30,
                    },
                    add_contact_person_email: {
                        required: false,
                        email: 30,
                    },
                    add_contact_person_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    add_contact_person_address: {
                        required: false,
                        maxlength: 50,
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

                var route = "{{route('admin.client.contact_person.store',['client'=>':client'])}}";
                route = route.replace(':client', client_id);
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
                        required: false,
                        maxlength: 30,
                    },
                    edit_contact_person_title: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_contact_person_name: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_contact_person_email: {
                        required: false,
                        email: true,
                    },
                    edit_contact_person_phone_number: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_contact_person_address: {
                        required: false,
                        maxlength: 50,
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
                var route = "{{route('admin.client.contact_person.update',['client'=>':client','contact_person'=>":contact_person"])}}";
                route = route.replace(':client', client_id);
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
            var client_id = "{{$client->id}}";

            var route = "{{route('admin.client.contact_person.list',['client'=>':client'])}}";
            route = route.replace(':client', client_id);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
                    client_id: client_id
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
            var client_id = "{{$client->id}}";
            getDocumentList();

            $('#add_document_form').validate({
                rules: {
                    add_document_file_name: {
                        required: true,
                        maxlength: 255,
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

                var route = "{{route('admin.client.document.store',['client'=>':client'])}}";
                route = route.replace(':client', client_id);
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

            $('#edit_contact_person_form').validate({
                rules: {
                    edit_document_file_name: {
                        required: true,
                        maxlength: 255,
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
                var route = "{{route('admin.client.document.update',['client'=>':client','document'=>":document"])}}";
                route = route.replace(':client', client_id);
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
            var client_id = "{{$client->id}}";

            var route = "{{route('admin.client.document.list',['client'=>':client'])}}";
            route = route.replace(':client', client_id);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
                    client_id: client_id
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
    {{--/Document Person Script--}}

@endpush
