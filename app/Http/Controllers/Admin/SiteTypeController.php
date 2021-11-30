<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteType;
use Illuminate\Http\Request;

class SiteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.site_type.index');
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
            'is_active' => $request->add_is_active == 'on' ? 1 : 0,
        ];

        $exists = SiteType::where('name', $request->add_name)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Type Already existed');
            return response()->json($response, 403);
        }

        $client = SiteType::create($data);
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
     * @param \App\Models\SiteType $site_type
     * @return \Illuminate\Http\Response
     */
    public function show(SiteType $site_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SiteType $site_type
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteType $site_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SiteType $site_type
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, SiteType $site_type)
    {
        $site_type->name = $request->edit_name;
        $site_type->is_active = $request->edit_is_active == 'on' ? 1 : 0;

        if ($site_type->save()) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SiteType $site_type
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SiteType $site_type)
    {
        try {
            if ($site_type->delete()) {
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
            2 => 'is_active',
        );
        $totalData = SiteType::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = SiteType::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = SiteType::where('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = SiteType::where('name', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $row->name;
                $nestedData['is_active'] = $row->is_active == 1 ? 'Active' : 'Disable';

                $id = $row->id;
                $del_link = route("admin.site_type.destroy", ["site_type" => $id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_site_type')){
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_site_type')){
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
