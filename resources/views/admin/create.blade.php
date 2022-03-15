@extends('layouts.app')

@section('content')
    @include('error.error')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Preview Picture </label>
                            <input class="form-control" type="file" name="preview_image"
                                   placeholder="Choose preview image" id="preview_image">
                            <span>4:4 ratio</span>
                        </div>
                        <div class="form-group">
                            <label>Main Picture </label>
                            <input class="form-control" type="file" name="main_image"
                                   placeholder="Choose main image" id="main_image">
                            <span>16:9 ratio</span>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control"
                                      onkeyup="countChar(this, 400);"> </textarea>
                            <div id="the-count">
                                <span id="charNum">0 </span>
                                <span id="maximum">/ 400</span>
                                <p id="count-error"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="ckeditor" class="form-control" name="content"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-block">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
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
    @include('script.custom')
@endpush
