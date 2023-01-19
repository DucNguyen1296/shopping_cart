<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Event;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function profile()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        return view('pages.user.profile')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'all_event'));
    }

    public function purchase()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $all_order = Order::where('customer_id', $user->id)->get();
        // dd($all_order);
        return view('pages.user.purchase')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'all_event', 'all_order'));
    }

    public function update_profile(Request $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($request->hasFile('avatar')) {
            if ($data->avatar != 'default.png') {
                Storage::delete('public/avatar/' . $data->avatar);
            }
            $name = $request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs('public/avatar', $name);
            $data->avatar = $name;
        }
        $data->save();

        return redirect()->back();
    }
}
