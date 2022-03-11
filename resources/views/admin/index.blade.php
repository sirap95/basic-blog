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

    <table class="table">
        <thead>
        <tr>
            <th scope="col"> Title</th>
            <th scope="col"> Description</th>
            <th scope="col"> Preview Image</th>
            <th scope="col"> Main Image</th>
            <th scope="col"> Views</th>
            <th scope="col"> Created at</th>
            <th scope="col"> Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ \Illuminate\Support\Str::limit($post->description, 60) }} </td>
                <td><img src="{{asset($post->preview_image != null ?
                            'images/preview_images/'.$post->preview_image : 'assets/upload/garden_sq_01.jpg' )}}"
                         width="50px"></td>
                <td><img src="{{asset($post->main_image != null ?
                            'images/main_images/'.$post->main_image : 'assets/upload/garden_sq_01.jpg' )}}"
                         width="50px"></td>
                <td>{{ $post->views }}</td>
                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
                <td style='white-space: nowrap'>
                    <form class="form-inline" action="{{ route('admin.delete', ['id' => $post->id]) }}"
                          method="POST">
                        @csrf
                        <a class="btn btn-warning" href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit</a>
                        <button style="margin-left: 2%" type="submit" class="btn btn-primary"> Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
