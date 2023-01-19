@extends('layout')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $product->product_name }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Chi tiết sản phẩm</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- BreadCrumb Start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ url('danh-muc-san-pham/' . $product->category_id) }}">{{ $product->category->category_name }}</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ url('thuong-hieu-san-pham/' . $product->brand_id) }}">{{ $product->brand->brand_name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
        </ol>
    </nav>
    <!-- BreadCrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/product_image/' . $product->product_image) }}"
                                alt="Image">
                        </div>
                        @foreach ($gallery_by_id as $key => $gallery)
                            <div class="carousel-item">
                                <img class="w-100 h-100"
                                    src="{{ asset('storage/gallery_image/' . $gallery->gallery_image) }}"
                                    alt="{{ $gallery->gallery_name }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->product_name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">{{ $product->product_views }} Views</small>
                </div>


                @if ($product->event_id == 0)
                    <h3 class="font-weight-semi-bold mb-4">
                        {{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}
                    </h3>
                @else
                    <?php
                    $sukien = $product->product_price;
                    ?>
                    <div class="d-flex flex-row">
                        @if ($product->event_detail->event_detail_type == 1)
                            <h4 class="text-danger">
                                {{ number_format($sukien - $sukien * ($product->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' }}
                            </h4>
                            <h4 class="text-muted ml-2">
                                <del>{{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                            </h4>
                            <h4 class="text-success ml-2">
                                -{{ number_format($product->event_detail->event_detail_discount) . ' %' }}
                            </h4>
                        @elseif($product->event_detail->event_detail_type == 2)
                            <h4 class="text-danger">
                                {{ number_format($sukien - $product->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                            </h4>
                            <h4 class="text-muted ml-2">
                                <del>{{ number_format($product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                            </h4>
                            <h4 class="text-success ml-2">
                                -{{ number_format($product->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                            </h4>
                        @endif
                    </div>
                    {{-- <div>{{ $new_pro->event->event_start->diffForHumans() }}</div> --}}
                @endif
                <p class="mb-4">{{ $product->product_desc }}
                </p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-5" name="color">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ url('/add-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_product_id"
                            value="{{ $product->id }}"class="cart_product_id_{{ $product->id }}">
                        <input type="hidden" name="cart_product_name"
                            value="{{ $product->product_name }}"class="cart_product_name_{{ $product->id }}">
                        <input type="hidden" name="cart_product_image"
                            value="{{ $product->product_image }}"class="cart_product_image_{{ $product->id }}">
                        @if ($product->event_id == 0)
                            <input type="hidden" name="cart_product_price"
                                value="{{ $product->product_price }}"class="cart_product_price_{{ $product->id }}">
                        @elseif ($product->event_detail->event_detail_type == 1)
                            <input type="hidden" name="cart_product_price"
                                value="{{ $sukien - $sukien * ($product->event_detail->event_detail_discount / 100) }}"class="cart_product_price_{{ $product->id }}">
                        @elseif($product->event_detail->event_detail_type == 2)
                            <input type="hidden" name="cart_product_price"
                                value="{{ $sukien - $product->event_detail->event_detail_discount }}"class="cart_product_price_{{ $product->id }}">
                        @endif
                        <input type="hidden" value="1"name="cart_product_qty"
                            class="cart_product_qty_{{ $product->id }}" id="cart-qty">
                        <button type="button" class="btn btn-primary px-3 add-cart"
                            data-id_product="{{ $product->id }}"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ
                            hàng</button>
                    </form>
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông tin</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Bình luận
                        ({{ $comment_by_id->count() }})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Mô tả sản phẩm</h4>
                        <p>{!! $product->product_desc !!}</p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Thông tin sản phẩm</h4>
                        <p>{!! $product->product_content !!}</p>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">Bình luận</h4>
                                @foreach ($comment_by_id as $key => $comment)
                                    <div class="media mb-4">
                                        <img src="{{ asset('storage/avatar/' . $comment->user->avatar) }}" alt="Image"
                                            class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>{{ $comment->user->name }}<small> -
                                                    <i>{{ $comment->created_at }}</i></small></h6>
                                            <div class="text-primary mb-2">
                                                @for ($i = 1; $i <= $comment->rate; $i++)
                                                    <i class="fas fa-star" style="color: #ffdf7e;"></i>
                                                @endfor
                                            </div>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Để lại đánh giá của bạn</h4>
                                @if (Auth::user())
                                    <form action="{{ url('comment-san-pham') }}" method="POST">
                                        @csrf
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Chất lượng * :</p>
                                            <div class="text-primary star-widget">

                                                <input type="radio" name="rate" id='rate-5' value="5"
                                                    style="display: none;">
                                                <label class="far fa-star" for="rate-5"></label>

                                                <input type="radio" name="rate" id='rate-4' value="4"
                                                    style="display: none;">
                                                <label class="far fa-star" for="rate-4"></label>

                                                <input type="radio" name="rate" id='rate-3' value="3"
                                                    style="display: none;">
                                                <label class="far fa-star" for="rate-3"></label>

                                                <input type="radio" name="rate" id='rate-2' value="2"
                                                    style="display: none;">
                                                <label class="far fa-star" for="rate-2"></label>

                                                <input type="radio" name="rate" id='rate-1' value="1"
                                                    style="display: none;" checked>
                                                <label class="far fa-star" for="rate-1"></label>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="comment">Đánh giá * :</label>
                                            <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" style="resize: none"></textarea>
                                        </div>
                                        <input type="hidden" name="product_id"
                                            value="{{ $product->id }}"class="comment-product">
                                        {{-- <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div> --}}

                                        <div class="form-group mb-0">
                                            <input type="submit" value="Đánh giá" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                @else
                                    <p>Vui lòng đăng nhập để đánh giá cho sản phẩm</p>
                                    <div class="form-group mb-0">
                                        <a class="btn btn-primary px-3" href="{{ url('/login-checkout') }}"
                                            role="button">Đăng nhập</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Carosel Products Start -->
    @include('../elements/caroselproduct')
    <!-- Products End -->
@endsection
