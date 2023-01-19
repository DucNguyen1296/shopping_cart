<div class="container-fluid bg-secondary pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="bg-secondary px-2">Danh mục</span></h2>
    </div>
    <div class="row px-xl-5 pb-3 ">
        @foreach ($all_category_product as $key => $cate)
            <div class="col-lg-2 col-md-8 pb-1">
                <div class="cat-item d-flex flex-column border mb-4 bg-light" style="padding: 30px;">
                    <p class="text-right">{{ $cate->products->count() }} Sản phẩm</p>
                    <a href="{{ url('/danh-muc-san-pham/' . $cate->id) }}"
                        class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('storage/category_image/' . $cate->category_image) }}"
                            alt="image">
                    </a>
                    <h6 class="font-weight-semi-bold m-0 text-center">{{ $cate->category_name }}</h6>
                </div>
            </div>
        @endforeach
    </div>
</div>
