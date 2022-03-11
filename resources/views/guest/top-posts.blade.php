<div class="widget">
    <h2 class="widget-title">Top Posts</h2>
    <div class="blog-list-widget">
        <div class="list-group">
            @foreach($topPosts as $topPost)
                <a href="{{ route('guest.post', ['id' => $topPost->id]) }}"
                   class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 justify-content-between">
                        <img src="{{asset($topPost->preview_image != null ? 'images/preview_images/'.$topPost->preview_image :
                            'assets/upload/garden_sq_01.jpg' )}}" alt="" class="img-fluid float-left">
                        <h5 class="mb-1">{{ $topPost->title }}</h5>
                        <small>{{ \Carbon\Carbon::parse($topPost->created_at)->format('d/m/Y')}}</small>
                    </div>
                </a>
                <p style="margin-bottom: 2%"></p>
            @endforeach
        </div>
    </div><!-- end blog-list -->
</div><!-- end widget -->

