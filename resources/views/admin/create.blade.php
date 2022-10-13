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
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.create') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Tag</label>
                        <div>
                            <select class="custom-select" id="tag" name="tag">
                                <option selected>Choose...</option>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 1%">
                            <label>Preview Picture </label>
                            <input class="form-control" type="file" name="preview_image"
                                   placeholder="Choose preview image" id="preview_image">
                            <span>4:4 ratio</span>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="ckeditor" class="form-control" name="content"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-block">Publish</button>
                        </div>
                    </form>
                    <div class="form-group text-center">
                        <button id="previewButton" class="btn btn-success btn-block">Preview</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 style="color: lightgray"> PREVIEW:</h1>
                <h1 style="padding-top: 30px" id="titlePreview"></h1>
                <div id="contentPreview" style="padding-top: 15px">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <x-scripts.ckeditor-conf/>
@endpush
