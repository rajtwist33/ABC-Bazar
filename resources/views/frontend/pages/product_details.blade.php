@extends('frontend.layouts.main')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('main')
    @include('frontend.pages.buy_modal.create')
    <div class="row">
        <div class="col-12 ">
            <div class="container">
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
            <div class="container">
                <div class="box_main mt-3">
                    <h4> Product Code : <strong class="ml-1 text-info">
                            <u>{{ $products->product_code }}</u></strong>
                        <button type="button" data-id="{{ $products->id }}" class="float-right btn btn-warning"
                            id="buy_product" data-toggle="modal">Buy</button>
                    </h4>
                    <h4>{{ $products->hascategory->title }} Model: <strong class="ml-1 ">
                            {{ $products->title }}</strong></h4>
                    <h4>{{ $products->hascategory->title }} Price: <strong class="ml-1 ">
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
                <div class="container">
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
                    <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <h5 class="shirt_text">{{ $product->title }}</h5>
                            <div class="electronic_img">
                                <a href="{{ asset($product->hasproduct_image[0]->file_path) }}" target="blank">
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
                                    <a href="{{ route('product-detail.show', $product->product_code) }}">Buy Now</a>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
        $(document).ready(function() {
            $("#buy_product").click(function() {
                    $('#buy_product_form')[0].reset();
                    $('.text-danger').empty();
                    $('#buy_product_modal').modal('show');

                    var dataId = $(this).data("id");
                    $("#send_data").click(function(event) {
                            event.preventDefault();
                            $(this).prop('disabled', true);
                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                            // Get the form data
                            var formData = $("#buy_product_form").serialize();
                            // Perform AJAX POST request
                            $.ajax({
                                    type: "POST",
                                    url: "{{ route('send-enquiry.store') }}", // Replace with your actual server endpoint
                                    data: formData,
                                    dataType: "json",
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    success: function(response) {
                                        var success = response.success;
                                        var error = response.error;
                                      if(success){
                                        toastr.success(success);
                                        $('#buy_product_modal').modal('hide');
                                      }
                                      if(error){
                                        toastr.error(error);
                                      }
                                      $('#send_data').prop('disabled', false);
                                    },
                                    error: function(xhr, status, error) {
                                        var errors = xhr.responseJSON.errors;
                                        $.each(errors, function(key, value) {
                                            $('#' + key + '_error').text(value[0]);
                                        });
                                        $('#send_data').prop('disabled', false);
                                    }
                            });
                    });
            });
        });
    </script>
@endsection
