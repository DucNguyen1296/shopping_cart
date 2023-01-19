<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Event;
use App\Models\LikeProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeProductController extends Controller
{
    //
    public function like_product($id)
    {
        $like = new LikeProduct();
        $like->customer_id = Auth::user()->id;
        $like->product_id = $id;
        $like->save();
        return redirect()->back();
    }

    public function delete_like_product($id)
    {
        $like = LikeProduct::where('product_id', $id)->first();
        $like->delete();
        return response()->json();
        // return redirect()->back();
    }

    public function show_like_product()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $all_like_product = $user->products;

        return view('pages.user.like_product')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'all_event', 'all_like_product'));
    }
}
