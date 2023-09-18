@extends('layouts.app')

@section('content')
@php
    $student = auth()->user()->student
    // dd(auth()->user()->student);
@endphp
<div class="card">
    <div class="card-header">
        
        
        @include('inc.message')
        <h3>Student ID</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ Storage::url('studentPhoto/' . $student->details->first()->photograph) }}"
                    alt="Image is not available" class="img-fluid thumbnail max-auto w-50 h-100" />
            </div>
                
            
            <div class="col-md-8">
                <p>Name: {{ $student->name }}</p>
                <p>Level: {{ $student->level->level_name }}</p>
                <p>Matric Number: {{ $student->matric_number }}</p>
                <p>Department: {{ $student->department->department_name }}</p>
                <p>Faculty: {{$student->faculty->faculty_name}}</p>
                <p>ID: {{$student->id}}</p>
            </div>
        </div>
    </div>
</div>
</body>

</html>




@endsection