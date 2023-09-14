@extends('layouts.app')

@section('content')
    <div class="container form-control">
        {!! Form::open(['action' => 'App\Http\Controllers\CoursesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])  !!}
        @csrf
        <hr>
            <div class="form-group">
                <input type="hidden" name="model_type1" value="courses">
                {{-- {{ Form::hidden('model_type1', 'courses') }} --}}
                {{ Form::label('name', 'CourseName') }}
                {{ Form::text('name', '', [ 'class' => 'form-control', 'placeholder' => 'Course Name'])}}
            </div>

            <div class="form-group form-control">
                {{-- {{ Form::label('semester', 'Semester') }} --}}
                <label for="semester">Semester</label>
                    <select class="form control" id="" name="semester">
                        <option value="" selected disabled>Select a semester</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester }}">{{ $semester }}</option>
                            @endforeach
                    </select>
            </div>

            <div class="form-group form-control">
                {{ Form::label('faculty', 'Faculty') }}
                    <select class="form control" id="course" name="faculty_name">
                        <option value="" selected disabled>Select a faculty</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty }}">{{ $faculty }}</option>
                            @endforeach
                    </select>
            </div>

          
        
            <div class="form-group">
                <input type="hidden" name="model_type1" value="courses">
                {{ Form::label('point', 'Point') }}
                {{ Form::text('point', '', ['class' => 'form-control', 'placeholder' => 'Course Point']) }}
            </div>
        <hr>

            <div class="form-group">
                <input type="hidden" name="model_type2" value="lecturers">
                {{ Form::label('lecturer_name', 'Course Lecturer') }}
                {{ Form::text('lecturer_name', '', ['class' => 'form-control', 'placeholder' => 'Lecturer Name']) }}
            </div>

            <div class="form-group">
                <input type="hidden" name="model_type2" value="lecturers">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Lecturer\'s Email']) }}
            </div>

            <div class="form-group">
                <input type="hidden" name="model_type2" value="lecturers">
                {{ Form::label('telephone', 'Telephone') }}
                {{ Form::text('telephone', '', ['class' => 'form-control', 'placeholder' => 'Lecturer\'s Telephone']) }}
            </div>

            <div class="form-group">
                <input type="hidden" name="model_type2" value="lecturers">
                {{ Form::file('image')}}
            
            </div>

            <hr>
            <div class="form-group">
                <input type="hidden" name="model_type3" value="levels">
                {{ Form::label('level_name', 'LevelName') }}
                {{ Form::text('level_name', '', ['class' => 'form-control', 'placeholder' => 'Level Name']) }}
            </div>

            <hr>

            <div class="form-group">
                <input type="hidden" name="model_type4" value="statuses">
                {{ Form::label('status_name', 'StatusName') }}
                {{ Form::text('status_name', '', ['class' => 'form-control', 'placeholder' => 'Status Name']) }}
            </div>

            <hr>

            <div class="form-group">
                <input type="hidden" name="model_type5" value="departments">
                {{ Form::label('department_name', 'DepartmentName') }}
                {{ Form::text('department_name', '', ['class' => 'form-control', 'placeholder' => 'The Department Name']) }}
            </div>

            {{-- <div class="form-group form-control">
                {{ Form::label("accessTocourse", "Accessible To") }}
                    <select class="form control" id="" name="accessTocourse">
                        <option value="" selected disabled>Select a faculty</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty }}">{{ $faculty }}</option>
                            @endforeach
                    </select>
            </div> --}}

            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

        {!!Form::close()!!}
    </div>

@endsection