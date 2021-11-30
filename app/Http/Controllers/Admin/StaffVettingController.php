<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffVetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class StaffVettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function index(Staff $staff)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function create(Staff $staff)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Staff $staff)
    {
        try {
            $staffvetting = new StaffVetting();
            $staffvetting->staff_id = $staff->id;
            $staffvetting->vetting_id = $request->add_vetting_id;
            $staffvetting->note = $request->add_note;
            $staffvetting->status = $request->add_status;
            $staffvetting->vetting_by = Auth::guard('admin')->id();

            if ($request->hasFile('add_document_file_path')) {
                $file_name = time() . '-document' . '.' . $request->add_document_file_path->extension();
                $filePath = '/documents/staff/vetting/' . Str::slug($staff->full_name) . '/';
                $request->add_document_file_path->move(public_path($filePath), $file_name);
                // $filePath = $request->file('add_document_file_path')->store('/documents/clients', 'public');
                $staffvetting->file_path = $filePath . $file_name;
            }
            $staffvetting->save();
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Staff $staff
     * @param \App\Models\StaffVetting $staff_vetting
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff, StaffVetting $staff_vetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Staff $staff
     * @param \App\Models\StaffVetting $staff_vetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff, StaffVetting $staff_vetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Staff $staff
     * @param \App\Models\StaffVetting $staff_vetting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffVetting $staff_vetting)
    {
        try {
            $staff_vetting->staff_id = $staff->id;
            $staff_vetting->vetting_id = $request->edit_staff_vetting_id;
            $staff_vetting->note = $request->edit_staff_vetting_note;
            $staff_vetting->status = $request->edit_staff_vetting_status;
            $staff_vetting->vetting_by = Auth::guard('admin')->id();

            if ($request->hasFile('edit_staff_vetting_file_path')) {

                if (file_exists(public_path($staff_vetting->file_path))) {
                    File::delete(public_path($staff_vetting->file_path));
                }

                $file_name = time() . '-document' . '.' . $request->edit_staff_vetting_file_path->extension();
                $filePath = '/documents/staff/vetting/' . Str::slug($staff->full_name) . '/';
                $request->edit_staff_vetting_file_path->move(public_path($filePath), $file_name);
                // $filePath = $request->file('add_document_file_path')->store('/documents/clients', 'public');
                $staff_vetting->file_path = $filePath . $file_name;
            }
            $staff_vetting->save();
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Staff $staff
     * @param \App\Models\StaffVetting $staff_vetting
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffVetting $staff_vetting)
    {
        //$note = Notes::find($request->id);
        $file_path = $staff_vetting->file_path;
        if ($staff_vetting->delete()) {

            if (file_exists(public_path($file_path))) {
                File::delete(public_path($file_path));
            }

            $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
        return response()->json($response, 403);
    }


    public function showData(Request $request, Staff $staff)
    {
        //$staff = Staff::find($request->id);
        $staff_vattings = $staff->vetting;
        return view('admin.staff.vetting.list', compact('staff_vattings', 'staff'))->render();
    }

    public function download(Staff $staff, StaffVetting $staff_vetting)
    {
        try {
            $file = public_path($staff_vetting->file_path);
            return Response::download($file);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
