@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa sự kiện
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
                        <form autocomplete="off" role="form"
                            action="{{ route('event_detail.update', [$event_detail->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sự kiện</label>
                                <select name="event_id" class="form-control input-sm m-bot15">
                                    {{-- <option value="0">----Chọn----</option> --}}
                                    @foreach ($all_event as $key => $value)
                                        <option {{ $event_detail->event_id == $value->id ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng sự kiện</label>
                                <select name="event_detail_type" class="form-control input-sm m-bot15">
                                    <option value="0">----Chọn----</option>
                                    @if ($event_detail->event_detail_type == 1)
                                        <option selected value="1">Giảm giá theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                                    @elseif ($event_detail->event_detail_type == 2)
                                        <option value="1">Giảm giá theo %</option>
                                        <option selected value="2">Giảm theo tiền</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số % hoặc tiền giảm</label>
                                <input name="event_detail_discount" type="text" class="form-control"
                                    id="exampleInputEmail1" placeholder="Giá trị giảm giá"
                                    value="{{ $event_detail->event_detail_discount }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày bắt đầu</label>
                                <input name="event_detail_start" type="date" class="form-control" id="exampleInputEmail1"
                                    value="{{ $event_detail->event_detail_start }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày kết thúc</label>
                                <input name="event_detail_end" type="date" class="form-control" id="exampleInputEmail1"
                                    value="{{ $event_detail->event_detail_end }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Áp dụng cho danh mục</label>
                                <select name="category_id" class="form-control input-sm m-bot15 choose-cate-event"
                                    id="product_category_event">
                                    <option value="0">Không</option>
                                    @if ($event_detail->brand != null)
                                        @foreach ($all_category as $key => $cate)
                                            <option {{ $event_detail->brand->category->id == $cate->id ? 'selected' : '' }}
                                                value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                        @endforeach
                                    @elseif($event_detail->category != null)
                                        @foreach ($all_category as $key => $cate)
                                            <option {{ $event_detail->category->id == $cate->id ? 'selected' : '' }}
                                                value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($all_category as $key => $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Áp dụng cho thương hiệu</label>
                                <select name="brand_id" class="form-control input-sm m-bot15" id="product_brand_event">
                                    <option value="0">Không</option>
                                    @if ($event_detail->brand != null)
                                        @foreach ($event_detail->category->brands as $key => $value)
                                            <option {{ $event_detail->brand_id == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">
                                                {{ $value->brand_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="event_detail_status" class="form-control input-sm m-bot15">
                                    @if ($event_detail->event_detail_status == 0)
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @elseif ($event_detail->event_detail_status == 1)
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button name="add_event" type="submit" class="btn btn-info">Sửa sự kiện</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
