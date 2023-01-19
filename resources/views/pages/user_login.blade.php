@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Đăng nhập</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thành viên mới? <a href="{{ url('/register-checkout') }}">Đăng ký</a> tại đây.</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <form action="{{ url('/login-user') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </form>
                        <div style="margin-top:10px;">
                            <a href="#">
                                Quên mật khẩu ?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <h3 class="or">Hoặc</h3>
            </div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <a class="btn btn-lg btn-block btn-primary" href="#" role="button">Đăng nhập bằng
                            Facebook</a>
                        <a class="btn btn-lg btn-block btn-secondary" href="#" role="button">Đăng nhập bằng Gmail</a>
                        <a class="btn btn-lg btn-block btn-warning" href="{{ url('/register-checkout') }}"
                            role="button">Đăng ký mới</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
    @endif
@endsection
