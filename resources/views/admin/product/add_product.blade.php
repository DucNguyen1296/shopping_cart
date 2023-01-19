@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form autocomplete="off" role="form" action="{{ route('product.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input name="product_name" type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên sản phẩm ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá thành sản phẩm</label>
                                <input name="product_price" type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Giá thành sản phẩm ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input name="product_image" type="file" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea name="product_desc" style="resize: none" type="text" class="form-control" id=""
                                    placeholder="Mô tả sản phẩm "> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea name="product_content" style="resize: none" type="text" class="form-control" id="ckeditor1"
                                    placeholder="Nội dung sản phẩm "> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa sản phẩm</label>
                                <textarea name="meta_keywords" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Từ khóa sản phẩm" required> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="product_category" id="product_category"
                                    class="form-control input-sm m-bot15 choose-cate">
                                    <option value="">----> Chọn danh mục sản phẩm <---- </option>
                                            @foreach ($all_category_product as $key => $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select name="product_brand" id="product_brand" class="form-control input-sm m-bot15">
                                    <option value="">----> Chọn thương hiệu sản phẩm <---- </option>
                                            {{-- @foreach ($all_brand_product as $key => $brand) --}}
                                            {{-- <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option> --}}
                                            {{-- @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Sự kiện</label>
                                <select name="product_event" id="product_event"
                                    class="form-control input-sm m-bot15 choose-event">
                                    <option value="0">Không</option>
                                    @foreach ($all_event as $key => $all_event)
                                        <option value="{{ $all_event->id }}">{{ $all_event->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Giảm giá sự kiện</label>
                                <select name="product_event_detail" id="product_event_detail"
                                    class="form-control input-sm m-bot15">
                                    <option value="0">Không</option>
                                    {{-- @foreach ($all_event_detail as $key => $event_detail)
                                        <option value="{{ $event_detail->id }}">{{ $event_detail->event_detail_discount }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button name="add_product" type="submit" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>

    

@endsection
