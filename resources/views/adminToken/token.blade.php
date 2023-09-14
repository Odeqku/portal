@extends('layouts.app')


@section('content')
    
    <div class='row justify-content-center'>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-header'><h1>Add a token</h1></div>
            
            
                <div class='card-body'>
                    {!! Form::open(['route' => 'tokens', 'method' => 'POST']) !!}
                    @csrf

                    <div class='row mb-3'>
                        {{-- {{ Form::label('admin_token', 'Admin Token', ['class' => 'col-md-4 col-form-label text-md-end']) }} --}}
                        {{ Form::text('admin_token', '', ['class' => 'col-md-3 form-control', 'placeholder' => 'Token Value']) }}
                    </div>

                    <div class='row mb-0'>
                        <div class='col-md-3 offset-mid-4'>
                            {{ Form::submit('Submit', ['calss'=>'btn btn-primary'] )}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection