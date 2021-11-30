<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Site;
use App\Models\Staff;
use App\Models\SubContractor;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total_clients = Clients::count();
        $total_sites = Site::count();
        $total_sub_contractor = SubContractor::count();
        $total_staff = Staff::count();
        return view('admin.home', get_defined_vars());
    }
}
