@foreach($charge_rate_cards as $charge_rate_card)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$charge_rate_card->site_type->name}}</td>
        <td>{{$charge_rate_card->rate}}</td>
        <td>
            <div class='btn-group' role='group'>
            @if(hasPermission('edit_site_charge_rate_card'))
                <button title='Edit' class='edit_charge_rate_card_data mr-2 btn btn-primary btn-sm'
                        data-rate="{{$charge_rate_card->rate}}"
                        data-site-type-id="{{$charge_rate_card->site_type_id}}"
                        data-id="{{$charge_rate_card->id}}"
                ><i class='far fa-edit'></i>
                </button>
                @endif
                <form
                    action='{{route('admin.site.charge_rate_card.destroy',['site'=>$site->id,'charge_rate_card'=>$charge_rate_card->id])}}'
                    method='POST' class='delete_charge_rate_card_form'>
                    @csrf
                    @method("DELETE")
                    @if(hasPermission('delete_site_charge_rate_card'))
                    <button type='submit' title='Delete' class='delete_charge_rate_card_data btn btn-danger btn-sm'
                            data-id='{{$charge_rate_card->id}}'>
                            <i class='fas fa-trash-alt'></i>
                    </button>
                    @endif
                </form>

            </div>
        </td>
    </tr>
@endforeach
