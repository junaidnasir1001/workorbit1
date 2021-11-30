<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Certificates List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_staff_certificate'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_c_modal"><i
                    class="fa fa-plus"></i> Add Certificate</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('staff_certificate_list'))
        <table id="c_dt" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Certificate Number</th>
                <th>Expiry Date</th>
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
<form method="post" id="add_c_form">
    @csrf
    <div class="modal fade" id="add_c_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_c_name" class="required">Certificate Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Certificate Name"
                                       name="add_c_name"
                                       id="add_c_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_c_number" class="">Certificate Number</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Certificate Number"
                                       name="add_c_number"
                                       id="add_c_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_c_expiry_date" class="">Expiry Date</label>
                                <input type="date" class="form-control"
                                       name="add_c_expiry_date"
                                       id="add_c_expiry_date">
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
<form method="post" id="edit_c_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_c_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_c_name" class="required">Certificate Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Certificate Name"
                                       name="edit_c_name"
                                       id="edit_c_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_c_number" class="">Certificate Number</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Certificate Number"
                                       name="edit_c_number"
                                       id="edit_c_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_c_expiry_date" class="">Expiry Date</label>
                                <input type="date" class="form-control"
                                       name="edit_c_expiry_date"
                                       id="edit_c_expiry_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_c_id" name="hidden_c_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
