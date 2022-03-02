@extends('layouts.app')

@section('content')
    @include('error.error')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update', ['id' => $postId]) }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label>Preview Picture </label>
                        <input class="form-control" type="file" name="preview_picture" placeholder="Choose image" id="preview_picture">
                    </div>
                    <label for="title"> Title </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="title"> Description </label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $post->description }}">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea id="ckeditor" class="form-control" name="content">{{$post->content}}</textarea>
                </div>
                <input type="hidden" name="id" value="{{$postId}}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            height: 500,
            filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token()])}}",
            filebrowserUploadMethod: "form"
        });
    </script>

@endpush
