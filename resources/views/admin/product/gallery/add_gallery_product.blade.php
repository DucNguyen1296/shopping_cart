@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thư viện ảnh
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

                    <form action="{{ url('/insert-gallery/' . $pro_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="file" name="file[]" accept="image/*"
                                    multiple>
                                <span id="error_gallery"></span>
                            </div>

                            <div class="col-md-3">
                                <input type="submit" name="taianh" value="Tải ảnh" class="btn btn-success btn-sm">
                            </div>
                        </div>
                    </form>

                    <form autocomplete="off" role="form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id">
                        {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh danh mục sản phẩm</label>
                                <input name="category_image" type="file" class="form-control" id="exampleInputEmail1">
                            </div> --}}
                        <div id="gallery_load">

                        </div>

                    </form>


                </div>
            </section>

        </div>
    </div>
@endsection
