<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Mua sắm thỏa thich</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">


</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Hướng dẫn</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Hỗ trợ(24/7)</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Liên hệ</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
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
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <span class="text-muted px-2">|</span>
                    @if (Auth::user())
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                style="padding: 0;">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ url('/profile') }}" class="dropdown-item">Thông tin cá nhân</a>
                                <a href="{{ url('/purchase') }}" class="dropdown-item">Đơn mua</a>
                                <a href="{{ url('/logout-checkout') }}" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </div>
                    @else
                        <a class="text-dark" href="{{ url('/login-checkout') }}">Đăng nhập</a>
                        <span class="text-muted px-2">|</span>
                        <a class="text-dark" href="{{ url('/register-checkout') }}">Đăng ký</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="/trang-chu" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="{{ url('/tim-kiem') }}" method="GET">
                    @csrf
                    <div class="input-group">

                        <input type="text" class="form-control" placeholder="Tìm kiếm" name="keywords_submit">
                        <div class="input-group-append" style="height: 38px;">
                            <span class="input-group-text bg-transparent text-primary">
                                <label for="btn-search" class="mb-0">
                                    <i class="fa fa-search"></i>
                                </label>
                                <button class="btn btn-sm" type="submit" id="btn-search"
                                    style="display:none; visibility: none"></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                @if (Auth::user())
                    <a href="{{ url('/show-like-product') }}" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">{{ $user->products->count() }}</span>
                    </a>
                @else
                    <a href="{{ url('/login-checkout') }}" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                @endif
                <a href="{{ url('/show-cart') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    @if (session()->get('cart') != null)
                        <span class="badge">{{ count(session()->get('cart')) }}</span>
                    @else
                        <span class="badge">0</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    {{-- <div class="navbar-nav w-100 overflow-hidden" style="height: 410px"> --}}
                    <div class="navbar-nav w-100">
                        @foreach ($all_category_product as $key => $cate)
                            <div class="nav-item dropright">
                                <span class="nav-link" data-toggle="dropdown"
                                    style="cursor: pointer">{{ $cate->category_name }}
                                    <i class="fa fa-angle-down float-right mt-1"></i></span>
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                    @foreach ($cate->brands as $key => $brand)
                                        <a href="{{ url('/thuong-hieu-san-pham/' . $brand->id) }}"
                                            class="dropdown-item">{{ $brand->brand_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/trang-chu" class="nav-item nav-link active">Trang chủ</a>
                            <a href="" class="nav-item nav-link">Khuyến mãi trong ngày</a>
                            <a href="" class="nav-item nav-link">Kênh bán hàng</a>
                            @if (Auth::user())
                                <a href="{{ url('/show-like-product') }}" class="nav-item nav-link">Yêu thích</a>
                            @else
                                <a href="{{ url('/login-checkout') }}" class="nav-item nav-link">Yêu thích</a>
                            @endif
                            <a href="/show-cart" class="nav-item nav-link">Giỏ hàng</a>
                            {{-- @foreach ($all_category_product as $key => $cate)
                                <a href="{{ url('/danh-muc-san-pham/' . $cate->id) }}"
                                    class="nav-item nav-link">{{ $cate->category_name }}</a>
                            @endforeach --}}
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-danger"
                                    data-toggle="dropdown">Sự kiện đang diễn ra</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($all_event as $event)
                                        <a href="{{ url('/event-san-pham/' . $event->id) }}"
                                            class="dropdown-item">{{ $event->event_name }}</a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    @php
                        $i = 0;
                    @endphp
                    <div class="carousel-inner">
                        @foreach ($all_event as $event)
                            @php
                                $i++;
                            @endphp
                            {{-- <div class="carousel-item {{ $i == 1 ? 'active' : '' }}" style="height: 410px;"> --}}
                            <div class="carousel-item {{ $i == 1 ? 'active' : '' }}" style="height: 500px;">
                                <img class="img-fluid"
                                    src="{{ asset('storage/event_image/' . $event->event_image) }}" alt="Image">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                            {{ $event->event_desc }}</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                            {{ $event->event_content }}</h3>
                                        <a href="{{ url('event-san-pham/' . $event->id) }}"
                                            class="btn btn-light py-2 px-3">Xem ngay</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Featured Start -->

    <!-- Featured End -->


    <!-- Categories Start -->

    <!-- Categories End -->


    <!-- Offer Start -->

    <!-- Offer End -->


    <!-- Products Start -->

    <!-- Products End -->


    <!-- Subscribe Start -->

    <!-- Subscribe End -->


    <!-- Hot Products Start -->

    <!-- Hot Products End -->


    <!-- Vendor Start -->

    <!-- Vendor End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Nền tảng thương mại điện tử cho người dùng trải nghiệm mua sắm và bán hàng online.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Đường chim bay, Hà Nội,
                    Việt Nam</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Link nhanh</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="/trang-chu"><i class="fa fa-angle-right mr-2"></i>Trang
                                chủ</a>
                            <a class="text-dark mb-2" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Tất
                                cả các sản phẩm</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Khuyến
                                mãi trong ngày</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Yêu
                                thích</a>
                            <a class="text-dark mb-2" href="{{ url('show-cart') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Giỏ hàng của bạn</a>
                            @if (Auth::user())
                                <a class="text-dark mb-2" href="{{ url('/purchase') }}"><i
                                        class="fa fa-angle-right mr-2"></i>Đơn mua</a>
                            @else
                                <a class="text-dark mb-2" href="{{ url('login-checkout') }}"><i
                                        class="fa fa-angle-right mr-2"></i>Đơn mua</a>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Về Shopper</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Giới
                                thiệu về Shopper</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Điều
                                khoản sử dụng</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Chính
                                sách bảo mật</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Liên
                                hệ</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Hỗ
                                trợ</a>
                            <a class="text-dark" href=""><i class="fa fa-angle-right mr-2"></i>Hướng dẫn sử
                                dụng</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Gửi đánh giá của bạn</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Họ & Tên"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Shopper.com.vn</a>. Bản quyền
                    được sở hữu và đăng ký bởi <a class="text-dark font-weight-semi-bold"
                        href="https://htmlcodex.com">HTML Codex</a><br>
                    Phân phối bởi <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <h6>Thanh toán</h6>
                <img class="img-fluid" src="{{ asset('img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/sweetalert.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        load_more_product();

        function load_more_product(id = '') {
            $.ajax({
                url: '{{ url('/load-more-product') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#load-more-button').remove();
                    $('#all_product').append(data);
                }
            });
        }

        $(document).on('click', '#load-more-button', function() {
            var id = $(this).data('id');
            load_more_product(id);
        })
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-cart') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },
                    success: function(data) {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn muốn chọn hàng tiếp hoặc tới giỏ hàng để thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('/show-cart') }}"
                            });
                    }
                });
            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');

                var ma_id = $(this).val();

                var _token = $('input[name="_token"]').val();

                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>

    <script>
        let btnDeleteLikeProduct = document.querySelectorAll(".delete-like-product");
        for (let i = 0; i < btnDeleteLikeProduct.length; i++) {
            btnDeleteLikeProduct[i].onclick = function(e) {
                e.preventDefault();
                // console.log(e);
                let id = e.target.getAttribute('data-id');
                axios.delete("/delete-like-product/" + id).then(function(response) {
                    document.querySelector('.like-product-' + id).remove();
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    </script>

    {{-- <script>
        let btnDeleteLikePro = document.querySelectorAll(".delete-likePro-button");
        for (let i = 0; i < btnDeleteLikePro.length; i++) {
            btnDeleteLikePro[i].onclick = function(e) {
                e.preventDefault();
                // console.log(e);
                let id = e.target.getAttribute('data-id');
                axios.delete("/delete-like-product/" + id).then(function(response) {
                    document.querySelector('.like-product-' + id).remove();
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.orderBy').change(function() {
                $('#form-order').submit()
            });
        });
    </script>
</body>

</html>
