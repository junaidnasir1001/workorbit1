@extends('admin.layouts.app')
@section('title', 'Site Details')

@section('content')
    <!-- Default box -->

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    </div>

                    <h3 class="profile-username text-center" id="name">{{$site->name}}</h3>

                    <p class="text-muted text-center" id="city">{{$site->city}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Address</b> <a class="float-right"><small
                                    id="address">{{$site->address}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Client Name</b> <a class="float-right"><small
                                    id="address">{{$site->name}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Postal Code/Zip Code</b> <a class="float-right"><small
                                    id="postal_code">{{$site->postal_code}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Longitude</b> <a class="float-right"><small
                                    id="start_date">{{$site->longitude}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Latitude</b> <a class="float-right"><small
                                    id="finish_date">{{$site->latitude}}
                                </small></a>
                        </li>
                    </ul>
                    @if(hasPermission('edit_site'))
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
                        <li class="nav-item"><a class="nav-link" href="#rate_card" data-toggle="tab">Rate Card</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#prefferd_staff" data-toggle="tab">Prefferd
                                Staff</a>
                        </li>
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
                                @if(hasPermission('add_site_note'))
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
                            @if(hasPermission('site_note_list'))
                            <div id="notes_div">

                            </div>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            @include('admin.clients.contact_person.index')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="prefferd_staff">
                            @include('admin.site.prefferd_staff.index')
                            @include('admin.site.banned_staff.index')
                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="rate_card">
                            @include('admin.site.pay_rate_card.index')
                            @include('admin.site.charge_rate_card.index')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="documents">
                            @include('admin.clients.document.index')
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
                        <h5 class="modal-title" id="addModalLabel">Edit Site</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_client_id" class="required">Client Name</label>
                                    <select name="edit_client_id" id="edit_client_id" class="form-control select2">
                                        <option value="" disabled selected>Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}"
                                                {{$site->client_id==$client->id?'selected':""}}
                                            >{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Name"
                                           name="edit_name"
                                           id="edit_name" value="{{$site->name}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_address" class="">Address</label>
                                    <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                           name="edit_address"
                                           id="edit_address" value="{{$site->address}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_postal_code" class="">Postal Code/Zip Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Postal Code"
                                           name="edit_postal_code"
                                           maxlength="31"
                                           id="edit_postal_code" value="{{$site->postal_code}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control" placeholder="Enter City"
                                           name="edit_city"
                                           id="edit_city" value="{{$site->city}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_longitude" class="">Longitude</label>
                                    <input type="text" class="form-control"
                                           name="edit_longitude" placeholder="Enter Longitude"
                                           id="edit_longitude" pattern="-?\d{1,3}\.\d+" value="{{$site->longitude}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_latitude" class="">Latitude</label>
                                    <input type="text" class="form-control"
                                           name="edit_latitude" placeholder="Enter Latitude"
                                           id="edit_latitude" value="{{$site->latitude}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="hidden_id" name="hidden_id" value="{{$site->id}}">
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
            var id = "{{$site->id}}";
            $('#edit_form').validate({
                rules: {
                    edit_client_id: "required",
                    edit_name: {
                        required: true,
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
                    edit_finish_date: {
                        required: false,
                        greaterThan: "#edit_start_date"
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
                var route = "{{route('admin.site.update',['site'=>':site'])}}";
                route = route.replace(':site', id);
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
                        var site = response.site;
                        $('#name').text(site.name);
                        $('#city').text(site.city);
                        $('#address').text(site.address);
                        $('#postal_code').text(site.postal_code);
                        $('#start_date').text(site.start_date);
                        $('#finish_date').text(site.finish_date);

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

    {{--Notes script--}}
    <script>
        $(document).ready(function () {
            getNoteList();
            var Id = "{{$site->id}}";
            $('#add_notes_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.site.note.store',['site'=>':site'])}}";
                route = route.replace(':site', Id);
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
        $(document).on('click', '.remove-note', function () {
            var Id = "{{$site->id}}";
            var id = $(this).data('note-id');
            var route = "{{route('admin.site.note.destroy',['site'=>':site','note'=>':note'])}}";
            route = route.replace(':site', Id);
            route = route.replace(':note', id);
            console.info("delete", route);
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE",
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
            var id = "{{$site->id}}";
            var route = "{{route('admin.site.note.index',['site'=>':site'])}}";
            route = route.replace(':site', id);
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
    {{--/Notes script--}}

    {{--Contact Person script--}}
    <script>
        $(document).ready(function () {
            var Id = "{{$site->id}}";
            getContactPersonList();

            $('#add_contact_person_form').validate({
                rules: {
                    add_contact_person_title: {
                        required: true,
                        maxlength: 30,
                    },
                    add_contact_person_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_contact_person_job_title: {
                        required: false,
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

                var route = "{{route('admin.site.contact_person.store',['site'=>':site'])}}";
                route = route.replace(':site', Id);
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
                    edit_contact_person_title: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_contact_person_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_contact_person_job_title: {
                        required: false,
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
                var route = "{{route('admin.site.contact_person.update',['site'=>':site','contact_person'=>":contact_person"])}}";
                route = route.replace(':site', Id);
                route = route.replace(':contact_person', id);
                console.log("edit contact person", route);

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
            var siteId = "{{$site->id}}";
            var route = "{{route('admin.site.contact_person.index',['site'=>':site'])}}";
            route = route.replace(':site', siteId);
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    // id: siteId
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
            var Id = "{{$site->id}}";
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

                var route = "{{route('admin.site.document.store',['site'=>':site'])}}";
                route = route.replace(':site', Id);
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
                var route = "{{route('admin.site.document.update',['site'=>':site','document'=>":document"])}}";
                route = route.replace(':site', Id);
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
            var id = "{{$site->id}}";

            var route = "{{route('admin.site.document.index',['site'=>':site'])}}";
            route = route.replace(':site', id);
            $.ajax({
                type: 'GET',
                url: route,
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

    {{--Site pay Rate Card script--}}
    <script>
        $(document).ready(function () {
            var Id = "{{$site->id}}";
            getPayRateCardList();

            $('#add_pay_rate_card_form').validate({
                rules: {},
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
            $('#add_pay_rate_card_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_pay_rate_card_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.site.pay_rate_card.store',['site'=>':site'])}}";
                route = route.replace(':site', Id);
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
                        getPayRateCardList();
                        $('#add_pay_rate_card_form')[0].reset();
                        $('#add_pay_rate_card_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_pay_rate_cards_form').validate({
                rules: {},
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
            $('#edit_pay_rate_cards_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_pay_rate_cards_form').valid()) {
                    return false;
                }
                var id = $('#edit_pay_rate_card_id').val();
                var route = "{{route('admin.site.pay_rate_card.update',['site'=>':site','pay_rate_card'=>":pay_rate_card"])}}";
                route = route.replace(':site', Id);
                route = route.replace(':pay_rate_card', id);

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
                        getPayRateCardList();
                        $('#edit_pay_rate_cards_modal').modal('hide');
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

        $(document).on('click', '.edit_pay_rate_card_data', function () {
            $('#edit_pay_rate_card_rate').val($(this).data('rate'));
            $('#edit_pay_rate_card_designation_id').val($(this).data('designation-id'));
            $('#edit_pay_rate_card_id').val($(this).data('id'));
            $('#edit_pay_rate_cards_modal').modal('show');
        });

        $(document).on('submit', '.delete_pay_rate_card_form', function (e) {
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
                            getPayRateCardList();
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

        function getPayRateCardList() {
            var siteId = "{{$site->id}}";
            var route = "{{route('admin.site.pay_rate_card.index',['site'=>':site'])}}";
            route = route.replace(':site', siteId);
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    // id: siteId
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#pay_rate_card_body').html(response);
                },
                error: function (xhr, error, status) {
                    //swal.close();
                    var response = xhr.responseJSON;
                }
            });
        }
    </script>
    {{--/Site pay Rate Card script--}}

    {{--Site Charge Rate Card script--}}
    <script>
        $(document).ready(function () {
            var Id = "{{$site->id}}";
            getChargeRateCardList();

            $('#add_charge_rate_card_form').validate({
                rules: {},
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
            $('#add_charge_rate_card_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#add_charge_rate_card_form').valid()) {
                    return false;
                }

                var route = "{{route('admin.site.charge_rate_card.store',['site'=>':site'])}}";
                route = route.replace(':site', Id);
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
                        getChargeRateCardList();
                        $('#add_charge_rate_card_form')[0].reset();
                        $('#add_charge_rate_card_modal').modal('hide');
                        alertMsg(response.message, response.status);
                    },
                    error: function (xhr, error, status) {
                        swal.close();
                        var response = xhr.responseJSON;
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_charge_rate_cards_form').validate({
                rules: {},
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
            $('#edit_charge_rate_cards_form').on('submit', function (e) {
                e.preventDefault();
                // check if the input is valid using a 'valid' property
                if (!$('#edit_charge_rate_cards_form').valid()) {
                    return false;
                }
                var id = $('#edit_charge_rate_card_id').val();
                var route = "{{route('admin.site.charge_rate_card.update',['site'=>':site','charge_rate_card'=>":charge_rate_card"])}}";
                route = route.replace(':site', Id);
                route = route.replace(':charge_rate_card', id);

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
                        getChargeRateCardList();
                        $('#edit_charge_rate_cards_modal').modal('hide');
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

        $(document).on('click', '.edit_charge_rate_card_data', function () {
            $('#edit_charge_rate_card_rate').val($(this).data('rate'));
            $('#edit_charge_rate_card_site_type_id').val($(this).data('site-type-id'));
            $('#edit_charge_rate_card_id').val($(this).data('id'));
            $('#edit_charge_rate_cards_modal').modal('show');
        });

        $(document).on('submit', '.delete_charge_rate_card_form', function (e) {
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
                            getChargeRateCardList();
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

        function getChargeRateCardList() {
            var siteId = "{{$site->id}}";
            var route = "{{route('admin.site.charge_rate_card.index',['site'=>':site'])}}";
            route = route.replace(':site', siteId);
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    // id: siteId
                },
                beforeSend: function () {
                    //loader();
                },
                success: function (response) {
                    $('#charge_rate_card_body').html(response);
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
    {{--/Site Charge Rate Card script--}}
@endpush
