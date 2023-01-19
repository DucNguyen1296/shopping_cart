@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Cảm ơn bạn đã đặt hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/trang-chu') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Trở về trang chủ để tiếp tục mua sắm</p>
            </div>
        </div>
    </div>
    <div>
        <p>Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
    </div>
    <!-- Page Header End -->
@endsection
