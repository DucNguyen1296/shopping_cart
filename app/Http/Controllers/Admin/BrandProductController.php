<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_category_product = CategoryProduct::all();
        $all_brand_product = BrandProduct::with('category')->get();
        return view('admin.brand.all_brand_product')->with(compact('all_category_product', 'all_brand_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $all_category_product = CategoryProduct::all();
        return view('admin.brand.add_brand_product')->with(compact('all_category_product'));
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
        $brand = new BrandProduct();
        $brand['category_id'] = $request->category_id;
        $brand['brand_name'] = $request->brand_name;
        $brand['brand_desc'] = $request->brand_desc;
        $brand['meta_keywords'] = $request->meta_keywords;
        $brand['brand_status'] = $request->brand_status;
        $brand['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $brand['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $brand->save();
        return redirect()->back()->with('status', 'Thêm thương hiệu sản phẩm thành công');
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
        $all_category_product = CategoryProduct::all();
        $brand = BrandProduct::find($id);
        return view('admin.brand.edit_brand_product')->with(compact('all_category_product', 'brand'));
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
        $brand = BrandProduct::find($id);
        $brand['category_id'] = $request->category_id;
        $brand['brand_name'] = $request->brand_name;
        $brand['brand_desc'] = $request->brand_desc;
        $brand['meta_keywords'] = $request->meta_keywords;
        $brand['brand_status'] = $request->brand_status;
        $brand['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $brand->save();
        return redirect()->back()->with('status', 'Sửa thương hiệu sản phẩm thành công');
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
        BrandProduct::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thương hiệu sản phẩm thành công');
    }
}
