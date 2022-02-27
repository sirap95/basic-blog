@extends('layouts.app')

@section('content')
    @include('error.error')
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-3 mt-4">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
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

@endpush
