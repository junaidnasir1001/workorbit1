<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger" id="edit_errors_div" style="display: none">
            <ul id="edit_errors"></ul>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="edit_client_id" class="required">Clients</label>
            <select name="edit_client_id" id="edit_client_id"
                    class="select2 form-control">
                <option value="" selected disabled>-Select One-</option>
                @foreach($clients as $client)
                    <option {{($shift->client_id == $client->id ? 'selected' : '' )}} value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_site_id" class="required">Site</label>
            <select name="edit_site_id" id="edit_site_id"
                    class="select2 form-control">
                <option value="" selected disabled>select site</option>
                @foreach($sites->where('client_id',$shift->client_id) as $site)
                    <option value="{{$site->id}}"
                        {{$shift->site_id==$site->id?'selected':''}}>{{$site->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_site_type_id" class="required">Site Type</label>
            <select name="edit_site_type_id" id="edit_site_type_id"
                    class="select2 form-control">
                <option value="" selected disabled>select site type</option>
                @foreach($site_types as $site_type)
                    <option value="{{$site_type->id}}"
                        {{$shift->site_id==$site_type->id?'selected':''}}>{{$site_type->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_time_in" class="required">Time In</label>
            <input type="time" class="form-control"
                   name="edit_time_in"
                   id="edit_time_in" value="{{$shift->time_in}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_time_out" class="required">Time Out</label>
            <input type="time" class="form-control"
                   name="edit_time_out"
                   id="edit_time_out" value="{{$shift->time_out}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_break_time_start" class="required">Break Time Start</label>
            <input type="time" class="form-control"
                   name="edit_break_time_start"
                   id="edit_break_time_start"
                   value="{{$shift->break_time_start}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_break_time_end" class="required">Break Time End</label>
            <input type="time" class="form-control"
                   name="edit_break_time_end"
                   id="edit_break_time_end"
                   value="{{$shift->break_time_end}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_start_date" class="required">Shift Start Date</label>
            <input type="date" class="form-control"
                   name="edit_start_date"
                   id="edit_start_date"
                   value="{{$shift->start_date}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="edit_end_date" class="required">Shift End Date</label>
            <input type="date" class="form-control"
                   name="edit_end_date"
                   id="edit_end_date"
                   value="{{$shift->end_date}}">
        </div>
    </div>
    <label for="" class="required">Working Days</label>
    <div class="col-md-12">
        <div class="form-group">
            @foreach($working_days as $day)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox"
                           id="edit_working_days{{$loop->index}}"
                           name="edit_working_days[]"
                           value="{{$day}}"
                           @if(in_array($day,json_decode($shift->working_days)))
                           checked
                        @endif>
                    <label class="form-check-label"
                           for="edit_working_days{{$loop->index}}">{{$day}}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="edit_instructions" class="">Instructions</label>
            <textarea class="form-control" rows="5" id="edit_instructions"
                      name="edit_instructions">{{$shift->instructions}}</textarea>
        </div>
    </div>
    <div class="col-md-12" id="edit_staff_div">
        @forelse($shift->staff as $staff)
            <table class="table table-bordered" id="edit_staff_table{{$loop->index}}">
                <thead>
                <tr>
                    <th>Staff</th>
                    <th>Pay Rate</th>
                    <th>Shift Schedule</th>
                    <th>
                        <button type="button" class="btn btn-danger btn-sm edit_remove_btn" data-i="{{$loop->index}}">
                            <i class="fas fa-times"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select name="edit_staff_id[]" id="edit_staff_id{{$loop->index}}"
                                class="select2 form-control edit_staff_id">
                            <option value="" selected disabled>select staff</option>
                            @foreach($staffs as $row)
                                <option value="{{$row->id}}"
                                        @if($staff->staff_id==$row->id)
                                        selected
                                    @endif>
                                    {{$row->full_name}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="enter pay rate"
                               name="edit_staff_pay_rate[]" value="{{$staff->pay_rate}}">
                    </td>
                    <td>
                        <select name="edit_staff_shift_schedule[]" id="edit_staff_shift_schedule{{$loop->index}}"
                                class="form-control edit_shift_schedule"
                                data-i="{{$loop->index}}">
                            <option value="default"
                                {{$staff->shift_schedule=='default'?'selected':''}}>
                                Default
                            </option>
                            <option value="custom" {{$staff->shift_schedule=='custom'?'selected':''}}>Custom</option>
                        </select>
                    </td>
                </tr>
                <tr id="edit_staff_shift_div{{$loop->index}}"
                    @if($staff->shift_schedule=='default') style="display: none" @endif>
                    <td colspan="3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Staff Time In</th>
                                <th>Staff Time Out</th>
                                <th>Staff Break Start</th>
                                <th>Staff Break End</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>
                                    <input type="time" class="form-control"
                                           name="edit_staff_time_in[]" value="{{$shift->time_in}}">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="edit_staff_time_out[]" value="{{$shift->time_out}}">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="edit_staff_break_time_start[]"
                                           value="{{$shift->break_time_start}}">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="edit_staff_break_time_end[]"
                                           value="{{$shift->break_time_end}}">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        @empty
            <table class="table table-bordered" id="edit_staff_table">
                <thead>
                <tr>
                    <th>Staff</th>
                    <th>Pay Rate</th>
                    <th>Shift Schedule</th>
                    <th>
                        <button type="button" class="btn btn-danger btn-sm edit_remove_btn" data-i="">
                            <i class="fas fa-times"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select name="edit_staff_id[]" id="edit_staff_id"
                                class="select2 form-control edit_staff_id">
                            <option value="" selected disabled>select staff</option>
                            @foreach($staffs as $row)
                                <option value="{{$row->id}}">{{$row->full_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="enter pay rate"
                               name="edit_staff_pay_rate[]">
                    </td>
                    <td>
                        <select name="edit_staff_shift_schedule[]" id="edit_staff_shift_schedule"
                                class="form-control edit_shift_schedule"
                                data-i="">
                            <option value="default" selected>Default</option>
                            <option value="custom">Custom</option>
                        </select>
                    </td>
                </tr>
                <tr id="edit_staff_shift_div" style="display: none">
                    <td colspan="3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Staff Time In</th>
                                <th>Staff Time Out</th>
                                <th>Staff Break Start</th>
                                <th>Staff Break End</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>
                                    <input type="time" class="form-control"
                                           name="add_staff_time_in[]">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="add_staff_time_out[]">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="add_staff_break_time_start[]">
                                </td>
                                <td>
                                    <input type="time" class="form-control"
                                           name="add_staff_break_time_end[]">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        @endforelse
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary" id="edit_btn" type="button">Add more</button>
    </div>
</div>
<input type="hidden" value="{{$shift->staff->count()}}" id="staff_count">
