<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class StaffReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.staff.index');
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

                $nestedData['options'] = "
<div class='btn-group' role='group'>
<a href='$show_link' title='Edit' class='edit_data ml-2 btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>
</div>";
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
