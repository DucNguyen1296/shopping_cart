@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập danh mục sản phẩm
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
                        <form autocomplete="off" role="form" action="{{ route('category.update', [$category->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input value="{{ $category->category_name }}" name="category_name" type="text"
                                    class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea name="category_desc" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả danh mục">{{ $category->category_desc }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input name="category_image" type="file" class="form-control" id="exampleInputEmail1">
                                <img src="{{ asset('/storage/category_image/' . $category->category_image) }}"
                                    alt="" height="250" width="180">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                <textarea name="meta_keywords" style="resize: none" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả danh mục">{{ $category->meta_keywords }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="category_status" class="form-control input-sm m-bot15">
                                    @if ($category->category_status == 0)
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @else
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Sửa danh mục</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
