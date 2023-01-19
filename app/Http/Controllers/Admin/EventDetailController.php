<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($all_event_detail);
        // return view('admin.event.event_detail.all_event_detail')->with(compact('all_event_detail'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $all_event = Event::all();
        // return view('admin.event.event_detail.add_event_detail')->with(compact('all_event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //;
        $data = $request->all();
        $event = new EventDetail();
        $event->event_id =  $data['event_id'];
        $event->event_detail_type = $data['event_detail_type'];
        $event->event_detail_discount = $data['event_detail_discount'];
        $event->event_detail_start = $data['event_detail_start'];
        $event->event_detail_end = $data['event_detail_end'];
        $event->event_detail_status = $data['event_detail_status'];

        $event->category_id = $data['category_id'];
        if ($data['brand_id'] != 0) {
            $event->category_id = 0;
            $event->brand_id = $data['brand_id'];
        } else {
            $event->brand_id = 0;
        }

        $event->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $event->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $event_old = EventDetail::where('category_id', $event->category_id)->where('brand_id', $event->brand_id)->whereNot('id', $event->id)->first();
        // dd($event_old);
        if ($event_old != Null) {
            $event_old->category_id = 0;
            $event_old->brand_id = 0;
            $event_old->save();
        }
        $event->save();

        if ($event->category_id != 0) {
            $products = Product::where('category_id', $event->category_id)->get();
            foreach ($products as $product) {
                $product->event_id = $event->event_id;
                $product->event_detail_id = $event->id;
                $product->save();
            }
        } elseif ($event->brand_id != 0) {
            $products = Product::where('brand_id', $event->brand_id)->get();
            foreach ($products as $product) {
                $product->event_id = $event->event_id;
                $product->event_detail_id = $event->id;
                $product->save();
            }
        }

        // $products = Product::where('category_id', $event->category_id)->orWhere('brand_id', $event->brand_id)->get();
        // dd($products);
        return redirect()->back()->with('status', 'Thêm chi tiết sự kiện thành công');
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
        $all_event = Event::all();
        $event_detail = EventDetail::find($id);
        $all_category = CategoryProduct::all();
        $all_brand = BrandProduct::all();
        return view('admin.event.event_detail.edit_event_detail')->with(compact('all_event', 'event_detail', 'all_category', 'all_brand'));
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
        $data = $request->all();
        $event = EventDetail::find($id);
        $old_category_id = $event->category_id;
        $old_brand_id = $event->brand_id;
        $event->event_id =  $data['event_id'];
        $event->event_detail_type = $data['event_detail_type'];
        $event->event_detail_discount = $data['event_detail_discount'];
        $event->event_detail_start = $data['event_detail_start'];
        $event->event_detail_end = $data['event_detail_end'];
        $event->event_detail_status = $data['event_detail_status'];

        $event->category_id = $data['category_id'];
        if ($data['brand_id'] != 0) {
            $event->category_id = 0;
            $event->brand_id = $data['brand_id'];
        } else {
            $event->brand_id = 0;
        }
        // $event->brand_id = $data['brand_id'];
        $event->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $event_old = EventDetail::where('category_id', $event->category_id)->where('brand_id', $event->brand_id)->whereNot('id', $id)->first();
        if ($event_old != Null) {
            $event_old->category_id = 0;
            $event_old->brand_id = 0;
            $event_old->save();
        }
        $event->save();

        if ($event->category_id == 0 && $event->brand_id == 0) {
            $products = Product::where('event_detail_id', $event->id)->get();
            foreach ($products as $product) {
                $product->event_id = 0;
                $product->event_detail_id = 0;
                $product->save();
            }
        } elseif ($data['category_id'] != 0 && $event->brand_id == 0) {
            $products = Product::where('event_detail_id', $event->id)->whereNot('category_id', $event->category_id)->get();
            $products_cate = Product::where('category_id', $data['category_id'])->get();
            foreach ($products as $product) {
                $product->event_id = 0;
                $product->event_detail_id = 0;
                $product->save();
            }

            foreach ($products_cate as $pro_cate) {
                $pro_cate->event_id = $event->event_id;
                $pro_cate->event_detail_id = $event->id;
                $pro_cate->save();
            }
        } elseif ($data['category_id'] != 0 && $event->brand_id != 0) {
            $products = Product::where('brand_id', $event->brand_id)->get();
            $products_old = Product::where('category_id', $old_category_id)->orWhere('brand_id', $old_brand_id)->get();
            foreach ($products as $product) {
                $product->event_id = $event->event_id;
                $product->event_detail_id = $event->id;
                $product->save();
            }

            foreach ($products_old as $pro_old) {
                $pro_old->event_id = 0;
                $pro_old->event_detail_id = 0;
                $pro_old->save();
            }
        }


        return redirect()->back()->with('status', 'Sửa chi tiết sự kiện thành công');
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
        $event = EventDetail::find($id);
        $products = $event->products;
        foreach ($products as $product) {
            $product->event_id = 0;
            $product->event_detail_id = 0;
            $product->save();
        }
        $event->delete();
        return redirect()->back()->with('status', 'Xóa chi tiết sự kiện thành công');
    }

    public function index_event_detail($id)
    {
        $event = Event::find($id);
        $all_event_detail = EventDetail::where('event_id', $id)->get();
        // dd($all_event_detail[0]->category->category_name);
        return view('admin.event.event_detail.all_event_detail')->with(compact('event', 'all_event_detail'));
    }

    public function create_event_detail($id)
    {
        $event = Event::find($id);
        $all_category = CategoryProduct::all();
        $all_brand = BrandProduct::all();
        return view('admin.event.event_detail.add_event_detail')->with(compact('event', 'all_category', 'all_brand'));
    }

    public function select_brand_event(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['action'] == 'product_category_event') {
            $select_brands = BrandProduct::where('category_id', $data['ma_id'])->orderBy('category_id')->get();
            $output .= '<option value="0"> Không</option>';
            foreach ($select_brands as $key => $brand) {
                $output .= '<option value="' . $brand->id . '">' . $brand->brand_name . '</option>';
            }
        }
        return response()->json($output);
    }
}
