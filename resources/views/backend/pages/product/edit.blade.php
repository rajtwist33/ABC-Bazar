@extends('backend.layouts.main')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="container">
        <a href="{{ route('admin.product.index') }}" class="float-right btn btn-success mb-2">Back</a>
        <button class="float-right btn btn-primary mb-2" id="reload">Reload</button>
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label fs-4"> Product ID : <strong id="product_id" class="text-danger">
                            {{ $data_lists->product_code != '' ? $data_lists->product_code : old('product_code') }}</strong></label><br>
                    @error('product_code')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="product_code" id="product_code"
                        aria-describedby="emailHelp"
                        value="{{ $data_lists->product_code != '' ? $data_lists->product_code : old('product_code') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Select Category</label>
                    <select class="form-select" name="select_category" id="select_category"
                        aria-label="Default select example">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $data_lists->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('select_category')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Model</label><br>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp"
                        value="{{ $data_lists->title != '' ? $data_lists->title : old('title') }}">
                    @error('title')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label><br>
                        <input type="text" class="form-control" name="price" id="price" aria-describedby="emailHelp"
                            value="{{ $data_lists->price != '' ? $data_lists->price : old('price') }}">
                        @error('price')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
              
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label><br>
                <textarea class="summernote" name="description">{{ $data_lists->description != '' ? $data_lists->description : old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Specification</label><br>
                <textarea class="summernote" name="specification">{{ $data_lists->specification != '' ? $data_lists->specification : old('specification') }}</textarea>
                @error('specification')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="exampleInputPassword1" class="form-label">Product Image</label>
                <div class="row">
                    @foreach ($data_lists->hasproduct_image as $productimage)
                        <div class="col-md-3 mb-3">
                            <div class="card border border-light-subtle p-2" style="width: 13rem; min-height: 8rem;">
                                <img src="{{ asset($productimage->file_path) }}" class="card-img-top" alt="image Not Found"
                                    style="height:15rem; ">
                                <a href="{{ route('admin.delete_product_image', $productimage->id) }}"
                                    class="btn btn-primary btn-sm mt-1" data-confirm-delete="true">Remove</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-3 mb-3">
                        <input type="file" name="images[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="images[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="images[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="images[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>

                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Imperfections</label>
                <textarea class="summernote" name="imperfections">{{ $data_lists->imperfections != '' ? $data_lists->imperfections : old('imperfections') }}</textarea>
            </div>
            <div class="col-md-12">
                <label for="exampleInputPassword1" class="form-label">Imperfection Product Image</label>
                <div class="row">
                    @foreach ($data_lists->hasimperfection_image as $productimage)
                        <div class="col-md-3 mb-3">
                            <div class="card border border-light-subtle p-2" style="width: 13rem; min-height: 8rem;">
                                <img src="{{ asset($productimage->file_path) }}" class="card-img-top"
                                    alt="image Not Found" style="width:100%; height:15rem; ">
                                <a href="{{ route('admin.imperfectionimage', $productimage->id) }}"
                                    class="btn btn-primary btn-sm mt-1" data-confirm-delete="true">Remove</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-3 mb-3">
                        <input type="file" name="imperfectionimages[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="imperfectionimages[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="imperfectionimages[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="file" name="imperfectionimages[]" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>

                </div>
            </div>
    </div>
    <input type="hidden" class="form-control" name="data_id" id="data_id" value="{{ $data_lists->id }}"
        aria-describedby="emailHelp">

    <button type="submit" class="btn btn-primary m-1  float-end" id="submit_btn">Update</button>
    <button type="reset" class="btn btn-secondary m-1 float-end">Reset</button>

    </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify"></script>

    <script>
        $(document).ready(function() {
            //Summernote
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['misc', ['undo', 'redo']]
                ],
                placeholder: 'Start typing here...',
            });
            //Dropify
            var dropify = $('.dropify').dropify();
            $('#select_category').on('change', function() {
                var selectedCategoryId = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.productcode') }}",
                    data: {
                        id: selectedCategoryId
                    },

                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    success: function(response) {
                        var data = response.product_id;
                        $('#product_id').text(data);
                        $('#product_code').val(data);

                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error.title : 'An error occurred. Please try again.';
                        toastr.error(errorMessage);
                        $('#error_title').text(errorMessage);
                    }
                });
            });
            $('#reload').on('click', function() {
                location.reload();
            });
        });
    </script>
@endsection
