@extends('admin.layouts.app')
@section('title', 'Sub Contractor Reports')

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
        @if(hasPermission('subcontractor_report_list'))
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
                    <th>Zip Code</th>
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
                    "url": "{{ route('admin.report.sub_contractor') }}",
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

        });


    </script>


@endpush
