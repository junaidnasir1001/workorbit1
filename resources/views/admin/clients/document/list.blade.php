@foreach($documents as $document)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$document->file_name}}</td>
        <td><a href="{{route('admin.client.document.download',['client'=>$client->id,'document'=>$document->id])}}">Click
                To Download</a></td>
        <td>
            <div class='btn-group' role='group'>
                @if(hasPermission('edit_client_document'))
                    <button title='Edit' class='edit_document_data mr-2 btn btn-primary btn-sm'
                            data-name="{{$document->file_name}}"
                            data-old-file-path="{{$document->file_path}}"
                            data-id="{{$document->id}}"
                    ><i class='far fa-edit'></i>
                    </button>
                @endif    
                <form
                    action='{{route('admin.client.document.destroy',['client'=>$client->id,'document'=>$document->id])}}'
                    method='POST' class='delete_document_form'>
                    @csrf
                    @method("DELETE")
                    @if(hasPermission('delete_client_document'))
                    <button type='submit' title='Delete' class='delete_document_data btn btn-danger btn-sm'
                            data-id='{{$document->id}}'>
                            <i class='fas fa-trash-alt'></i>
                    </button>
                    @endif
                </form>

            </div>
        </td>
    </tr>
@endforeach
