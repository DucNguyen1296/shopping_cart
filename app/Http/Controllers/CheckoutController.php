<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function login_checkout()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand')->where('product_status', 1)->get()->random(20);
        $cart = Session::get('cart');
        // dd($cart);
        return view('pages.user_login')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'all_event', 'random_product'));
    }

    public function login_user(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if (Gate::allows('isUser')) { {
                    $request->session()->regenerate();
                    return redirect('/trang-chu');
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function logout_checkout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/trang-chu');
    }


    public function register_checkout()
    {
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand')->where('product_status', 1)->get()->random(20);
        $cart = Session::get('cart');
        // dd($cart);
        return view('pages.user_register')->with(compact('all_category_product', 'all_brand_product', 'all_product', 'all_event', 'random_product'));
    }

    public function register_user(Request $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone = $request->phone;
        $data->role = 'user';
        $data->avatar = 'default.png';
        $data->save();

        return redirect('/login-checkout')->with('status', 'Đăng ký thành công');
    }

    //------ Check out -----//
    public function checkout()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand')->where('product_status', 1)->get()->random(20);
        $cart = Session::get('cart');
        $shipping = Session::get('shipping');
        // dd(Session::all());
        return view('pages.checkout')->with(compact('user', 'all_event', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'cart', 'shipping'));
    }

    public function save_checkout(Request $request)
    {

        $user = Auth::user();
        // Payment tbl_payment method 
        $cart = Session::get('cart');
        $coupon = Session::get('coupon');
        $delivery = Session::get('delivery');
        $shipping = Session::get('shipping');
        // dd($shipping);
        $shipping_data = new Shipping();
        $shipping_data->customer_id = Auth::user()->id;
        $shipping_data->shipping_name = $shipping->shipping_name;
        $shipping_data->shipping_email = $shipping->shipping_email;
        $shipping_data->shipping_address = $shipping->shipping_address;
        $shipping_data->shipping_phone = $shipping->shipping_phone;
        $shipping_data->shipping_note = $shipping->shipping_note;
        $shipping_data->save();
        // dd($shipping);
        $payment_data = new Payment();
        $payment_data->payment_method = $request->payment_option;
        $payment_data->payment_status = 'Đang chờ xử lý';
        $payment_data->save();

        // Order tbl_order method
        $order_data = new Order();
        $order_data->customer_id = Auth::user()->id;
        $order_data->shipping_id = $shipping_data->id;
        $order_data->payment_id = $payment_data->id;
        $order_data->order_total = number_format(session()->get('thanh_tien'), 0, ',', '.');
        $order_data->order_status = 'Đang chờ xử lý';
        $order_data->save();

        //

        foreach ($cart as $cart_content) {

            $order_details_data = new OrderDetail();
            $order_details_data->order_id = $order_data->id;
            $order_details_data->product_id = $cart_content['product_id'];
            $order_details_data->product_name = $cart_content['product_name'];
            $order_details_data->product_price = $cart_content['product_price'];
            $order_details_data->product_quantity = $cart_content['product_qty'];
            $order_details_data->delivery_id = $delivery->id;
            if ($coupon != null) {
                $order_details_data->coupon_id = $coupon->id;

                $cou = Coupon::find($coupon->id);
                $cou->coupon_times--;
                $cou->save();
            }
            $order_details_data->save();
        }

        if ($payment_data->payment_method == 1) {
            echo ('VISA');
        } elseif ($payment_data->payment_method == 2) {
            $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
            $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
            $all_product = Product::with('category', 'brand')->orderBy('product_name', 'DESC')->where('product_status', 1)->get();
            $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('delivery');
            Session::forget('shipping');
            Session::forget('giam_gia');
            Session::forget('tong_giam');
            Session::forget('van_chuyen');
            // Session::forget('van_chuyen');
            Session::forget('thanh_tien');
            return view('pages.handcash')->with(compact('user', 'all_event', 'all_category_product', 'all_brand_product', 'all_product', 'cart', 'shipping'));
        } else {
            echo ('BANKING');
        }
    }
}
