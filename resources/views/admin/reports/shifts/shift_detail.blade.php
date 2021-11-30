@extends('admin.layouts.app')
@section('title', 'Shift Details')
@push('css')

@endpush
@section('content')
    <!-- Default box -->

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Shift Detail
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Staff</th>
                    <th>Pay Rate</th>
                    <th>Schedule</th>
                </tr>
                </thead>
                <tbody>
                @forelse($shift_staff as $shift)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$shift->staff->full_name}}</td>
                        <td>{{$shift->pay_rate}}</td>
                        <td class="text-capitalize">

                            @if($shift->shift_schedule=='default')
                                {{$shift->shift_schedule}}
                            @else
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#shift_time_modal{{$loop->index}}">{{$shift->shift_schedule}}</button>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @foreach($shift_staff as $shift)
        <div class="modal fade" id="shift_time_modal{{$loop->index}}" tabindex="-1" role="dialog"
             aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">{{$shift->staff->full_name}}'s Shift Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Time In</th>
                                <td>{{$shift->time_in}}</td>
                                <th>Time Out</th>
                                <td>{{$shift->time_out}}</td>
                            </tr>
                            <tr>
                                <th>Break Time Start</th>
                                <td>{{$shift->break_time_start}}</td>
                                <th>Break Time End</th>
                                <td>{{$shift->break_time_end}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('js')

    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
