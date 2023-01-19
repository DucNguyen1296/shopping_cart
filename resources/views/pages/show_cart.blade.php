@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng của bạn</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('trang-chu') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ hàng của bạn</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">

        <div class="row px-xl-2">

            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Thao tác</th>
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

                                <tr class="cart-detail-{{ $cart['session_id'] }}">
                                    <td class="align-middle"><img
                                            src="{{ asset('storage/product_image/' . $cart['product_image']) }}"
                                            alt="" style="width: 50px;">
                                        {{ $cart['product_name'] }}</td>
                                    <td class="align-middle">
                                        {{ number_format($cart['product_price'], 0, ',', '.') . ' VNĐ' }}</td>
                                    <form action="{{ url('/update-cart') }}" method="POST">
                                        @csrf
                                        <td class="align-middle">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-sm bg-secondary text-center"
                                                    name="cart_qty[{{ $cart['session_id'] }}]"
                                                    value="{{ $cart['product_qty'] }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                    <td class="align-middle">{{ number_format($subtotal, 0, ',', '.') . ' VNĐ' }}</td>
                                    <td class="align-middle">
                                        {{-- <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> --}}
                                        <form action="{{ url('/delete-cart/' . $cart['session_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('/delete-cart/' . $cart['session_id']) }}">
                                                <button class="btn btn-sm btn-primary delete-cart"
                                                    data-session_id="{{ $cart['session_id'] }}"><i
                                                        class="fa fa-times"></i></button>
                                            </a>
                                        </form>
                                        <a
                                            href="{{ url('thuong-hieu-san-pham/' . $all_product->where('id', $cart['product_id'])->first()->brand_id) }}">
                                            Xem sản phẩm tương tự
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Thêm sản phẩm vào giỏ hàng của bạn</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4">
                <form class="mb-5" action="{{ url('/check-coupon') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="coupon_code" class="form-control p-4" placeholder="Nhập mã giảm giá">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Thêm mã</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h5 class="font-weight-semi-bold m-0">Khu vực vận chuyển</h5>
                    </div>
                    <div class="card-body">
                        <form autocomplete="off" role="form" action="{{ url('/check-delivery') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city"
                                    required>
                                    <option value="">----> Chọn thành phố <---- </option>
                                            @foreach ($city as $key => $ci)
                                    <option value="{{ $ci->city_code }}">{{ $ci->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province"
                                    required>
                                    <option value="">----> Chọn quận huyện <---- </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards" required>
                                    <option value="">----> Chọn xã phường <---- </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info add_delivery">Tính phí vận
                                chuyển</button>
                        </form>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Giá trị giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Phí tổng</h6>
                            <h6 class="font-weight-medium">{{ number_format($total, 0, ',', '.') . ' VNĐ' }}</h6>
                        </div>
                        <?php
                        $tong_giam = 0;
                        $VAT = 0;
                        $phi_van_chuyen = 0;
                        ?>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Mã giảm</h6>
                            <h6 class="font-weight-medium">

                                @if (Session::get('coupon'))
                                    <?php
                                    $giam_gia = Session::get('coupon');
                                    session()->put('giam_gia', $giam_gia);
                                    ?>
                                    @if ($giam_gia->coupon_condition == 1)
                                        {{ $giam_gia->coupon_numbers . ' %' }}
                                        <?php
                                        $tong_giam = ($total * $giam_gia->coupon_numbers) / 100;
                                        ?>
                                    @elseif($giam_gia->coupon_condition == 2)
                                        {{ number_format($giam_gia->coupon_numbers, 0, ',', '.') . ' VNĐ' }}
                                        <?php
                                        $tong_giam = $giam_gia->coupon_numbers;
                                        ?>
                                    @endif
                                @endif
                            </h6>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Thuế VAT</h6>
                            <h6 class="font-weight-medium">
                                {{ number_format($total * 0.1, 0, ',', '.') . ' VNĐ' }}
                                <?php
                                $VAT = $total * 0.1;
                                ?>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">
                                @if (Session::get('delivery'))
                                    <?php
                                    $van_chuyen = Session::get('delivery');
                                    session()->put('van_chuyen', $van_chuyen);
                                    ?>
                                    {{ number_format($van_chuyen->delivery_fee, 0, ',', '.') . ' VNĐ' }}
                                    <?php
                                    $phi_van_chuyen = $van_chuyen->delivery_fee;
                                    ?>
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Thành tiền</h5>
                            <h5 class="font-weight-bold text-danger">
                                <?php
                                $thanh_tien = $total - $tong_giam + $VAT + $phi_van_chuyen;
                                
                                session()->put('tong_giam', $tong_giam);
                                session()->put('phi_van_chuyen', $phi_van_chuyen);
                                session()->put('thanh_tien', $thanh_tien);
                                ?>
                                {{ number_format($thanh_tien, 0, ',', '.') . ' VNĐ' }}
                            </h5>
                        </div>
                        @if (Auth::user())
                            <a href="{{ url('/shipping-cart') }}">
                                <button class="btn btn-block btn-primary my-3 py-3">
                                    Thanh toán
                                </button>
                            </a>
                        @else
                            <a href="{{ url('/login-checkout') }}">
                                <button type="submit" class="btn btn-block btn-primary my-3 py-3">Thanh toán</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Cart End -->
    @if (session()->has('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
    @endif

    {{-- <script>
        let btnDeleteCart = document.querySelectorAll(".delete-cart");
        for (let i = 0; i < btnDeleteCart.length; i++) {
            btnDeleteCart[i].onclick = function(e) {
                e.preventDefault();
                // console.log(e);
                let session_id = e.target.getAttribute('data-session_id');
                axios.delete("/delete-cart/" + session_id).then(function(response) {
                    document.querySelector('.cart-detail-' + session_id).remove();
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    </script> --}}
@endsection
