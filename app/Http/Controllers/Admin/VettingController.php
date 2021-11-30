<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vetting;
use Illuminate\Http\Request;

class VettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vetting.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->add_name,
        ];

        $exists = Vetting::where('name', $request->add_name)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Type Already existed');
            return response()->json($response, 403);
        }

        $client = Vetting::create($data);
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
     * @param  \App\Models\Vetting  $vetting
     * @return \Illuminate\Http\Response
     */
    public function show(Vetting $vetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vetting  $vetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Vetting $vetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vetting  $vetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vetting $vetting)
    {
        $vetting->name = $request->edit_name;


        if ($vetting->save()) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vetting  $vetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vetting $vetting)
    {
        try {
            if ($vetting->delete()) {
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
        );
        $totalData = Vetting::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Vetting::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Vetting::where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Vetting::where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;

                $id = $row->id;
                $del_link = route("admin.vetting.destroy", ["vetting" => $id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_staff_vetting')){
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_staff_vetting')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    <i class='fas fa-trash-alt'></i></button>";
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
