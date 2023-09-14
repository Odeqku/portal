@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Portal</h1>
</div>
<div class="card">
    <div class="header">
        <h3 class="text-center">Login or Register</h3>
    </div>
    <div class="card-body">
        @include('inc.message')
        <div class="row">
            <div class="col-md-11">
                <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                <th>
            </div>

            <div class="col-md-1">
                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a></th>
            </div>
        </div>
    </div>
</div>
@endsection