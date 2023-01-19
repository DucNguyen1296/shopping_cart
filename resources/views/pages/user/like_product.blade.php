@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Sản phẩm yêu thích</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/trang-chu">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Sản phẩm yêu thích</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- BreadCrumb Start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
        </ol>
    </nav>
    <!-- BreadCrumb End -->


    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Thao tác</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($all_like_product as $key => $like_product)
                            <tr class="like-product-{{ $like_product->id }}">
                                <td class="align-middle"><img
                                        src="{{ asset('/storage/product_image/' . $like_product->product_image) }}"
                                        alt="" style="width: 100px;"></td>
                                <td class="align-middle">
                                    <a href="{{ url('/chi-tiet-san-pham/' . $like_product->id) }}">
                                        {{ $like_product->product_name }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    {{ number_format($like_product->product_price, 0, ',', '.') . ' VNĐ' }}
                                </td>
                                <td class="align-middle">
                                    <form action="{{ url('/delete-like-product/' . $like_product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-primary delete-like-product"
                                            data-id="{{ $like_product->id }}"><i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
