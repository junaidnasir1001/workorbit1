<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffEmployment;
use Illuminate\Http\Request;

class StaffEmploymentController extends Controller
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
        try {
            StaffEmployment::create([
                "staff_id" => $staff->id,
                "company_name" => $request->add_employment_company_name,
                "job_title" => $request->add_employment_job_title,
                "address" => $request->add_employment_address,
                "postal_code" => $request->add_employment_postal_code,
                "contact_person" => $request->add_employment_contact_person,
                "contact_phone" => $request->add_employment_contact_phone,
                "email" => $request->add_employment_email,
                "start_date" => $request->add_employment_start_date,
                "end_date" => $request->add_employment_end_date,
                "reason_for_leaving" => $request->add_employment_reason_for_leaving,
            ]);
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StaffEmployment $staffEmployment
     * @return \Illuminate\Http\Response
     */
    public function show(StaffEmployment $staffEmployment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffEmployment $staffEmployment
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffEmployment $staffEmployment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffEmployment $staffEmployment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffEmployment $staff_employment)
    {
        try {
            $staff_employment->company_name = $request->edit_employment_company_name;
            $staff_employment->job_title = $request->edit_employment_job_title;
            $staff_employment->address = $request->edit_employment_address;
            $staff_employment->postal_code = $request->edit_employment_postal_code;
            $staff_employment->contact_person = $request->edit_employment_contact_person;
            $staff_employment->contact_phone = $request->edit_employment_contact_phone;
            $staff_employment->email = $request->edit_employment_email;
            $staff_employment->start_date = $request->edit_employment_start_date;
            $staff_employment->end_date = $request->edit_employment_end_date;
            $staff_employment->reason_for_leaving = $request->edit_employment_reason_for_leaving;
            $staff_employment->save();
            $response = array('status' => 'success', "message" => "Data Updated Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StaffEmployment $staff_employment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffEmployment $staff_employment)
    {
        try {
            if ($staff_employment->delete()) {
                $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
                return response()->json($response, 200);
            }
            $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
            return response()->json($response, 403);

        } catch (\Exception  $th) {
            $response = array('status' => 'error', 'message' => $th->getMessage());
            return response()->json($response, 403);
        }
    }

    /**
     * @param Request $request
     * @param Staff $staff
     */
    public function showData(Request $request, Staff $staff)
    {
        $columns = array(
            0 => 'id',
            1 => 'company_name',
            2 => 'job_title',
            3 => 'address',
            4 => 'postal_code',
            6 => 'contact_person',
            7 => 'contact_person',
            8 => 'contact_phone',
            9 => 'email',
            10 => 'start_date',
            11 => 'end_date',
            12 => 'reason_for_leaving',
        );
        $totalData = StaffEmployment::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffEmployment::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffEmployment::where('staff_id', $staff->id)
                ->where('company_name', 'LIKE', "%{$search}%")
                ->orWhere('job_title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffEmployment::where('staff_id', $staff->id)
                ->where('company_name', 'LIKE', "%{$search}%")
                ->orWhere('job_title', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['company_name'] = $row->company_name;
                $nestedData['job_title'] = $row->job_title;
                $nestedData['address'] = $row->address;
                $nestedData['postal_code'] = $row->postal_code;
                $nestedData['contact_person'] = $row->contact_person;
                $nestedData['contact_phone'] = $row->contact_phone;
                $nestedData['email'] = $row->email;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['end_date'] = $row->end_date;
                $nestedData['reason_for_leaving'] = $row->reason_for_leaving;

                $id = $row->id;
                $del_link = route("admin.staff_employment.destroy", ["staff_employment" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_employment')){
                    $editButton = "<button title='Edit' class='edit_employment_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_employment')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
        <div class='btn-group' role='group'>
        $editButton
        <form action='$del_link' method='POST' class='delete_employment_form'>
        <input type='hidden' name='_token' value='$csrf'>
        <input type='hidden' name='_method' value='delete' />
        $deleteButton
        </form>

        </div>
        ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return json_encode($json_data);
    }
}
