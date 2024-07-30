@extends('layouts.main')
@section('Conten')
<div class="wrapper">
    <div class="header">
      <div class="top">
        <div class="logo">
          <img src="{{ URL('storage/logo/logo.png')}}" alt="instagram" style="width: 175px" />
        </div>
        <div class="form">
            <form method="POST" action="{{ route('login') }}">
                @csrf

          <div class="input_field">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
             name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>
          <div class="input_field">
            {{-- <input type="password" placeholder="Password" class="input" /> --}}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="input_field " style="padding-left: 20px ">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Nhớ Mật Khẩu') }}
            </label>
          </div>
          {{-- <div class="btn"><a href="#">Log In</a></div> --}}
          <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif

        </div>
    </form>
        <div class="or">
          <div class="line"></div>
          <p>OR</p>
          <div class="line"></div>
        </div>
        <div class="dif">
          <div class="fb">
            <img src="{{ URL('https://i.pinimg.com/originals/74/65/f3/7465f30319191e2729668875e7a557f2.png') }}" alt="" />
            <p>Log in with Google</p>
          </div>
          <div class="forgot">
            <a href="#">Forgot password?</a>
          </div>
        </div>
      </div>
      <div class="signup">
        <p>Don't have an account? <a href="#">Sign up</a></p>
      </div>
    </div>
  </div>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@endpush
