<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_coupon = Coupon::all();
        return view('admin.coupon.all_coupon')->with(compact('all_coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $coupon = new Coupon();

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_numbers = $data['coupon_numbers'];
        $coupon->coupon_status = $data['coupon_status'];
        $coupon->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon->save();
        return redirect()->back()->with('status', 'Thêm mã giảm giá sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit_coupon')->with(compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $coupon = Coupon::find($id);
        $data = $request->all();
        // dd($data);
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_numbers = $data['coupon_numbers'];
        $coupon->coupon_status = $data['coupon_status'];
        $coupon->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $coupon->save();
        return redirect()->back()->with('status', 'Cập nhập mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Coupon::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa mã giảm giá sản phẩm thành công');
    }
}
