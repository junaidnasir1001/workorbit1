<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPermission extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permission::all();
        $users = Admin::where('type', '=', 'manager')->orWhere('type', '=', 'controller')->get();
        return view('admin.user_permission.index', get_defined_vars());
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
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {

        $permissions_encode = json_encode($request->permissions);
        $data = [
            'permissions' => $permissions_encode,
        ];
        $admin_id = $request->admin_id;
        $x = DB::table('admins')
            ->where('id', $admin_id)
            ->update($data);
        if ($x) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function edit($user_permission)
    {
        $user = Admin::find($user_permission);
        $permissions = permission::all();

        $users = Admin::where('type', 'manager')
            ->orWhere('type', 'controller')->get();

        return view('admin.user_permission.edit_data',
            compact('user', 'users', 'permissions'))
            ->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_permission)
    {
        $user= Admin::find($user_permission);
        $user->permissions=null;
        $user->save();
        $response = array('status' => 'success', 'message' => 'Permission Deleted Successfully');
        return response()->json($response, 200);
    }

    public function showData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'permissions',

        );
        $totalData = Admin::where('permissions', '!=', null)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Admin::where('permissions', '!=', null)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Admin::where('permissions', '!=', null)->
            where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Admin::where('permissions', '!=', null)
                ->where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $permissions = "";
                if(!empty($row->permissions)){
                foreach (json_decode($row->permissions) as $permission) {
                    $permissions .= "<span class='badge badge-primary m-1' > " . $permission . "</span > ";

                }
            }
                $nestedData['permissions'] = $permissions;


                $id = $row->id;
                $del_link = route("admin.user_permission.destroy", ["user_permission" => $id]);
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
