<nav class="navbar navbar-expand-md navbar-dark  bg-dark">
    <div class="container-fluid">
        <img src="{{ $setting != '' ? asset($setting->file_path) : '' }}" class="d-none d-md-block" style="width: 5%; max-width: 400px; height: auto;">
        <a class="navbar-brand d-none d-md-block" href="{{ url('/') }}">
                {{ $setting != '' ? $setting->title : 'ABC ' }}
        </a>

            <img src="{{ $setting != '' ? asset($setting->file_path) : '' }}" class="d-block d-md-none" style="width: 15%; max-width: 400px; height: auto;">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5  pe-4">
                <li class="nav-item ">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sell-old-mobile') ? 'active' : '' }}" href="{{route('sell_old_mobile')}}">Sell Phone</a>
                </li>

            </ul>

        </div>
    </div>
</nav>
