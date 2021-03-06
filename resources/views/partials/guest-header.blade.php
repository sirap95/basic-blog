<div id="wrapper">
    <div class="topbar-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                    <div class="topsocial">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i
                                class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i
                                class="fa fa-youtube"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                class="fa fa-pinterest"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i
                                class="fa fa-flickr"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                class="fa fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i
                                class="fa fa-google-plus"></i></a>
                    </div><!-- end social -->
                </div><!-- end col -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin-left:auto; margin-right:0">
                    <div class="search text-right">
                        <form class="form-inline my-2 my-lg-0" action="{{route('guest.search')}}" method="GET">
                            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search"
                                   aria-label="Search">
                            <a href="/"><i class="fa fa-search"></i> Search</a>
                        </form>
                    </div><!-- end search -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end header-logo -->
    </div><!-- end topbar -->

    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9"
                     style="font-size: xxx-large; font-weight: bold; display: inline-block; margin: 0 auto; padding: 3px;">
                    <div class="logo" style="text-align: center">
                        <a href="{{ route('guest.index') }}">BASIC BLOG</a>
                    </div><!-- end logo -->
                </div>
            </div><!-- end row -->
        </div><!-- end header-logo -->
    </div><!-- end header -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('guest.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('guest.tag', ['id' => 1]) }}">Tag
                                    1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('guest.tag', ['id' => 2]) }}">Tag
                                    2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('guest.tag', ['id' => 3]) }}">Tag
                                    3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('guest.tag', ['id' => 4]) }}">Tag
                                    4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="{{ route('other.about')}}">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div><!-- end container -->
    </header><!-- end header -->
</div>
