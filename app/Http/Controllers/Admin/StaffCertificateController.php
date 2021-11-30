<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffCertificate;
use Illuminate\Http\Request;

/**
 * Class StaffCertificateController
 * @package App\Http\Controllers\Admin
 */
class StaffCertificateController extends Controller
{
    /**
     *
     */
    public function index()
    {
        //
    }


    /**
     *
     */
    public function create()
    {
        //
    }


    /**
     * @param Request $request
     * @param Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Staff $staff)
    {
        try {
            StaffCertificate::create([
                "staff_id" => $staff->id,
                "name" => $request->add_c_name,
                "number" => $request->add_c_number,
                "expiry_date" => $request->add_c_expiry_date,
            ]);
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }


    /**
     * @param Staff $staff
     * @param StaffCertificate $staffCertificate
     */
    public function show(Staff $staff, StaffCertificate $staffCertificate)
    {
        //
    }


    /**
     * @param Staff $staff
     * @param StaffCertificate $staffCertificate
     */
    public function edit(Staff $staff, StaffCertificate $staffCertificate)
    {
        //
    }


    /**
     * @param Request $request
     * @param Staff $staff
     * @param StaffCertificate $staff_certificate
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffCertificate $staff_certificate)
    {
        //$staff_emergency_contact = StaffCertificate::find(request()->staff_emergency_contact);
        try {
            $staff_certificate->name = $request->edit_c_name;
            $staff_certificate->number = $request->edit_c_number;
            $staff_certificate->expiry_date = $request->edit_c_expiry_date;
            $staff_certificate->save();
            $response = array('status' => 'success', "message" => "Data Updated Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }


    /**
     * @param Staff $staff
     * @param StaffCertificate $staff_certificate
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffCertificate $staff_certificate)
    {
        try {
            //$staff_certificate = StaffCertificate::find(request()->staff_emergency_contact);
            if ($staff_certificate->delete()) {
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
            1 => 'name',
            2 => 'number',
            3 => 'expiry_date',
        );
        $totalData = StaffCertificate::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffCertificate::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffCertificate::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('number', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffCertificate::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('number', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $nestedData['number'] = $row->number;
                $nestedData['expiry_date'] = $row->expiry_date;

                $id = $row->id;
                $del_link = route("admin.staff_certificate.destroy", ["staff_certificate" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_certificate')){
                    $editButton = "<button title='Edit' class='edit_c_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_certificate')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
        <div class='btn-group' role='group'>
        $editButton
        <form action='$del_link' method='POST' class='delete_c_form'>
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
