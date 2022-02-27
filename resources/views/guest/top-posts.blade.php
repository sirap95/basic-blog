<div class="widget">
    <h2 class="widget-title">Top Posts</h2>
    <div class="blog-list-widget">
        <div class="list-group">
            @foreach($topPosts as $topPost)
                <a href="{{ route('guest.post', ['id' => $topPost->id]) }}"
                   class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 justify-content-between">
                        <img src="{{asset('/assets/upload/garden_sq_09.jpg')}}" alt="" class="img-fluid float-left">
                        <h5 class="mb-1">{{ $topPost->title }}</h5>
                        <small>{{ \Carbon\Carbon::parse($topPost->created_at)->format('d/m/Y')}}</small>
                    </div>
                </a>
            @endforeach
        </div>
    </div><!-- end blog-list -->
</div><!-- end widget -->

