<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


/**
 * Class ClientsController
 * @package App\Http\Controllers\Admin
 */
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permission.index');
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
            'slug' => Str::slug($request->add_name),
            
            
        ];
        $exists = permission::where('name', $request->add_name)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Type Already existed');
            return response()->json($response, 403);
        }

        $client = permission::create($data);
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
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        $permission->name = $request->edit_name;
        $permission->slug =  Str::slug($request->edit_name);
        


        if ($permission->save()) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        try {
            if ($permission->delete()) {
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
            2 => 'slug',
            
        );
        $totalData = permission::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = permission::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = permission::where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = permission::where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $nestedData['slug'] = $row->slug;
                
                $id = $row->id;
                $del_link = route("admin.permission.destroy", ["permission" => $id]);
                $csrf = csrf_token();

                $nestedData['options'] = "
<div class='btn-group' role='group'>
        <button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>
       <form action='$del_link' method='POST' class='delete_form'>
        <input type='hidden' name='_token' value='$csrf'>
        <input type='hidden' name='_method' value='delete' />
        <button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
        <i class='fas fa-trash-alt'></i></button>
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
