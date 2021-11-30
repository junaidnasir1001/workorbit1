<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.sites.index');
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

                $nestedData['options'] = "
<div class='btn-group' role='group'>
<a href='$show_link' class='btn btn-sm btn-secondary ml-2'><i class='far fa-eye'></i></a>
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
