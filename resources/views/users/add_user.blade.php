@extends('layouts.fo_layout')

@section('content')
    <div class="container">
        <div class="row p-5">
            <h1 class="mb-3">Adicionar Utilizador</h1>
            <form method="POST" action="{{ route('users.adicionar') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nome:</label>
                    <input type="name" class="form-control" name="name" aria-describedby="emailHelp">
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            Nome invalido!
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address:</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            Email invalido!
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            Password invalido!
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </form>
        </div>
    </div>
@endsection
