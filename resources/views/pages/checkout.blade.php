@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh toán</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/trang-chu') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ url('/show-cart') }}">Chỉnh sửa giỏ hàng của bạn</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">
                        <?php
                        $total = 0;
                        ?>
                        @if (Session::get('cart'))
                            @foreach (Session::get('cart') as $key => $cart)
                                <?php
                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                $total += $subtotal;
                                ?>

                                <tr>
                                    <td class="align-middle"><img
                                            src="{{ asset('storage/product_image/' . $cart['product_image']) }}"
                                            alt="" style="width: 50px;">
                                        {{ $cart['product_name'] }}</td>
                                    <td class="align-middle">
                                        {{ number_format($cart['product_price'], 0, ',', '.') . ' VNĐ' }}</td>

                                    <td class="align-middle">
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                            name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}">
                                    </td>

                                    <td class="align-middle">{{ number_format($subtotal, 0, ',', '.') . ' VNĐ' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Thêm sản phẩm vào giỏ hàng của bạn</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="col-lg-12 mt-5">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Thông tin gửi hàng - <a
                                href="{{ url('/shipping-cart') }}">Thay đổi</a></h4>

                        <div class="form-group">
                            <label>Tên</label>
                            {{-- <input class="form-control" type="text" placeholder="Name"> --}}
                            <div class="form-control">{{ $shipping->shipping_name }}</div>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <div class="form-control">{{ $shipping->shipping_email }}</div>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <div class="form-control">{{ $shipping->shipping_phone }}</div>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ gửi hàng</label>
                            <div class="form-control">{{ $shipping->shipping_address }}</div>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú đơn hàng</label>
                            <div class="form-control">{{ $shipping->shipping_note }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thanh toán đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                        @if (Session::get('cart'))
                            @foreach (Session::get('cart') as $key => $cart)
                                <div class="d-flex justify-content-between">
                                    <p>{{ $cart['product_name'] }}</p>
                                    <p>{{ number_format($cart['product_price'], 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        @endif
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Phí tổng</h6>
                            <h6 class="font-weight-medium">{{ number_format($total, 0, ',', '.') . ' VNĐ' }}</h6>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Mã giảm</h6>
                            <h6 class="font-weight-medium">
                                @if (Session::get('giam_gia'))
                                    @if (session()->get('giam_gia')->coupon_condition == 1)
                                        {{ session()->get('giam_gia')->coupon_numbers . ' %' }}
                                    @elseif(session()->get('giam_gia')->coupon_condition == 2)
                                        {{ number_format(session()->get('giam_gia')->coupon_numbers, 0, ',', '.') . ' VNĐ' }}
                                    @endif
                                @endif
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Thuế VAT</h6>
                            <h6 class="font-weight-medium">{{ number_format($total * 0.1, 0, ',', '.') . ' VNĐ' }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">
                                {{ number_format(session()->get('van_chuyen')->delivery_fee, 0, ',', '.') . ' VNĐ' }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng</h5>
                            <h5 class="font-weight-bold">
                                {{ number_format(session()->get('thanh_tien'), 0, ',', '.') . ' VNĐ' }}</h5>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ url('/save-checkout') }}">
                    @csrf
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Hình thức thanh toán</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_option" id="paypal"
                                        value="1">
                                    <label class="custom-control-label" for="paypal">Trả thẻ VISA</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_option"
                                        id="directcheck" value="2">
                                    <label class="custom-control-label" for="directcheck">Trả tiền mặt</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_option"
                                        id="banktransfer" value="3">
                                    <label class="custom-control-label" for="banktransfer">Chuyển khoản</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
