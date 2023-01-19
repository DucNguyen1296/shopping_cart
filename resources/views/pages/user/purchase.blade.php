@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Đơn hàng của bạn</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/trang-chu">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Đơn hàng của bạn</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- BreadCrumb Start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đơn hàng của bạn</li>
        </ol>
    </nav>
    <!-- BreadCrumb End -->

    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h6>Chỉnh sửa thông tin</h6>
                    </div>
                    <div class="text-right d-flex flex-row justify-content-between mt-3 mx-3">
                        <i class="fas fa-solid fa-user"></i>
                        <p><a href="{{ url('/profile') }}">Thông tin cá nhân</a></p>
                    </div>
                    <div class="text-right d-flex flex-row justify-content-between mt-3 mx-3">
                        <i class="fas fa-solid fa-coins"></i>
                        <p><a href="{{ url('/purchase') }}">Đơn mua</a></p>
                    </div>
                    <div class="text-right d-flex flex-row justify-content-between mt-3 mx-3">
                        <i class="fas fa-solid fa-bell"></i>
                        <p><a href="">Thông báo</a></p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column col-lg-9">
                @foreach ($all_order as $key => $order)
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <div class="d-flex flex-row justify-content-between">
                                <h4 class="font-weight-semi-bold m-0">Đơn hàng của bạn</h4>
                                <div class="text-danger">Tình trạng: {{ $order->order_status }}</div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            @foreach ($order->order_details as $key => $order_detail)
                                <div class="card-body d-flex flex-row" style="border-bottom: 1px solid #777">
                                    <div class="col-lg-2">
                                        <img src="{{ asset('storage/product_image/' . $order_detail->product->product_image) }}"
                                            alt="" height="100px" width="100px">
                                    </div>
                                    <div class="d-flex flex-column col-lg-7">
                                        <h5>{{ $order_detail->product_name }}</h5>
                                        <div>Số lượng: x {{ $order_detail->product_quantity }}</div>
                                        <div>VAT:
                                            {{ number_format($order_detail->product->product_price * 0.1, 0, ',', '.') . ' VNĐ' }}
                                        </div>
                                        @if ($order_detail->coupon != null)
                                            @if ($order_detail->coupon->coupon_condition == 1)
                                                <div>Mã giảm giá: {{ $order_detail->coupon->coupon_numbers }} %</div>
                                            @elseif($order_detail->coupon->coupon_condition == 2)
                                                <div>Mã giảm giá:
                                                    {{ number_format($order_detail->coupon->coupon_numbers, 0, ',', '.') . ' VNĐ' }}
                                                </div>
                                            @endif
                                        @else
                                            <div>Mã giảm giá: Không</div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column col-lg-3">
                                        @if ($order_detail->product->event_id != 0)
                                            <?php
                                            $gia_sp = $order_detail->product->product_price;
                                            ?>
                                            @if ($order_detail->product->event_detail->event_detail_type == 1)
                                                <h5 class="text-muted">
                                                    <del>{{ number_format($order_detail->product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                                </h5>
                                                <h5 class="text-danger">
                                                    {{ number_format($gia_sp - $gia_sp * ($order_detail->product->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' }}
                                                </h5>
                                            @elseif($order_detail->product->event_detail->event_detail_type == 2)
                                                <h5 class="text-muted">
                                                    <del>{{ number_format($order_detail->product->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                                </h5>
                                                <h5 class="text-danger">
                                                    {{ number_format($gia_sp - $order_detail->product->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                                </h5>
                                            @endif
                                        @else
                                            <p class="font-weight-semi-bold">
                                                {{ number_format($order_detail->product_price, 0, ',', '.') . ' VNĐ' }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer bg-secondary border-0">
                            <div class="d-flex flex-column float-right">
                                <p>
                                    Phí vận chuyển:
                                    {{ number_format($order_detail->delivery->delivery_fee, 0, ',', '.') . ' VNĐ' }}
                                </p>
                                <div class="font-weight-semi-bold m-0 text-right">Thành tiền:
                                    <span class="font-weight-bold text-danger"
                                        style="font-size: 1.5rem">{{ $order->order_total . ' VNĐ' }}</span>
                                </div>
                                <form action="{{ url('/delete-order/' . $order->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')"
                                        class="btn btn-danger w-100">Hủy đơn hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
