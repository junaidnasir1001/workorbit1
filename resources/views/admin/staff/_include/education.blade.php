<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Education List
        @if(hasPermission('add_staff_education'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_education_modal"><i
                    class="fa fa-plus"></i> Add Education Data</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('staff_education_list'))
        <table id="education_dt" class="table table-sm table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Institution</th>
                <th>Speciality</th>
                <th>Degree Obtained</th>
                <th>City</th>
                <th>Country</th>
                <th>Start Date</th>
                <th>End Date</th>
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
<form method="post" id="add_education_form">
    @csrf
    <div class="modal fade" id="add_education_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Education Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_education_institution" class="required">Institution</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Institution Name"
                                       name="add_education_institution"
                                       id="add_education_institution">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_education_speciality" class="required">Speciality</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter speciality"
                                       name="add_education_speciality"
                                       id="add_education_speciality">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_education_degree_obtained" class="">Degree Obtained</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Degree Obtained"
                                       name="add_education_degree_obtained"
                                       id="add_education_degree_obtained">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_education_city" class="">City</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter City"
                                       name="add_education_city"
                                       id="add_education_city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_education_country" class="">Country</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Country"
                                       name="add_education_country"
                                       id="add_education_country">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_education_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="add_education_start_date"
                                       id="add_education_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_education_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="add_education_end_date"
                                       id="add_education_end_date">
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
<form method="post" id="edit_education_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_education_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_education_institution" class="required">Institution</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Institution Name"
                                       name="edit_education_institution"
                                       id="edit_education_institution">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_education_speciality" class="required">Speciality</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter speciality"
                                       name="edit_education_speciality"
                                       id="edit_education_speciality">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_education_degree_obtained" class="">Degree Obtained</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Degree Obtained"
                                       name="edit_education_degree_obtained"
                                       id="edit_education_degree_obtained">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_education_city" class="">City</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_education_city"
                                       id="edit_education_city" placeholder="Enter City">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_education_country" class="">Country</label>
                                <input maxlength="31" type="text" class="form-control"
                                       name="edit_education_country"
                                       id="edit_education_country" placeholder="Enter Country">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_education_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="edit_education_start_date"
                                       id="edit_education_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_education_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="edit_education_end_date"
                                       id="edit_education_end_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_education_id" name="hidden_education_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
