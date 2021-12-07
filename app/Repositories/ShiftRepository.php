<?php


namespace App\Repositories;


use App\Http\Requests\ShiftUpdateRequest;
use App\Models\Shift;
use App\Models\ShiftStaff;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ShiftRepository extends BaseRepository
{
    public function __construct(Shift $model)
    {
        parent::__construct($model);
    }

    public function storeShift(array $data)
    {
        $shift_data = array(
            'client_id' => $data['add_client_id'],
            'site_id' => $data['add_site_id'],
            'site_type_id' => $data['add_site_type_id'],
            'time_in' => $data['add_time_in'],
            'time_out' => $data['add_time_out'],
            'break_time_start' => $data['add_break_time_start'],
            'break_time_end' => $data['add_break_time_end'],
            'start_date' => $data['add_start_date'],
            'end_date' => $data['add_end_date'],
            'working_days' => json_encode($data['add_working_days']),
            'instructions' => $data['add_instructions'],
        );
        $shift = $this->create($shift_data);

        for ($i = 0; $i < count($data['add_staff_id']); $i++) {
            ShiftStaff::create([
                'shift_id' => $shift->id,
                'staff_id' => $data['add_staff_id'][$i],
                'pay_rate' => $data['add_staff_pay_rate'][$i],
                'shift_schedule' => $data['add_staff_shift_schedule'][$i],
                'time_in' => $data['add_staff_time_in'][$i],
                'time_out' => $data['add_staff_time_out'][$i],
                'break_time_start' => $data['add_staff_break_time_start'][$i],
                'break_time_end' => $data['add_staff_break_time_end'][$i],
            ]);
        }
        return $shift;
    }

    public function getShiftData(Request $request)
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
        $totalData = Shift::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Shift::with(['site', 'siteType', 'staff'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Shift::with(['site', 'siteType', 'staff','client'])
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
                $nestedData['client_id'] = ($row->client ? $row->client->name : null);
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
                $del_link = route("admin.shift.destroy", ["shift" => $id]);
                $csrf = csrf_token();

                $nestedData['options'] = "
<div class='btn-group' role='group'>
        <button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'>Edit</button>
       <form action='$del_link' method='POST' class='delete_form'>
        <input type='hidden' name='_token' value='$csrf'>
        <input type='hidden' name='_method' value='delete' />
        <button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
        Delete</button>
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

    public function updateShift(Request $request, Shift $shift)
    {

        $shift->client_id = $request->edit_client_id;
        $shift->site_id = $request->edit_site_id;
        $shift->site_type_id = $request->edit_site_type_id;
        $shift->time_in = $request->edit_time_in;
        $shift->time_out = $request->edit_time_out;
        $shift->break_time_start = $request->edit_break_time_start;
        $shift->break_time_end = $request->edit_break_time_end;
        $shift->start_date = $request->edit_start_date;
        $shift->end_date = $request->edit_end_date;
        $shift->end_date = $request->edit_end_date;
        $shift->instructions = $request->edit_instructions;
        $shift->working_days = json_encode($request->edit_working_days);
        $shift->save();
        $shift->staff()->delete();

        for ($i = 0; $i < count($request->edit_staff_id); $i++) {
            $shift_schedule = $request->edit_staff_shift_schedule[$i];
            ShiftStaff::create([
                'shift_id' => $shift->id,
                'staff_id' => $request->edit_staff_id[$i],
                'pay_rate' => $request->edit_staff_pay_rate[$i],
                'shift_schedule' => $shift_schedule,
                'time_in' => $shift_schedule == 'custom' ? $request->edit_staff_time_in[$i] : null,
                'time_out' => $shift_schedule == 'custom' ? $request->edit_staff_time_out[$i] : null,
                'break_time_start' => $shift_schedule == 'custom' ? $request->edit_staff_break_time_start[$i] : null,
                'break_time_end' => $shift_schedule == 'custom' ? $request->edit_staff_break_time_end[$i] : null,
            ]);
        }
    }

    public function deleteShift(Shift $shift)
    {
        $shift->staff()->delete();
        $shift->delete();
        return true;
    }
}
