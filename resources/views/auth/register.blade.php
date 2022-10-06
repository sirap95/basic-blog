@extends('layouts.app')

@section('content')
    <style>
        .error-template {
            padding: 40px 15px;
            text-align: center;
        }

        .error-actions {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .error-actions .btn {
            margin-right: 10px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!
                    </div>
                    <div class="error-actions">
                        <a href="{{route('guest.index')}}" class="btn btn-primary btn-lg"><span
                                class="glyphicon glyphicon-home"></span>
                            Take Me Home </a><a class="btn btn-default btn-lg"><span
                                class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--       <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">{{ __('Register') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        <form method="POST" action="{{ route('register') }}">--}}
    {{--                            @csrf--}}

    {{--                            <div class="row mb-3">--}}
    {{--                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="name" type="text"--}}
    {{--                                           class="form-control @error('name') is-invalid @enderror" name="name"--}}
    {{--                                           value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

    {{--                                    @error('name')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--            <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="row mb-3">--}}
    {{--                                <label for="email"--}}
    {{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="email" type="email"--}}
    {{--                                           class="form-control @error('email') is-invalid @enderror" name="email"--}}
    {{--                                           value="{{ old('email') }}" required autocomplete="email">--}}

    {{--                                    @error('email')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--            <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="row mb-3">--}}
    {{--                                <label for="password"--}}
    {{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password" type="password"--}}
    {{--                                           class="form-control @error('password') is-invalid @enderror" name="password"--}}
    {{--                                           required autocomplete="new-password">--}}

    {{--                                    @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--            <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="row mb-3">--}}
    {{--                                <label for="password-confirm"--}}
    {{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password-confirm" type="password" class="form-control"--}}
    {{--                                           name="password_confirmation" required autocomplete="new-password">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="row mb-0">--}}
    {{--                                <div class="col-md-6 offset-md-4">--}}
    {{--                                    <button type="submit" class="btn btn-primary">--}}
    {{--                                        {{ __('Register') }}--}}
    {{--                                    </button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div> --}}
@endsection
