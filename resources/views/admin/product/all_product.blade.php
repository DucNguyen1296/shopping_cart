@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê danh mục sản phẩm
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row w3-res-tb">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control w-sm inline v-middle">
                            <option value="0">Bulk action</option>
                            <option value="1">Delete selected</option>
                            <option value="2">Bulk edit</option>
                            <option value="3">Export</option>
                        </select>
                        <button class="btn btn-sm btn-default">Apply</button>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Thư viện ảnh sản phẩm</th>
                                <th>Hình ảnh sản phẩm</th>
                                <th>Danh mục sản phẩm</th>
                                <th>Thương hiệu sản phẩm</th>
                                <th>Hiển thị</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày chỉnh sửa</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>
                            @foreach ($all_product as $key => $product)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td><a href="{{ url('add-gallery/' . $product->id) }}">Thêm thư viện ảnh</a></td>
                                    <td><img src="{{ asset('storage/product_image/' . $product->product_image) }}"
                                            alt="" height="100" width="100"></td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->brand->brand_name }}</td>
                                    @if ($product->product_status == 0)
                                        <td>
                                            <span class="text-ellipsis text-danger">Ẩn</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="text-ellipsis text-success">Hiển thị</span>
                                        </td>
                                    @endif
                                    <td><span class="text-ellipsis">{{ $product->created_at->diffForHumans() }}</span></td>
                                    <td><span class="text-ellipsis">{{ $product->updated_at->diffForHumans() }}</span></td>
                                    <td>
                                        <a href="{{ route('product.show', [$product->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('product.destroy', [$product->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">

                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                                <li><a href="">4</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
