<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryProductController extends Controller
{
    //
    public function add_gallery($id)
    {
        $product = Product::find($id);
        $pro_id = $id;
        return view('admin.product.gallery.add_gallery_product')->with(compact('pro_id', 'product'));
    }

    public function select_gallery(Request $request)
    {
        $product_id = $request->pro_id;
        $gallery = GalleryProduct::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form>
                    ' . csrf_field() . '
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Thứ tự</th>
                                <th scope="col">Tên hình ảnh</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
                                <tr>
                                    <th scope="row">' . $i . '</th>
                                    <td contenteditable class="edit_gal_name" data-gal_id="' . $gal->id . '">' . $gal->gallery_name . '</td>
                                    <td><img src="' . url('storage/gallery_image/' . $gal->gallery_image) . '" class="img-thumbnail"
                                    width="120px" height="120px">
                                    <input type="file" class="file_image" style="width:40%;" data-gal_id="' . $gal->id . '" id="file-' . $gal->id . '" name="file" accept="image/*" />
                                    </td>
                                    <td>
                                        <button type="button" data-gal_id="' . $gal->id . '" class="btn btn-danger delete_gallery">Xóa</button>
                                    </td>
                                </tr>
                            
                            ';
            }
        } else {
            $output .= '<tr>
                            <td colspan="4">Chưa có thư viện ảnh</td>
                        </tr>
                        ';
        }
        $output .= '</tbody>
                </table>
                </form>';
        return response()->json($output);
    }

    public function insert_gallery(Request $request, $id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('public/gallery_image', $name);
                $gallery = new GalleryProduct();
                $gallery->gallery_name = $name;
                $gallery->gallery_image = $name;
                $gallery->product_id = $id;
                $gallery->save();
            }
        }
        return back()->with('status', 'Thêm ảnh vào thư viện thành công');
    }

    public function update_gallery_name(Request $request)
    {
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = GalleryProduct::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }

    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
        $gallery = GalleryProduct::find($gal_id);
        if ($gallery->gallery_image != null) {
            Storage::delete('public/gallery_image/' . $gallery->gallery_image);
        }
        $gallery->delete();
    }

    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
            $name = $get_image->getClientOriginalName();
            $path = $get_image->storeAs('public/gallery_image', $name);
            $gallery = GalleryProduct::find($gal_id);
            if ($gallery->gallery_image != null) {
                Storage::delete('public/gallery_image/' . $gallery->gallery_image);
            }
            $gallery->gallery_image = $name;
            $gallery->save();
        }
    }
}
