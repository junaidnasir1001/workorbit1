<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftRequest;
use App\Http\Requests\ShiftUpdateRequest;
use App\Interfaces\ShiftInterface;
use App\Models\Clients;
use App\Models\Shift;
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
class ShiftController extends Controller
{
    /**
     * @var ShiftInterface
     */
    private $shift;

    /**
     * ShiftController constructor.
     * @param ShiftInterface $shift
     */
    public function __construct(ShiftInterface $shift)
    {
        $this->shift = $shift;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        $site_types = SiteType::isActive()->get();
        $staffs = Staff::isActive()->get();
        $clients = Clients::get();
        $working_days = Shift::workingDays();
        return view('admin.shift.index', get_defined_vars());
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
    public function store(ShiftRequest $request)
    {
        $this->shift->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Shift $shift
     * @return string
     */
    public function edit(Shift $shift)
    {
        $sites = Site::all();
        $site_types = SiteType::isActive()->get();
        $staffs = Staff::isActive()->get();
        $working_days = Shift::workingDays();
        $clients = Clients::get();
        return view('admin.shift.edit', get_defined_vars())->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shift $shift
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftUpdateRequest $request, Shift $shift)
    {
        return $this->shift->update($request, $shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shift $shift
     * @return string
     */
    public function destroy(Shift $shift)
    {
        try {
            return $this->shift->delete($shift);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     */
    public function showData(Request $request)
    {
        return $this->shift->showData($request);
    }
}
