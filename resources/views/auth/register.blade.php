<?php
    // use App\Models\Department;
    // $departments = Department::all();
    // $profiles = ['Admin', 'Student'];
    // dd($profiles);
?>

@extends('layouts.app')

@section('content')

@include('inc.message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class=''>
                    <a href="/home/studentRegister" class="" onclick="event.preventDefault();
                            if(document.getElementById('form').style.display === 'none'){
                                document.getElementById('form').style.display = 'block';
                            }else{
                                document.getElementById('form').style.display = 'none';
                            }">

                        {{-- Student Registration --}}
                    </a>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('registration') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirmation" class="col-md-4 col-form-label text-md-end">{{
                                __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label for='profile' class="col-md-4 col-form-label text-md-end">Profile</label>

                            <div class='col-md-4'>
                                <select class="form-control" id="profiles" name="profile" onchange="
                                                if(document.getElementById('profiles').value === 'Admin'){
                                                    document.getElementById('Admin_token').style.display = 'block';
                                                    document.getElementById('Admin_token').setAttribute('placeholder', 'Provide a Token');
                                                    document.getElementById('department').style.display = 'none';
                                                    document.getElementById('faculty').style.display = 'none';
                                                    
                                                }else{
                                                    document.getElementById('Admin_token').style.display = 'none';
                                                    document.getElementById('department').style.display = 'block';
                                                    // document.getElementById('faculty').style.display = 'block';
                                                    
                                                }">

                                    <option value="" name='profile'>Register as:</option>
                                    @foreach($profiles as $profile)
                                    <option value="{{ $profile }}" name='profile'>{{ $profile }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label for="token" class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-4">
                                <input id="Admin_token" type="text" class="form-control" name="token"
                                    style='display: none;' placeholder='Provide a token'
                                    onchange="document.getElementById('Admin_token').style.display = 'none'">

                            </div>
                        </div>

                        <div class='row mb-0 justify-content-center'>
                            <div class='col-md-4'>
                                <select class="form-control" id="department" name="department" style='display:none;'>
                                    <option value="" name='department' onchange='
                                            document.getElementById("faculty").value = this.value->faculty->faculty_name
                                            // this.value = this.value->id                                                                                  
                                            '>
                                        Your Department
                                    </option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department }}">
                                        {{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='row mb-0 justify-content-center'>
                            <div class='col-md-4'>
                                <select class="form-control" id="faculty" name="faculty" style='display:none;'>
                                    <option value="" name='faculty'>Your Faculty</option>
                                    {{-- @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" name='faculty'>
                                        {{ $faculty->faculty_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection