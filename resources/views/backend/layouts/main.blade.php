<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('backend/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('backend/assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
   @include('backend.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.layouts.header')
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Sample Page</h5>
            @yield('main')
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="{{asset('backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('backend/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('backend/assets/js/app.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/simplebar/dist/simplebar.js')}}"></script>
</body>

</html>
