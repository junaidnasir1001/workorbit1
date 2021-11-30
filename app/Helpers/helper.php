<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('hasPermission')) {

    function hasPermission($permission)
    {
        if (!Auth::check()) {
            return false;
        }

        if (Auth::guard('admin')->user()->type == 'admin') {
            return true;
        }

        $permissions = json_decode(Auth::guard('admin')->user()->permissions, true);
        if (is_null($permissions) || empty($permissions)) {
            return false;
        }
        return in_array($permission, $permissions) ? true : false;
    }

}
