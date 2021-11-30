<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Passport Details</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('add_staff_passport_detail'))
        <form id="passport_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="document_no">Document No</label>
                        <input maxlength="31" class="form-control form-control-sm EnterOnlyNumber" type="number"
                               name="document_no" placeholder="Enter Document No"
                               id="document_no" value="{{$passport->document_no??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="country_of_issue">Country Of Issue</label>
                        <input maxlength="31" class="form-control form-control-sm entertxtOnly" type="text"
                               name="country_of_issue" placeholder="Enter Country Of Issue"
                               id="country_of_issue" value="{{$passport->country_of_issue??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="date_of_issue">Date Of Issue</label>
                        <input class="form-control form-control-sm" type="date"
                               name="date_of_issue" placeholder="Enter Date Of Issue"
                               id="date_of_issue" value="{{$passport->date_of_issue??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        <label for="date_of_expiry">Date Of Expiry</label>
                        <input class="form-control form-control-sm" type="date"
                               name="date_of_expiry" placeholder="Enter Date Of Expiry"
                               id="date_of_issue" value="{{$passport->date_of_expiry??''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-sm">
                        @php
                            $visa_need="";
                            if(isset($passport->visa_need)){
                                $visa_need=$passport->visa_need;
                            }
                        @endphp
                        <label for="visa_need">Visa Need</label>
                        <select name="visa_need" id="visa_need" class="form-control form-control-sm">
                            <option value="visa_need" selected disabled>select option</option>
                            <option value="yes" {{$visa_need=="yes"?"selected":""}}>Yes</option>
                            <option value="no" {{$visa_need=="no"?"selected":""}}>No</option>
                        </select>
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
