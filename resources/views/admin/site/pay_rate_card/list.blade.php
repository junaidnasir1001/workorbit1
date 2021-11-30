@foreach($pay_rate_cards as $pay_rate_card)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$pay_rate_card->designation->name}}</td>
        <td>{{$pay_rate_card->rate}}</td>
        <td>
            <div class='btn-group' role='group'>
            @if(hasPermission('edit_site_pay_rate_card'))
                <button title='Edit' class='edit_pay_rate_card_data mr-2 btn btn-primary btn-sm'
                        data-rate="{{$pay_rate_card->rate}}"
                        data-designation-id="{{$pay_rate_card->designation_id}}"
                        data-id="{{$pay_rate_card->id}}"
                ><i class='far fa-edit'></i>
                </button>
                @endif
                <form
                    action='{{route('admin.site.pay_rate_card.destroy',['site'=>$site->id,'pay_rate_card'=>$pay_rate_card->id])}}'
                    method='POST' class='delete_pay_rate_card_form'>
                    @csrf
                    @method("DELETE")
                    @if(hasPermission('delete_site_pay_rate_card'))
                    <button type='submit' title='Delete' class='delete_pay_rate_card_data btn btn-danger btn-sm'
                            data-id='{{$pay_rate_card->id}}'>
                            <i class='fas fa-trash-alt'></i>
                    </button>
                    @endif
                </form>

            </div>
        </td>
    </tr>
@endforeach
