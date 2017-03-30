@extends('layouts.auth')

@section('content')

    <h2 class="subtitle">Login</h2>
    <form class="form" role="form" method="POST" action="{{ route('login') }}">
        <div class="box">
            {{ csrf_field() }}

            @include('components.forms.field', [
                'name' => 'email',
                'type' => 'email',
                'label' => 'E-mail address',
                'autoFocus' => true
            ])

            @include('components.forms.field', [
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'autoFocus' => true
            ])
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
            <div class="field has-text-centered">
                <a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
            <div class="field has-text-centered">
                <a href="{{ route('register') }}">
                    Do not have account? Sign up instead.
                </a>
            </div>
        </div>


    </form>
@endsection
