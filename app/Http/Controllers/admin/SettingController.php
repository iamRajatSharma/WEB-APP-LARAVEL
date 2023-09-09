<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1)->first();
        return view('admin.setting', ['setting' => $setting]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $setting = Setting::find(1);
        if ($setting == null) {
        } else {
            // $setting = new Setting();
            $setting->website_title     = $request->name;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->instagram = $request->instagram;
            $setting->contact_card_1 = $request->card1;
            $setting->contact_card_2 = $request->card2;
            $setting->contact_card_3 = $request->card3;

            if ($setting->save()) {
                return redirect(route('setting'))->with(['type' => 'success', 'message' => 'Data Saved Successfully']);
            } else {
                return redirect(route('setting'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
            }
        }
    }
}
