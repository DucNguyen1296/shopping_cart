@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê chi tiết sự kiện {{ $event->event_name }}
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
                                <th>Tên sự kiện</th>
                                <th>Tính năng sự kiện</th>
                                <th>Số % hoặc tiền giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Hiển thị</th>
                                <th>Áp dụng toàn bộ danh mục</th>
                                <th>Áp dụng toàn bộ thương hiệu</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày chỉnh sửa</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_event_detail as $key => $event_detail)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>
                                        <span class="text-danger">
                                            {{ $event_detail->event->event_name }}
                                        </span>
                                    </td>

                                    @if ($event_detail->event_detail_type == 1)
                                        <td>
                                            <span class="text-ellipsis text-primary">Giảm theo %</span>
                                        </td>
                                    @elseif($event_detail->event_detail_type == 2)
                                        <td>
                                            <span class="text-ellipsis text-success">Giảm theo tiền</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="text-ellipsis text-success">Không</span>
                                        </td>
                                    @endif
                                    @if ($event_detail->event_detail_type == 1)
                                        <td>{{ $event_detail->event_detail_discount }} %</td>
                                    @elseif($event_detail->event_detail_type == 2)
                                        <td> {{ number_format($event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                        </td>
                                    @endif
                                    <td>{{ $event_detail->event_detail_start }}</td>
                                    <td>{{ $event_detail->event_detail_end }}</td>
                                    @if ($event_detail->event_detail_status == 0)
                                        <td>
                                            <span class="text-ellipsis text-danger">Ẩn</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="text-ellipsis text-success">Hiển thị</span>
                                        </td>
                                    @endif
                                    @if ($event_detail->category != null)
                                        <td>{{ $event_detail->category->category_name }}</td>
                                    @else
                                        <td>Không</td>
                                    @endif
                                    @if ($event_detail->brand != null)
                                        <td>{{ $event_detail->brand->brand_name }}</td>
                                    @else
                                        <td>Không</td>
                                    @endif
                                    <td><span class="text-ellipsis">{{ $event_detail->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $event_detail->updated_at->diffForHumans() }}</span>
                                    </td>

                                    <td>
                                        <a href="{{ route('event_detail.show', [$event_detail->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('event_detail.destroy', [$event_detail->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa chi tiết sự kiện này không?')"
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
