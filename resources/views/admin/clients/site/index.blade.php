<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Active Site
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(hasPermission('client_site_list'))
            <table id="prefferd_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Staff Number</th>
                    <th>Email</th>
                </tr>
                </thead>
                @foreach($sites as $site)
                    <tbody>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{route('admin.site.index')}}">{{$site->name}}</a></td>
                        <td>{{$site->address}}</td>
                        <td>{{$site->city}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        @endif
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

