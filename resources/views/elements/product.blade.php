<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm đang khuyến mãi</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($event_product as $key => $event_pro)
            @if ($event_pro->category->category_status == 1 &&
                $event_pro->brand->brand_status == 1 &&
                $event_pro->event_detail->event_detail_status == 1)
                <div class="col-lg-2 col-md-4 col-sm-8 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="{{ url('/chi-tiet-san-pham/' . $event_pro->id) }}">
                                <img class="img-fluid w-100"
                                    src="{{ asset('storage/product_image/' . $event_pro->product_image) }}"
                                    alt="product_image" style="height: 130px;">
                            </a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">
                                <span class="dislike" data-toggle="tooltip" data-placement="top"
                                    title="{{ $event_pro->product_name }}">
                                    {{ $event_pro->product_name }}
                                </span>

                            </h6>
                            <div class="d-flex flex-column justify-content-center">
                                @if ($event_pro->event_id == 0)
                                    <h6 class="text-danger" style="margin-top:1.75rem;">
                                        {{ number_format($event_pro->product_price, 0, ',', '.') . ' VNĐ' }}
                                    </h6>
                                @elseif($event_pro->event_id != 0)
                                    <?php
                                    $sukien = $event_pro->product_price;
                                    ?>
                                    @if ($event_pro->event_detail->event_detail_type == 1)
                                        <h6 class="text-muted ml-2">
                                            <del>{{ number_format($event_pro->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                        </h6>
                                        <h6 class="text-danger">
                                            {{ number_format($sukien - $sukien * ($event_pro->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' }}
                                        </h6>
                                    @elseif($event_pro->event_detail->event_detail_type == 2)
                                        <h6 class="text-muted ml-2">
                                            <del>{{ number_format($event_pro->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                        </h6>
                                        <h6 class="text-danger">
                                            {{ number_format($sukien - $event_pro->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                        </h6>
                                    @endif
                                    {{-- <div>{{ $event_pro->event_detail->event_detail_start->diffForHumans() }}</div> --}}
                                @endif
                            </div>
                            @if ($event_pro->event_detail_id != 0)
                                <img src="{{ asset('img/sale.png') }}" class="sale" alt="">
                                @if ($event_pro->event_detail->event_detail_type == 1)
                                    <div class="event-product">
                                        <span
                                            class="event-product-discount text-danger">-{{ $event_pro->event_detail->event_detail_discount }}%</span>
                                    </div>
                                @elseif($event_pro->event_detail->event_detail_type == 2)
                                    <div class="event-product-2">
                                        <span
                                            class="event-product-discount-2 text-danger">-{{ number_format($event_pro->event_detail->event_detail_discount, 0, ',', '.') }}
                                            VNĐ</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            @if (Auth::user())
                                <div class="like-product-footer">
                                    @if ($user->products->where('id', $event_pro->id)->first() != null)
                                        <form action="{{ '/delete-like-product/' . $event_pro->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm text-dark p-0 delete-likePro-button"
                                                data-id="{{ $event_pro->id }}"><i
                                                    class="fas fa-heart text-primary mr-1"></i>Thích</button>
                                        </form>
                                    @else
                                        <form action="{{ '/like-product/' . $event_pro->id }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm text-dark p-0"><i
                                                    class="far fa-heart text-primary mr-1"></i>Thích</button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <a href="{{ url('/login-checkout') }}" class="btn btn-sm text-dark p-0"><i
                                        class=" far fa-heart text-primary mr-1"></i>Thích</a>
                            @endif
                            <a href="{{ url('/chi-tiet-san-pham/' . $event_pro->id) }}"
                                class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="mb-4 loading-more">
        <a href="" class="btn btn-lg btn-primary load-more-button">Xem thêm</a>
    </div>
    {{-- <div class="col-12 pb-1">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-3">
                {{ $event_product->links() }}
            </ul>
        </nav>
    </div> --}}
</div>

<script type="text/javascript"></script>
