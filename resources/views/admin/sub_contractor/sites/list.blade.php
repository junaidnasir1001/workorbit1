@foreach($contact_persons as $contact)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$contact->title.' '.$contact->name}}</td>
    </tr>
@endforeach
