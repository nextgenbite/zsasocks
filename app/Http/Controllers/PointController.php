<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Setting;
use Illuminate\Http\Request;

class PointController extends Controller
{
     /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $data = Point::all()->pluck('point', 'name');

        return view('admin.point.index', compact('data', 'settings'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|array',
        ]);

        foreach ($request->key as $key => $value) {
 

            // Store configuration setting
            Point::updateOrCreate(
                ['name' => $key],
                ['point' => $value]
            );
        }

        $notification = [
            'message' => 'Point Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
