<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
            'add_client_id' => 'required',
            'add_site_id' => 'required',
            'add_site_type_id' => 'required',
            'add_time_in' => 'required|date_format:H:i',
            'add_time_out' => 'required|after:add_time_in',
            'add_break_time_start' => 'required|date_format:H:i',
            'add_break_time_end' => 'required|after:add_time_in',
            'add_start_date' => 'required',
            'add_end_date' => 'required',
            'add_working_days' => 'required',
            'add_staff_id.*' => 'required',
            'add_staff_pay_rate.*' => 'required',
            'add_staff_shift_schedule.*' => 'required',
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
            'add_client_id.required' => 'Please Select Client',
            'add_site_id.required' => 'Please Select Site',
            'add_site_type_id.required' => 'Please Select Site Type',
            'add_time_in.required' => 'Please Enter Time In',
            'add_time_out.required' => 'Please Enter Time Out',
            'add_time_out.after' => 'Time Out Must Greater Than Time In',
            'add_break_time_start.required' => 'Please Enter Break Time Start',
            'add_break_time_end.required' => 'Please Enter Break Time End',
            'add_break_time_end.after' => 'Break Time End Must be greater than start time',
            'add_start_date.required' => 'Please Enter Start Date',
            'add_end_date.required' => 'Please Enter End Date',
            'add_working_days.required' => 'Please Select Working Days',
            'add_staff_id.required' => 'Please Select Staff',
            'add_staff_pay_rate.required' => 'Please Enter Pay Rate',
            'add_staff_shift_schedule.required' => 'Please Select Shift Schedule',
        ];
    }
}
