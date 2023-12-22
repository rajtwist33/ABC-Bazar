@extends('backend.layouts.main')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
@endsection
@section('main')
    <div class="container">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <div class="col-md-4 float-end">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" name="image" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" data-default-file="{{ Auth::user()->file_path != '' ? Auth::user()->file_path : 'backend/assets/images/profile/user-1.jpg' }}" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text"  class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="{{ Auth::user()->name }}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="{{ Auth::user()->email }}">
            </div>
            <button type="submit" class="btn btn-primary float-end">Update</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            //Dropify
            var dropify = $('.dropify').dropify();
        });
    </script>
@endsection
