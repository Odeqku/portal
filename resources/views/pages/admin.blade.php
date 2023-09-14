@extends('layouts.app')


@section('content')
    <div class='container'>
        <div class='card'>
            <div class='card-header'>
        
                <h1>Hello Admin {{ $authorizedUser->name }}</h1>
            </div>
            <div class='card-body'>
                <div class='row'>
                    <div class='col'>
                        <div class='table-responsive'>
                                <table class='table table-bordered'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <span class='badge badge-secondary'><th>Profile</th></span>
                                            <th>User ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td >{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>

                                                <td><a href="{{route('user_profile', ['user' => $user])}}">{{ $user->profile->profileable_type }}</a></td>
                                                <td>{{ $user->id }}</td>
                                                    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection