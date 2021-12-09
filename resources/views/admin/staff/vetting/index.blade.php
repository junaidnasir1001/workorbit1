<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Vetting List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_staff_vetting_name'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_vetting_modal"><i
                    class="fa fa-plus"></i> Add Vetting</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        @if(hasPermission('staff_vetting_name_list'))
            <table id="staff_vetting_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Vetting Name</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="staff_vetting_body">

                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" id="add_vetting_form">
    @csrf
    <div class="modal fade" id="add_vetting_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Staff Vetting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_vetting_id" class="required">Vetting Name</label>
                                <select name="add_vetting_id" id="add_vetting_id" class="form-control select2">
                                    <option value="" disabled selected>Select Option</option>
                                    @foreach($staff_vettings as $staff_vetting)
                                        <option value="{{$staff_vetting->id}}">{{$staff_vetting->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_document_name" class="required">File</label>
                                <input type="file" class="form-control"
                                       name="add_document_file_path"
                                       id="add_document_file_path">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_note" class="">Note</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Note"
                                       name="add_note"
                                       id="add_note">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_status" class="required">Status</label>
                                <select name="add_status" id="add_status"
                                        class="form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="verified">Verified</option>
                                    <option value="not_verified">Not Verified</option>
                                    <option value="rejected">Rejected</option>
                                </select>
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
<form method="post" id="edit_staff_vetting_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_staff_vetting_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Staff Vetting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_staff_vetting_id" class="required">Vetting Name</label>
                                <select name="edit_staff_vetting_id" id="edit_staff_vetting_id" class="form-control">
                                    <option value="" disabled selected>Select option</option>
                                    @foreach($staff_vettings as $staff_vetting)
                                        <option value="{{$staff_vetting->id}}">{{$staff_vetting->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_staff_vetting_file_path" class="required">File</label>
                                <input type="file" class="form-control"
                                       name="edit_staff_vetting_file_path"
                                       id="edit_staff_vetting_file_path">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_staff_vetting_note" class="">Note</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Note"
                                       name="edit_staff_vetting_note"
                                       id="edit_staff_vetting_note">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_staff_vetting_status" class="required">Status</label>
                                <select name="edit_staff_vetting_status" id="edit_staff_vetting_status"
                                        class="form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="verified">Verified</option>
                                    <option value="not_verified">Not Verified</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_staff_vetting_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
