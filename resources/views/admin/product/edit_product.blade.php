@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa sản phẩm
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
                        <form autocomplete="off" role="form" action="{{ route('product.update', [$product->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input value="{{ $product->product_name }}" name="product_name" type="text"
                                    class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá thành sản phẩm</label>
                                <input value="{{ $product->product_price }}" name="product_price" type="text"
                                    class="form-control" id="exampleInputEmail1" placeholder="Giá thành sản phẩm ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input name="product_image" type="file" class="form-control" id="exampleInputEmail1">
                                <img src="{{ asset('/storage/product_image/' . $product->product_image) }}" alt=""
                                    height="250" width="180">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea name="product_desc" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả sản phẩm "> {{ $product->product_desc }} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea name="product_content" style="resize: none" type="text" class="form-control" id="ckeditor2"
                                    placeholder="Nội dung sản phẩm ">{!! $product->product_content !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa sản phẩm</label>
                                <textarea name="meta_keywords" style="resize: none" type="text" class="form-control"
                                    placeholder="Nội dung sản phẩm ">{{ $product->meta_keywords }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="product_category" id="product_category"
                                    class="form-control input-sm m-bot15 choose-cate">
                                    @foreach ($all_category_product as $key => $cate)
                                        <option {{ $cate->id == $product->category_id ? 'selected' : '' }}
                                            value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select name="product_brand" id="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($product->category->brands as $key => $brand)
                                        <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                            value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sự kiện</label>
                                <select name="product_event" id="product_event"
                                    class="form-control input-sm m-bot15 choose-event">
                                    <option value="0">Không</option>
                                    @foreach ($all_event as $key => $event)
                                        <option {{ $event->id == $product->event_id ? 'selected' : '' }}
                                            value="{{ $event->id }}">{{ $event->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giảm giá sự kiện</label>
                                <select name="product_event_detail" id="product_event_detail"
                                    class="form-control input-sm m-bot15">
                                    @if ($product->event_id == 0)
                                        <option value="0">Không</option>
                                    @else
                                        @foreach ($product->event->event_details as $key => $event_detail)
                                            @if ($event_detail->event_detail_type == 1)
                                                <option
                                                    {{ $event_detail->id == $product->event_detail_id ? 'selected' : '' }}
                                                    value="{{ $event_detail->id }}">
                                                    {{ $event_detail->event_detail_discount }} %
                                                </option>
                                            @elseif($event_detail->event_detail_type == 2)
                                                <option
                                                    {{ $event_detail->id == $product->event_detail_id ? 'selected' : '' }}
                                                    value="{{ $event_detail->id }}">
                                                    {{ number_format($event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    @if ($product->product_status == 0)
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @else
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button name="update_product" type="submit" class="btn btn-info">Sửa</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
