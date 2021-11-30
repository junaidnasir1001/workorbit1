@foreach($contact_persons as $contact)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$contact->title.' '.$contact->name}}</td>
        <td>{{$contact->job_title}}</td>
        <td>{{$contact->phone_number}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->address}}</td>
        <td>{{$contact->postal_code}}</td>
        <td>
            <div class='btn-group' role='group'>
                @if(hasPermission('edit_client_contact_person'))
                    <button title='Edit' class='edit_contact_person_data mr-2 btn btn-primary btn-sm'
                            data-title="{{$contact->title}}"
                            data-name="{{$contact->name}}"
                            data-job-title="{{$contact->job_title}}"
                            data-phone-number="{{$contact->phone_number}}"
                            data-email="{{$contact->email}}"
                            data-address="{{$contact->address}}"
                            data-postal-code="{{$contact->postal_code}}"
                            data-id="{{$contact->id}}"
                    ><i class='far fa-edit'></i>
                    </button>
                @endif
                <form
                    action='{{route('admin.client.contact_person.destroy',['client'=>$client->id,'contact_person'=>$contact->id])}}'
                    method='POST' class='delete_contact_person_form'>
                    @csrf
                    @method("DELETE")
                    @if(hasPermission('delete_client_contact_person'))
                        <button type='submit' title='Delete' class='delete_contact_person_data btn btn-danger btn-sm'
                                data-id='{{$contact->id}}'>
                                <i class='fas fa-trash-alt'></i>
                        </button>
                    @endif
                </form>

            </div>
        </td>
    </tr>
@endforeach
