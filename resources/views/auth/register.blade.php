@extends('layouts.auth')

@section('content')

    <h2 class="subtitle">Sign up</h2>
    <form class="form" role="form" method="POST" action="{{ route('register') }}">
        <div class="box">

            {{ csrf_field() }}
            <div class="field">
                <label for="name" class="label">Your name</label>
                <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="field">
                <label for="email" class="label">E-Mail Address</label>
                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required
                       autofocus>
            </div>

            <div class="field">
                <label for="password" class="label">Password</label>
                <input id="password" type="password" class="input" name="password" required>
            </div>

            <div class="field">
                <label for="password-confirm" class="label">Confirm Password</label>
                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
            </div>
            {{--  @if ($errors->has('password'))
                  <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif--}}
            <div class="field">
                <label class="checkbox">
                    <input id="remember" class="checkbox" type="checkbox"
                           name="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me</label>
            </div>
            <div class="field">
                <button type="submit" class="button is-primary is-fullwidth">
                    Sign up
                </button>
            </div>
            <div class="field has-text-centered">
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </div>


    </form>
@endsection
