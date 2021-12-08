<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Personal Details</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('add_staff_personal_detail'))
        <form id="staff_details_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="vetting_start_date">Vetting Start Date</label>
                        <input class="form-control form-control-sm" type="date"
                               name="vetting_start_date"
                               id="vetting_start_date" value="{{$staff_details->vetting_start_date??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="vetting_end_date">Vetting End Date</label>
                        <input class="form-control form-control-sm" type="date"
                               name="vetting_end_date"
                               id="vetting_end_date" value="{{$staff_details->vetting_end_date??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="contract_start_date">Contract Start Date</label>
                        <input class="form-control form-control-sm" type="date"
                               name="contract_start_date"
                               id="contract_start_date" value="{{$staff_details->contract_start_date??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="contract_end_date">Contract End Date</label>
                        <input class="form-control form-control-sm" type="date"
                               name="contract_end_date"
                               id="contract_end_date" value="{{$staff_details->contract_end_date??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="ni_number">NI Number</label>
                        <input maxlength="31" class="form-control form-control-sm EnterOnlyNumber" type="number"
                               name="ni_number" placeholder="Enter NI Number"
                               id="ni_number" value="{{$staff_details->ni_number??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="gender">Gender</label>
                        <br>
                        @php
                            $staff_gender="";
                            if(isset($staff_details->gender)){
                                $staff_gender=$staff_details->gender;
                            }
                        @endphp
                        <select name="gender" id="gender"
                                class="form-control form-control-sm">
                            <option value="" disabled selected>select gender</option>
                            @foreach($genders as $gender)
                                <option value="{{$gender}}"
                                    {{$gender==$staff_gender?"selected":""}}
                                >{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="ethnic_origin">Ethnic Origin</label>
                        <br>
                        @php
                            $staff_origin="";
                            if(isset($staff_details->ethnic_origin)){
                                $staff_origin=$staff_details->ethnic_origin;
                            }
                        @endphp
                        <select name="ethnic_origin" id="ethnic_origin"
                                class="form-control form-control-sm">
                            <option value="" disabled selected>select ethnic origin</option>
                            @foreach($ethnic_origins as $ethnic_origin)
                                <option
                                    value="{{$ethnic_origin}}"
                                    {{$ethnic_origin==$staff_origin?"selected":""}}
                                >{{$ethnic_origin}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="date_of_birth">Date of Birth</label>
                        <input class="form-control form-control-sm" type="date"
                               name="date_of_birth"
                               id="date_of_birth" value="{{$staff_details->date_of_birth??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="place_of_birth">Place of Birth</label>
                        <input class="form-control form-control-sm" type="text"
                               name="place_of_birth" placeholder="Place of Birth"
                               id="place_of_birth" value="{{$staff_details->place_of_birth??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="nationality">Nationality</label>
                        <input class="form-control form-control-sm" type="text"
                               name="nationality" placeholder="Nationality"
                               id="nationality" value="{{$staff_details->nationality??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="current_address">Current Address</label>
                        <input maxlength="51" class="form-control form-control-sm" type="text"
                               name="current_address" placeholder="Enter Current Address"
                               id="current_address" value="{{$staff_details->current_address??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="postal_code">Zip Code/Postal Code</label>
                        <input maxlength="31" class="form-control form-control-sm" type="text"
                               name="postal_code" placeholder="Enter Postral Code"
                               id="postal_code" value="{{$staff_details->postal_code??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="city">City</label>
                        <input class="form-control form-control-sm" type="text" name="city"
                               id="city" placeholder="Enter City" value="{{$staff_details->city??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="living_from">Living From</label>
                        <input class="form-control form-control-sm" type="date"
                               name="living_from"
                               id="living_from" value="{{$staff_details->living_from??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="living_to">Living To</label>
                        <input class="form-control form-control-sm" type="date"
                               name="living_to"
                               id="living_to" value="{{$staff_details->living_to??''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="driving_license">Driving Licence</label>
                        <br>
                        @php
                            $staff_license="";
                            if(isset($staff_details->driving_license)){
                                $staff_license=$staff_details->driving_license;
                            }
                        @endphp
                        <select name="driving_license" id="driving_license"
                                class="form-control form-control-sm">
                            <option value="" disabled selected>select driving license</option>
                            @foreach($driving_license as $license)
                                <option value="{{$license}}"
                                    {{$license==$staff_license?"selected":""}}
                                >{{$license}}</option>
                            @endforeach
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
