@extends('layouts.app')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Register</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">{{ __('Register') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first_name" class="text-small text-uppercase mb-2">Full Name</label>
                                <input type="text" name="full_name" class="form-control form-control-lg" value="{{ old('full_name') }}" placeholder="Enter full name">
                                @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="text-small text-uppercase mb-2">Email</label>
                                <input type="text" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mobile" class="text-small text-uppercase mb-2">Mobile</label>
                                <input type="text" name="mobile" class="form-control form-control-lg" value="{{ old('mobile') }}" placeholder="Enter mobile">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="text-small text-uppercase mb-2">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" value="{{ old('password') }}" placeholder="Enter password">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="text-small text-uppercase mb-2">Re-Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Re-type password" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Register') }}
                            </button>

                            @if(Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-link">
                                    {{ __('Have an account ?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
