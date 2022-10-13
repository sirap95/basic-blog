@extends('layouts.app')

@section('content')
    @include('error.error')
    <style>
        .container {
            max-width: 80%;
        }

        #preview_image {
            width: 60%;
        }

        #title {
            width: 60%;
        }

        #previewButton {
            width: 21%;
            margin-bottom: 30px;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('admin.update', ['id' => $postId])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Tag</label>
                <div>
                    <select class="custom-select" id="tag" name="tag">
                        @foreach($post->tags as $tag)
                            <option selected>CURRENT TAG: {{$tag->name}}</option>
                        @endforeach
                        @foreach($tags as $tag)
                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Preview Picture </label>
                    <input class="form-control" type="file" name="preview_image" id="preview_image">
                    <img src="{{asset($preview_image)}}" width="200px">
                    <span>4:4 ratio</span>
                </div>
                <div class="form-group">
                    <label for="title"> Title </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea id="ckeditor" class="form-control" name="content">{{$post->content}}</textarea>
                    </div>
                    <input type="hidden" name="id" value="{{$postId}}">

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-warning" href="{{route('admin.index')}}" title="">Exit</a>

                </div>
            </form>
            <button id="previewButton" class="btn btn-success btn-block">Preview</button>
        </div>
        <div class="col-lg-6">
            <h1 style="color: lightgray"> PREVIEW:</h1>
            <h1 style="padding-top: 30px" id="titlePreview"></h1>
            <div id="contentPreview" style="padding-top: 15px">
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <x-scripts.ckeditor-conf/>
@endpush
