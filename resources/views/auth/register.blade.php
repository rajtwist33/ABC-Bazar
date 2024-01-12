<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ $setting != '' ? asset($setting->file_path) : '' }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ $setting != '' ? asset($setting->file_path) : '' }}" class="img-fluid"
                                        width="100" alt="" />
                                    {{-- <img src="{{ asset('backend/assets/images/logos/dark-logo.svg') }}" width="180"
                                        alt=""> --}}
                                </a>

                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name <code>*</code></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control  @error('name') is-invalid @enderror"
                                            id="exampleInputtext1" aria-describedby="textHelp">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone
                                            <code>*</code></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                            class="form-control  @error('phone') is-invalid @enderror"
                                            id="exampleInputtext1" aria-describedby="textHelp" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email
                                            Address<code>*</code></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1"
                                            class="form-label @error('password') is-invalid @enderror">Password<code>*</code></label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control" id="exampleInputPassword1">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label"> Retype Password <code
                                                class="ml-2">*</code></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="exampleInputPassword1">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        Up</button>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="fs-4 mb-0 fw-bold">Already have an Account </p>
                                            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">login</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
