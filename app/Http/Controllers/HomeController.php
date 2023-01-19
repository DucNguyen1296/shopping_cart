<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Comment;
use App\Models\Event;
use App\Models\GalleryProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        $event_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('event_detail_id', '>', 0)->get()->take(12);
        $new_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('product_views', 'DESC')->where('product_status', 1)->get()->take(12);
        // dd($all_product);
        // dd($event_product[10]->event_detail->event_detail_status);
        return view('home')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'all_event', 'random_product', 'event_product', 'new_product'));
    }

    public function show_details_home($id)
    {
        $user = Auth::user();
        $product = Product::find($id);
        $product->product_views++;
        $product->save();
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        $comment_by_id = Comment::where('product_id', $id)->orderBy('created_at', 'DESC')->get();
        $gallery_by_id = GalleryProduct::where('product_id', $id)->get();
        // dd(Event::find(1)->event_status);
        return view('pages.product_detail')->with(compact('user', 'product', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'comment_by_id', 'gallery_by_id', 'all_event'));
    }

    public function show_category_home(Request $request, $id)
    {
        $user = Auth::user();
        $category_by_id = CategoryProduct::find($id);
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        // $product_by_category = Product::where('category_id', $id)->paginate(6);
        $product_by_category = Product::where('category_id', $id)->where('product_status', 1);
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    // $product_by_category = Product::where('product_price', '<', 1000000)->where('category_id', $id)->paginate(6);
                    $product_by_category->where('product_price', '<', 1000000);
                    break;

                case '2':
                    // $product_by_category = Product::whereBetween('product_price', [1000000, 5000000])->where('category_id', $id)->paginate(6);
                    $product_by_category->whereBetween('product_price', [1000000, 5000000]);
                    break;

                case '3':
                    $product_by_category->whereBetween('product_price', [5000000, 20000000]);
                    break;

                case '4':
                    $product_by_category->whereBetween('product_price', [20000000, 40000000]);
                    break;

                case '5':
                    // $product_by_category = Product::where('product_price', '>', 40000000)->where('category_id', $id)->paginate(6);
                    $product_by_category->where('product_price', '>', 40000000);
                    break;
            }
        }

        if ($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'price_max':
                    $product_by_category->orderBy('product_price', 'ASC');
                    break;

                case 'price_min':
                    $product_by_category->orderBy('product_price', 'DESC');
                    break;

                case 'az':
                    $product_by_category->orderBy('product_name', 'ASC');
                    break;

                case 'za':
                    $product_by_category->orderBy('product_name', 'DESC');
                    break;

                case 'newest':
                    $product_by_category->orderBy('updated_at', 'DESC');
                    break;

                case 'oldest':
                    $product_by_category->orderBy('updated_at', 'ASC');
                    break;
            }
        }
        $product_by_category = $product_by_category->paginate(6);
        // dd($product_by_category[0]->event_detail);
        return view('pages.category_product')->with(compact('user', 'category_by_id', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'product_by_category', 'all_event'));
    }

    public function show_brand_home($id)
    {
        $user = Auth::user();
        $brand_by_id = BrandProduct::find($id);
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        $product_by_brand = Product::where('brand_id', $id)->paginate(6);
        return view('pages.brand_product')->with(compact('user', 'brand_by_id', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'product_by_brand', 'all_event'));
    }

    public function show_event_home($id)
    {
        $user = Auth::user();
        $event_by_id = Event::find($id);
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        $product_by_event = Product::with('category', 'brand', 'event', 'event_detail')->where('event_id', $id)->paginate(6);
        // dd($product_by_event);
        return view('pages.event_product')->with(compact('user', 'event_by_id', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'product_by_event', 'all_event'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->keywords_submit;
        $all_category_product = CategoryProduct::orderBy('category_name', 'ASC')->where('category_status', 1)->get();
        $all_brand_product = BrandProduct::with('category')->orderBy('brand_name', 'DESC')->where('brand_status', 1)->get();
        $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->get();
        $all_event = Event::orderBy('id', 'DESC')->where('event_status', 1)->get();
        $random_product = Product::with('category', 'brand', 'event', 'event_detail')->where('product_status', 1)->get()->random(20);
        $search_product = Product::where('product_name', 'LIKE', '%' . $keyword . '%')->paginate(6);
        // dd($search_product);
        return view('pages.search_product')->with(compact('user', 'all_category_product', 'all_brand_product', 'all_product', 'random_product', 'keyword', 'search_product', 'all_event'));
    }

    public function load_more_product(Request $request)
    {
        $data = $request->all();
        if ($data['id'] > 0) {
            $all_product = Product::with('category', 'brand', 'event', 'event_detail')->where('id', '<', $data['id'])->where('product_status', 1)->orderBy('id', 'DESC')->take(12)->get();
        } else {
            $all_product = Product::with('category', 'brand', 'event', 'event_detail')->orderBy('id', 'DESC')->where('product_status', 1)->take(12)->get();
        }
        $output = '';
        if (!$all_product->isEmpty()) {
            foreach ($all_product as $key => $value) {

                $last_id = $value->id;
                if ($value->category->category_status == 1) {

                    $output .= '
        <div class="col-lg-2 col-md-4 col-sm-8 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <a href="' . url('/chi-tiet-san-pham/' . $value->id) . '">
                        <img class="img-fluid w-100"
                            src="' . asset("storage/product_image/" . $value->product_image) . '"
                            alt="product_image" style="height: 130px;">
                    </a>
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">
                        <span class="dislike" data-toggle="tooltip" data-placement="top"
                            title="' . $value->product_name . '">' . $value->product_name . '
                        </span>
                    </h6>
                    <div class="d-flex flex-column justify-content-center">';
                    if ($value->event_id == 0 || $value->event_detail->event_detail_status == 0) {
                        $output .= '
                            <h6 class="text-danger" style="margin-top:1.75rem;">
                                ' . number_format($value->product_price, 0, ',', '.') . '. VNĐ.' . '
                            </h6>
            ';
                    } elseif ($value->event_id != 0 && $value->event_detail->event_detail_status != 0) {
                        if ($value->event_detail->event_detail_type == 1) {
                            $output .= '
                                <h6 class="text-muted ml-2">
                                    <del>' . number_format($value->product_price, 0, ',', '.') . 'VNĐ' . '</del>
                                </h6>
                                <h6 class="text-danger">
                                        ' . number_format($value->product_price - $value->product_price * ($value->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' . '
                                    </h6>
                ';
                        } elseif ($value->event_detail->event_detail_type == 2) {
                            $output .= '
                                <h6 class="text-muted ml-2">
                                    <del>' . number_format($value->product_price, 0, ',', '.') . ' VNĐ' . '</del>
                                </h6>
                                <h6 class="text-danger">
                                    ' . number_format($value->product_price - $value->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' . '
                                </h6>
                ';
                        }
                    }
                    $output .= '</div>';
                    if ($value->event_detail_id != 0 && $value->event_detail->event_detail_status != 0) {
                        $output .= '
            <img src="' . asset('img/sale.png') . '" class="sale" alt="">
            ';
                        if ($value->event_detail->event_detail_type == 1) {
                            $output .= '
                            <div class="event-product">
                                <span class="event-product-discount text-danger">-' . $value->event_detail->event_detail_discount . ' %</span>
                            </div>
                ';
                        } elseif ($value->event_detail->event_detail_type == 2) {
                            $output .= '
                            <div class="event-product-2">
                                <span class="event-product-discount-2 text-danger">-' . number_format($value->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ</span>
                            </div>
                ';
                        }
                    }
                    $output .= '</div>
            <div class="card-footer d-flex justify-content-between bg-light border">';
                    if (Auth::user()) {
                        if (Auth::user()->products->where('id', $value->id)->first() != null) {
                            $output .= '
                <form action="' . url('/delete-like-product/' . $value->id) . '" method="POST">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm text-dark p-0"><i
                                            class=" fas fa-heart text-primary mr-1"></i>Thích</button>
                                </form>
                ';
                        } else {
                            $output .= '
                <form action="' . url('/like-product/' . $value->id) . '" method="POST">
                                ' . csrf_field() . '
                                    <button class="btn btn-sm text-dark p-0"><i
                                            class="far fa-heart text-primary mr-1"></i>Thích</button>
                                </form>
                ';
                        }
                    } else {
                        $output .= '
            <a href="{{ url("/login-checkout") }}" class="btn btn-sm text-dark p-0"><i class=" far fa-heart text-primary mr-1"></i>Thích</a>
            ';
                    }
                    $output .= '
            <a href="' . url('/chi-tiet-san-pham/' . $value->id) . '" class="btn btn-sm text-dark p-0"><i
                                class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</a>
                                </div>
                </div>
            </div>
            ';
                }
            }
            $output .= '
            <div class="text-center mb-4 loading-more"  >
                <button type="button" name="load_more_button" class="btn btn-lg btn-primary d-block load-more-button" id="load-more-button" data-id="' . $last_id . '">Xem thêm</button>
            </div>
                ';
        } else {
            $output .= '
            <div class="text-center mb-4" style="width:1150px;" >
                <h4>Đang cập nhập thêm....</h4>
            </div>
                ';
        }
        echo $output;
    }
}
