<!-- Default box -->

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Banned Staff
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('site_banned_staff_list'))
        <table id="banned_dt" class="table table-sm table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Staff Number</th>
                <th>Email</th>
            </tr>
            </thead>
            @foreach($bannedStaff as $banned)
            <tbody>
            <tr>
                {{--       <td>{{$loop->iteration}}</td>
                       <td>{{$banned->staff->first_name}}</td>
                       <td>{{$banned->staff->staff_number}}</td>
                       <td>{{$banned->staff->email}}</td>--}}
            </tr>
            </tbody>
            @endforeach
        </table>
    @endif
    </div>
    <!-- /.card-body -->
</div>

<!-- /.card -->

