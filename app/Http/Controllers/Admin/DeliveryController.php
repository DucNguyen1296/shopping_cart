<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_delivery_fee = Delivery::all();
        return view('admin.delivery.all_delivery')->with(compact('all_delivery_fee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $city = City::orderBy('city_code', 'ASC')->get();
        $province = Province::orderBy('province_code', 'ASC')->get();
        $wards = Ward::orderBy('ward_code', 'ASC')->get();
        // dd($city[0]->city_code); 
        return view('admin.delivery.add_delivery', ['city' => $city, 'province' => $province, 'wards' => $wards]);
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
        $data = new Delivery();
        $data['city_code'] = $request->city;
        $data['province_code'] = $request->province;
        $data['ward_code'] = $request->wards;
        $data['delivery_fee'] = $request->delivery_fee;

        $data->save();
        return redirect()->back()->with('status', 'Thêm phí vận chuyển thành công');
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
        $delivery_by_id = Delivery::find($id);
        $city = City::where('city_code', $delivery_by_id->city_code)->first();
        $province = Province::where('province_code', $delivery_by_id->province_code)->first();
        $wards = Ward::where('ward_code', $delivery_by_id->ward_code)->first();
        return view('admin.delivery.edit_delivery')->with(compact('delivery_by_id', 'city', 'province', 'wards'));
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
        $data = Delivery::find($id);
        $data['city_code'] = $request->city;
        $data['province_code'] = $request->province;
        $data['ward_code'] = $request->wards;
        $data['delivery_fee'] = $request->delivery_fee;

        $data->save();
        return redirect()->back()->with('status', 'Sửa phí vận chuyển thành công');
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
        Delivery::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa phí vận chuyển thành công');
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        // Log::channel('custom')->info($data);
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('city_code', $data['ma_id'])->orderBy('province_code')->get();
                $output .= '<option value=""> ----> Chọn quận huyện <----- </option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->province_code . '">' . $province->province_name . '</option>';
                }
            } else {
                $select_wards = Ward::where('province_code', $data['ma_id'])->orderBy('ward_code')->get();

                $output .= '<option value=""> ----> Chọn xã phường <----- </option>';
                foreach ($select_wards as $key => $wards) {
                    $output .= '<option value="' . $wards->ward_code . '">' . $wards->ward_name . '</option>';
                }
            }
        }
        echo $output;
    }
}
