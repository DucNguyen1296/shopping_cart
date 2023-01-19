@extends('admin/admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sự kiện
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
                        <form autocomplete="off" role="form" action="{{ route('event.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sự kiện</label>
                                <input name="event_name" type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên sự kiện">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả sự kiện</label>
                                <input name="event_desc" type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Mô tả sự kiện">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung sự kiện</label>
                                <input name="event_content" type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Nội dung sự kiện">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sự kiện</label>
                                <input name="event_image" type="file" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày bắt đầu</label>
                                <input name="event_start" type="date" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ngày kết thúc</label>
                                <input name="event_end" type="date" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="event_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button name="add_event" type="submit" class="btn btn-info">Thêm sự kiện</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
