<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Emergency Contact List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_staff_emergency_contact'))
            <a href="javascript:;" class="btn btn-outline-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_em_modal"><i
                    class="fa fa-plus"></i> Add Emergency Contact</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('staff_emergency_contact_list'))
        <table id="em_dt" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th></th>
                <th>Address</th>
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
<form method="post" id="add_em_form">
    @csrf
    <div class="modal fade" id="add_em_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Emergency Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_em_name" class="required">Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Type Name"
                                       name="add_em_name"
                                       id="add_em_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_em_phone" class="required">Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter phone"
                                       name="add_em_phone"
                                       id="add_em_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_em_relation" class="">Relation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Relation"
                                       name="add_em_relation"
                                       id="add_em_relation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_em_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Postal Code"
                                       name="add_em_postal_code"
                                       id="add_em_postal_code">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_em_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="add_em_address"
                                       id="add_em_address">
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
<form method="post" id="edit_em_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_em_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Emergency Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_em_name" class="required">Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Type Name"
                                       name="edit_em_name"
                                       id="edit_em_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_em_phone" class="required">Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter phone"
                                       name="edit_em_phone"
                                       id="edit_em_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_em_relation" class="">Relation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Relation"
                                       name="edit_em_relation"
                                       id="edit_em_relation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_em_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Postal Code"
                                       name="edit_em_postal_code"
                                       id="edit_em_postal_code">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_em_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="edit_em_address"
                                       id="edit_em_address">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_id" name="hidden_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
