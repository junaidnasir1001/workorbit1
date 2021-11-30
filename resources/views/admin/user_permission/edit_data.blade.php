<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="admin_id" class="required">Select User Name</label>
            <select name="admin_id" id="admin_id" class="form-control select2">
                <option value="" disabled selected>Select User Name</option>
                @foreach($users as $row)
                    <option value="{{$row->id}}" {{$row->id==$user->id?'selected':''}}>{{$row->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @foreach($permissions as $permission)
        @php
            $user_permissions=json_decode($user->permissions);
            $is_checked="";
            if(!empty($user->permissions)){
            if(in_array($permission->slug,$user_permissions)){
                $is_checked="checked";
            }
        }
        @endphp
        <div class="col-md-4 border mb-1">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="permissions[]"
                           name="permissions[]"
                           value="{{$permission->slug}}" {{$is_checked}}> {{$permission->name}}
                </label>
            </div>
        </div>
    @endforeach
</div>
