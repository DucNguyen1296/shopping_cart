@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông tin gửi hàng của bạn</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thông tin gửi hàng của bạn</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container">
        <form action="{{ url('/add-shipping-cart') }}" method="POST">
            @csrf
            <div class="col-lg-8 mt-5">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin gửi hàng</h4>

                    <div class="form-group">
                        <label>Họ & Tên</label>
                        <input class="form-control" name="shipping_name" type="text" placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" name="shipping_email" type="email" placeholder="example@email.com"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="shipping_phone" type="text" placeholder="Phone Number"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ gửi hàng</label>
                        <textarea class="form-control" name="shipping_address" id="" cols="90" rows="5" style="resize: none"
                            placeholder="Địa chỉ gửi hàng" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú đơn hàng</label>
                        <textarea class="form-control" name="shipping_note" id="" cols="90" rows="5" style="resize: none"
                            placeholder="Ghi chú đơn hàng" required></textarea>
                    </div>
                    <div class="d-flex flex-row justify-content-between mt-2">
                        <a href="{{ url('/show-cart') }}" class="btn btn-block btn-secondary my-3 py-3">
                            Trở lại
                        </a>
                        <button type="submit" class="btn btn-block btn-primary my-3 py-3">Thanh toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
