<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Prefferd Staff
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('site_prefferd_staff_list'))
        <table id="prefferd_dt" class="table table-sm table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Staff Number</th>
                <th>Email</th>
            </tr>
            </thead>

            @foreach($preferredStaff as $preferr)
            <tbody>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$preferr->staff->first_name}}</td>
                <td>{{$preferr->staff->staff_number}}</td>
                <td>{{$preferr->staff->email}}</td>
            </tr>
            </tbody>
            @endforeach
        </table>
    @endif
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

