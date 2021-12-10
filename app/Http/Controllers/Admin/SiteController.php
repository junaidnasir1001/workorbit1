<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\ShiftStaff;
use App\Models\Site;
use App\Models\Designation;
use App\Models\SiteChargeRateCard;
use App\Models\SitePayRateCard;
use App\Models\SiteStaff;
use App\Models\SiteType;
use App\Models\Staff;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Clients::all();
        return view('admin.site.index', get_defined_vars());
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
            'client_id' => $request->add_client_id,
            'name' => $request->add_name,
            'address' => $request->add_address,
            'postal_code' => $request->add_postal_code,
            'city' => $request->add_city,
            'start_date' => $request->add_start_date,
            'finish_date' => $request->add_finish_date,
            'longitude' => $request->add_longitude,
            'latitude' => $request->add_latitude,
        ];

        $exists = Site::where('name', $request->name)
            ->where('client_id', $request->add_client_id)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Type Already existed');
            return response()->json($response, 403);
        }

        $site = Site::create($data);
        if ($site) {
            $response = array('status' => 'success', 'message' => 'Data Inserted Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not inserted try again');
        return response()->json($response, 403);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        $sitetypes = SiteType::isActive()->get();
        $clients = Clients::all();
        $designations = Designation::active()->get();
        $staffs = Staff::isActive()->get();

        return view('admin.site.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site)
    {
        $site->name = $request->edit_name;
        $site->client_id = $request->edit_client_id;
        $site->address = $request->edit_address;
        $site->postal_code = $request->edit_postal_code;
        $site->city = $request->edit_city;
        $site->start_date = $request->edit_start_date;
        $site->finish_date = $request->edit_finish_date;
        $site->longitude = $request->edit_longitude;
        $site->latitude = $request->edit_latitude;

        if ($site->save()) {
            $response = array('status' => 'success', 'message' => 'Data Updated Successful', 'site' => $site);
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site)
    {
        try {
            if ($site->delete()) {
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
            2 => 'address',
            3 => 'postal_code',
            4 => 'city',
            5 => 'start_date',
            6 => 'finish_date',
            7 => 'longitude',
            8 => 'latitude',
        );
        $totalData = Site::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Site::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Site::where('name', 'LIKE', "%{$search}%")
                ->orWhere('postal_code', 'LIKE', "%{$search}%")
                ->orWhere('city', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Site::where('name', 'LIKE', "%{$search}%")
                ->orWhere('postal_code', 'LIKE', "%{$search}%")
                ->orWhere('city', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['client_id'] = $row->client->name;
                $nestedData['name'] = $row->name;
                $nestedData['address'] = $row->address;
                $nestedData['postal_code'] = $row->postal_code;
                $nestedData['city'] = $row->city;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['finish_date'] = $row->finish_date;
                $nestedData['longitude'] = $row->longitude;
                $nestedData['latitude'] = $row->latitude;

                $id = $row->id;
                $del_link = route("admin.site.destroy", ["site" => $id]);
                $show_link = route("admin.site.show", ["site" => $id]);
                $csrf = csrf_token();

                $editButton = '';
                if(hasPermission('edit_site')){
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if(hasPermission('delete_site')){
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    <i class='fas fa-trash-alt'></i></button>";
                };
                $viewButton = '';
                if(hasPermission('site_list')){
                    $viewButton = "<a href='$show_link' class='btn btn-sm btn-secondary ml-2'><i class='far fa-eye'></i></a>";
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

    public function preferred_staff_add(Request $request){
        $staff = new SiteStaff();
        $staff->staff_id = $request->add_prefferd_staff_id;
        $staff->site_id = $request->site_idd;
        $staff->type = 'preferred';
        $staff->save();

        return redirect()->back();
    }
    public function banned_staff_add(Request $request){
        $staff = new SiteStaff();
        $staff->staff_id = $request->add_banned_staff_id;
        $staff->site_id = $request->banned_site_id;
        $staff->type = 'banned';
        $staff->save();

        return redirect()->back();
    }

    public function delete_site_staff(Request $request){
        $staff = SiteStaff::find($request->delete_site_satff_modal);

        $staff->delete();

        return redirect()->back();
    }

}
