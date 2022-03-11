@extends('layouts.app')

@section('content')
<style>
    #paginate:hover {
        color: #BCBCBC !important;
    }
    #paginate:active {
        background-color: #000000 !important;
    }
</style>
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">

                    <div class="page-wrapper">
                        <div class="blog-list clearfix">

                            @foreach($posts as $post)
                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="{{ route('guest.post', ['id' => $post->id]) }}" title="">
                                                <img src="{{asset($post->preview_image != null ?
                                                        'images/preview_images/'.$post->preview_image : 'assets/upload/garden_sq_01.jpg' )}}"
                                                     alt=""
                                                     class="img-fluid">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <span class="bg-aqua"><a href="#" title="">Category</a></span>
                                        <h4><a href="{{ route('guest.post', ['id' => $post->id]) }}"
                                               title="">{{ $post->title }}</a></h4>
                                        <p>{{ \Illuminate\Support\Str::limit($post->description, 150) }} </p>
                                        <small><a href="garden-category.html" title=""><i class="fa fa-eye"></i>
                                                {{$post->views}}
                                            </a></small>
                                        <small><a href="garden-single.html"
                                                  title="">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</a></small>
                                        <small><a href="#" title="">Admin Name</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                                <hr class="invis">
                            @endforeach

                        </div><!-- end blog-list -->
                    </div><!-- end page-wrapper -->

                    <hr class="invis">

                    <div class="row">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation">
                                    {{$posts->links()}}
                            </nav>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="widget">
                            <h2 class="widget-title">Search</h2>
                            <form class="form-inline search-form" action="{{route('guest.search')}}" method="GET">
                                <div class="form-group">
                                    <input name="search" id="search" type="text" class="form-control" placeholder="Search on the site">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                        </div><!-- end widget -->
                        @include('guest.top-posts')
                        <div class="widget">
                            <h2 class="widget-title">Advertising</h2>
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{asset('assets/upload/banner_04.jpg')}}" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{asset('assets/upload/banner_04.jpg')}}" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{asset('assets/upload/banner_04.jpg')}}" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                        </div><!-- end widget -->

                    </div><!-- end sidebar -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection


