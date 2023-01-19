<div class="container-fluid bg-secondary py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="bg-secondary px-2">Có thể bạn quan tâm</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($random_product as $key => $ran_pro)
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="{{ url('/chi-tiet-san-pham/' . $ran_pro->id) }}">
                                <img class="img-fluid w-100"
                                    src="{{ asset('storage/product_image/' . $ran_pro->product_image) }}"
                                    alt="product_image" style="height: 260px;">
                            </a>
                        </div>
                        <div
                            class="card-body
                                border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">
                                <span class="dislike" data-toggle="tooltip" data-placement="top"
                                    title="{{ $ran_pro->product_name }}">
                                    {{ $ran_pro->product_name }}
                                </span>
                            </h6>
                            <div class="d-flex flex-column justify-content-center">
                                @if ($ran_pro->event_id == 0 || $ran_pro->event_detail->event_detail_status == 0)
                                    <h6 class="text-danger" style="margin-top:1.75rem">
                                        {{ number_format($ran_pro->product_price, 0, ',', '.') . ' VNĐ' }}
                                    </h6>
                                @elseif($ran_pro->event_id != 0 && $ran_pro->event_detail->event_detail_status == 1)
                                    <?php
                                    $sukien = $ran_pro->product_price;
                                    ?>
                                    @if ($ran_pro->event_detail->event_detail_type == 1)
                                        <h6 class="text-muted ml-2">
                                            <del>{{ number_format($ran_pro->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                        </h6>
                                        <h6 class="text-danger">
                                            {{ number_format($sukien - $sukien * ($ran_pro->event_detail->event_detail_discount / 100), 0, ',', '.') . ' VNĐ' }}
                                        </h6>
                                    @elseif($ran_pro->event_detail->event_detail_type == 2)
                                        <h6 class="text-muted ml-2">
                                            <del>{{ number_format($ran_pro->product_price, 0, ',', '.') . ' VNĐ' }}</del>
                                        </h6>
                                        <h6 class="text-danger">
                                            {{ number_format($sukien - $ran_pro->event_detail->event_detail_discount, 0, ',', '.') . ' VNĐ' }}
                                        </h6>
                                    @endif

                                    {{-- <div>{{ $ran_pro->event_detail->event_detail_start->diffForHumans() }}</div> --}}
                                @endif
                            </div>
                            @if ($ran_pro->event_id != 0 && $ran_pro->event_detail->event_detail_status != 0)
                                <img src="{{ asset('img/sale.png') }}" class="sale" alt="">
                                @if ($ran_pro->event_detail->event_detail_type == 1)
                                    <div class="event-product-carousel">
                                        <span
                                            class="event-product-discount-carousel text-danger">-{{ $ran_pro->event_detail->event_detail_discount }}%</span>
                                    </div>
                                @elseif($ran_pro->event_detail->event_detail_type == 2)
                                    <div class="event-product-carousel">
                                        <span
                                            class="event-product-discount-carousel text-danger">-{{ number_format($ran_pro->event_detail->event_detail_discount, 0, ',', '.') }}
                                            VNĐ</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="#" class="btn btn-sm text-dark p-0"><i
                                    class=" far fa-heart text-primary mr-1"></i>Thích</a>
                            <a href="{{ url('/chi-tiet-san-pham/' . $ran_pro->id) }}"
                                class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
