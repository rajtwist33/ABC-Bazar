@extends('frontend.layouts.main')
@section('carousel')
@include('frontend.layouts.section.carousel')
@endsection
@section('main')
    <h2 class="text-center text-primary">We Buy Your Old Phones</h2>
    <hr>
    <div class="conatiner ">
        <div class="row mt-3">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6">
                    <div class="card" style="width: 100%;">
                        <img src="{{ $category != '' ? asset($category->file_path) : '' }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <a href="{{route('sell_old_mobile')}}" class="btn btn-primary col-12">Sell Phone </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 fs-5">
                    <p class="">{!! $category->description !!}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
