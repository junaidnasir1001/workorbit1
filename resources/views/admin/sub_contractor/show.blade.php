@extends('admin.layouts.app')
@section('title', 'Sub Contractor Details')

@section('content')
    <!-- Default box -->
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" id="sub_contractor_profile_path"
                             src="{{asset($sub_contractor->profile_path)}}"
                             alt="Sub Contractor profile picture">
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">

                        <li class="list-group-item">
                            <b>Name</b> <a class="float-right"><small
                                    id="sub_contractor_name">{{$sub_contractor->name}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right"><small
                                    id="sub_contractor_email">{{$sub_contractor->email}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile Number</b> <a class="float-right"><small
                                    id="sub_contractor_phone_number">{{$sub_contractor->phone_number}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone Number</b> <a class="float-right"><small
                                    id="sub_contractor_mobile_number">{{$sub_contractor->mobile_number}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Postal Code</b> <a class="float-right"><small
                                    id="sub_contractor_postal_code">{{$sub_contractor->postal_code}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>City</b> <a class="float-right"><small
                                    id="sub_contractor_city">{{$sub_contractor->city}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Website</b> <a class="float-right"><small
                                    id="sub_contractor_website">{{$sub_contractor->website}}</small></a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b> <a class="float-right"><small
                                    id="sub_contractor_address">{{$sub_contractor->address}}</small></a>
                        </li>
                    </ul>
                    @if(hasPermission('edit_subcontractor'))
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
                        <li class="nav-item"><a class="nav-link" href="#sites" data-toggle="tab">Sites</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#staff" data-toggle="tab">Staff</a>
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
                                @if(hasPermission('add_subcontractor_note'))
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
                            @if(hasPermission('subcontractor_note_list'))
                            <div id="notes_div">

                            </div>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="sites">
                            @include('admin.sub_contractor.sites.index')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="staff">
                            @include('admin.sub_contractor.staff.index')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="documents">
                            @include('admin.sub_contractor.document.index')
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
                        <h5 class="modal-title" id="addModalLabel">Edit SubContractor</h5>
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
                                           id="edit_name" value="{{$sub_contractor->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_phone_number" class="">Phone Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Phone Number"
                                           name="edit_phone_number"
                                           id="edit_phone_number" value="{{$sub_contractor->phone_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile_number" class="">Mobile Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Mobile Number"
                                           name="edit_mobile_number"
                                           id="edit_mobile_number" value="{{$sub_contractor->mobile_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email" class="">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                           name="edit_email"
                                           id="edit_email" value="{{$sub_contractor->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_registration_number" class="">Registration Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Registration Number"
                                           name="edit_registration_number"
                                           id="edit_registration_number"
                                           value="{{$sub_contractor->registration_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_vat_number" class="">VAT Number</label>
                                    <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter VAT Number"
                                           name="edit_vat_number"
                                           id="edit_vat_number" value="{{$sub_contractor->vat_number}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Subcontractor Profile</label>
                                    <div id="img_div">
                                        <img src="{{public_path($sub_contractor->profile_path)}}" alt="profile image"
                                             style="height: 200px" id="edit_profile_image">
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
                                           id="edit_address" value="{{$sub_contractor->address}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_postal_code" class="">Postal Code/ Zip Code</label>
                                    <input maxlength="31" type="text" class="form-control" placeholder="Enter Postal Code"
                                           name="edit_postal_code"
                                           id="edit_postal_code" value="{{$sub_contractor->postal_code}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control" placeholder="Enter City"
                                           name="edit_city"
                                           id="edit_city" value="{{$sub_contractor->city}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_country" class="">Country</label>
                                    <input maxlength="31" type="text" class="form-control" placeholder="Enter Country"
                                           name="edit_country"
                                           id="edit_country" value="{{$sub_contractor->country}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_website" class="">Website</label>
                                    <input type="url" class="form-control" placeholder="https://example.com"
                                           name="edit_website" pattern="https?://.+"
                                           id="edit_website" value="{{$sub_contractor->website}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_pay_rate" class="">Pay Rate</label>
                                    <input maxlength="31" type="number" class="form-control" placeholder="Rate Format (1.00)"
                                           name="edit_pay_rate"
                                           id="edit_pay_rate" pattern="\d+(\.\d{2})?" value="{{$sub_contractor->pay_rate}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_is_active"
                                           name="edit_is_active" {{$sub_contractor->is_active==1?"checked":""}}>
                                    <label class="form-check-label" for="edit_is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="old_profile_path" name="old_profile_path"
                               value="{{$sub_contractor->profile_path}}">
                        <input type="hidden" id="hidden_id" name="hidden_id" value="{{$sub_contractor->id}}">
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
            var sub_contractor_id = "{{$sub_contractor->id}}";

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
                        alertMsg(response.message, response.status);
                        $('#edit_modal').modal('hide');
                        var data = response.data;
                        $('#sub_contractor_name').val(data.name);
                        $('#sub_contractor_email').val(data.email);
                        $('#sub_contractor_phone_number').val(data.phone_number);
                        $('#sub_contractor_mobile_number').val(data.mobile_number);
                        $('#sub_contractor_postal_code').val(data.postal_code);
                        $('#sub_contractor_city').val(data.city);
                        $('#sub_contractor_website').val(data.website);
                        $('#sub_contractor_address').val(data.address);
                        $('#sub_contractor_profile_path').attr('src', data.profile_path);
                        $('#edit_profile_image').attr('src', data.profile_path);
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
            var sub_contractor = "{{$sub_contractor->id}}";
            $('#add_notes_form').on('submit', function (e) {
                e.preventDefault();
                var route = "{{route('admin.sub_contractor.notes.save',['sub_contractor'=>':sub_contractor'])}}";
                route = route.replace(':sub_contractor', sub_contractor);
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
            var id = $(this).data('note-id');
            $.ajax({
                type: 'POST',
                url: "{{route('admin.sub_contractor.notes.delete')}}",
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
            var sub_contractor = "{{$sub_contractor->id}}";
            var route = "{{route('admin.sub_contractor.notes.list',['sub_contractor'=>':sub_contractor'])}}";
            route = route.replace(':sub_contractor', sub_contractor);
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

    {{--Document script--}}
    <script>
        $(document).ready(function () {
            var sub_contractor = "{{$sub_contractor->id}}";
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

                var route = "{{route('admin.sub_contractor.document.store',['sub_contractor'=>':sub_contractor'])}}";
                route = route.replace(':sub_contractor', sub_contractor);
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
                var route = "{{route('admin.sub_contractor.document.update',['sub_contractor'=>':sub_contractor','document'=>":document"])}}";
                route = route.replace(':sub_contractor', sub_contractor);
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
            var sub_contractor = "{{$sub_contractor->id}}";

            var route = "{{route('admin.sub_contractor.document.index',['sub_contractor'=>':sub_contractor'])}}";
            route = route.replace(':sub_contractor', sub_contractor);
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    _token: "{{csrf_token()}}",
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
    {{--/Document Script--}}
@endpush
