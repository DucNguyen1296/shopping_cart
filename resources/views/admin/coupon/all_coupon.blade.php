@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê mã giảm giá
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
                                <th>Tên mã giảm giá</th>
                                <th>Mã giảm giá</th>
                                <th>Số lượng mã giảm giá</th>
                                <th>Tính năng mã giảm giá</th>
                                <th>Số % hoặc tiền giảm</th>
                                <th>Hiển thị</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày chỉnh sửa</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_coupon as $key => $coupon)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->coupon_times }}</td>
                                    @if ($coupon->coupon_condition == 1)
                                        <td>
                                            <span class="text-ellipsis text-primary">Giảm theo %</span>
                                        </td>
                                    @elseif($coupon->coupon_condition == 2)
                                        <td>
                                            <span class="text-ellipsis text-success">Giảm theo tiền</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="text-ellipsis text-success">Không</span>
                                        </td>
                                    @endif
                                    <td>{{ $coupon->coupon_numbers }}</td>
                                    @if ($coupon->coupon_status == 0)
                                        <td>
                                            <span class="text-ellipsis text-danger">Ẩn</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="text-ellipsis text-success">Hiển thị</span>
                                        </td>
                                    @endif
                                    <td><span class="text-ellipsis">{{ $coupon->created_at->diffForHumans() }}</span></td>
                                    <td><span class="text-ellipsis">{{ $coupon->updated_at->diffForHumans() }}</span></td>
                                    <td>
                                        <a href="{{ route('coupon.show', [$coupon->id]) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('coupon.destroy', [$coupon->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa mã giảm giá này không?')"
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
