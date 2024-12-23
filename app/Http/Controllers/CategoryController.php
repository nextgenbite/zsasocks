<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $title = ["Category", 'category'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =$this->title;
        $index = Category::latest()->get();
        // return response()->json($index);
        return view('admin.category.index', compact('index', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =$this->title;
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $request->all();
        $image = $request->file('thumbnail');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/'.$this->title[1].'/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
        }
        $category['slug'] =  Str::slug($request->category_name);
        $category['thumbnail'] =  $image_url ?? null;
        Category::create($category);

        $notification = array(
            'messege' => 'category is create successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/category')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title =$this->title;
        return view('admin.category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        if ($image = $request->file('thumbnail')) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/'.$this->title[1].'/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            if (file_exists($category->thumbnail)) {
                unlink(public_path($category->thumbnail));
            }
        }
        $data['slug'] =  Str::slug($request->category_name);
        $data['thumbnail'] =  $image_url ?? $category->thumbnail;
        $category->update($data);
        
        $notification = array(
            'messege' => 'category is update successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (file_exists($category->thumbnail)) {
            unlink(public_path($category->thumbnail));
        }
        $category->delete();

        $notification = array(
            'messege' => 'Data is Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function active(Category $category, $id)
    {
        $active = $category->whereId($id)->update(['category_status' => 1]);
        //return response()->json($active);
        if ($active) {
            $notification = array(
                'messege' => 'Actived is successfully!',
                'alert-type' => 'success'
            );
        };
        return  Redirect()->back()->with($notification);
    }
    public function inActive(Category $category, $id)
    {
        $inactive =   $category->whereId($id)->update(['category_status' => 0]);
        if ($inactive) {
            $notification = array(
                'messege' => 'Deactived is successfully!',
                'alert-type' => 'error'
            );
        };
        return  Redirect()->back()->with($notification);
    }
}
