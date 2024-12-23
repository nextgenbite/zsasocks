<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $title = ["Product", 'product'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =$this->title;
        $index = Product::select(['id', 'product_name', 'status', 'selling_price', 'product_image', 'category_id'])
            ->with('category:id,category_name')
            // ->latest()
            ->get();
        // return response()->json($index);
        return view('admin.product.index', compact('index', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =$this->title;
        $categories = Category::select('id', 'parent_id', 'category_name')->get();
        return view('admin.product.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_name' => 'required',
            'selling_price' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'multi_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'color' => 'required',
            'size' => 'required',
        ]);

        $image = $request->file('product_image');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/product/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name),
            'product_qty' => $request->product_qty,
            'sku' => $request->sku,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'color' => json_encode(explode(',', $validatedData['color'])),
            'size' => json_encode(explode(',', $validatedData['size'])),
            'product_image' => $image_url,
            'video' => $request->video,
        ]);
        if (request()->hasFile('multi_image')) {
            $images = request()->File('multi_image');

            foreach ($images as $image) {

                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'images/multi-image/';
                $image_url = $upload_path . $image_full_name;
                $image->move($upload_path, $image_full_name);
                $product->images()->create([
                    'path' => $image_url,
                ]);
            }
        }

        if ($product) {
            $notification = array(
                'messege' => 'Successfully Product Inserted',
                'alert-type' => 'success'
            );
            return Redirect('/admin/product')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $title =$this->title;
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'multi_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            // 'color' => 'required',
            // 'size' => 'required',
        ]);



        if ($image = $request->file('product_image')) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/product/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            if (file_exists($product->product_image)) {
                unlink(public_path($product->product_image));
            }
        }

        if ($request->hasFile('multi_image')) {
            $existingImages = $product->images()->get(); // Get all existing images for the product

            foreach ($existingImages as $image) {
                $imagePath = $image->path;
                if (file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
                $image->delete();
            }
            foreach ($request->file('multi_image') as $img) {
                $image_name = hexdec(uniqid());
                $ext = strtolower($img->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'images/multi-image/';
                $multi_image_url = $upload_path . $image_full_name;
                $img->move(public_path($upload_path), $image_full_name);

                $product->images()->create([
                    'path' => $multi_image_url,
                ]);
            }
        }
        $getProduct = $product->update([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name),
            'product_qty' => $request->product_qty,
            'sku' => $request->sku,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'color' => json_encode(explode(',', $request['color'])),
            'size' => json_encode(explode(',', $request['size'])),
            'product_image' => $image_url ?? $product->product_image,
            'video' => $request->video,
            'trend' => $request->trend,
            'top' => $request->top,
            'priority' => $request->priority,
            'point' => $request->point,
        ]);
        // $this->storeImage($getProduct);

        if ($getProduct) {
            $notification = array(
                'messege' => 'Data is Updated!',
                'alert-type' => 'info'
            );
        };
        return redirect('/admin/product')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (file_exists($product->product_image)) {
            unlink(public_path($product->product_image));
        }

        $image = $product->images()->first(); // Get the first image in the relationship
        if ($image) {
            $imagePath = $image->path;
            if (file_exists($imagePath)) {
                unlink(public_path($imagePath));
            }
            $image->delete();
        }

        $delete = $product->delete();

        if ($delete) {
            $notification = array(
                'messege' => 'Data is Deleted!',
                'alert-type' => 'error'
            );
        };
        return  Redirect()->back()->with($notification);
    }

    private function storeImage($product)
    {
        if (request()->hasFile('multi_image')) {
            $images = request()->File('multi_image');

            foreach ($images as $image) {

                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'images/multi-image/';
                $image_url = $upload_path . $image_full_name;
                $image->move($upload_path, $image_full_name);
                if (file_exists($product->images()->path)) {
                    unlink(public_path($product->images()->path));
                }
                $product->images()->update([
                    'path' => $image_url,
                ]);
            }
        }
    }
    public function active(Product $product, $id)
    {
        $active = $product->whereId($id)->update(['status' => 1]);
        //return response()->json($active);
        if ($active) {
            $notification = array(
                'messege' => 'Actived is successfully!',
                'alert-type' => 'success'
            );
        };
        return  Redirect()->back()->with($notification);
    }
    public function inActive(Product $product, $id)
    {
        $inactive =   $product->whereId($id)->update(['status' => 0]);
        if ($inactive) {
            $notification = array(
                'messege' => 'Deactived is successfully!',
                'alert-type' => 'error'
            );
        };
        return  Redirect()->back()->with($notification);
    }
}
