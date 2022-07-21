@extends('layouts.app')

@section('content')
    <style>
        img {
            max-width: 100% !important;
            height: auto !important;
        }
    </style>
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-title-area">
                            <span class="color-green"><a href="{{ route('guest.tag', ['id' => $tag_id]) }}" title=""
                                                         style="padding: 1%">{{$tag}}</a></span>

                            <h3>{{ $post->title }}</h3>

                            <div class="blog-meta big-meta">
                                <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</small>
                                <small>{{ $post->users->name }}</small>
                                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                            </div><!-- end meta -->

                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i>
                                            <span class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    <!-- <li><a href="#" class="wh-button btn btn-primary"><i class="fa fa-whatsapp"></i>
                                             <span class="down-mobile"> Share on Whatsapp</span></a></li> -->
                                </ul>
                            </div><!-- end post-sharing -->
                        </div><!-- end title -->

                        <div class="single-post-media">
                            <img src="{{$main_image_url}}" alt="" class="img-fluid">
                        </div><!-- end media -->

                        <div class="blog-content">
                            <div class="pp">
                                <h4> {{$post->description}} </h4>
                            </div>
                        </div><!-- end content -->


                        <div class="blog-content">
                            <div class="pp">
                                <p> {!! ($post->content) !!} </p>

                            </div>
                        </div><!-- end content -->


                        <div class="blog-title-area">
                            <div class="tag-cloud-single">
                                <span>Tags</span>
                                <small><a href="{{ route('guest.tag', ['id' => 1]) }}" title="">Tag 1</a></small>
                                <small><a href="{{ route('guest.tag', ['id' => 2]) }}" title="">Tag 2</a></small>
                                <small><a href="{{ route('guest.tag', ['id' => 3]) }}" title="">Tag 3</a></small>
                                <small><a href="{{ route('guest.tag', ['id' => 4]) }}" title="">Tag 4</a></small>
                            </div><!-- end meta -->

                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i>
                                            <span class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    </li>
                                </ul>
                            </div><!-- end post-sharing -->
                        </div><!-- end title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="{{asset('assets/upload/banner_01.jpg')}}" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <hr class="invis1">

                        <div class="custombox authorbox clearfix">
                            <h4 class="small-title">About author</h4>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <img src="{{$profile_image_url != null ?
                                        asset($profile_image_url) : asset('assets/upload/author.jpg')}}"
                                         alt="" class="img-fluid rounded-circle">
                                </div><!-- end col -->

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <h4><a href="#">{{ $post->users->name }}</a></h4>
                                    <p>{{ $post->users->description }}</p>

                                    <div class="topsocial">
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i
                                                class="fa fa-facebook"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i
                                                class="fa fa-youtube"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                                class="fa fa-pinterest"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                                class="fa fa-twitter"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                                class="fa fa-instagram"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i
                                                class="fa fa-link"></i></a>
                                    </div><!-- end social -->

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end author-box -->


                        <hr class="invis1">

                        <div class="custombox clearfix"> <!-- to modify -->
                            <h4 class="small-title">You may also like</h4>

                            <div class="row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media" style="max-width: 300px; max-height: 300px">
                                                <a href="{{ route('guest.post', ['id' => $relatedPost->id]) }}"
                                                   title="">
                                                    @foreach($preview_images as $preview_image)
                                                        @if($preview_image->post_id == $relatedPost->id)
                                                            <img
                                                                style="max-width: 300px !important; max-height: 300px !important"
                                                                src="{{asset($preview_image->url)}}"
                                                                alt=""
                                                                class="img-fluid">
                                                        @endif
                                                    @endforeach
                                                    <div class="hovereffect"
                                                         style="max-width: 300px; max-height: 300px">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="{{route('guest.post', ['id' => $relatedPost->id]) }}"
                                                       title="">{{$relatedPost->title}}</a>
                                                </h4>
                                                <small><a href="{{ route('guest.tag', ['id' => $tag_id]) }}"
                                                          title="">{{$tag}}</a></small>
                                                <small>
                                                    {{ \Carbon\Carbon::parse($relatedPost->created_at)->format('d/m/Y')}}
                                                </small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div>
                            @endforeach<!-- end col -->
                            </div> <!-- end row -->
                        </div><!-- end custom-box -->

                        <hr class="invis1">

                    </div><!-- end page-wrapper -->
                </div><!-- end col -->

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <br>
                        <br>
                        @include('guest.top-posts')

                        <div class="widget">
                            <h2 class="widget-title">Advertising</h2>
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{asset('assets/upload/banner_04.jpg')}}" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                            <br>
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{asset('assets/upload/banner_04.jpg')}}" alt="" class="img-fluid">
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                            <br>
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

