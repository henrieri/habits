@extends('layouts.landing')
@section('content')
<section class="hero is-medium has-text-centered view--landing">
    <div class="hero-head">
        @include('components.header')
    </div>
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Habit Tracker</h1>
            <div class="subtitle">Create and track <strong>life-changing habits</strong>. Measure your progress in life and get some <br> extra
                <strong>motivation</strong> for
                building habits with graphs and personalized scoring system.<br>
                This is a demo application and not meant for serious use.
            </div>
            <div class="hero-buttons">
                <a class="button is-medium" href="/login">Login</a>
                <a class="button is-primary is-medium" href="/register">Sign up</a>
            </div>
        </div>
    </div>
</section>
@endsection

