@extends('admin.layouts.app')
@section('title', 'Staff Shift')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Shift List
                {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
                @if(hasPermission('add_shift'))
                <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
                   data-target="#add_modal"><i
                        class="fa fa-plus"></i> Add Shift</a>
                        @endif
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        @if(hasPermission('shift_list'))
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Site</th>
                    <th>Site Type</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Break Start</th>
                    <th>Break End</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Working Days</th>
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
                                <div class="alert alert-danger" id="errors_div" style="display: none">
                                    <ul id="errors"></ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_client_id" class="required">Clients</label>
                                    <select name="add_client_id" id="add_client_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>-Select One-</option>
                                        @foreach($clients as $client)
                                            <option  value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_site_id" class="required">Site</label>
                                    <select name="add_site_id" id="add_site_id"
                                            class="select2 form-control">
                                        <option value="" selected disabled>select site</option>
{{--                                        @foreach($sites as $site)--}}
{{--                                            <option value="{{$site->id}}" client_id="{{$site->client_id}}">{{$site->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_site_type_id" class="required">Site Type</label>
                                    <select name="add_site_type_id" id="add_site_type_id"
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
                                    <label for="add_start_date" class="required">Shift Start Date</label>
                                    <input type="date" class="form-control"
                                           name="add_start_date"
                                           id="add_start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="add_end_date" class="required">Shift End Date</label>
                                    <input type="date" class="form-control"
                                           name="add_end_date"
                                           id="add_end_date">
                                </div>
                            </div>
                            <label for="" class="required">Working Days</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @foreach($working_days as $day)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                   id="add_working_days{{$loop->index}}"
                                                   name="add_working_days[]"
                                                   value="{{$day}}">
                                            <label class="form-check-label"
                                                   for="add_working_days{{$loop->index}}">{{$day}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add_instructions" class="">Instructions</label>
                                    <textarea class="form-control" rows="5" id="add_instructions"
                                              name="add_instructions"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12" id="staff_div">
                                <table class="table table-bordered" id="staff_table">
                                    <thead>
                                    <tr>
                                        <th>Staff</th>
                                        <th>Pay Rate</th>
                                        <th>Shift Schedule</th>
                                        <th>
                                            <button type="button" class="btn btn-danger btn-sm remove_btn" data-i="">
                                                <i class="fas fa-times"></i></button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select name="add_staff_id[]" id="add_staff_id"
                                                    class="select2 form-control add_staff_id">
                                                <option value="" selected disabled>select staff</option>
                                                @foreach($staffs as $staff)
                                                    <option value="{{$staff->id}}">{{$staff->full_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="enter pay rate"
                                                   name="add_staff_pay_rate[]">
                                        </td>
                                        <td>
                                            <select name="add_staff_shift_schedule[]" id="add_staff_shift_schedule"
                                                    class="form-control shift_schedule"
                                                    data-i="">
                                                <option value="default" selected>Default</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="staff_shift_div" style="display: none">
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
                                                               name="add_staff_time_in[]">
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
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="add_btn" type="button">Add more</button>
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
                        <h5 class="modal-title" id="addModalLabel">Edit Shift</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="edit_modal_div">
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
    <input type="hidden" id="sites_data" value="{{json_encode($sites)}}">
    <!--/Edit Modal -->
@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $('#add_client_id').on('change',function (){
                let sites_raw = $('#sites_data').val();
                let client_id = parseInt($(this).val());
                let sites = JSON.parse(sites_raw);
                let client_sites = sites.filter( site =>{
                    if(site.client_id === client_id){
                        return site
                    }
                })
                $('#add_site_id').find('option').not(':first').remove();
                $.each(client_sites, function (i,value){
                    $('#add_site_id').append(' <option value="'+value.id+'">'+value.name+'</option>')
                })
            })

            $(document).on('change','#edit_client_id',function (){
                let sites_raw = $('#sites_data').val();
                let client_id = parseInt($(this).val());
                let sites = JSON.parse(sites_raw);
                let client_sites = sites.filter( site =>{
                    if(site.client_id === client_id){
                        return site
                    }
                })
                $('#edit_site_id').find('option').not(':first').remove();
                $.each(client_sites, function (i,value){
                    $('#edit_site_id').append(' <option value="'+value.id+'">'+value.name+'</option>')
                })
            })


            var table = $("#dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    "url": "{{ route('admin.shift.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "client_id"},
                    {"data": "site_id"},
                    {"data": "site_type_id"},
                    {"data": "time_in"},
                    {"data": "time_out"},
                    {"data": "break_time_start"},
                    {"data": "break_time_end"},
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {"data": "working_days"},
                    {"data": "options", orderable: false, searchable: false}
                ],
                "order": [0, "desc"],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                    "targets": [7, 8, 9],
                    "visible": false
                }],
                "bDestroy": true
            }).buttons().container().appendTo('#dt_wrapper .col-md-6:eq(0)');
            $('#add_form').validate({
                rules: {
                    add_site_id: "required",
                    add_site_type_id: "required",
                    add_time_in: "required",
                    add_time_out: "required",
                    add_break_time_start: "required",
                    add_break_time_end: "required",
                    add_start_date: "required",
                    add_end_date: "required",
                    add_instructions: {
                        required: false,
                        maxlength: 65535,
                    },
                    add_staff_pay_rate:{
                        required: false,
                        maxlength: 255,
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
                var time_in = $('#add_time_in').val();
                var time_out = $('#add_time_out').val();
                if (Date.parse(time_out) > Date.parse(time_in) > true) {
                    alert('start time should be smaller')
                }

                var staff_id_arr = [];
                $('.add_staff_id').each(function (index) {
                    if (this.value != '') {
                        staff_id_arr.push(this.value);
                    }
                });
                console.info($.chk_duplicate_arr(staff_id_arr));
                if ($.chk_duplicate_arr(staff_id_arr).length > 0) {
                    alertMsg('Same Staff Selected Twice', 'error');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.shift.store')}}',
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
                        $('#errors_div').show();
                        var errors = "";
                        $.each(response.errors, function (index, value) {
                            /*$('#' + index).closest('.form-group').append(
                                '<small class="text-danger">' + value[0] + '</small'
                            );*/
                            console.info(index);
                            errors += '<li>' + value[0] + '</li>';
                        });
                        $('#errors').html(errors);
                        alertMsg(response.message, 'error');
                    }
                });
            });

            $('#edit_form').validate({
                rules: {
                    edit_site_id: "required",
                    edit_site_type_id: "required",
                    edit_time_in: "required",
                    edit_time_out: "required",
                    edit_break_time_start: "required",
                    edit_break_time_end: "required",
                    edit_start_date: "required",
                    edit_end_date: "required",
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
                var time_in = $('#edit_time_in').val();
                var time_out = $('#edit_time_out').val();
                if (Date.parse(time_out) > Date.parse(time_in) > true) {
                    alert('start time should be smaller')
                }

                var staff_id_arr = [];
                $('.edit_staff_id').each(function (index) {
                    if (this.value != '') {
                        staff_id_arr.push(this.value);
                    }
                });
                console.info($.chk_duplicate_arr(staff_id_arr));
                if ($.chk_duplicate_arr(staff_id_arr).length > 0) {
                    alertMsg('Same Staff Selected Twice', 'error');
                    return false;
                }
                var id = $('#hidden_id').val();
                var route = "{{route('admin.shift.update',['shift'=>':shift'])}}";
                route = route.replace(':shift', id);
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
                        swal.close();
                        $('#edit_errors_div').show();
                        var errors = "";
                        $.each(response.errors, function (index, value) {
                            console.info(index);
                            errors += '<li>' + value[0] + '</li>';
                        });
                        $('#edit_errors').html(errors);
                    }
                });
            });
            var i = 0;
            $('#add_btn').on('click', function () {
                i++;
                $('#staff_div').append('<table class="table table-bordered" id="staff_table' + i + '">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Staff</th>' +
                    '<th>Pay Rate</th>' +
                    '<th>Shift Schedule</th>' +
                    '<th>' +
                    '<button type="button" class="btn btn-danger btn-sm remove_btn" data-i="' + i + '">' +
                    '<i class="fas fa-times"></i></button>' +
                    '</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' +
                    '<select name="add_staff_id[]" id="add_staff_id' + i + '" ' +
                    'class="select2 form-control add_staff_id">' +
                    '<option value="" selected disabled>select staff</option>' +
                    ' @foreach($staffs as $staff)' +
                    '<option value="{{$staff->id}}">{{$staff->full_name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control" placeholder="enter pay rate" ' +
                    'name="add_staff_pay_rate[]" id="add_staff_pay_rate' + i + '">' +
                    '</td>' +
                    '<td>' +
                    '<select name = "add_staff_shift_schedule[]" id ="add_staff_shift_schedule' + i + '" ' +
                    'class="form-control shift_schedule"' +
                    'data-i="' + i + '">' +
                    '<option value = "default" selected>Default</option>' +
                    '<option value="custom">Custom</option>' +
                    '</select>' +
                    '</td>' +
                    '</tr>' +
                    '<tr id="staff_shift_div' + i + '" style="display: none">' +
                    '<td colspan="3">' +
                    '<table class="table">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Staff Time In</th>' +
                    '<th>Staff Time Out</th>' +
                    '<th>Staff Break Start</th>' +
                    '<th>Staff Break End</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tr>' +
                    '<td>' +
                    '<input type="time" class="form-control" ' +
                    'name="add_staff_time_in[]">' +
                    '</td>' +
                    '<td>' +
                    '<input type="time" class="form-control" ' +
                    'name="add_staff_time_out[]">' +
                    '</td>' +
                    '<td>' +
                    '<input type="time" class="form-control" name="add_staff_break_time_start[]">' +
                    '</td>' +
                    '<td>' +
                    '<input type="time" class="form-control" name="add_staff_break_time_end[]">' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>');

                $('.select2').select2({
                    theme: 'bootstrap4'
                });
            });
        });

        $(document).on('click', '.edit_data', function () {
            var data = $(this).data('params');
            var route = "{{route('admin.shift.edit',['shift'=>':shift'])}}";
            route = route.replace(':shift', data.id);
            $.ajax({
                type: 'GET',
                url: route,
                beforeSend: function () {
                    loader();
                },
                success: function (response) {
                    swal.close();
                    $('#edit_modal_div').html(response);
                    $('.select2').select2({
                        theme: 'bootstrap4'
                    });
                    $('#edit_modal').modal('show');
                },
                error: function (xhr, error, status) {
                    swal.close();
                    var response = xhr.responseJSON;
                    alertMsg(response.message, 'error');
                }
            });
            $('#hidden_id').val(data.id);

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
        $(document).on('change', '.shift_schedule', function () {
            var schedule = $(this).val();
            var i = $(this).data('i');
            console.info(i);
            if (schedule == 'custom') {
                $('#staff_shift_div' + i).show();
            } else {
                $('#staff_shift_div' + i).hide();
            }
        });
        $(document).on('click', '.remove_btn', function () {
            var i = $(this).data('i');
            $('#staff_table' + i).remove();
        });
        $(document).on('click', '.edit_remove_btn', function () {
            var i = $(this).data('i');
            $('#edit_staff_table' + i).remove();
        });
        $(document).on('change', '.edit_shift_schedule', function () {
            var schedule = $(this).val();
            var i = $(this).data('i');
            console.info(i);
            if (schedule == 'custom') {
                $('#edit_staff_shift_div' + i).show();
            } else {
                $('#edit_staff_shift_div' + i).hide();
            }
        });

        $(document).on('click', '#edit_btn', function () {
            var y = parseInt($('#staff_count').val()) || 0;
            y++;
            $('#edit_staff_div').append('<table class="table table-bordered" id="edit_staff_table' + y + '">' +
                '<thead>' +
                '<tr>' +
                '<th>Staff</th>' +
                '<th>Pay Rate</th>' +
                '<th>Shift Schedule</th>' +
                '<th>' +
                '<button type="button" class="btn btn-danger btn-sm edit_remove_btn" data-i="' + y + '">' +
                '<i class="fas fa-times"></i></button>' +
                '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr>' +
                '<td>' +
                '<select name="edit_staff_id[]" id="edit_staff_id' + y + '" ' +
                'class="select2 form-control edit_staff_id">' +
                '<option value="" selected disabled>select staff</option>' +
                ' @foreach($staffs as $staff)' +
                '<option value="{{$staff->id}}">{{$staff->full_name}}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" placeholder="enter pay rate" ' +
                'name="edit_staff_pay_rate[]" id="edit_staff_pay_rate' + y + '">' +
                '</td>' +
                '<td>' +
                '<select name = "edit_staff_shift_schedule[]" id ="edit_staff_shift_schedule' + y + '" ' +
                'class="form-control edit_shift_schedule"' +
                'data-i="' + y + '">' +
                '<option value = "default" selected>Default</option>' +
                '<option value="custom">Custom</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr id="staff_shift_div' + y + '" style="display: none">' +
                '<td colspan="3">' +
                '<table class="table">' +
                '<thead>' +
                '<tr>' +
                '<th>Staff Time In</th>' +
                '<th>Staff Time Out</th>' +
                '<th>Staff Break Start</th>' +
                '<th>Staff Break End</th>' +
                '</tr>' +
                '</thead>' +
                '<tr>' +
                '<td>' +
                '<input type="time" class="form-control" ' +
                'name="edit_staff_time_in[]">' +
                '</td>' +
                '<td>' +
                '<input type="time" class="form-control" ' +
                'name="edit_staff_time_out[]">' +
                '</td>' +
                '<td>' +
                '<input type="time" class="form-control" name="edit_staff_break_time_start[]">' +
                '</td>' +
                '<td>' +
                '<input type="time" class="form-control" name="edit_staff_break_time_end[]">' +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>');

            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>


@endpush
