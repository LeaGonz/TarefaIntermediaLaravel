@extends('layouts.fo_layout')
@section('content')
    <div class="container mt-2">
        <h1>Aqui vês todos os users</h1>

        <div class="row text-center">
            <div class="col mt-2 border border-dark p-2 me-1">
                <h6>{{ $cesaeInfo['name'] }}</h6>
                <h6>{{ $cesaeInfo['address'] }}</h6>
                <h6>{{ $cesaeInfo['email'] }}</h6>
            </div>

            <div class="col mt-2 border border-dark p-2 ms-1">
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact['id'] }}</td>
                            <td> | {{ $contact['name'] }} | </td>
                            <td>{{ $contact['phone'] }} | </td><br>
                        </tr>
                    @endforeach
                </tbody>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <table class="table text-center table-secondary border border-dark mt-4">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Password</th>
                        <th scope="col">Updated at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allUsers as $user)
                        <tr class="table-dark">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td><a class="btn btn-info" href="{{ route('users.view_user', $user->id) }}">Ver</a></td>
                            <td><a class="btn btn-danger" href="{{ route('users.delete_user', $user->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
