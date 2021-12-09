<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Employment List
        @if(hasPermission('add_staff_employment'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_employment_modal"><i
                    class="fa fa-plus"></i> Add Employment Data</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('staff_employment_list'))
        <table id="employment_dt" class="table table-sm table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Address</th>
                <th>Zip Code/Postal Code</th>
                <th>Contact Person</th>
                <th>Contact Phone</th>
                <th>Email</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason For Leave</th>
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
<form method="post" id="add_employment_form">
    @csrf
    <div class="modal fade" id="add_employment_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Employment Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_employment_company_name" class="required">Company Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Company Name"
                                       name="add_employment_company_name"
                                       id="add_employment_company_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_employment_job_title" class="required">Job Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Job Title"
                                       name="add_employment_job_title"
                                       id="add_employment_job_title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_employment_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="add_employment_address"
                                       id="add_employment_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="add_employment_postal_code"
                                       id="add_employment_postal_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_contact_person" class="">Contact Person Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="add_employment_contact_person"
                                       id="add_employment_contact_person">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_contact_phone" class="">Contact Person Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="add_employment_contact_phone"
                                       id="add_employment_contact_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_email" class="">Contact Person Email</label>
                                <input type="email" class="form-control"
                                       name="add_employment_email"
                                       id="add_employment_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="add_employment_start_date"
                                       id="add_employment_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_employment_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="add_employment_end_date"
                                       id="add_employment_end_date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_employment_reason_for_leaving" class="">Reason For Leaving</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="add_employment_reason_for_leaving" placeholder="Reason For Leaving"
                                       id="add_employment_reason_for_leaving">
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
<form method="post" id="edit_employment_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_employment_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Employment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_employment_company_name" class="required">Company Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Company Name"
                                       name="edit_employment_company_name"
                                       id="edit_employment_company_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_employment_job_title" class="required">Job Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Job Title"
                                       name="edit_employment_job_title"
                                       id="edit_employment_job_title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_employment_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="edit_employment_address"
                                       id="edit_employment_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_employment_postal_code" placeholder="Zip Code/Postal Code"
                                       id="edit_employment_postal_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_contact_person" class="">Contact Person Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly"
                                       name="edit_employment_contact_person" placeholder="Contact Person Name"
                                       id="edit_employment_contact_person">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_contact_phone" class="">Contact Person Phone</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="edit_employment_contact_phone" placeholder="Contact Person Phone"
                                       id="edit_employment_contact_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_email" class="">Contact Person Email</label>
                                <input type="email" class="form-control"
                                       name="edit_employment_email" placeholder="Contact Person Email"
                                       id="edit_employment_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="edit_employment_start_date"
                                       id="edit_employment_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_employment_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="edit_employment_end_date"
                                       id="edit_employment_end_date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_employment_reason_for_leaving" class="">Reason For Leaving</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_employment_reason_for_leaving" placeholder="Reason For Leaving"
                                       id="edit_employment_reason_for_leaving">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_employment_id" name="hidden_employment_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
