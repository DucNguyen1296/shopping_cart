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
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_product = Product::with('category', 'brand')->orderBy('id', 'DESC')->get();
        $all_event = Event::all();
        return view('admin.product.all_product')->with(compact('all_product', 'all_event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_category_product = CategoryProduct::all();
        $all_brand_product = BrandProduct::with('category')->get();
        $all_event = Event::all();
        $all_event_detail = EventDetail::all();
        return view('admin.product.add_product')->with(compact('all_category_product', 'all_brand_product', 'all_event', 'all_event_detail'));
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
        $data = $request->validate(
            [
                'product_name' => 'required',
                'product_price' => 'required',
                'product_desc' => 'required',
                'product_content' => 'required',
                'meta_keywords' => 'required',
                'product_image' => 'required|image',
                'product_category' => 'required',
                'product_brand' => 'required',
                'product_event' => 'required',
                'product_event_detail' => 'required',
                'product_status' => 'required'
            ],
            [
                'product_name.required' => 'T??n s???n ph???m ph???i c??',
                'product_desc.required' => 'T??m t???t s???n ph???m ph???i c??',
                'product_content.required' => 'M?? t??? s???n ph???m ph???i c??',
                'product_price.required' => 'Gi?? th??nh s???n ph???m ph???i c??',
                'product_image.required' => 'H??nh ???nh s???n ph???m ph???i c??',
                'meta_keywords.required' => 'T??? kh??a s???n ph???m ph???i c??',
                'product_category.required' => 'Danh m???c s???n ph???m ph???i c??',
                'product_brand.required' => 'Th????ng hi???u s???n ph???m ph???i c??',
                'product_event.required' => 'S??? ki???n ph???i c??',
                'product_event_detail.required' => 'Chi ti???t s??? ki???n ph???i c??',
                'product_status.required' => 'Hi???n th??? s???n ph???m ph???i c??',
            ]
        );
        $product = new Product();
        $product['category_id'] = $data['product_category'];
        $product['brand_id'] = $data['product_brand'];
        $product['product_name'] = $data['product_name'];
        $product['product_desc'] = $data['product_desc'];
        $product['product_content'] = $data['product_content'];
        $product['product_price'] = $data['product_price'];
        $product['meta_keywords'] = $data['meta_keywords'];
        $product['product_status'] = $data['product_status'];
        $product['event_id'] = $data['product_event'];
        $product['event_detail_id'] = $data['product_event_detail'];
        $product['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $product['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('product_image')) {
            $name = $request->file('product_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('product_image')->storeAs('public/product_image', $name);
            $product->product_image = $name;
        }
        $product['product_views'] = 1;
        $product->save();
        return redirect()->back()->with('status', 'Th??m s???n ph???m th??nh c??ng');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $all_category_product = CategoryProduct::all();
        $all_brand_product = BrandProduct::with('category')->get();
        $all_event = Event::all();
        $all_event_detail = EventDetail::all();
        return view('admin.product.edit_product')->with(compact('all_category_product', 'all_brand_product', 'all_event', 'all_event_detail', 'product'));
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
        $data = $request->validate(
            [
                'product_name' => 'required',
                'product_price' => 'required',
                'product_desc' => 'required',
                'product_content' => 'required',
                'meta_keywords' => 'required',
                'product_category' => 'required',
                'product_brand' => 'required',
                'product_event' => 'required',
                'product_event_detail' => 'required',
                'product_status' => 'required',
            ],
            [
                'product_name.required' => 'T??n s???n ph???m ph???i c??',
                'product_desc.required' => 'T??m t???t s???n ph???m ph???i c??',
                'product_content.required' => 'M?? t??? s???n ph???m ph???i c??',
                'product_price.required' => 'Gi?? th??nh s???n ph???m ph???i c??',
                'meta_keywords.required' => 'T??? kh??a s???n ph???m ph???i c??',
                'product_category.required' => 'Danh m???c s???n ph???m ph???i c??',
                'product_brand.required' => 'Th????ng hi???u s???n ph???m ph???i c??',
                'product_event.required' => 'S??? ki???n ph???i c??',
                'product_event_detail.required' => 'Chi ti???t s??? ki???n ph???i c??',
                'product_status.required' => 'Hi???n th??? s???n ph???m ph???i c??',
            ]
        );
        $product = Product::find($id);
        $product['category_id'] = $data['product_category'];
        $product['brand_id'] = $data['product_brand'];
        $product['product_name'] = $data['product_name'];
        $product['product_desc'] = $data['product_desc'];
        $product['product_content'] = $data['product_content'];
        $product['product_price'] = $data['product_price'];
        $product['meta_keywords'] = $data['meta_keywords'];
        $product['product_status'] = $data['product_status'];
        $product['event_id'] = $data['product_event'];
        $product['event_detail_id'] = $data['product_event_detail'];
        $product['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('product_image')) {
            if ($product->product_image != null) {
                Storage::delete('public/product_image/' . $product->product_image);
            }
            $name = $request->file('product_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('product_image')->storeAs('public/product_image', $name);
            $product->product_image = $name;
        }

        $product->save();
        return redirect()->back()->with('status', 'S???a s???n ph???m th??nh c??ng');
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
        $product = Product::find($id);
        if ($product->product_image != null) {
            Storage::delete('public/product_image/' . $product->product_image);
        }
        $product->delete();
        return redirect()->back()->with('status', 'X??a s???n ph???m th??nh c??ng');
    }

    public function select_brand(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['action'] == 'product_category') {
            $select_brands = BrandProduct::where('category_id', $data['ma_id'])->orderBy('category_id')->get();
            $output .= '<option value=""> ----> Ch???n th????ng hi???u s???n ph???m <----- </option>';
            foreach ($select_brands as $key => $brand) {
                $output .= '<option value="' . $brand->id . '">' . $brand->brand_name . '</option>';
            }
        }
        return response()->json($output);
    }

    public function select_event_detail(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['ma_id'] == 0) {
            $output .= '<option value="0">Kh??ng</option>';
        }
        if ($data['ma_id'] != 0 && $data['action'] == 'product_event') {
            $select_event_details = EventDetail::where('event_id', $data['ma_id'])->orderBy('event_detail_discount', 'DESC')->get();
            $output .= '<option value=""> ----> Ch???n gi?? tr??? s??? ki???n <----- </option>';
            foreach ($select_event_details as $key => $event_detail) {
                if ($event_detail->event_detail_type == 1) {
                    $output .= '<option value="' . $event_detail->id . '">' . $event_detail->event_detail_discount . ' %</option>';
                } elseif ($event_detail->event_detail_type == 2) {
                    $output .= '<option value="' . $event_detail->id . '">' . number_format($event_detail->event_detail_discount, 0, ',', '.') . ' VN??</option>';
                }
            }
        }
        return response()->json($output);
    }
}
