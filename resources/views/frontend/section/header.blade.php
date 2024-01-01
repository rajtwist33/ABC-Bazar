<div class="header_section">
    <div class="container">
        <div class="containt_main">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="{{ url('/') }}">Home</a>
                @foreach ($categories as $category)
                    <a href="{{ route('search.show', $category->id) }}">{{ $category->title }}</a>
                @endforeach

            </div>
            <span class="toggle_icon" onclick="openNav()"><img
                    src="{{ asset('frontend/images/toggle-icon.png') }}"></span>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($categories as $category)
                        <a href="{{ route('search.show', $category->id) }}"
                            class="dropdown-item">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="main">
                <form action="{{ route('search.store') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_name"
                            placeholder="Search Product name ... ">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit"
                                style="background-color: #f26522; border-color:#f26522 ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
