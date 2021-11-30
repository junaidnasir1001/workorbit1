<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffTraining;
use Illuminate\Http\Request;

class StaffTrainingController extends Controller
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
            StaffTraining::create([
                "staff_id" => $staff->id,
                "training_provider_name" => $request->add_training_provider_name,
                "course_name" => $request->add_training_course_name,
                "certificate_obtained" => $request->add_training_certificate_obtained,
                "start_date" => $request->add_training_start_date,
                "end_date" => $request->add_training_end_date,
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
     * @param \App\Models\StaffTraining $staffTraining
     * @return \Illuminate\Http\Response
     */
    public function show(StaffTraining $staffTraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StaffTraining $staffTraining
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffTraining $staffTraining)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StaffTraining $staffTraining
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, StaffTraining $staff_training)
    {
        try {
            $staff_training->training_provider_name = $request->edit_training_provider_name;
            $staff_training->course_name = $request->edit_training_course_name;
            $staff_training->certificate_obtained = $request->edit_training_certificate_obtained;
            $staff_training->start_date = $request->edit_training_start_date;
            $staff_training->end_date = $request->edit_training_end_date;
            $staff_training->save();
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
     * @param \App\Models\StaffTraining $staffTraining
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Staff $staff, StaffTraining $staff_training)
    {
        try {
            if ($staff_training->delete()) {
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
            1 => 'training_provider_name',
            2 => 'course_name',
            3 => 'certificate_obtained',
            4 => 'start_date',
            5 => 'end_date',
        );
        $totalData = StaffTraining::where('staff_id', $staff->id)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = StaffTraining::where('staff_id', $staff->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = StaffTraining::where('staff_id', $staff->id)
                ->where('training_provider_name', 'LIKE', "%{$search}%")
                ->orWhere('course_name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = StaffTraining::where('staff_id', $staff->id)
                ->where('training_provider_name', 'LIKE', "%{$search}%")
                ->orWhere('course_name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['training_provider_name'] = $row->training_provider_name;
                $nestedData['course_name'] = $row->course_name;
                $nestedData['certificate_obtained'] = $row->certificate_obtained;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['end_date'] = $row->end_date;

                $id = $row->id;
                $del_link = route("admin.staff_training.destroy", ["staff_training" => $id, "staff" => $staff->id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_training')){
                    $editButton = "<button title='Edit' class='edit_training_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_training')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    Delete</button>";
                };
                $nestedData['options'] = "
        <div class='btn-group' role='group'>
        $editButton
        <form action='$del_link' method='POST' class='delete_training_form'>
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
