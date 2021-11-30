<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Bank Details</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('add_staff_bank_detail'))
        <form id="bank_details_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="bank_name">Bank Name</label>
                        <input maxlength="31" class="form-control form-control-sm entertxtOnly" type="text"
                               name="bank_name" placeholder="Enter Bank Name"
                               id="bank_name" value="{{$bank_details->bank_name??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="account_title">Account Title</label>
                        <input maxlength="31" class="form-control form-control-sm entertxtOnly" type="text"
                               name="account_title" placeholder="Enter Account Title"
                               id="account_title" value="{{$bank_details->account_title??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="account_number">Account Number</label>
                        <input maxlength="31" class="form-control form-control-sm EnterOnlyNumber" type="text"
                               name="account_number" placeholder="Enter Account Number"
                               id="account_number" value="{{$bank_details->account_number??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="short_code">Short Code</label>
                        <input maxlength="31" class="form-control form-control-sm EnterOnlyNumber" type="text"
                               name="short_code" placeholder="Enter Short Code"
                               id="short_code" value="{{$bank_details->short_code??''}}">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
