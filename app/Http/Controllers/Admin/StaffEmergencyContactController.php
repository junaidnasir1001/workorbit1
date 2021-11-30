<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffEmergencyContact;
use Illuminate\Http\Request;

/**
 * Class StaffEmergencyContactController
 * @package App\Http\Controllers\Admin
 */
class StaffEmergencyContactController extends Controller
{

    /**
     * @param Staff $staff
     */
    public function index(Staff $staff)
    {
        //
    }


    /**
     * @param Staff $staff
     */
    public function create(Staff $staff)
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
            StaffEmergencyContact::create([
                "staff_id" => $staff->id,
                "name" => $request->add_em_name,
                "phone" => $request->add_em_phone,
                "relation" => $request->add_em_relation,
                "address" => $request->add_em_address,
                "postal_code" => $request->add_em_postal_code,
            ]);
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }

    }


    /**
     * @param StaffEmergencyContact $staff_emergency_contact
     * @param Staff $staff
     */
    public function show(StaffEmergencyContact $staff_emergency_contact, Staff $staff)
    {
        //
    }

    /**
     * @param StaffEmergencyContact $staff_emergency_contact
     * @param Staff $staff
     */
    public function edit(StaffEmergencyContact $staff_emergency_contact, Staff $staff)
    {
        //
    }


    /**
     * @param Request $request
     * @param StaffEmergencyContact $staff_emergency_contact
     * @param Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request/*, StaffEmergencyContact $staff_emergency_contact, Staff $staff*/)
    {
        $staff_emergency_contact = StaffEmergencyContact::find(request()->staff_emergency_contact);
        try {
            $staff_emergency_contact->name = $request->edit_em_name;
            $staff_emergency_contact->phone = $request->edit_em_phone;
            $staff_emergency_contact->relation = $request->edit_em_relation;
            $staff_emergency_contact->address = $request->edit_em_address;
            $staff_emergency_contact->postal_code = $request->edit_em_postal_code;
            $staff_emergency_contact->save();
            $response = array('status' => 'success', "message" => "Data Updated Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }


    /**
     * @param StaffEmergencyContact $staff_emergency_contact
     * @param Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(/*StaffEmergencyContact $staff_emergency_contact, Staff $staff*/)
    {
        try {
            $staff_emergency_contact = StaffEmergencyContact::find(request()->staff_emergency_contact);
            if ($staff_emergency_contact->delete()) {
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
            2 => 'phone',
            3 => 'relation',
            4 => 'address',
            5 => 'postal_code',
        );
        $totalData = StaffEmergencyContact::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffEmergencyContact::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffEmergencyContact::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->where('phone', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffEmergencyContact::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->where('phone', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $nestedData['phone'] = $row->phone;
                $nestedData['relation'] = $row->relation;
                $nestedData['address'] = $row->address;
                $nestedData['postal_code'] = $row->postal_code;

                $id = $row->id;
                $del_link = route("admin.staff_emergency_contact.destroy", ["staff_emergency_contact" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_emergency_contact')){
                    $editButton = "<button title='Edit' class='edit_em_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_emergency_contact')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
<div class='btn-group' role='group'>
        $editButton
       <form action='$del_link' method='POST' class='delete_form'>
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
        echo json_encode($json_data);
    }
}
