<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$setting != '' ? $setting->title : config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ $setting != '' ? asset($setting->file_path) : '' }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.min.css') }}" />
    <style>
        .dropify-wrapper .dropify-message p {
            display: none;
        }
    </style>
    @yield('style')
</head>

<body>
    @include('sweetalert::alert')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('backend.layouts.sidebar')
        <div class="body-wrapper">
            @include('backend.layouts.header')
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                     @role('admin')   <h5 class="card-title fw-semibold mb-4">{{ $page }}</h5> @endrole
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
          feather.replace();
    </script>
    @yield('script')
</body>

</html>
