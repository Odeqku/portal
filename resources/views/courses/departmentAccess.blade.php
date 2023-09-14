<?php
    // dd($departments);
?>

@extends('layouts.app1')

@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th><h4>Check the department(s) that should be able to register {{ $newCourse->name }}</h4></th>
                <th></th>
                <th></th>
                {{-- <th>Lecturer's Email</th>
                <th>Telephone</th>
                <th>Course Status</th> --}}
            </tr>
        </thead>
        <tbody>
            <form class='form-group' action="{{ route('course_access') }}" method='POST'>
                @csrf
                @foreach($departments as $department)
                <tr>
                    <td>
                        <input type="checkbox" name="course_access[]" value="{{ $department->id }}"
                            id="{{ $department->department_name }}" style='margin-right: 5px;'>
                        <label for="{{ $department->department_name }}">{{ $department->department_name }}</label><br>
                    </td>
                    <td></td>
                    <td></td>
                    {{-- <td>{{ $course->lecturer->email }}</td>
                    <td>{{ $course->lecturer->telephone }}</td>
                    <td>{{ $course->status->status_name }}</td> --}}
                </tr>
                @endforeach
                {{-- {{$newCourse}} --}}
                {{ Form::hidden('newCourse', $newCourse) }}
                {{-- {{ Form::hidden('semester', $newCourse->semester) }} --}}

                <tr>
                    <td colspan="6">
                        <input type='submit' value="Submit" class='btn btn-primary'/>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>

@endsection