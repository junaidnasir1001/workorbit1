<!-- Default box -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Banned Staff
            {{-- <a href="javascript:;" data-toggle="modal" data-target="#add_modal"  style="font-size: 24px"><i class="fa fa-plus"></i></a> --}}
            @if(hasPermission('add_site_charge_rate_card'))
            <a href="javascript:;" class="btn btn-primary btn-md btn-flat ml-2" data-toggle="modal"
               data-target="#add_banned_staff_modal"><i
                    class="fa fa-plus"></i> Add Banned Staff</a>
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
                    <th>Name</th>
                    <th>Staff Number</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="">
                @forelse($site->banned_staff as $banned_staff)
                    <tr>
                        <td>{{@$banned_staff->id}}</td>
                        <td>{{@$banned_staff->staff->first_name}}</td>
                        <td>{{@$banned_staff->staff->staff_number}}</td>
                        <td>{{@$banned_staff->staff->email}}</td>

                        <td>
                            <button type='button' class='delete_site_satff btn btn-danger btn-sm'
                                    id='{{@$banned_staff->id}}'>
                                <i class='fas fa-trash-alt'></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td><h4>No Preferred Staff</h4></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                @endforelse
                </tbody>
            </table>
            @endif
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!--Add Modal -->
<form method="post" action="{{route('admin.banned.staff.add')}}">
    @csrf
    <input type="hidden" name="banned_site_id" value="{{$site->id}}">
    <div class="modal fade" id="add_banned_staff_modal" tabindex="-1" role="dialog"
         aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Banned Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_banned_staff_id" class="required">Staff Name</label>
                                <select name="add_banned_staff_id" id="add_banned_staff_id"
                                        class="form-control">
                                    <option value="" disabled selected>Select Type</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{$staff->id}}">{{$staff->first_name}}</option>
                                    @endforeach
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

<!--/Edit Modal -->

