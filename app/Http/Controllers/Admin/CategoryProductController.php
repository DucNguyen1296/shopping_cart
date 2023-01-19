<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryProductController extends Controller
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
        return view('admin.category.all_category_product')->with(compact('all_category_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.add_category_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cate = new CategoryProduct();
        $cate['category_name'] = $request->category_name;
        $cate['category_desc'] = $request->category_desc;
        $cate['meta_keywords'] = $request->meta_keywords;
        $cate['category_status'] = $request->category_status;
        $cate['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $cate['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('category_image')) {
            $name = $request->file('category_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('category_image')->storeAs('public/category_image', $name);
            $cate->category_image = $name;
        }
        $cate->save();
        return redirect()->back()->with('status', 'Thêm danh mục sản phẩm thành công');
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
        $category = CategoryProduct::find($id);
        return view('admin.category.edit_category_product')->with(compact('category'));
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
        $cate = CategoryProduct::find($id);
        $cate['category_name'] = $request->category_name;
        $cate['category_desc'] = $request->category_desc;
        $cate['meta_keywords'] = $request->meta_keywords;
        $cate['category_status'] = $request->category_status;
        $cate['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('category_image')) {
            if ($cate->category_image != null) {
                Storage::delete('public/category_image/' . $cate->category_image);
            }
            $name = $request->file('category_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('category_image')->storeAs('public/category_image', $name);
            $cate->category_image = $name;
        }
        $cate->save();
        return redirect()->back()->with('status', 'Sửa danh mục sản phẩm thành công');
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
        $category = CategoryProduct::find($id);
        if ($category->category_image != null) {
            Storage::delete('public/category_image/' . $category->category_image);
        }
        $category->delete();
        return redirect()->back()->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}
