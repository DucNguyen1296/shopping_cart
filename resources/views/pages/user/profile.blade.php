@extends('layout')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông tin cá nhân</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/trang-chu">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thông tin cá nhân</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- BreadCrumb Start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
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
            <div class="col-lg-9">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Hồ sơ của bạn</h4>
                    </div>
                    <form action="{{ url('update-profile/' . $user->id) }}" enctype="multipart/form-data" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body d-flex flex-row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <h6 class="font-weight-medium mb-3">Tên đăng nhập</h6>
                                    <input class=" form-control" type="text" name="name" value="{{ $user->name }}">
                                </div>

                                <div class="form-group">
                                    <h6 class="font-weight-medium mb-3">Email</h6>
                                    <input class=" form-control" type="email" name="email" value="{{ $user->email }}">
                                </div>

                                <div class="form-group">
                                    <h6 class="font-weight-medium mb-3">Số điện thoại</h6>
                                    <input class=" form-control" type="text" name="phone" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card mb-4 p-4" style="border: none;">
                                    <img id="image_preview" src="{{ asset('/storage/avatar/' . $user->avatar) }}"
                                        alt="" style="clip-path: circle(50%);">
                                </div>
                                <label class="px-5" for="camera">
                                    <div class="btn btn-primary"> Tải ảnh lên
                                        <i class="fas fa-solid fa-camera"></i>
                                    </div>
                                </label>
                                <input type="file" name="avatar" id="camera" style="display: none; visibility: none"
                                    onchange="loadFile(event)" />
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            {{-- <div class="col-lg-4">
                <div class="card mb-5 p-5">
                    <img src="{{ asset('/storage/avatar/' . Auth::user()->avatar) }}" alt="">
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        let loadFile = function(event) {
            let image_preview = document.getElementById('image_preview');
            image_preview.src = URL.createObjectURL(event.target.files[0]);

        };
    </script>
@endsection
