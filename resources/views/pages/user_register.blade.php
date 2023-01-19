@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Đăng ký mới</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Bạn đã có tài khoản? <a href="{{ url('/login-checkout') }}">Đăng nhập</a> tại đây.</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-sm-offset-1">
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <form action="{{ url('/register-user') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ & Tên</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                    else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-1">
                <h3 class="or">Hoặc</h3>
            </div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <a class="btn btn-lg btn-block btn-primary" href="#" role="button">Đăng ký bằng Facebook</a>
                        <a class="btn btn-lg btn-block btn-secondary" href="#" role="button">Đăng ký bằng Gmail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
