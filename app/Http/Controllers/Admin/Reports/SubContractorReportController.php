<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\SubContractor;
use Illuminate\Http\Request;

class SubContractorReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.sub_contractor.index');
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

                $nestedData['options'] = "
<div class='btn-group' role='group'>
<a href='$show_link' title='show' class='ml-2 btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>
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
