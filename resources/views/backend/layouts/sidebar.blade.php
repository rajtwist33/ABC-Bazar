<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ $setting != '' ? asset($setting->file_path) : '' }}" class="img-fluid" width="100" alt="" />
                {{-- <img src="{{ asset('backend/assets/images/logos/dark-logo.svg') }}" width="180" alt="" /> --}}
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
               <h3 class="ml-5"> {{ Auth::user()->roles->first()->name }}</h3>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">UI COMPONENTS</span>
                </li>
                @role('admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is(['category*', 'trashed/category*']) ? 'active' : '' }}"
                        href="{{ route('admin.category.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is(['slider*']) ? 'active' : '' }}"
                        href="{{ route('admin.slider.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <span class="hide-menu">Slider</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is(['product*', 'trashed/product*']) ? 'active' : '' }}"
                        href="{{ route('admin.product.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is(['setting*', 'trashed/setting*']) ? 'active' : '' }}"
                        href="{{ route('admin.setting.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Setting</span>
                    </a>
                </li>
                @endrole
                @role('seller')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is(['product*', 'trashed/product*']) ? 'active' : '' }}"
                        href="{{ route('admin.product.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Product</span>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
