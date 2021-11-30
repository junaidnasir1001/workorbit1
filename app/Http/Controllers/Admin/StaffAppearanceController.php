<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffAppearance;
use Illuminate\Http\Request;

class StaffAppearanceController extends Controller
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
        $staff_appearance = StaffAppearance::where("staff_id", $staff->id)->first();
        if ($staff_appearance) {
            $staff_appearance->update($request->except('_token'));
        } else {
            $request->merge(['staff_id' => $staff->id]);
            $staff_appearance = new  StaffAppearance($request->except('_token'));
            $staff_appearance->save();
        }
        $response = array('status' => 'success', 'message' => 'Data Added Successful');
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StaffAppearance $staffAppearance
     * @return \Illuminate\Http\Response
     */
    public function show(StaffAppearance $staffAppearance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffAppearance $staffAppearance
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffAppearance $staffAppearance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffAppearance $staffAppearance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffAppearance $staffAppearance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StaffAppearance $staffAppearance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffAppearance $staffAppearance)
    {
        //
    }
}
