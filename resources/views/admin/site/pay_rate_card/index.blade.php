<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Site Pay Rate Cards
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_site_pay_rate_card'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_pay_rate_card_modal"><i
                    class="fa fa-plus"></i> Add Site Pay Rate</a>
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
        @if(hasPermission('site_pay_rate_card_list'))
            <table id="pay_rate_card_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Designation</th>
                    <th>Rate</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="pay_rate_card_body">
                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" id="add_pay_rate_card_form">
    @csrf
    <div class="modal fade" id="add_pay_rate_card_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Site Pay Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_pay_rate_card_designation_id" class="required">Designation</label>
                                <select name="add_pay_rate_card_designation_id" id="add_pay_rate_card_designation_id"
                                        class="form-control">
                                    <option value="" disabled selected>Select designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_pay_rate_card_rate" class="required">Rate</label>
                                <input type="text" class="form-control EnterOnlyNumber" placeholder="Enter rate"
                                       name="add_pay_rate_card_rate"
                                       id="add_pay_rate_card_rate">
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
<form method="post" id="edit_pay_rate_cards_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_pay_rate_cards_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Pay Rate Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_pay_rate_card_designation_id" class="required">Designation</label>
                                <select name="edit_pay_rate_card_designation_id" id="edit_pay_rate_card_designation_id"
                                        class="form-control" required>
                                    <option value="" disabled selected>Select designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_pay_rate_card_rate" class="required">Rate</label>
                                <input type="text" class="form-control" placeholder="Enter Rate"
                                       name="edit_pay_rate_card_rate"
                                       id="edit_pay_rate_card_rate" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_pay_rate_card_id" name="edit_pay_rate_card_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->

