@extends('layouts.app')

@section('content')
@include('inc/message')
<div class="container">
    @php
    $authUser = auth()->user()
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Student Data') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div>
                        {{ __('You are logged in!') }}
                    </div>
                    @if($authUser)
                    {!! Form::open(['route' => 'studentReg', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                    @csrf

                    @if($studentDetailsIsEmpty)
                    <div class="">
                        <a href="/home/studentRegister" class="btn btn-primary" onclick="event.preventDefault();
                                                        if(document.getElementById('form1').style.display === 'none'){
                                                            document.getElementById('form1').style.display = 'block';
                                                        }else{
                                                            document.getElementById('form1').style.display = 'none';
                                                        }">
                            Personal Details
                        </a>
                    </div>

                    <div class="form-group" style='display: none;' id='form1'>
                        <div class="form-group form-control">
                            {{ Form::text('matric_number', $authUser->student->matric_number, ['class' =>
                            'form-action col-md-4', 'placeholder' => 'Matric Number', 'readonly'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('sex', '', ['class' => 'form-action col-md-4', 'placeholder' => 'Your Sex'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('state_of_origin', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Your State of Origin'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::textarea('home_address', '', ['class' => 'form-action col-md-8', 'placeholder' =>
                            'Your Home Address'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('LGA_of_origin', '', ['class' => 'form-action col-md-8', 'placeholder' =>
                            'Local Govt'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('date_of_birth', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Your Date of Birth'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('telephone', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Telephone'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::file('photograph', ['class' => 'form-action col-md-6'])}}
                        </div>

                    </div>
                    <div class="">
                        <h1></h1>
                    </div>

                    <div class="">
                        <a href="/home/studentRegister" class="btn btn-primary" onclick="event.preventDefault();
                                                        if(document.getElementById('form2').style.display === 'none'){
                                                            document.getElementById('form2').style.display = 'block';
                                                        }else{
                                                            document.getElementById('form2').style.display = 'none';
                                                        }">
                            Next of Kin's Details
                        </a>
                    </div>

                    <div class="form-group" style='display: none;' id='form2'>
                        <div class="form-group form-control">
                            {{-- {{ Form::text('matric_number', auth()->user()->student->matric_number, ['class' =>
                            'form-action col-md-4', 'placeholder' => 'Matric Number', 'readonly'])}} --}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('name', '', ['class'=>'form-action col-md-6', 'placeholder'=>"Next Of Kin's Name"])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::textarea('address', '', ['class' => 'form-action col-md-8', 'placeholder'=>'Next of Kin\'s Address'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('relationship', '', ['class' => 'form-action col-md-6', 'placeholder'=>'Your relationship with him/her'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('phone', '', ['class' => 'form-action col-md-4', 'placeholder'
                            =>'Telephone'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('email', '', ['class' => 'form-action col-md-4', 'placeholder' => 'Email'])}}
                        </div>

                    </div>

                    <div class="">
                        <h1></h1>
                    </div>

                    <div class="">
                        <a href="/home/studentRegister" class="btn btn-primary" onclick="event.preventDefault();
                                                        if(document.getElementById('form3').style.display === 'none'){
                                                            document.getElementById('form3').style.display = 'block';
                                                        }else{
                                                            document.getElementById('form3').style.display = 'none';
                                                        }">

                            Guardian's Details
                        </a>
                    </div>

                    <div class="form-group" style='display: none;' id='form3'>
                        <div class="form-group form-control">
                            {{ Form::text('guardian_name', '', ['class' => 'form-action col-md-4', 'placeholder'
                            =>'Name'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::textarea('guardian_address', '', ['class' => 'form-action col-md-8',
                            'placeholder'=>'Address'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('guardian_telephone', '', ['class' => 'form-action col-md-4', 'placeholder'
                            =>'Telephone'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('guardian_email', '', ['class' => 'form-action col-md-4',
                            'placeholder'=>'Email'])}}
                        </div>
                    </div>

                    <div class="">
                        <h1></h1>
                    </div>

                    <div class="">
                        <a href="/home/studentRegister" class="btn btn-primary" onclick="event.preventDefault();
                                                        if(document.getElementById('form4').style.display === 'none'){
                                                            document.getElementById('form4').style.display = 'block';
                                                        }else{
                                                            document.getElementById('form4').style.display = 'none';
                                                        }">
                            Sponsor's Details
                        </a>
                    </div>

                    <div class="form-group" style='display: none;' id='form4'>

                        <div class="form-group form-control">
                            {{ Form::text('sponsor_name', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Name'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::textarea('sponsor_address', '', ['class' => 'form-action col-md-8', 'placeholder'
                            => 'Address'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('sponsor_telephone', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Telephone'])}}
                        </div>

                        <div class="form-group form-control">
                            {{ Form::text('sponsor_email', '', ['class' => 'form-action col-md-4', 'placeholder' =>
                            'Email'])}}
                        </div>
                    </div>

                    <div class="">
                        <h1></h1>
                    </div>
                    @endif
                    <div class=''>
                        <a href="/home/studentRegister" class="btn btn-primary" onclick="event.preventDefault();
                                                        if(document.getElementById('form').style.display === 'none'){
                                                            document.getElementById('form').style.display = 'block';
                                                        }else{
                                                            document.getElementById('form').style.display = 'none';
                                                        }">
                            Course Registration
                        </a>
                    </div>


                    <div class="form-group" style='display: none;' id='form'>

                        <div class="form-group form-control w-48 bg-white shadow rounded">
                            {{ Form::text('matric_number', $authUser->student->matric_number, ['class' =>
                            'form-action col-md-4', 'placeholder' => 'Matric Number', 'readonly'])}}
                        </div>

                        <div><h1></h1></div>

                        <div class="form-group form-control w-48 bg-white shadow rounded">

                            <select class="form-group form-control" id="course" name="level">
                                <option value="" selected disabled>Select a level</option>

                                <option value="{{ $authUser->student->level->id }}">
                                    {{$authUser->student->level->level_name}}</option>

                            </select>
                        </div>
                        <div><h1></h1></div>
                        <div class="form-group form-control w-48 bg-white shadow rounded col-md-4">

                            <select class="form-group form-control col-md-4" id="course" name="semester">
                                <option value="" selected disabled>Select a semester</option>
                                @foreach($semesters as $semester)
                                <option value="{{ $semester }}">{{ $semester }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{ Form::hidden('faculty_id', '', ['class' => 'form-action']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::hidden('department', '', ['class' => 'form-action']) }}
                        </div>


                        <div class="form-group">
                            {{ Form::hidden('department_id', '', ['class' => 'form-action']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::hidden('course_id', '', ['class' => 'form-action']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::hidden('user_id', '', ['class' => 'form-action']) }}
                        </div>
                    </div>

                    <div class="">
                        <h1></h1>
                    </div>
                    <div class='row mb-0'>
                        <div class='col-mb-6 offset-mid-4'>
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection