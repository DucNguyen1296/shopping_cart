@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa mã giảm giá sản phẩm
                </header>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="position-center">
                        <form autocomplete="off" role="form" action="{{ route('coupon.update', [$coupon->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input name="coupon_name" type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{ $coupon->coupon_name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mã giảm giá</label>
                                <input name="coupon_code" type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{ $coupon->coupon_code }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng mã giảm giá</label>
                                <input name="coupon_times" type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{ $coupon->coupon_times }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng mã giảm giá</label>
                                <select name="coupon_condition" class="form-control input-sm m-bot15">
                                    <option value="0">----Chọn----</option>
                                    @if ($coupon->coupon_condition == 1)
                                        <option selected value="1">Giảm giá theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                                    @elseif($coupon->coupon_condition == 2)
                                        <option value="1">Giảm giá theo %</option>
                                        <option selected value="2">Giảm theo tiền</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số % hoặc tiền giảm</label>
                                <input name="coupon_numbers" type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{ $coupon->coupon_numbers }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="coupon_status" class="form-control input-sm m-bot15">
                                    @if ($coupon->coupon_status == 0)
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @else
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button name="add_coupon" type="submit" class="btn btn-info">Sửa mã</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
