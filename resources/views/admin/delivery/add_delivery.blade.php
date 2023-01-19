@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">

                <header class="panel-heading">
                    Thêm phí vận chuyển
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
                        <form autocomplete="off" role="form" action="{{ route('delivery.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="">----> Chọn thành phố <---- </option>
                                            @foreach ($city as $key => $ci)
                                    <option value="{{ $ci->city_code }}">{{ $ci->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province"
                                    class="form-control input-sm m-bot15 choose province">
                                    <option value="">----> Chọn quận huyện <---- </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">----> Chọn xã phường <---- </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí vận chuyển</label>
                                <input name="delivery_fee" type="text" class="form-control fee_ship"
                                    id="exampleInputEmail1" placeholder="Phí vận chuyển">
                            </div>
                            <button name="add_delivery" type="submit" class="btn btn-info add_delivery">Thêm phí vận
                                chuyển</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');

                var ma_id = $(this).val();

                var _token = $('input[name="_token"]').val();
                
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
@endsection
