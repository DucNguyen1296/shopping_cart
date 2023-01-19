@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê đơn hàng
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
                                <th>Tài khoản đặt</th>
                                <th>Tổng giá tiền</th>
                                <th>Số điện thoại liên hệ</th>
                                <th>Hình thức thanh toán</th>
                                <th>Tình trạng</th>

                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_order as $key => $order)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->order_total . ' VNĐ' }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                    @if($order->payment->payment_method == 1)
                                    <td>Thanh toán bằng thẻ VISA</td>
                                    @elseif($order->payment->payment_method == 2)
                                    <td>Thanh toán tiền mặt</td>
                                    @elseif($order->payment->payment_method == 3)
                                    <td>Thanh toán bằng thẻ ngân hàng</td>
                                    @endif
                                    <td>{{ $order->order_status }}</td>

                                    <td>
                                        <a href="{{ url('/view-order/' . $order->id) }}" class="btn btn-primary">Details</a>
                                        <form action="{{ url('/delete-order/' . $order->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')"
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
