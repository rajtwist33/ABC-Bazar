<div class="fashion_section">
    <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <h1 class="fashion_taital">Accessories</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <strong for="" class="text-dark">Product Id : </strong><strong class="ml-1 btn btn-sm btn-outline-success"> {{ $product->product_code }}</strong>
                                        <h5 class="shirt_text">{{ $product->title }}</h5>
                                        <p class="price_text"> Price <span style="color: #262626;">RS.
                                                {{ $product->price }}</span>
                                        </p>
                                        <div class="electronic_img">
                                            <a href="{{ $product->hasproduct_image[0]->file_path }}" target="blank">
                                                <img src="{{ asset($product->hasproduct_image[0]->file_path) }}"
                                                    style="height:20rem;"></a>
                                        </div>
                                        <div class="btn_main">
                                            <div class="buy_bt"><a href="#">Buy Now</a></div>
                                            <div class="seemore_bt"><a href="#">See More</a></div>
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
