<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'edit_site_id' => 'required',
            'edit_site_type_id' => 'required',
//            'edit_time_in' => 'required|date_format:H:i',
//            'edit_time_out' => 'required|after:edit_time_in',
//            'edit_break_time_start' => 'required|date_format:H:i',
//            'edit_break_time_end' => 'required|after:edit_time_in',
            'edit_start_date' => 'required',
            'edit_end_date' => 'required',
            'edit_working_days' => 'required',
            'edit_staff_id.*' => 'required',
            'edit_staff_pay_rate.*' => 'required',
            'edit_staff_shift_schedule.*' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'edit_site_id.required' => 'Please Select Site',
            'edit_site_type_id.required' => 'Please Select Site Type',
            'edit_time_in.required' => 'Please Enter Time In',
            'edit_time_in.date_format' => 'Invalid Time In Format must be H:i:s',
            'edit_time_out.required' => 'Please Enter Time Out',
            'edit_time_out.after' => 'Time Out Must Greater Than Time In',
            'edit_break_time_start.required' => 'Please Enter Break Time Start',
            'edit_break_time_end.required' => 'Please Enter Break Time End',
            'edit_break_time_end.after' => 'Break Time End Must be greater than start time',
            'edit_start_date.required' => 'Please Enter Start Date',
            'edit_end_date.required' => 'Please Enter End Date',
            'edit_working_days.required' => 'Please Select Working Days',
            'edit_staff_id.required' => 'Please Select Staff',
            'edit_staff_pay_rate.required' => 'Please Enter Pay Rate',
            'edit_staff_shift_schedule.required' => 'Please Select Shift Schedule',
        ];
    }
}
