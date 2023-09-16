<?php
    // dd('Here');
?>
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="card">
            <div class="card-header"><h2>Available Courses Accross Deparments</h2></div>
            <div class="card-body">
                @if(count($courses) > 0)
                        <table class="table table-striped">
                        
                                
                                @foreach($departments as $department)

                                    <tr>
                                        <div class="card-title">
                                            <th>{{ $department->department_name }}</th>
                                            <th>Point</th>
                                        </div>
                                    </tr>

                            
                                    
                                    @foreach($courses as $course)     
                                        {{-- {{ $course->department}}                                        --}}
                                        @if($department->department_name === $course->department->department_name)
                                            
                                            <tr>
                                                <div class="card-text .bg-success">
                                                    <th>{{ $course->name }}</th>
                                                    <th>{{ $course->point }}</th>
                                                </div>
                                            </tr>
                                        @endif
                                        
                                    @endforeach   
                                    <?php
                                        // dd('hi');
                                    ?>                                 
                                @endforeach
                        </table>
                    </div>              
                @else
                    <p>No Available Courses Yet</p>
                @endif
            </div>
    </div>
@endsection


