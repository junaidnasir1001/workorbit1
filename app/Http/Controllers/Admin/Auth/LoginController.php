<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function checkLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arrCredentials = [
            'email' => $request->input("email"),
            'password' => $request->input("password"),
        ];

        $admin = \App\Models\Admin::where('email', '=', $request->email)->first();

        if ($admin && Auth::guard('admin')->attempt($arrCredentials, $request->input("remember"))) {
            return redirect()->route('admin.home');
        }

        $validator->getMessageBag()->add('error', 'Credentials not matched');

        return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
    }

    public function adminLogout()
    {
        if (Auth::guard("admin")->check()) {
            Auth::guard("admin")->logout();
        }
        return redirect()->route('admin.login');
    }
}
