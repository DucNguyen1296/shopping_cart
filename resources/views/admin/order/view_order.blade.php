@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin người mua
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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th>Tài khoản đặt hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại liên hệ</th>


                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $customer_by_id->name }}</td>
                                <td>{{ $customer_by_id->email }}</td>
                                <td>{{ $customer_by_id->phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin vận chuyển đơn hàng
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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th>Tên đơn vận chuyển</th>
                                <th>Phí vận chuyển</th>
                                <th>Địa chỉ vận chuyển</th>
                                <th>Số điện thoại liên hệ</th>
                                <th>Ghi chú đơn vận chuyển</th>

                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $shipping_by_id->shipping_name }}</td>
                                <td>
                                    {{ number_format($order_details_by_id[0]->delivery->delivery_fee, 0, ',', '.') . ' VNĐ' }}
                                </td>
                                <td>{{ $shipping_by_id->shipping_address }}</td>
                                <td>{{ $shipping_by_id->shipping_phone }}</td>
                                <td>{{ $shipping_by_id->shipping_note }}</td>



                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê chi tiết đơn hàng
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
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>VAT</th>
                                <th>Mã giảm giá</th>
                                <th>Thành tiền</th>

                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_details_by_id as $key => $order_details)
                                <?php
                                $gia_sp = $order_details->product->product_price;
                                $total = 0;
                                $VAT = 0;
                                $giam_gia = 0;
                                ?>
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $order_details->product_name }}</td>
                                    <td>{{ $order_details->product_quantity }}</td>
                                    <td>
                                        {{ number_format($order_details->product_price, 0, ',', '.') . ' VNĐ' }}
                                    </td>
                                    <td>
                                        {{ number_format($order_details->product_price * 0.1, 0, ',', '.') . ' VNĐ' }}
                                        <?php
                                        $VAT = $order_details->product_price * 0.1;
                                        ?>
                                    </td>
                                    <td>
                                        @if ($order_details->coupon != null)
                                            @if ($order_details->coupon->coupon_condition == 1)
                                                <div>
                                                    {{ $order_details->coupon->coupon_code }} -
                                                    {{ $order_details->coupon->coupon_numbers }}%
                                                </div>
                                                <?php
                                                $giam_gia = ($gia_sp * $order_details->coupon->coupon_numbers) / 100;
                                                ?>
                                            @elseif($order_details->coupon->coupon_condition == 2)
                                                <div>
                                                    {{ $order_details->coupon->coupon_code }} -
                                                    {{ number_format($order_details->coupon->coupon_numbers, 0, ',', '.') . ' VNĐ' }}
                                                </div>
                                                <?php
                                                $giam_gia = $order_details->coupon->coupon_numbers;
                                                ?>
                                            @endif
                                        @else
                                            <div>Không</div>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        $total = $gia_sp + $VAT - $giam_gia;
                                        ?>
                                        {{-- {{ (int) $order_details->product_price * $order_details->product_quantity }} --}}
                                        {{ number_format($total, 0, ',', '.') . ' VNĐ' }}
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
