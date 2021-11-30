<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffHealthInformation;
use Illuminate\Http\Request;

class StaffHealthInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Staff $staff)
    {
        $staff_health_information = StaffHealthInformation::where("staff_id", $staff->id)->first();
        if ($staff_health_information) {
            $staff_health_information->update($request->except('_token'));
        } else {
            $request->merge(['staff_id' => $staff->id]);
            $staff_health_information = new  StaffHealthInformation($request->except('_token'));
            $staff_health_information->save();
        }
        $response = array('status' => 'success', 'message' => 'Data Added Successful');
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StaffHealthInformation $staffHealthInformation
     * @return \Illuminate\Http\Response
     */
    public function show(StaffHealthInformation $staffHealthInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffHealthInformation $staffHealthInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffHealthInformation $staffHealthInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffHealthInformation $staffHealthInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffHealthInformation $staffHealthInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StaffHealthInformation $staffHealthInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffHealthInformation $staffHealthInformation)
    {
        //
    }
}
