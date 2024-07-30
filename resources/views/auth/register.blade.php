@extends('layouts.main')
@section('Conten')
<div class="wrapper">
    <div class="header">
      <div class="top">
        <div class="logo">
          <img src="{{ URL('storage/logo/logo.png')}}" alt="instagram" style="width: 175px" />
        </div>
        <div class="form">
            <form method="POST" action="{{ route('register') }}">
                {{-- <form method="POST" action=""> --}}
                @csrf
                <input type="hidden" name="role" value="user">
          <div class="input_field">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
          </div>
          <div class="input_field">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="Name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

      </div>

          <div class="input_field" >
            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div  class="input_field" style="padding-top:5px ">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password-confirm" required autocomplete="new-password">
          </div>
          <div style="display: flex; justify-content: center; padding-top: 10px;" >
            <button type="submit" class="btn" >
            {{ __('Register') }}
        </button>
    </div>
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
