@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Login</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{{ __('Login') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username" class="text-small text-uppercase mb-2">Email</label>
                                <input type="text" name="email" class="form-control form-control-lg" value="{{ old('email') }}">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="text-small text-uppercase mb-2">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="custom-control-label text-small mb-2" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>



@endsection
