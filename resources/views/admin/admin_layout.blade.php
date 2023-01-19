<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { 
        setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){ window.scrollTo(0,1); 
        } 
        </script>
    <link rel="shortcut icon" href="{{ asset('admin/images/icon.png') }}">
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom CSS -->
    <link href="{{ asset('admin/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('admin/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}" type="text/css" />
    <link href="{{ asset('admin/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('admin/css/monthly.css') }}">
    <!-- //calendar -->


    <!-- //font-awesome icons -->
    <script src="{{ asset('admin/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('admin/js/morris.js') }}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ url('/admin-dashboard') }}" class="logo">
                    Admin
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('admin/images/2.png') }}">
                            <span class="username">Admin Name</span>
                            {{-- <span class="username">Admin</span> --}}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ url('/admin-dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ url('/manage-order') }}">Quản lý đơn hàng</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>

                            <ul class="sub">
                                <li><a href="{{ route('delivery.create') }}">Thêm phí vận chuyển</a></li>
                                <li><a href="{{ route('delivery.index') }}">Quản lý phí vận chuyển</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('coupon.index') }}">Quản lý mã giảm giá</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{ route('coupon.create') }}">Thêm mã giảm giá</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sự kiện</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('event.index') }}">Quản lý sự kiện</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{ route('event.create') }}">Thêm sự kiện</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('category.index') }}">Quản lý danh mục sản phẩm</a></li>
                                <li><a href="{{ route('category.create') }}">Thêm danh mục sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('brand.index') }}">Quản lý thương hiệu sản phẩm</a></li>
                                <li><a href="{{ route('brand.create') }}">Thêm thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('product.index') }}">Quản lý sản phẩm</a></li>
                                <li><a href="{{ route('product.create') }}">Thêm sản phẩm</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('admin_content')

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
                    </p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('admin/js/jquery.scrollTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>




    <script type="text/javascript">
        var ckeditor1 = document.getElementById('ckeditor1');
        // console.log(ckeditor1);
        CKEDITOR.replace('ckeditor1', {
            filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
            filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });

        // CKEDITOR.replace('ckeditor2', {
        //     filebrowserBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html') }}',
        //     filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        //     filebrowserWindowWidth: '1000',
        //     filebrowserWindowHeight: '700'
        // });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose-cate-event').on('change', function() {
                var action = $(this).attr('id');

                var ma_id = $(this).val();

                var _token = $('input[name="_token"]').val();

                var result = '';

                if (action == 'product_category_event') {
                    result = 'product_brand_event';
                }

                $.ajax({
                    url: '{{ url('/select-brand-event') }}',
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose-cate').on('change', function() {
                var action = $(this).attr('id');

                var ma_id = $(this).val();

                var _token = $('input[name="_token"]').val();

                var result = '';

                if (action == 'product_category') {
                    result = 'product_brand';
                }

                $.ajax({
                    url: '{{ url('/select-brand') }}',
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

        $(document).ready(function() {
            $('.choose-event').on('change', function() {
                var action = $(this).attr('id');

                var ma_id = $(this).val();

                var _token = $('input[name="_token"]').val();

                var result = '';

                if (action == 'product_event') {
                    result = 'product_event_detail';
                }

                $.ajax({
                    url: '{{ url('/select-event-detail') }}',
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

    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                // alert(pro_id);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-gallery') }}',
                    method: 'POST',
                    data: {
                        pro_id: pro_id,
                        _token: _token

                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                })
            }

            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 5) {
                    error += '<p>Bạn chỉ được chọn tối đa 5 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống trường này</p>';
                } else if (files.size > 2000000) {
                    error += '<p>Kích thước file không lớn 2MB</p>';
                }

                if (error == '') {

                } else {

                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;
                }
            });

            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-gallery-name') }}',
                    method: 'POST',
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token

                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhập tên hình ảnh thành công</span>'
                        );
                    }
                })
            });

            $(document).on('click', '.delete_gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn có muốn xóa hình ảnh này không?')) {
                    $.ajax({
                        url: '{{ url('/delete-gallery') }}',
                        method: 'POST',
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa hình ảnh thành công</span>'
                            );
                        }
                    })
                }
            });

            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-' + gal_id).files[0];

                var form_data = new FormData();
                form_data.append("file", image);
                form_data.append("gal_id", gal_id);

                $.ajax({
                    url: '{{ url('/update-gallery') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhập hình ảnh thành công</span>'
                        );
                    }
                })

            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('admin/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->


</body>

@if (session()->has('correct'))
    <script>
        alert('{{ session('correct') }}');
    </script>
@endif

</html>
