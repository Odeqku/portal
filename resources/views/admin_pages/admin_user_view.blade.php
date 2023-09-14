<?php
    // dd($user->student->department->department_name);
    // dd($user->student->department->department_name);
    // dd($studentCourses->$user);
    // dd($user->student->details->first()->photograph);
?>
@extends('layouts.app')
   
@section('content')
    <div class='container'>
        <div class='row justify-content-center'>
            {{-- <div> --}}
                <h2 class='row justify-content-center'>{{ $user->name }} Profile</h2>
                @if($user->student->details->isEmpty())
                    <img src="{{ Storage::url('images/Screenshot (245)_png') }}" alt="My Image" class='img-fluid thumbnail max-auto w-25 h-25'>
                @else
                    <img src="{{ Storage::url('studentPhoto/'. $user->student->details->first()->photograph) }}" alt="My Image" class='img-fluid thumbnail max-auto w-25 h-25'>
                @endif
                <h6 class='row justify-content-center'>Department: {{ $user->student->department->department_name }}</h6>
                <h6 class='row justify-content-center'>Level: {{ $user->student->level->level_name }}</h6>
                <h6 class='row justify-content-center'>Faculty: {{ $user->student->faculty->faculty_name }}</h6>
                <h6 class='row justify-content-center'>Matric Number: {{ $user->student->matric_number }}</h6>
            
                {{-- <div class='card'> --}}
                    
                    <div class='card-body'>
                        <div class='row justify-content-center'>
                            <div class='col-md-8'>
                                <div class='table-responsive'>
                                        <table class='table table-bordered'>
                                            <thead class='thead-dark'>
                                                <tr>
                                                    <th>COURSE CODE</th>
                                                    <th>UNIT</th>
                                                    {{-- <span class='badge badge-secondary'><th>Profile</th></span> --}}
                                                    <th>GRADE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($studentCourses as $studentCourse)
                                                    @if($student_user_id === $studentCourse->student_id )
                                                        @php
                                                            $counter += $studentCourse->course->point;
                                                        @endphp
                                                        <tr>
                                                            <td >{{ $studentCourse->course->name }}</td>
                                                            <td>{{ $studentCourse->course->point }}</td>
                                                            {{-- <td></td> --}}
                                                            {{-- <td><a href="{{route('user_profile', ['user' => $user])}}">{{ $user->profile->profileable_type }}</a></td> --}}
                                                            <td>N/A</td>
                                                        </tr>
                                                    @endif                                                 
                                                @endforeach
                                                    <tr class="striped-row">
                                                        <th>Total Credit Unit</th>
                                                        <th>{{ $counter }}</th>
                                                        {{-- <td></td> --}}
                                                        {{-- <td><a href="{{route('user_profile', ['user' => $user])}}">{{ $user->profile->profileable_type }}</a></td> --}}
                                                        <th>---</th>
                                                    </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}










                {{-- <h4>{{$user}}</h4> --}}
            
                {{-- </div> --}}
                {{-- @foreach($studentCourses as $studentCourse)
                    @if($student_user_id === $studentCourse->student_id )
                        
                        <h3>{{ $Courses->find($studentCourse->course_id)->name }}</h3>

                    @endif
                @endforeach --}}
        </div>
    </div>

@endsection