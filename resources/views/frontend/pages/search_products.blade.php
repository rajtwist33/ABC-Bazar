@extends('frontend.layouts.main')
@section('main')
    <div class="fashion_section">
        <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h2 class="text-center text-success">Searched Products</h2>
                        @if(isset($category))<h1 class="fashion_taital">{{ $category->title }}</h1>@endif
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach ($products as $product)
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h5 class="shirt_text">{{ $product->title }}</h5>
                                        <div class="electronic_img">
                                            <a href="{{ asset($product->hasproduct_image[0]->file_path) }}"
                                                target="blank">
                                                <img src="{{ asset($product->hasproduct_image[0]->file_path) }}"
                                                    style="height:20rem;"></a>
                                        </div>
                                        <strong for="" class="text-dark">Product Id : </strong><strong
                                            class="ml-1 text-success">
                                            {{ $product->product_code }}</strong>

                                        <p class="price_text">
                                        </p>
                                        <div class="btn_main">
                                            <div class="buy_bt"> <strong for="" class="text-dark">Price: </strong><strong
                                                class="ml-1 text-secondary">
                                                RS. {{ $product->price }}</strong></div>
                                            <div class="buy_bt1 ">
                                                <a href="{{ route('product-detail.show', $product->product_code) }}">Buy Now</a></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="float-right">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
