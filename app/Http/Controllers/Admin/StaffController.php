<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Designation;
use App\Models\Notes;
use App\Models\Staff;
use App\Models\Vetting;
use App\Models\StaffDetails;
use App\Models\StaffHealthInformation;
use App\Models\SubContractor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sub_contractors = SubContractor::active()->get();
        $designations = Designation::active()->get();
        $staff_names = Staff::all();
        $staff_vettings = Vetting::all();
        return view('admin.staff.index', get_defined_vars());
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
    public function store(Request $request)
    {
        $data = [
            'first_name' => $request->add_first_name,
            'last_name' => $request->add_last_name,
            'staff_number' => $request->add_staff_number,
            'sub_contractor_id' => $request->add_sub_contractor_id,
            'designation_id' => $request->add_designation_id,
            'phone_number' => $request->add_phone_number,
            'mobile_number' => $request->add_mobile_number,
            'email' => $request->add_email,
            'pay_rate' => $request->add_pay_rate,
            'sia_number' => $request->add_sia_number,
            'is_active' => $request->add_is_active == 'on' ? 1 : 0,
        ];

        if ($request->hasFile('add_profile_path')) {
            $filePath = $request->file('add_profile_path')->store('/profile/staff', 'public');
            $data = array_merge($data, ['profile_path' => '/storage/' . $filePath]);
        }

        /*$exists = Staff::where('email', $request->add_email)
            ->orWhere('phone_number', $request->add_phone_number)
            ->orWhere('mobile_number', $request->mobile_number)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Client Already existed');
            return response()->json($response, 403);
        }*/


        $client = Staff::create($data);
        if ($client) {
            $response = array('status' => 'success', 'message' => 'Data Inserted Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not inserted try again');
        return response()->json($response, 403);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staff_names = Staff::all();
        $staff_vettings = Vetting::all();
        $sub_contractors = SubContractor::active()->get();
        $designations = Designation::active()->get();
        $genders = StaffDetails::gender();
        $ethnic_origins = StaffDetails::ethnic_origin();
        $driving_license = StaffDetails::driving_license();
        $staff_details = $staff->details;
        $bank_details = $staff->bank_details;
        $passport = $staff->passport;
        $yesOrNo = StaffHealthInformation::yesOrNo();
        $appearance = $staff->appearance;
        $health_information = $staff->health_information;
        return view('admin.staff.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff)
    {
        $staff->first_name = $request->edit_first_name;
        $staff->last_name = $request->edit_last_name;
        $staff->staff_number = $request->edit_staff_number;
        $staff->sub_contractor_id = $request->edit_sub_contractor_id;
        $staff->designation_id = $request->edit_designation_id;
        $staff->phone_number = $request->edit_phone_number;
        $staff->mobile_number = $request->edit_mobile_number;
        $staff->email = $request->edit_email;
        $staff->pay_rate = $request->edit_pay_rate;
        $staff->sia_number = $request->edit_sia_number;
        $staff->is_active = $request->edit_is_active == 'on' ? 1 : 0;

        if ($request->hasFile('edit_profile_path')) {

            if (file_exists(public_path($request->old_profile_path))) {
                File::delete(public_path($request->old_profile_path));
            }

            $filePath = $request->file('edit_profile_path')->store('/profile/staff', 'public');
            $staff->profile_path = '/storage/' . $filePath;
        }

        if ($staff->save()) {
            $response = array('status' => 'success',
                'message' => 'Data Updated Successful',
                'staff' => $staff,
                'sub_contractor' => $staff->sub_contractor,
                'designation' => $staff->designation);
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff)
    {
        if (file_exists(public_path($staff->profile_path))) {
            File::delete(public_path($staff->profile_path));
        }
        try {

            if ($staff->delete()) {
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

    public function showData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'profile_path',
            3 => 'phone_number',
            4 => 'mobile_number',
            5 => 'email',
            6 => 'registration_number',
            7 => 'vat_number',
            8 => 'postal_code',
            9 => 'city',
            10 => 'country',
        );
        $totalData = Staff::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Staff::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Staff::where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('staff_number', 'LIKE', "%{$search}%")
                ->orWhere('sia_number', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Staff::where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('staff_number', 'LIKE', "%{$search}%")
                ->orWhere('sia_number', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['first_name'] = "<a href='" . route('admin.staff.show', ['staff' => $row->id]) . "'>" . $row->first_name . " " . $row->last_name . "</a>";
                $path = URL::asset($row->profile_path);
                $nestedData['profile_path'] = "<img class='img-thumbnail' src='$path' alt='' style='width:60px'/>";
                $nestedData['staff_number'] = $row->staff_number;
                $nestedData['sub_contractor_id'] = $row->sub_contractor->name ?? '';
                $nestedData['designation_id'] = $row->designation->name ?? '';
                $nestedData['phone_number'] = $row->phone_number;
                $nestedData['mobile_number'] = $row->mobile_number;
                $nestedData['email'] = $row->email;
                $nestedData['pay_rate'] = $row->pay_rate;
                $nestedData['sia_number'] = $row->sia_number;
                $nestedData['is_active'] = $row->is_active == 1 ? "Active" : "Disabled";

                $id = $row->id;
                $del_link = route("admin.staff.destroy", ["staff" => $id]);
                $show_link = route("admin.staff.show", ["staff" => $row->id]);
                $csrf = csrf_token();


                $editButton = '';
                if (hasPermission('edit_staff')) {
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if (hasPermission('delete_staff')) {
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    <i class='fas fa-trash-alt'></i></button>";
                };
                $viewButton = '';
                if (hasPermission('staff_list')) {
                    $viewButton = "<a href='$show_link' title='Edit' class='edit_data ml-2 btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>";
                };
                $nestedData['options'] = "
<div class='btn-group' role='group'>
        $editButton
       <form action='$del_link' method='POST' class='delete_form'>
        <input type='hidden' name='_token' value='$csrf'>
        <input type='hidden' name='_method' value='delete' />
        $deleteButton
        </form>
        $viewButton
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

    public function notesList(Staff $staff)
    {
        $notes = $staff->notes()->orderByDesc('id')->get();

        return view('admin.staff.notes.notes_list', compact('notes'))->render();
    }

    public function saveNotes(Request $request, Staff $staff)
    {
        $notes = new Notes();
        $notes->description = $request->description;

        if ($staff->notes()->save($notes)) {
            $response = array('status' => 'success', 'message' => 'Data Added Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Added Successful');
        return response()->json($response, 403);
    }

    public function deleteNotes(Request $request)
    {
        $note = Notes::find($request->id);
        if ($note->delete()) {
            $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
        return response()->json($response, 403);
    }
}
