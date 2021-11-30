<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftRequest;
use App\Http\Requests\ShiftUpdateRequest;
use App\Interfaces\ShiftInterface;
use App\Models\Shift;
use App\Models\ShiftStaff;
use App\Models\Site;
use App\Models\SiteType;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * Class ShiftController
 * @package App\Http\Controllers\Admin
 */
class ShiftReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.shifts.index');
    }

    /**
     * @param Request $request
     */
    public function showData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'site_id',
            2 => 'site_type_id',
            3 => 'time_in',
            4 => 'time_out',
            5 => 'break_time_start',
            6 => 'break_time_end',
            7 => 'start_date',
            8 => 'end_date',
            9 => 'working_days',
        );
        $totalData = Shift::where('start_date', '<=', now())
            ->where('end_date', '>', now())
            ->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Shift::with(['site', 'siteType', 'staff'])
                ->where('start_date', '<=', now())
                ->where('end_date', '>', now())
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Shift::with(['site', 'siteType', 'staff'])
                ->where('start_date', '<=', now())
                ->where('end_date', '>', now())
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Shift::count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['site_id'] = $row->site->name;
                $nestedData['site_type_id'] = $row->siteType->name;
                $nestedData['time_in'] = $row->time_in;
                $nestedData['time_out'] = $row->time_out;
                $nestedData['break_time_start'] = $row->break_time_start;
                $nestedData['break_time_end'] = $row->break_time_end;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['end_date'] = $row->end_date;
                $working_days = "";
                foreach (json_decode($row->working_days) as $days) {
                    $working_days .= "<small class='badge badge-primary ml-1'>" . $days . "</small>";
                }
                $nestedData['working_days'] = $working_days;

                $id = $row->id;
                $link = route("admin.report.shift.detail", ["shift" => $id]);
                $csrf = csrf_token();

                $nestedData['options'] = "
<div class='btn-group' role='group'>
        <a href='$link' title='view detail' class='btn btn-info btn-sm'><i class='far fa-eye'></i></a>
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

    /**
     * @param Request $request
     */
    public function totalShiftList(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $shift = Shift::query();
        if (!is_null($request->start_date) && !is_null($request->end_date)) {
            $shift = $shift->with(['site', 'siteType', 'staff'])->where('start_date', '<=', $start_date)->where('end_date', '>', $end_date);
        } else {
            $shift = $shift->with(['site', 'siteType', 'staff']);
        }

        $columns = array(
            0 => 'id',
            1 => 'site_id',
            2 => 'site_type_id',
            3 => 'time_in',
            4 => 'time_out',
            5 => 'break_time_start',
            6 => 'break_time_end',
            7 => 'start_date',
            8 => 'end_date',
            9 => 'working_days',
        );
        $totalData = $shift->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = $shift
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = $shift
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $shift->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['site_id'] = $row->site->name;
                $nestedData['site_type_id'] = $row->siteType->name;
                $nestedData['time_in'] = $row->time_in;
                $nestedData['time_out'] = $row->time_out;
                $nestedData['break_time_start'] = $row->break_time_start;
                $nestedData['break_time_end'] = $row->break_time_end;
                $nestedData['start_date'] = $row->start_date;
                $nestedData['end_date'] = $row->end_date;
                $working_days = "";
                foreach (json_decode($row->working_days) as $days) {
                    $working_days .= "<small class='badge badge-primary ml-1'>" . $days . "</small>";
                }
                $nestedData['working_days'] = $working_days;

                $id = $row->id;
                $link = route("admin.report.shift.detail", ["shift" => $id]);
                $csrf = csrf_token();

                $nestedData['options'] = "
<div class='btn-group' role='group'>
        <a href='$link' title='view detail' class='btn btn-info btn-sm'>View</a>
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

    public function shiftDetails(Shift $shift)
    {
        $shift_staff = ShiftStaff::with(['staff'])
            ->where('shift_id', $shift->id)
            ->get();
        return view('admin.reports.shifts.shift_detail', get_defined_vars());
    }

    public function totalShift()
    {
        return view('admin.reports.shifts.total_shifts');
    }
}
