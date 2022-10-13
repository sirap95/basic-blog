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
                                                @foreach($preview_images as $preview_image)
                                                    @if($preview_image->post_id == $post->id)
                                                        <img src="{{asset($preview_image->url)}}"
                                                             alt=""
                                                             class="img-fluid">
                                                    @endif
                                                @endforeach
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        @foreach($post->tags as $tag)
                                            <span class="bg-aqua"><a
                                                    href="{{ route('guest.tag', ['id' => $tag->id]) }}"
                                                    title="">{{$tag->name}}</a></span>
                                        @endforeach
                                        <h4><a href="{{ route('guest.post', ['id' => $post->id]) }}"
                                               title="">{{ $post->title }}</a></h4>
                                        <p>{!! \Illuminate\Support\Str::limit($post->content, 110)  !!}  </p>
                                        <small><i class="fa fa-eye"></i>
                                            {{$post->views}}
                                        </small>
                                        <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</small>
                                        <small>{{ $post->users->name }}</small>
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
                                    <input name="search" id="search" type="text" class="form-control"
                                           placeholder="Search on the site">
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


