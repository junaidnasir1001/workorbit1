@foreach($staff_vattings as $staff_vatting)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$staff_vatting->vetting->name}}</td>
        <td>{{$staff_vatting->note}}</td>
        <td>{{$staff_vatting->status}}</td>

        <td>
            <a href="{{route('admin.staff.staff_vetting.download',['staff'=>$staff->id,'staff_vetting'=>$staff_vatting->id])}}">Click
                To Download</a>
        </td>
        <td>
            <div class='btn-group' role='group'>
            @if(hasPermission('edit_staff_vetting_name'))
                <button title='Edit' class='edit_staff_vetting_data mr-2 btn btn-primary btn-sm'
                        data-vetting-id="{{$staff_vatting->vetting_id}}"
                        data-file-path="{{$staff_vatting->file_path}}"
                        data-note="{{$staff_vatting->note}}"
                        data-status="{{$staff_vatting->status}}"
                        data-id="{{$staff_vatting->id}}"
                ><i class='far fa-edit'></i>
                </button>
                @endif
                <form
                    action='{{route('admin.staff.staff_vetting.destroy',['staff'=>$staff->id,'staff_vetting'=>$staff_vatting->id])}}'
                    method='POST' class='delete_staff_vetting_form'>
                    @csrf
                    @method("DELETE")
                    @if(hasPermission('delete_staff_vetting_name'))
                    <button type='submit' title='Delete' class='delete_staff_vetting_data btn btn-danger btn-sm'
                            data-id='{{$staff_vatting->id}}'>
                            <i class='fas fa-trash-alt'></i>
                    </button>
                    @endif
                </form>

            </div>
        </td>
    </tr>
@endforeach
