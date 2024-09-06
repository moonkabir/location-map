@extends('layouts.login') @section('content')

<div class="login-wrap p-4 p-md-5">
    <div class="icon d-flex align-items-center justify-content-center">
        <span class="fa fa-user-o"></span>
    </div>
    <h5 class="text-center mb-4">Sign In</h5>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif 
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="text" placeholder="email" class="form-control rounded-left @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group d-flex">
            <input id="password" type="password" class="form-control rounded-left @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary rounded submit px-3">{{ __('Login') }}</button>
        </div>
    </form>
</div>

@endsection
