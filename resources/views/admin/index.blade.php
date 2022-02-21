@extends('layouts.app')

@section('content')
    <br>
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <br>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.create') }}" class="btn btn-success"> New Post</a>
        </div>
    </div>
    <br>
    @foreach($posts as $post)
        <div class="row">
            <div class="col-md-12">
                <p><strong>{{ $post->title }}</strong>
                    <a href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit</a>
                    <strong> - </strong>
                    <a href="{{ route('admin.delete', ['id' => $post->id]) }}"> Delete </a>
                    <strong> - </strong> <a> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</a>
                </p>
            </div>
        </div>
    @endforeach

@endsection
