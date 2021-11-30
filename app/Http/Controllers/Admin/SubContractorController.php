<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubContractor;
use App\Models\Staff;
use App\Models\Site;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::get();
        $site = Site::get();
        return view('admin.sub_contractor.index', get_defined_vars());
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
            'name' => $request->add_name,
            'phone_number' => $request->add_phone_number,
            'mobile_number' => $request->add_mobile_number,
            'email' => $request->add_email,
            'registration_number' => $request->add_registration_number,
            'vat_number' => $request->add_vat_number,
            'address' => $request->add_address,
            'postal_code' => $request->add_postal_code,
            'city' => $request->add_city,
            'country' => $request->add_country,
            'website' => $request->add_website,
            'pay_rate' => $request->add_pay_rate,
            'is_active' => $request->add_is_active == 'on' ? 1 : 0,
        ];

        if ($request->hasFile('add_profile_path')) {
            $file_name = time() . '-sub_contractor' . '.' . $request->add_profile_path->extension();
            $filePath = '/profile/sub_contractor/';
            $request->add_profile_path->move(public_path($filePath), $file_name);
            $data = array_merge($data, ['profile_path' => $filePath . $file_name]);
        }

        $exists = SubContractor::where('email', $request->add_email)
            ->orWhere('phone_number', $request->add_phone_number)
            ->orWhere('mobile_number', $request->mobile_number)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Sub Contractor Already existed');
            return response()->json($response, 403);
        }


        $client = SubContractor::create($data);
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
     * @param \App\Models\SubContractor $sub_contractor
     * @return \Illuminate\Http\Response
     */
    public function show(SubContractor $sub_contractor)
    {

        $staff = Staff::get();
        $site = Site::get();
        return view('admin.sub_contractor.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SubContractor $sub_contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(SubContractor $sub_contractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SubContractor $sub_contractor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, SubContractor $sub_contractor)
    {
        $sub_contractor->name = $request->edit_name;
        $sub_contractor->phone_number = $request->edit_phone_number;
        $sub_contractor->mobile_number = $request->edit_mobile_number;
        $sub_contractor->email = $request->edit_email;
        $sub_contractor->registration_number = $request->edit_registration_number;
        $sub_contractor->vat_number = $request->edit_vat_number;
        $sub_contractor->address = $request->edit_address;
        $sub_contractor->postal_code = $request->edit_postal_code;
        $sub_contractor->city = $request->edit_city;
        $sub_contractor->country = $request->edit_country;
        $sub_contractor->website = $request->edit_website;
        $sub_contractor->pay_rate = $request->edit_pay_rate;
        $sub_contractor->is_active = $request->edit_is_active == 'on' ? 1 : 0;

        if ($request->hasFile('edit_profile_path')) {

            if (file_exists(public_path($request->old_profile_path))) {
                File::delete(public_path($request->old_profile_path));
            }

            $file_name = time() . '-sub_contractor' . '.' . $request->edit_profile_path->extension();
            $filePath = '/profile/sub_contractor/';
            $request->edit_profile_path->move(public_path($filePath), $file_name);
            $sub_contractor->profile_path = $filePath . $file_name;
        }

        if ($sub_contractor->save()) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful', 'data' => $sub_contractor);
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SubContractor $sub_contractor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SubContractor $sub_contractor)
    {
        if (file_exists(public_path($sub_contractor->profile_path))) {
            File::delete(public_path($sub_contractor->profile_path));
        }
        try {

            if ($sub_contractor->delete()) {
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
            11 => 'website',
            12 => 'pay_rate',
            13 => 'website',
            14 => 'is_active',
        );
        $totalData = SubContractor::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = SubContractor::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = SubContractor::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('registration_number', 'LIKE', "%{$search}%")
                ->orWhere('vat_number', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = SubContractor::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('registration_number', 'LIKE', "%{$search}%")
                ->orWhere('vat_number', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $path = asset($row->profile_path);
                $nestedData['profile_path'] = "<img class='img-thumbnail' src='$path' alt='' style='width:60px'/>";
                $nestedData['phone_number'] = $row->phone_number;
                $nestedData['mobile_number'] = $row->mobile_number;
                $nestedData['email'] = $row->email;
                $nestedData['registration_number'] = $row->registration_number;
                $nestedData['vat_number'] = $row->vat_number;
                $nestedData['city'] = $row->city;
                $nestedData['country'] = $row->country;
                $nestedData['postal_code'] = $row->postal_code;
                $nestedData['pay_rate'] = $row->pay_rate;
                $nestedData['website'] = $row->website;
                $nestedData['is_active'] = $row->is_active == 1 ? "Active" : "Disabled";

                $id = $row->id;
                $del_link = route("admin.sub_contractor.destroy", ["sub_contractor" => $id]);
                $show_link = route("admin.sub_contractor.show", ["sub_contractor" => $row->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_subcontractor')){
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_subcontractor')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    <i class='fas fa-trash-alt'></i></button>";
                };
                $viewButton = '';
                if(hasPermission('subcontractor_list')){
                    $viewButton = "<a href='$show_link' title='show' class='ml-2 btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>";
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

    public function notesList(SubContractor $sub_contractor)
    {
        $notes = $sub_contractor->notes()->orderByDesc('id')->get();

        return view('admin.sub_contractor.notes.notes_list', compact('notes'))->render();
    }

    public function saveNotes(Request $request, SubContractor $sub_contractor)
    {
        $notes = new Notes();
        $notes->description = $request->description;

        if ($sub_contractor->notes()->save($notes)) {
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
