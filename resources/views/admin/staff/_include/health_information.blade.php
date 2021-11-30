<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Health Information</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('add_staff_health_information'))
        <form id="staff_health_information_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $can_examined="";
                            if(isset($health_information->can_examined)){
                                $can_examined=$health_information->can_examined;
                            }
                        @endphp
                        <label for="can_examined">Can Examined</label>
                        <select name="can_examined" id="can_examined" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$can_examined==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $has_condition="";
                            if(isset($health_information->has_condition)){
                                $has_condition=$health_information->has_condition;
                            }
                        @endphp
                        <label for="has_condition">Has Condition</label>
                        <select name="has_condition" id="has_condition" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$has_condition==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $need_care="";
                            if(isset($health_information->need_care)){
                                $need_care=$health_information->need_care;
                            }
                        @endphp
                        <label for="need_care">Need Care</label>
                        <select name="need_care" id="need_care" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$need_care==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        <label for="disabled_no">Disabled no</label>
                        <input maxlength="31" type="text" class="form-control form-control-sm EnterOnlyNumber" placeholder="Enter Disabled no" name="disabled_no" id="disabled_no"
                               value="{{$health_information?($health_information->disabled_no??""):""}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        <label for="absent_days_in_last_two_years">Absent Days In Last Two Years</label>
                        <input maxlength="31" type="text" class="form-control form-control-sm" name="absent_days_in_last_two_years"
                               id="absent_days_in_last_two_years" placeholder="Enter Absent Days In Last Two Years"
                               value="{{$health_information?($health_information->absent_days_in_last_two_years??""):""}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        <label for="additional_comment">Additional Comment</label>
                        <input maxlength="31" type="text" class="form-control form-control-sm" name="additional_comment"
                               id="additional_comment" placeholder="Enter Additional Comment"
                               value="{{$health_information?($health_information->additional_comment??""):""}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $heart_disease="";
                            if(isset($health_information->heart_disease)){
                                $heart_disease=$health_information->heart_disease;
                            }
                        @endphp
                        <label for="heart_disease">Heart Disease</label>
                        <select name="heart_disease" id="heart_disease" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$heart_disease==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $diabetes="";
                            if(isset($health_information->diabetes)){
                                $diabetes=$health_information->diabetes;
                            }
                        @endphp
                        <label for="diabetes">Diabetes</label>
                        <select name="diabetes" id="diabetes" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$diabetes==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        @php
                            $glasses="";
                            if(isset($health_information->glasses)){
                                $glasses=$health_information->glasses;
                            }
                        @endphp
                        <label for="glasses">Glasses</label>
                        <select name="glasses" id="glasses" class="form-control form-control-sm">
                            <option value="" selected disabled>select option</option>
                            @foreach($yesOrNo as $option)
                                <option value="{{$option}}"
                                    {{$glasses==$option?"selected":""}}
                                >{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-sm">
                        <label for="other_illness">Other Illness</label>
                        <input maxlength="31" type="text" class="form-control form-control-sm" name="other_illness"
                               id="other_illness" placeholder="Enter Other Illness"
                               value="{{$health_information?($health_information->other_illness??""):""}}">
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
