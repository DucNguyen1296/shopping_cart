@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $category_by_id->category_name }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/trang-chu">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">{{ $category_by_id->category_desc }}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- BreadCrumb Start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category_by_id->category_name }}</li>
        </ol>
    </nav>
    <!-- BreadCrumb End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Lọc theo giá</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input {{ Request::get('price') == 'all' ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-all">
                            <label class="custom-control-label" for="price-all">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 'all']) }}">Tất cả</a>
                            </label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input {{ Request::get('price') == 1 ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 1]) }}">Dưới 1tr VNĐ</a>
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input {{ Request::get('price') == 2 ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 2]) }}">Từ 1tr - 5tr VNĐ</a>
                            </label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input {{ Request::get('price') == 3 ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 3]) }}">Từ 5tr - 20tr VNĐ</a>
                            </label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input {{ Request::get('price') == 4 ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 4]) }}">Từ 20tr - 40tr VNĐ</a>
                            </label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input {{ Request::get('price') == 5 ? 'checked' : '' }} type="checkbox"
                                class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 5]) }}">Trên 40tr VNĐ</a>
                            </label>

                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Lọc theo thương hiệu</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">Tất cả thương hiệu</label>
                            {{-- <span class="badge border font-weight-normal">1000</span> --}}
                        </div>
                        @foreach ($category_by_id->brands as $key => $value)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-1">
                                <label class="custom-control-label" for="color-1">{{ $value->brand_name }}</label>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <form action="" id="form-order" method="GET">
                                    <select name="orderby" class="custom-select orderBy">
                                        <option {{ Request::get('orderby') == 'option' ? "selected='selected'" : '' }}
                                            value="option" selected>Mặc định</option>
                                        <option {{ Request::get('orderby') == 'price_max' ? "selected='selected'" : '' }}
                                            value="price_max">Giá tăng dần</option>
                                        <option {{ Request::get('orderby') == 'price_min' ? "selected='selected'" : '' }}
                                            value="price_min">Giá giảm dần</option>
                                        <option {{ Request::get('orderby') == 'az' ? "selected='selected'" : '' }}
                                            value="az">Theo chữ cái: A-Z</option>
                                        <option {{ Request::get('orderby') == 'za' ? "selected='selected'" : '' }}
                                            value="za">Theo chữ cái: Z-A</option>
                                        <option {{ Request::get('orderby') == 'newest' ? "selected='selected'" : '' }}
                                            value="newest">Mới nhất</option>
                                        <option {{ Request::get('orderby') == 'oldest' ? "selected='selected'" : '' }}
                                            value="oldest">Cũ nhất</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach ($product_by_category as $key => $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <a href="{{ url('chi-tiet-san-pham/' . $product->id) }}">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/product_image/' . $product->product_image) }}"
                                            alt="image" style="height: 260px">
                                    </a>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">
                                        <span class="dislike" data-toggle="tooltip" data-placement="top"
                                            title="{{ $product->product_name }}">
                                            {{ $product->product_name }}
                                        </span>
                                    </h6>
                                    <div class="d-flex flex-column justify-content-center">
                                        @if ($product->event_detail_id == 0)
                                            <h6 class="text-danger" style="margin-top:1.75rem;">
                                                {{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}
                                            </h6>
                                        @elseif($product->event_detail_id != 0 && $product->event_detail->event_detail_status == 1)
                                            <?php
                                            $sukien = $product->product_price;
                                            ?>
                                            @if ($product->event_detail->event_detail_type == 1)
                                                <h6 class="text-muted ml-2">
                                                    <del>{{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                                </h6>
                                                <h6 class="text-danger">
                                                    {{ number_format($sukien - $sukien * ($product->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' }}
                                                </h6>
                                            @elseif($product->event_detail->event_detail_type == 2)
                                                <h6 class="text-muted ml-2">
                                                    <del>{{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                                </h6>
                                                <h6 class="text-danger">
                                                    {{ number_format($sukien - $product->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                                </h6>
                                            @endif
                                            {{-- <div>{{ $product->event_detail->event_detail_start->diffForHumans() }}</div> --}}
                                        @endif
                                    </div>
                                    @if ($product->event_id != 0)
                                        <img src="{{ asset('img/sale.png') }}" class="sale" alt="">
                                        @if ($product->event_detail->event_detail_type == 1)
                                            <div class="event-product">
                                                <span
                                                    class="event-product-discount text-danger">-{{ $product->event_detail->event_detail_discount }}%</span>
                                            </div>
                                        @elseif($product->event_detail->event_detail_type == 2)
                                            <div class="event-product-2">
                                                <span
                                                    class="event-product-discount-2 text-danger">-{{ number_format($product->event_detail->event_detail_discount, 0, ',', '.') }}
                                                    VNĐ</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ url('/chi-tiet-san-pham/' . $product->id) }}"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="far fa-heart text-primary mr-1"></i>Thích</a>
                                    <a href="{{ url('/chi-tiet-san-pham/' . $product->id) }}"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                {{-- <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li> --}}
                                {{ $product_by_category->withQueryString()->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Carosel Products Start -->
    @include('../elements/caroselproduct')
    <!-- Products End -->
@endsection
