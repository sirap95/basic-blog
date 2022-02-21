@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <br>
            <p class="post"> </p>
        </div>
    </div>
    @foreach($posts as $post)
        <div class="row" style="align-content: center">
            <div class="col-md-9">
                <h1 class="post-title"> {{ $post->title }} </h1>
                <p> {{ $post->content }} </p>
                <p><a href="{{ route('guest.post', ['id' => $post->id]) }}">Read more...</a></p>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
