<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Contact Person List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_staff_contact_person'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_contact_person_modal"><i
                    class="fa fa-plus"></i> Add Contact Person</a>
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
        @if(hasPermission('staff_contact_person_list'))
            <table id="contact_person_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Zip Code</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="contact_person_body">

                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" id="add_contact_person_form">
    @csrf
    <div class="modal fade" id="add_contact_person_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_contact_person_title" class="required">Title</label>
                                <select name="add_contact_person_title" id="add_contact_person_title"
                                        class="form-control">
                                    <option value="" selected disabled>select title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_contact_person_name" class="required">Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Name"
                                       name="add_contact_person_name"
                                       id="add_contact_person_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_contact_person_job_title" class="">Job Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Job Title"
                                       name="add_contact_person_job_title"
                                       id="add_contact_person_job_title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_contact_person_phone_number" class="">Phone Number</label>
                                <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter Phone Number"
                                       name="add_contact_person_phone_number"
                                       id="add_contact_person_phone_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_contact_person_email" class="">Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email"
                                       name="add_contact_person_email"
                                       id="add_contact_person_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_contact_person_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control" placeholder="Enter Address"
                                       name="add_contact_person_address"
                                       id="add_contact_person_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_contact_person_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber" placeholder="Enter Postal Code"
                                       name="add_contact_person_postal_code"
                                       id="add_contact_person_postal_code">
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
<form method="post" id="edit_contact_person_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_contact_person_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_contact_person_title" class="required">Title</label>
                                <select name="edit_contact_person_title" id="edit_contact_person_title"
                                        class="form-control">
                                    <option value="" selected disabled>select title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_contact_person_name" class="required">Name</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Name"
                                       name="edit_contact_person_name"
                                       id="edit_contact_person_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_contact_person_job_title" class="">Job Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Job Title"
                                       name="edit_contact_person_job_title"
                                       id="edit_contact_person_job_title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_contact_person_phone_number" class="">Phone Number</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="edit_contact_person_phone_number"
                                       id="edit_contact_person_phone_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_contact_person_email" class="">Email</label>
                                <input type="email" class="form-control"
                                       name="edit_contact_person_email"
                                       id="edit_contact_person_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_contact_person_address" class="">Address</label>
                                <input maxlength="101" type="text" class="form-control"
                                       name="edit_contact_person_address"
                                       id="edit_contact_person_address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_contact_person_postal_code" class="">Zip Code/Postal Code</label>
                                <input maxlength="31" type="text" class="form-control EnterOnlyNumber"
                                       name="edit_contact_person_postal_code"
                                       id="edit_contact_person_postal_code">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_contact_person_id" name="hidden_contact_person_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
