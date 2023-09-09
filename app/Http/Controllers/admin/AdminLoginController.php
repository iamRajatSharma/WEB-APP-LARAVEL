<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            // now authenticate user
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remeber'))) {
                $admin = Auth::guard('admin')->user();

                if ($admin->role == "admin") {
                    return redirect(route('admin.dashboard'));
                } else {
                    Auth::guard('admin')->logout();
                    return redirect(route('admin.login'))->with('error', "Either email/password is incorrect");
                }
            } else {
                return redirect(route('admin.login'))->with('error', "Either email/password is incorrect");;
            }
        } else {
            return back()->withInput($request->only('email'))->withErrors($validator);
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
