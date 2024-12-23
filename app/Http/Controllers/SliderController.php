<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public $title = ["Slider", 'slider'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =$this->title;
        $index =Slider::latest()->get();
        // return response()->json($index);
         return view('admin.slider.index', compact('index', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =$this->title;
        return view('admin.slider.create', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $image=$request->file('slider_image');
            if ($image) {
                $image_name=hexdec(uniqid());
                $ext=strtolower($image->getClientOriginalExtension());
                $image_full_name=$image_name.'.'.$ext;
                $upload_path='images/slider/';
                $image_url=$upload_path.$image_full_name;
                $success=$image->move($upload_path,$image_full_name);
                $input['slider_image']=$image_url;



        }
        // return response()->json($input);

           $slider =slider::create($input);


         if ($slider) {
            $notification=array(
               'messege'=>'Successfully Slider Inserted',
               'alert-type'=>'success'
                );
              return Redirect('/admin/slider')->with($notification);
       }else{
             $notification=array(
               'messege'=>'Something went wrong!',
               'alert-type'=>'error'
                );
              return Redirect()->back()->with($notification);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if(file_exists($slider->slider_image)){
            unlink(public_path($slider->slider_image));

        }
        $delete=  $slider->delete();
        if ($delete) {
            $notification=array(
                'messege'=>'Data is Deleted!',
                'alert-type'=>'error'
                );
            };
        return  Redirect()->back()->with($notification);
    }

    public function active(Slider $slider, $id)
    {
       $active=$slider->whereId($id)->update(['slider_status'=> 1]);
        //return response()->json($active);
        if ($active) {
            $notification=array(
                'messege'=>'Actived is successfully!',
                'alert-type'=>'success'
                );
            };
            return  Redirect()->back()->with($notification);
    }
    public function inActive(Slider $slider,$id)
    {
        $inactive=  $slider->whereId($id)->update(['slider_status'=> 0]);
     if ($inactive) {
        $notification=array(
            'messege'=>'Deactived is successfully!',
            'alert-type'=>'error'
            );
        };
        return  Redirect()->back()->with($notification);

    }
}
