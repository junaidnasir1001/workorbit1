@foreach($notes as $note)
    <div class="card card-primary card-outline mt-2">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool remove-note" data-note-id="{{$note->id}}" data-card-widget="remove"
                        title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {{$note->description}}
        </div>
    </div>
@endforeach
