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
     * @param \App\Http\Requests\SettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([

    //         'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    //         'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    //     ]);

    //     $count = Setting::count();
    //     if ($count == 0) {
    //         $input = $request->all();



    //         $image = $request->file('logo');
    //         if ($image) {
    //             $image_name = hexdec(uniqid());
    //             $ext = strtolower($image->getClientOriginalExtension());
    //             $image_full_name = $image_name . '.' . $ext;
    //             $upload_path = 'uploads/setting/';
    //             $image_url = $upload_path . $image_full_name;
    //             $success = $image->move($upload_path, $image_full_name);
    //             $input['logo'] = $image_url;
    //         }
    //         $image = $request->file('favicon');
    //         if ($image) {
    //             $image_name = hexdec(uniqid());
    //             $ext = strtolower($image->getClientOriginalExtension());
    //             $image_full_name = $image_name . '.' . $ext;
    //             $upload_path = 'uploads/setting/';
    //             $image_url = $upload_path . $image_full_name;
    //             $success = $image->move($upload_path, $image_full_name);
    //             $input['favicon'] = $image_url;
    //         }
    //         Setting::create($input);
    //     } else {
    //         $firstdata = Setting::first();
    //         $setting = Setting::findOrFail($firstdata->id);
    //         // return response()->json($setting);
    //         $input = $request->all();



    //         $image = $request->file('logo');
    //         if ($image) {
    //             $image_name = hexdec(uniqid());
    //             $ext = strtolower($image->getClientOriginalExtension());
    //             $image_full_name = $image_name . '.' . $ext;
    //             $upload_path = 'uploads/setting/';
    //             $image_url = $upload_path . $image_full_name;
    //             $success = $image->move($upload_path, $image_full_name);
    //             $input['logo'] = $image_url;

    //             if (file_exists($setting->logo)) {
    //                 unlink(public_path($setting->logo));
    //             }
    //         }
    //         if ( $image = $request->file('favicon')) {
    //             if (file_exists($setting->favicon )) {
    //                 unlink(public_path($setting->favicon));
    //             }
    //             $image_name = hexdec(uniqid());
    //             $ext = strtolower($image->getClientOriginalExtension());
    //             $image_full_name = $image_name . '.' . $ext;
    //             $upload_path = 'uploads/setting/';
    //             $image_url = $upload_path . $image_full_name;
    //             $success = $image->move($upload_path, $image_full_name);
    //             $input['favicon'] = $image_url;


    //         }


    //         $setting->update($input);
    //     }

    //     return redirect()->route('setting.index')
    //         ->with('success', 'Settings created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|array',
        ]);

        foreach ($request->key as $key => $value) {
            if ($key == 'logo' || $key == 'favicon') {
                // Process image upload

                $setting = Setting::where('key', $key)->first();
                if ($setting && file_exists(public_path($setting->value))) {
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
