<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\Event;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //------ Cart -----//
    public function show_cart()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand')->where('product_status', 1)->get()->random(20);
        $city = City::orderBy('city_code', 'ASC')->get();
        $cart = Session::get('cart');
        $coupon = session()->get('coupon');

        // dd($all_product->where('id', $cart[0]['product_id']));
        return view('pages.show_cart')->with(compact('user', 'all_category_product', 'all_event', 'all_brand_product', 'all_product', 'random_product', 'city'));
    }

    public function add_cart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);

        $cart = Session::get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_available++;
                }
            }
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                    '_token' => $data['_token']
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
                '_token' => $data['_token']
            );
        }
        Session::put('cart', $cart);
        Session::save();

        // return view('pages.show_cart')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'random_product'));;
        // return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $value) {
                    if ($value['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }

    public function delete_cart($session_id, Request $request)
    {
        $cart = Session::get('cart');
        // return response()->json();
        // dd($cart);
        if ($cart) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
                if (count($cart) == 0) {
                    $request->session()->forget('shipping');
                    $request->session()->forget('giam_gia');
                    $request->session()->forget('tong_giam');
                    $request->session()->forget('coupon');
                    $request->session()->forget('delivery');
                    $request->session()->forget('thanh_tien');
                    // dd(session()->all());
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }
    //------ End Cart -----//

    // ------ Shipping -----//
    public function shipping_cart()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand')->where('product_status', 1)->get()->random(20);
        $coupon = Session::get('coupon');
        $cart = Session::get('cart');
        // dd(session()->get('cart'));
        return view('pages.shipping_cart')->with(compact('user', 'all_event', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'cart', 'coupon'));
    }

    public function add_shipping_cart(Request $request)
    {
        $shipping_data = new Shipping();
        $shipping_data->customer_id = Auth::user()->id;
        $shipping_data->shipping_name = $request->shipping_name;
        $shipping_data->shipping_email = $request->shipping_email;
        $shipping_data->shipping_address = $request->shipping_address;
        $shipping_data->shipping_phone = $request->shipping_phone;
        $shipping_data->shipping_note = $request->shipping_note;
        // $shipping_data->save();
        // $shipping_id = $shipping_data->shipping_id;
        Session::put('shipping', $shipping_data);
        // $coupon = Session::get('coupon');
        // $cart = Session::get('cart');
        // dd(Session::all());
        return redirect('/checkout');
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status', 1)->where('coupon_times', '>', 0)->first();
        // Session::put('coupon', $coupon);
        $request->session()->put('coupon', $coupon);
        // session()->save();
        // dd(Session::get('coupon'));
        // dd($coupon->coupon_numbers);
        if ($coupon == null) {
            return redirect()->back()->with('status', 'Mã giảm giá không đúng hoặc đã hết hạn, xin thử lại');
        } else {
            return redirect()->back();
        }
    }

    public function check_delivery(Request $request)
    {
        $data = $request->all();
        $delivery = Delivery::where('city_code', $data['city'])->where('province_code', $data['province'])->where('ward_code', $data['wards'])->first();
        $request->session()->put('delivery', $delivery);
        // session()->save();
        if ($delivery == null) {
            return redirect()->back()->with('status', 'Địa chỉ tính phí không đúng, xin thử lại');
        } else {
            return redirect()->back();
        }
    }
}
