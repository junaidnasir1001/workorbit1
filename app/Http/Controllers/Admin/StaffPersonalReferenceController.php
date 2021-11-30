<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffPersonalReference;
use Illuminate\Http\Request;

class StaffPersonalReferenceController extends Controller
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
            StaffPersonalReference::create([
                "staff_id" => $staff->id,
                "name" => $request->add_personal_references_name,
                "email" => $request->add_personal_references_email,
                "address" => $request->add_personal_references_address,
                "postal_code" => $request->add_personal_postal_code,
                "phone" => $request->add_personal_phone,
                "occupation" => $request->add_personal_references_occupation,
                "how_long_know" => $request->add_personal_references_how_long_know,
                "relation" => $request->add_personal_references_relation,
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
     * @param \App\Models\StaffPersonalReference $staffPersonalReference
     * @return \Illuminate\Http\Response
     */
    public function show(StaffPersonalReference $staffPersonalReference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffPersonalReference $staffPersonalReference
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffPersonalReference $staffPersonalReference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffPersonalReference $staffPersonalReference
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffPersonalReference $staff_personal_reference)
    {
        try {
            $staff_personal_reference->name = $request->edit_personal_references_name;
            $staff_personal_reference->email = $request->edit_personal_references_email;
            $staff_personal_reference->address = $request->edit_personal_references_address;
            $staff_personal_reference->postal_code = $request->edit_personal_postal_code;
            $staff_personal_reference->phone = $request->edit_personal_phone;
            $staff_personal_reference->occupation = $request->edit_personal_references_occupation;
            $staff_personal_reference->how_long_know = $request->edit_personal_references_how_long_know;
            $staff_personal_reference->relation = $request->edit_personal_references_relation;

            $staff_personal_reference->save();
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
     * @param \App\Models\StaffPersonalReference $staffPersonalReference
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffPersonalReference $staff_personal_reference)
    {
        try {
            if ($staff_personal_reference->delete()) {
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
            2 => 'email',
            3 => 'address',
            4 => 'postal_code',
            6 => 'phone',
            7 => 'occupation',
            8 => 'how_long_know',
            9 => 'relation',
        );
        $totalData = StaffPersonalReference::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffPersonalReference::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffPersonalReference::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffPersonalReference::where('staff_id', $staff->id)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['address'] = $row->address;
                $nestedData['postal_code'] = $row->postal_code;
                $nestedData['phone'] = $row->phone;
                $nestedData['occupation'] = $row->occupation;
                $nestedData['how_long_know'] = $row->how_long_know;
                $nestedData['relation'] = $row->relation;

                $id = $row->id;
                $del_link = route("admin.staff_personal_reference.destroy", ["staff_personal_reference" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_personal_references')){
                    $editButton = "<button title='Edit' class='edit_personal_references_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_personal_references')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
        <div class='btn-group' role='group'>
        $editButton
        <form action='$del_link' method='POST' class='delete_personal_references_form'>
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
