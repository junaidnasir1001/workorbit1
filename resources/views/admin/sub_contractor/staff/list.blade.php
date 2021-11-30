@foreach($contact_persons as $contact)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$contact->title.' '.$contact->name}}</td>
        <td>{{$contact->job_title}}</td>
        <td>{{$contact->phone_number}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->address}}</td>
        <td>{{$contact->postal_code}}</td>
    </tr>
@endforeach
