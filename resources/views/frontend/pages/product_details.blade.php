@extends('frontend.layouts.main')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
@section('main')
    <div class="row">
        <div class="col-12 ">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($products->hasproduct_image as $image)
                                    <div class="swiper-slide">
                                        <img class="object-cover img-fluid" src="{{ asset($image->file_path) }}"
                                            alt="image" style="height: 500px; width:100%;" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 ">
            <div class="container-fluid">
                <div class="box_main mt-3">
                    <h4> Product Code : <strong class="ml-1 text-info">
                            <u>{{ $products->product_code }}</u></strong></h4>
                    <h4>{{ $products->hascategory->title }} Model: <strong class="ml-1 ">
                            {{ $products->title }}</strong></h4>
                    <h4>{{ $products->hascategory->title }} Prce: <strong class="ml-1 ">
                            {{ $products->price }}</strong></h4>
                    @if ($products->description)
                        <strong>{{ $products->hascategory->title }} Overview</strong>
                        <p>{!! $products->description !!}</p>
                    @endif
                    @if ($products->specification)
                        <strong>{{ $products->hascategory->title }} Specification</strong>
                        <p>{!! $products->specification !!}</p>
                    @endif

                    @if ($products->imperfections)
                        <strong>{{ $products->hascategory->title }} Imperfections</strong>
                        <p>{!! $products->imperfections !!}</p>
                    @endif
                </div>
            </div>
        </div>

        @if (count($products->hasimperfection_image) > 0)
            <div class="col-12">
                <div class="container-fluid">
                    <strong class="ml-2">Imperfection Images </strong>
                    <div class="row">
                        @foreach ($products->hasimperfection_image as $image)
                            <div class="col-md-4">
                                <div class="electronic_img">
                                    <a href="{{ asset($image->file_path) }}" target="blank">
                                        <img src="{{ asset($image->file_path) }}" style="height:20rem;"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    <hr>
    <div class="container">
        <h2 class="text-center m-2">Related Products</h2>
        <div class="col-12">
            <div class="row">
                @foreach ($related_products as $product)
                    <div class="col-md-4">
                        <div class="box_main">
                            <strong for="" class="text-dark">Product Id : </strong><strong
                                class="ml-1 text-success">
                                {{ $product->product_code }}</strong>
                            <h5 class="shirt_text">{{ $product->title }}</h5>
                            <p class="price_text"> Price <span style="color: #262626;">RS.
                                    {{ $product->price }}</span>
                            </p>
                            <div class="electronic_img">
                                <a href="{{ asset($product->hasproduct_image[0]->file_path) }}" target="blank">
                                    <img src="{{ asset($product->hasproduct_image[0]->file_path) }}"
                                        style="height:20rem;"></a>
                            </div>
                            <div class="btn_main">
                                <div class="buy_bt"><a href="#">Buy Now</a></div>
                                <div class="seemore_bt"><a
                                        href="{{ route('product-detail.show', $product->product_code) }}">See
                                        More</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="float-right mb-3">
                {{ $related_products->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper, .product_swiper", {
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
            mousewheel: true,
            keyboard: true,
        });
    </script>
@endsection
