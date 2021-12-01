@extends('admin.layouts.app')
@section('title', 'Site')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Site
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                @if(hasPermission('add_site'))
                <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                   data-target="#add_modal"><i
                        class="fa fa-plus"></i> Add Site</a>
                        @endif
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(hasPermission('site_list'))
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>City</th>
                    <th>Start Date</th>
                    <th>Finish Date</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
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
    <form action="{{route('admin.site_type.store')}}" method="post" id="add_form">
        @csrf
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Site</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_client_id" class="required">Client Name</label>
                                    <select name="add_client_id" id="add_client_id" class="form-control select2">
                                        <option value="" disabled selected>Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_name" class="required">Name</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Type Name"
                                           name="add_name"
                                           id="add_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_address" class="">Address11</label>
                                    <input type="text" class="form-control" placeholder="Enter Address"
                                           name="add_address"
                                           id="add_address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_postal_code" class="">Postal Code/Zip Code</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Postal Code"
                                           name="add_postal_code"
                                           id="add_postal_code" maxlength="31">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter City"
                                           name="add_city"
                                           id="add_city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_start_date" class="">Start Date</label>
                                    <input type="date" class="form-control"
                                           name="add_start_date"
                                           id="add_start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_finish_date" class="">Finish Date</label>
                                    <input type="date" class="form-control"
                                           name="add_finish_date"
                                           id="add_finish_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_longitude" class="">Longitude</label>
                                    <input type="number" class="form-control"
                                           name="add_longitude" placeholder="Enter Longitude"
                                           id="add_longitude" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_latitude" class="">latitude</label>
                                    <input type="number" class="form-control"
                                           name="add_latitude" placeholder="Enter Latitude"
                                           id="add_latitude" step="0.01">
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
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                    <label for="edit_address" class="">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Address"
                                           name="edit_address"
                                           id="edit_address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_postal_code" class="">Postal Code/Zip Code</label>
                                    <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Postal Code"
                                           name="edit_postal_code"
                                           id="edit_postal_code" maxlength="31">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_city" class="">City</label>
                                    <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter City"
                                           name="edit_city"
                                           id="edit_city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_start_date" class="">Start Date</label>
                                    <input type="date" class="form-control"
                                           name="edit_start_date"
                                           id="edit_start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_finish_date" class="">Finish Date</label>
                                    <input type="date" class="form-control"
                                           name="edit_finish_date"
                                           id="edit_finish_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_longitude" class="">Longitude</label>
                                    <input type="number" class="form-control"
                                           name="edit_longitude" placeholder="Enter Longitude"
                                           id="edit_longitude" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_latitude" class="">Latitude</label>
                                    <input type="number" class="form-control"
                                           name="edit_latitude" placeholder="Enter Latitude"
                                           id="edit_latitude" step="0.01">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                    "url": "{{ route('admin.site.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "client_id"},
                    {"data": "name"},
                    {"data": "address"},
                    {"data": "postal_code"},
                    {"data": "city"},
                    {"data": "start_date"},
                    {"data": "finish_date"},
                    {"data": "longitude"},
                    {"data": "latitude"},
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
                    add_client_id: "required",
                    add_name: {
                        required: true,
                        maxlength: 30,
                    },
                    add_address: {
                        required: false,
                        maxlength: 150
                    },
                    add_finish_date: {
                        required: false,
                        greaterThan: "#add_start_date"
                    },
                    add_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    add_city: {
                        required: false,
                        maxlength: 30,
                    },
                    add_longitude: {
                        required: false,
                        maxlength: 30,
                    },
                    add_latitude: {
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
                    url: '{{route('admin.site.store')}}',
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
                    edit_client_id: "required",
                    edit_name: {
                        required: true,
                        maxlength: 30,
                    },
                    edit_finish_date: {
                        required: false,
                        greaterThan: "#edit_start_date"
                    },
                    edit_postal_code: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_address: {
                        required: false,
                        maxlength: 50
                    },
                    edit_city: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_longitude: {
                        required: false,
                        maxlength: 30,
                    },
                    edit_latitude: {
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
            $('#edit_client_id').val(data.client_id).trigger('change');
            $('#edit_name').val(data.name);
            $('#edit_address').val(data.address);
            $('#edit_postal_code').val(data.postal_code);
            $('#edit_city').val(data.city);
            $('#edit_start_date').val(data.start_date);
            $('#edit_finish_date').val(data.finish_date);
            $('#edit_longitude').val(data.longitude);
            $('#edit_latitude').val(data.latitude);

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


@endpush
