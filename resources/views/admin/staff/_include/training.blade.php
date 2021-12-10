<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Training List
        @if(hasPermission('add_staff_training'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_training_modal"><i
                    class="fa fa-plus"></i> Add Training Date</a>
                    @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('staff_training_list'))
        <table id="training_dt" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Provider Name</th>
                <th>Course Name</th>
                <th>Certificate Obtained</th>
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
<form method="post" id="add_training_form">
    @csrf
    <div class="modal fade" id="add_training_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Training Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_training_provider_name" class="required">Provider Name</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Certificate Name"
                                       name="add_training_provider_name"
                                       id="add_training_provider_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_training_course_name" class="required">Course Name</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Course Number"
                                       name="add_training_course_name"
                                       id="add_training_course_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_training_certificate_obtained" class="">Certificate Obtained</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Certificate Number"
                                       name="add_training_certificate_obtained"
                                       id="add_training_certificate_obtained">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_training_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="add_training_start_date"
                                       id="add_training_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="add_training_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="add_training_end_date"
                                       id="add_training_end_date">
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
<form method="post" id="edit_training_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_training_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Training Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_training_provider_name" class="required">Provider Name</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Certificate Name"
                                       name="edit_training_provider_name"
                                       id="edit_training_provider_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_training_course_name" class="required">Course Name</label>
                                <input maxlength="31" type="text" class="form-control" placeholder="Enter Certificate Number"
                                       name="edit_training_course_name"
                                       id="edit_training_course_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_training_certificate_obtained" class="">Certificate Obtained</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" placeholder="Enter Certificate Number"
                                       name="edit_training_certificate_obtained"
                                       id="edit_training_certificate_obtained">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_training_start_date" class="">Start Date</label>
                                <input type="date" class="form-control"
                                       name="edit_training_start_date"
                                       id="edit_training_start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_training_end_date" class="">End Date</label>
                                <input type="date" class="form-control"
                                       name="edit_training_end_date"
                                       id="edit_training_end_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_training_id" name="hidden_training_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
