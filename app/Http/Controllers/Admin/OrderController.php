<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    // -------------- Admin Manager Order ---------------//

    public function manage_order()
    {

        // $all_product = Product::all();
        $all_product = Product::with('category', 'brand')->orderBy('id', 'DESC')->get();
        $all_order = Order::with('user')->orderBy('id', 'DESC')->get();
        return view('admin.order.manage_order', ['all_product' => $all_product, 'all_order' => $all_order]);
    }

    public function view_order($id)
    {
        $order_by_id = Order::where('id', $id)->first();
        $customer_by_id = User::where('id', $order_by_id->customer_id)->first();
        $shipping_by_id = Shipping::where('id', $order_by_id->shipping_id)->first();
        $order_details_by_id = OrderDetail::where('order_id', $id)->get();
        return view('admin.order.view_order', ['order_by_id' => $order_by_id, 'customer_by_id' => $customer_by_id, 'shipping_by_id' => $shipping_by_id, 'order_details_by_id' => $order_details_by_id]);
    }

    public function delete_order($id)
    {
        $order_by_id = Order::where('id', $id)->first();
        Payment::where('id', $order_by_id->payment_id)->delete();
        Shipping::where('id', $order_by_id->shipping_id)->delete();
        Order::where('id', $id)->delete();
        OrderDetail::where('order_id', $id)->delete();
        return redirect()->back()->with('status', 'Xóa đơn hàng sản phẩm thành công');
    }
}
