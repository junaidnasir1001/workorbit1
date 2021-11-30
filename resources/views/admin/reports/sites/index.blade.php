@extends('admin.layouts.app')
@section('title', 'Sites Reports')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
        @if(hasPermission('site_report_list'))
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Zip Code</th>
                    <th>City</th>
                    <th>Start Date</th>
                    <th>Finish Date</th>
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
                    "url": "{{ route('admin.report.site') }}",
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

        });


    </script>


@endpush
