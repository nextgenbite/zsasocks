<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.setting.index', compact('settings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|array',
        ]);

        foreach ($request->key as $key => $value) {
            if ($key == 'logo' || $key == 'favicon') {
                // Process image upload

                $setting = Setting::where('key', $key)->first();
                if ($setting && $setting->value && file_exists(public_path($setting->value)) && is_file(public_path($setting->value))) {
                    unlink(public_path($setting->value));
                }
                $image_name = hexdec(uniqid());
                $ext = strtolower($value->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'images/setting/';
                $image_url = $upload_path . $image_full_name;
                $success = $value->move($upload_path, $image_full_name);

                // Assign image URL to $value
                $value = $image_url;
            }

            // Store configuration setting
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $notification = [
            'message' => 'Settings Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
