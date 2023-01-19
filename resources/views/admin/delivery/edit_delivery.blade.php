@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa phí vận chuyển
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
                        <form autocomplete="off" role="form"
                            action="{{ route('delivery.update', [$delivery_by_id->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province"
                                    class="form-control input-sm m-bot15 choose province">
                                    <option value="{{ $province->province_code }}">{{ $province->province_name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="{{ $wards->ward_code }}">{{ $wards->ward_name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí vận chuyển</label>
                                <input name="delivery_fee" type="text" class="form-control fee_ship"
                                    id="exampleInputEmail1" placeholder="Phí vận chuyển"
                                    value="{{ $delivery_by_id->delivery_fee }}">
                            </div>
                            <button name="add_delivery" type="submit" class="btn btn-info add_delivery">Sửa phí vận
                                chuyển</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
