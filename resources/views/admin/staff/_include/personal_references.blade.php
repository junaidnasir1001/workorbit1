<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Personal References List
            @if(hasPermission('add_staff_personal_references'))
                <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
                   data-target="#add_personal_references_modal"><i
                        class="fa fa-plus"></i> Add Personal References Data</a>
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(hasPermission('staff_personal_references_list'))
            <table id="personal_references_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Zip Code/Postal Code</th>
                    <th>Phone</th>
                    <th>Occupation</th>
                    <th>How Long Know</th>
                    <th>Relation</th>
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
<form method="post" id="add_personal_references_form">
    @csrf
    <div class="modal fade" id="add_personal_references_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Personal References Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_personal_references_name" class="required">Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       placeholder="Enter Name"
                                       name="add_personal_references_name"
                                       id="add_personal_references_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_personal_references_email" class="">Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email"
                                       name="add_personal_references_email"
                                       id="add_personal_references_email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_personal_references_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="add_personal_references_address"
                                       id="add_personal_references_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_personal_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="add_personal_postal_code"
                                       id="add_personal_postal_code" placeholder="Enter Postal Code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_personal_phone" class="">Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="add_personal_phone"
                                       id="add_personal_phone" placeholder="Enter Phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="add_personal_references_occupation" class="">Occupation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="add_personal_references_occupation"
                                       id="add_personal_references_occupation" placeholder="Enter Occupation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="add_personal_references_how_long_know" class="">How long know</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="add_personal_references_how_long_know"
                                       id="add_personal_references_how_long_know" placeholder="Enter How long know">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="add_personal_references_relation" class="">Relation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="add_personal_references_relation"
                                       id="add_personal_references_relation" placeholder="Enter Relation">
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
<form method="post" id="edit_personal_references_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_personal_references_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Personal References</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_personal_references_name" class="required">name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       placeholder="Enter Name"
                                       name="edit_personal_references_name"
                                       id="edit_personal_references_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_personal_references_email" class="">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="edit_personal_references_email"
                                       id="edit_personal_references_email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_personal_references_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="edit_personal_references_address"
                                       id="edit_personal_references_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_personal_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_personal_postal_code"
                                       id="edit_personal_postal_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_personal_phone" class="">Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="edit_personal_phone"
                                       id="edit_personal_phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_personal_references_occupation" class="">Occupation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="edit_personal_references_occupation"
                                       id="edit_personal_references_occupation">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_personal_references_how_long_know" class="">How long know</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_personal_references_how_long_know"
                                       id="edit_personal_references_how_long_know">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_personal_references_relation" class="">Relation</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="edit_personal_references_relation"
                                       id="edit_personal_references_relation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_personal_references_id" name="hidden_personal_references_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
