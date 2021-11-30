<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Document List
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_client_document'))
                <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
                data-target="#add_document_modal"><i
                        class="fa fa-plus"></i> Add Document</a>
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
        @if(hasPermission('client_document_list'))
            <table id="document_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="document_body">

                </tbody>
            </table>
        @endif    
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" id="add_document_form">
    @csrf
    <div class="modal fade" id="add_document_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_document_file_name" class="required">Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" id="add_document_file_name"
                                       name="add_document_file_name">
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
<form method="post" id="edit_document_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_document_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_document_file_name" class="required">Title</label>
                                <input maxlength="31" type="text" class="form-control entertxtOnly" id="edit_document_file_name"
                                       name="edit_document_file_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_document_file_name" class="required">File</label>
                                <input type="file" class="form-control"
                                       name="edit_document_file_path"
                                       id="edit_document_file_name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hidden_document_id" name="hidden_document_id">
                    <input type="hidden" id="hidden_document_old_file_path" name="hidden_document_old_file_path">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->
