<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    public function index()
    {

        // return Product::whereTop(true)->orderBy('priority', 'asc')->get();
        $categories = Category::whereCategory_status(true)->whereNull('parent_id')->get(['id', 'slug', 'category_name', 'thumbnail']);
        
        // Fetching recent, trend, and top products in a single query
        $productsQuery = Product::query();

   

     
        // Paginating all products with status true
        $products = $productsQuery->whereStatus(true)->latest()->get();
        // $products = $productsQuery->whereStatus(true)->latest()->paginate(18);
        $sliders = Slider::whereSlider_status(true)->limit(5)->get();
        $reviews = Review::whereStatus(1)->latest()->get();
        return view('frontend.index', compact('categories', 'products', 'sliders',  'reviews'));
    }
    public function ProductDetails($slug)
    {
        $product = Product::whereStatus(true)->whereSlug($slug)->first();
        $cat_id = $product->category_id;
        $relatedProduct = Product::whereStatus(true)->where('category_id', $cat_id)->where('id', '!=', $product->id)->latest()->get();
        // return response()->json($relatedProduct);
        return view('frontend.view', compact('product', 'relatedProduct'));
    }
    public function categoryWiseProduct($slug)
    {
        // Find the category or subcategory based on the slug
        $category = Category::where('category_status', true)
            ->where('slug', $slug)
            ->with('children.products')
            ->firstOrFail();
    
        // Fetch all products directly from the category and its children, if any
        $productsQuery = $category->products();
    
        if ($category->children->isNotEmpty()) {
            $productsQuery->orWhereIn('category_id', $category->children->pluck('id'));
        }
    
        // Paginate the products
        $perPage = 24;
        $paginatedProducts = $productsQuery->paginate($perPage);
    
        $paginatedProducts->appends(['slug' => $slug]); // Append slug to pagination links
    
        return view('frontend.categories', compact('category', 'paginatedProducts'));
    }
    
    public function prodcutSearch(Request $request)
    {

        $products = Product::whereStatus(true)->where('product_name', 'LIKE', '%' . $request->q . '%')
        ->orwhere('sku','LIKE','%' . $request->q . '%')
        ->orwhere('short_descp_en','LIKE','%' . $request->q . '%')
        ->paginate(24);
        return view('product_search', compact('products'));
    }
    public function ajaxSearch(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('status', true)
            ->where(function ($query) use ($search) {
                $query->where('product_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_descp_en', 'LIKE', '%' . $search . '%');
            })
            ->paginate(24);
        if ($products->isEmpty()) {
            // If no products are found, return '0'
            return '0';
        } else {
            return view('frontend.partials.search_content', compact('products'));
        }
    }
    public function page($slug)
    {
        $data = Page::whereStatus(true)->whereSlug($slug)->first();

        return view('frontend.page', compact('data'));
    }
    public function subCategory(Request $request)
    {
        $subcategories = Category::whereCategory_status(true)->whereParent_id($request->id)->get();

        return view('frontend.partials.nav_element', compact('subcategories'));
    }
    
}
