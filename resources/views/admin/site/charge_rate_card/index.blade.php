<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Site Charge Rate Cards
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_site_charge_rate_card'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_charge_rate_card_modal"><i
                    class="fa fa-plus"></i> Add Charge Rate Card</a>
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
        @if(hasPermission('site_charge_rate_card_list'))
            <table id="charge_rate_card_dt" class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Rate</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="charge_rate_card_body">
                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" id="add_charge_rate_card_form">
    @csrf
    <div class="modal fade" id="add_charge_rate_card_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Site Charge Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_charge_rate_card_site_type_id" class="required">Type</label>
                                <select name="add_charge_rate_card_site_type_id" id="add_charge_rate_card_site_type_id"
                                        class="form-control">
                                    <option value="" disabled selected>Select Type</option>
                                    @foreach($sitetypes as $site_type)
                                        <option value="{{$site_type->id}}">{{$site_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_charge_rate_card_rate" class="required">Rate</label>
                                <input type="number" class="form-control" placeholder="Rate Format (1.00)"
                                       name="add_charge_rate_card_rate"
                                       id="add_charge_rate_card_rate" pattern="\d+(\.\d{2})?">
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
<form method="post" id="edit_charge_rate_cards_form">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit_charge_rate_cards_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Charge Rate Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_charge_rate_card_site_type_id" class="required">Type</label>
                                <select name="edit_charge_rate_card_site_type_id"
                                        id="edit_charge_rate_card_site_type_id"
                                        class="form-control" required>
                                    <option value="" disabled selected>Select type</option>
                                    @foreach($sitetypes as $site_type)
                                        <option value="{{$site_type->id}}">{{$site_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_charge_rate_card_rate" class="required">Rate</label>
                                <input type="number" class="form-control" placeholder="Rate Format (1.00)"
                                       name="edit_charge_rate_card_rate"
                                       id="edit_charge_rate_card_rate" pattern="\d+(\.\d{2})?" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_charge_rate_card_id" name="edit_charge_rate_card_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--/Edit Modal -->

