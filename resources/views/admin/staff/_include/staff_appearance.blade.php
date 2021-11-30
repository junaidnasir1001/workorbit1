<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Staff Appearance</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    @if(hasPermission('add_staff_appearance'))
        <form id="staff_appearance_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="trousers_size">Trousers Size</label>
                        <input maxlength="31" type="text" class="form-control form-control-sm entertxtOnly" placeholder="Enter Trousers Size" name="trousers_size" id="trousers_size"
                               value="{{$appearance ? ($appearance->trousers_size??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="skirt_size">Skirt Size</label>
                        <input maxlength="31" type="text" placeholder="Enter Skirt Size" class="form-control form-control-sm" name="skirt_size" id="trousers_size"
                               value="{{$appearance ? ($appearance->skirt_size??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="hips">Hips</label>
                        <input maxlength="31" type="text" placeholder="Enter Hips" class="form-control form-control-sm" name="hips" id="hips"
                               value="{{$appearance ? ($appearance->hips??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="hair_color" class="text-capitalize">Hair Color</label>
                        <input maxlength="31" type="text" placeholder="Enter Hair Color entertxtOnly" class="form-control form-control-sm" name="hair_color" id="hair_color"
                               value="{{$appearance ? ($appearance->hair_color??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="jacket_size" class="text-capitalize">Jacket Size</label>
                        <input maxlength="31" type="text" placeholder="Enter Jacket Size" class="form-control form-control-sm" name="jacket_size" id="jacket_size"
                               value="{{$appearance ? ($appearance->jacket_size??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="height" class="text-capitalize">Height</label>
                        <input maxlength="31" type="text" placeholder="Enter Height" class="form-control form-control-sm" name="height" id="height"
                               value="{{$appearance ? ($appearance->height??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="bust" class="text-capitalize">Bust</label>
                        <input maxlength="31" type="text" placeholder="Enter Bust" class="form-control form-control-sm" name="bust" id="bust"
                               value="{{$appearance ? ($appearance->bust??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="chest" class="text-capitalize">Chest</label>
                        <input maxlength="31" type="text" placeholder="Enter Chest" class="form-control form-control-sm" name="chest" id="chest"
                               value="{{$appearance ? ($appearance->chest??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="collar" class="text-capitalize">Collar</label>
                        <input maxlength="31" type="text" placeholder="Enter Collar" class="form-control form-control-sm" name="collar" id="collar"
                               value="{{$appearance ? ($appearance->collar??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="waist" class="text-capitalize">Waist</label>
                        <input maxlength="31" type="text" placeholder="Enter Waist" class="form-control form-control-sm" name="waist" id="waist"
                               value="{{$appearance ? ($appearance->waist??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="inside_leg" class="text-capitalize">Inside Leg</label>
                        <input maxlength="31" type="text" placeholder="Enter Inside Leg" class="form-control form-control-sm" name="inside_leg" id="inside_leg"
                               value="{{$appearance ? ($appearance->inside_leg??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="eye_colour" class="text-capitalize">Eye Colour</label>
                        <input maxlength="31" type="text" placeholder="Enter Eye Colour" class="form-control form-control-sm" name="eye_colour" id="eye_colour"
                               value="{{$appearance ? ($appearance->eye_colour??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="shoe_size" class="text-capitalize">Shoe Size</label>
                        <input maxlength="31" type="text" placeholder="Enter Shoe Size" class="form-control form-control-sm" name="shoe_size" id="shoe_size"
                               value="{{$appearance ? ($appearance->shoe_size??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="hat_size" class="text-capitalize">Hat Size</label>
                        <input maxlength="31" type="text" placeholder="Enter Hat Size" class="form-control form-control-sm" name="hat_size" id="hat_size"
                               value="{{$appearance ? ($appearance->hat_size??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="weight" class="text-capitalize">Weight</label>
                        <input maxlength="31" type="text" placeholder="Enter Weight" class="form-control form-control-sm" name="weight" id="weight"
                               value="{{$appearance ? ($appearance->weight??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="hair_length" class="text-capitalize">Hair Length</label>
                        <input maxlength="31" type="text" placeholder="Enter Hair Length" class="form-control form-control-sm" name="hair_length" id="hair_length"
                               value="{{$appearance ? ($appearance->hair_length??""):""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-sm">
                        <label for="facial_length" class="text-capitalize">Facial Length</label>
                        <input maxlength="31" type="text" placeholder="Enter Facial Length" class="form-control form-control-sm" name="facial_length" id="facial_length"
                               value="{{$appearance ? ($appearance->facial_length??""):""}}">
                    </div>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
