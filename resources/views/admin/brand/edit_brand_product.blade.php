@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập thương hiệu sản phẩm
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
                        <form autocomplete="off" role="form" action="{{ route('brand.update', [$brand->id]) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input value="{{ $brand->brand_name }}" name="brand_name" type="text"
                                    class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <textarea name="brand_desc" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả thương hiệu">{{ $brand->brand_desc }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa thương hiệu</label>
                                <textarea name="meta_keywords" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Từ khóa thương hiệu">{{ $brand->meta_keywords }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="category_id" class="form-control input-sm m-bot15">
                                    @foreach ($all_category_product as $key => $value)
                                        <option {{ $brand->category_id == $value->id ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="brand_status" class="form-control input-sm m-bot15">
                                    @if ($brand->brand_status == 0)
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @else
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Sửa thương hiệu</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
