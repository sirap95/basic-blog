@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.detail-update', ['id' => \Illuminate\Support\Facades\Auth::id()])}}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Profile Image </label>
                    <input class="form-control" type="file" name="profile_image" id="profile_image">
                    <img src="{{($profile_image_url != null ?
                              asset($profile_image_url) : 'assets/upload/author.jpg' )}}"
                         width="200px">
                </div>
                <div class="form-group">
                    <label for="title"> Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                </div>
                <div class="form-group">
                    <label for="title"> Description </label>
                    <textarea type="text" class="form-control" id="description" onkeyup="countChar(this, 600);"
                              name="description">{{ $admin->description }}</textarea>
                    <div id="the-count">
                        <span id="charNum">{{ strlen($admin->description) }} </span>
                        <span id="maximum">/ 600</span>
                        <p id="count-error"></p>
                    </div>
                    <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-warning" href="{{route('admin.index')}}" title="">Exit</a>
                </div>
            </form>

        </div>
    </div>
    @include('script.custom')
@endsection
