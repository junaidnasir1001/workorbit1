<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffEducation;
use App\Models\StaffEmployment;
use Illuminate\Http\Request;

class StaffEducationController extends Controller
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
            StaffEducation::create([
                "staff_id" => $staff->id,
                "institution" => $request->add_education_institution,
                "speciality" => $request->add_education_speciality,
                "degree_obtained" => $request->add_education_degree_obtained,
                "city" => $request->add_education_city,
                "country" => $request->add_education_country,
                "start_date" => $request->add_education_start_date,
                "end_date" => $request->add_education_end_date,
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
     * @param \App\Models\StaffEducation $staffEducation
     * @return \Illuminate\Http\Response
     */
    public function show(StaffEducation $staffEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffEducation $staffEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffEducation $staffEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffEducation $staffEducation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffEducation $staff_education)
    {
        try {
            $staff_education->institution = $request->edit_education_institution;
            $staff_education->speciality = $request->edit_education_speciality;
            $staff_education->degree_obtained = $request->edit_education_degree_obtained;
            $staff_education->city = $request->edit_education_city;
            $staff_education->country = $request->edit_education_country;
            $staff_education->start_date = $request->edit_education_start_date;
            $staff_education->end_date = $request->edit_education_end_date;

            $staff_education->save();
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
     * @param \App\Models\StaffEducation $staff_education
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffEducation $staff_education)
    {
        try {
            if ($staff_education->delete()) {
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
            1 => 'institution',
            2 => 'speciality',
            3 => 'degree_obtained',
            4 => 'city',
            6 => 'country',
            7 => 'start_date',
            8 => 'end_date',
        );
        $totalData = StaffEducation::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffEducation::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffEducation::where('staff_id', $staff->id)
                ->where('institution', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffEducation::where('staff_id', $staff->id)
                ->where('institution', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['institution'] = $row->institution;
                $nestedData['speciality'] = $row->speciality;
                $nestedData['degree_obtained'] = $row->degree_obtained;
                $nestedData['city'] = $row->city;
                $nestedData['country'] = $row->country;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['end_date'] = $row->end_date;

                $id = $row->id;
                $del_link = route("admin.staff_education.destroy", ["staff_education" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_education')){
                    $editButton = "<button title='Edit' class='edit_education_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_education')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
        <div class='btn-group' role='group'>
        $editButton
        <form action='$del_link' method='POST' class='delete_education_form'>
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
