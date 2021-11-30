<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Sites List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        @if(hasPermission('subcontractor_site_list'))
            <table id="sites_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody id="sites_body">

                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
