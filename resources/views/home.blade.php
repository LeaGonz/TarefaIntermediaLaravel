@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                @auth
                    @if (isset(Auth::user()->name))
                        <h5 class="mb-3">Olá {{ Auth::user()->name }}</h5>
                    @endif
                @endauth
                <h6>{{ $myVar }}</h6>
                <h6>{{ $contactInfo['nome'] }}</h6>

                <!-- Imagem -->
                <div class="my-4">
                    <img src="{{ asset('img/carrossel-3.jpg') }}" alt="Imagem" class="img-fluid rounded shadow">
                </div>

                <!-- Lista -->
                <ul class="list-unstyled mt-4">
                    <li><a href="{{ route('users.show') }}" class="btn btn-link">Users</a></li>
                    <li><a href="{{ route('users.add') }}" class="btn btn-link">Adicionar User</a></li>
                    <li><a href="{{ route('tarefas.allTarefas') }}" class="btn btn-link">Tarefas</a></li>
                    <li><a href="{{ route('tarefas.allTarefas2') }}" class="btn btn-link">Todas as Tarefas</a></li>
                    <li><a href="{{ route('prendas.home') }}" class="btn btn-link">Prendas</a></li>
                    <li><a href="{{ route('prendas.add') }}" class="btn btn-link">Adicionar Prendas</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content2')
    <div class="col-md-4 bg-secondary text-white text-center">
        <h5>Content 2</h5>
    </div>
@endsection
