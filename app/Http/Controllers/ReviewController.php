<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public $title = ["Review", 'review'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =$this->title;
        $index = Review::latest()->get();
        // return response()->json($index);
        return view('admin.review.index', compact('index', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =$this->title;
        return view('admin.review.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = $request->all();
        $image = $request->file('path');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/'.$this->title[1].'/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
        }
        $review['path'] =  $image_url ?? null;
        Review::create($review);

        $notification = array(
            'messege' => 'review is create successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/review')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $title =$this->title;
        $data = $review;
        return view('admin.review.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $data = $request->all();
        if ($image = $request->file('path')) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/'.$this->title[1].'/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            if (file_exists($review->path)) {
                unlink(public_path($review->path));
            }
        }
        $data['path'] =  $image_url ?? $review->path;
        $review->update($data);
        
        $notification = array(
            'messege' => 'review is update successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/review')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if (file_exists($review->path)) {
            unlink(public_path($review->path));
        }
        $review->delete();

        $notification = array(
            'messege' => 'Data is Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function active(Review $review, $id)
    {
        $active = $review->whereId($id)->update(['status' => 1]);
        //return response()->json($active);
        if ($active) {
            $notification = array(
                'messege' => 'Actived is successfully!',
                'alert-type' => 'success'
            );
        };
        return  Redirect()->back()->with($notification);
    }
    public function inActive(Review $review, $id)
    {
        $inactive =   $review->whereId($id)->update(['status' => 0]);
        if ($inactive) {
            $notification = array(
                'messege' => 'Deactived is successfully!',
                'alert-type' => 'error'
            );
        };
        return  Redirect()->back()->with($notification);
    }
}
