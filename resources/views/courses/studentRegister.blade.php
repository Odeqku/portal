@extends('layouts.app1')

@section('content')

<div class="container">
    <div class='card'>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <div class='card-hearder'>
                    <h1>Hello {{ auth()->user()->name }}</h1>
                </div>

            </div>
            @include('inc.message')
            <div class='row justify-content-center'>
                <h4>
                    Kindly go through the listed courses below, tick and submit to complete your course registration.
                </h4>
            </div>
        </div>
        <hr>

        <div class='card-body'>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Course Tilte</th>
                        <th></th>
                        <th>Course Lecturer</th>
                        <th>Lecturer's Email</th>
                        <th>Telephone</th>
                        <th>Course Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form class='form-group' action="{{ route('course_submit') }}" method='POST'>
                        @csrf
                        @foreach($levelCourses as $levelCourse)
                            @if(in_array($levelCourse->id, $studentCourseIds))

                                @php
                                $studentLevelCourse = $levelCourse

                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox" name="registered-courses[]"
                                            value="{{ $studentLevelCourse->name }}" id="{{ $studentLevelCourse->name }}"
                                            style='margin-right: 5px;'>
                                        <label for="{{ $studentLevelCourse->name }}">{{ $studentLevelCourse->name }}</label><br>
                                    </td>
                                    <td></td>
                                    <td>{{ $studentLevelCourse->lecturer->lecturer_name }}</td>
                                    <td>{{ $studentLevelCourse->lecturer->email }}</td>
                                    <td>{{ $studentLevelCourse->lecturer->telephone }}</td>
                                    <td>{{ $studentLevelCourse->status->status_name }}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="6">
                                {{-- <input type="hidden" name="studentDetails" value={{ $studentDetailsRequest }} /> --}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <input type='submit' value="Submit" class='btn btn-primary' />
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection