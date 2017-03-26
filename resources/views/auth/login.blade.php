@extends('layouts.auth')

@section('content')

    <h2 class="subtitle">Login</h2>
    <form class="form" role="form" method="POST" action="{{ route('login') }}">
        <div class="box">

            {{ csrf_field() }}
            <div class="field">
                <label for="email" class="label">E-Mail Address</label>
                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required
                       autofocus>
            </div>
            <div class="field">
                <label for="password" class="label">Password</label>
                <input id="password" type="password" class="input" name="password" required>
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
                Login
            </button>
            </div>
            <div class="field">
            <a class="has-text-centered is-fullwidth" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
            </div>
        </div>


    </form>
@endsection
