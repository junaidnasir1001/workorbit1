@extends('admin.layouts.app')
@section('title', 'Total Shift List')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        @if(hasPermission('total_shift_list'))
            <div class="row">
                <div class="col-md-12">
                    <label for="">Shift Start</label>
                    <input type="text" name="daterange" class="form-control"/>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Total Shift List
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        @if(hasPermission('total_shift_list'))
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Site</th>
                    <th>Site Type</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Break Start</th>
                    <th>Break End</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Working Days</th>
                    <th></th>
                </tr>
                </thead>
            </table>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $("#dt").DataTable({
                dom: 'Bfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    "url": "{{ route('admin.report.total.shift.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [
                    {"data": "id"},
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


            $('input[name="daterange"]').daterangepicker({}, function (start, end, label) {
                var start_date = start.format('YYYY-MM-DD');
                var end_date = end.format('YYYY-MM-DD');

                $("#dt").DataTable({
                    dom: 'Bfrtip',
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax": {
                        "url": "{{ route('admin.report.total.shift.list') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{csrf_token()}}",
                            start_date: start_date,
                            end_date: end_date
                        }
                    },
                    "columns": [
                        {"data": "id"},
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
            });
        });
    </script>
@endpush
