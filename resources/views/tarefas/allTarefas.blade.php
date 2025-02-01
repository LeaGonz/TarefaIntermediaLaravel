@extends('layouts.fo_layout')
@section('content')
<div class="container mt-5">
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endsession
    <div class="row">
    <div class="col-6">
    <h1>TAREFAS</h1>
    <ul>
        @foreach ($tarefas as $tarefa)
        <li>{{$tarefa['name']}} | {{$tarefa['task']}}</li>
        @endforeach
    </ul>
    <h1>AVAILABLE TASKS</h1>
    <ul>
        @foreach ($availableTasks as $availableTask)
        <li>{{$availableTask}}</li>
        @endforeach
    </ul>
</div>
<div class="col-6">
    <form method="POST" action="{{ route('tasks.adicionar') }}">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nome Tarefa:</label>
            <input type="name" class="form-control" name="name" aria-describedby="emailHelp">
            @error('name')
            <div class="alert alert-danger" role="alert">
            name invalido!
        </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descrição:</label>
            <input type="description" class="form-control" name="description" aria-describedby="emailHelp">
            @error('description')
            <div class="alert alert-danger" role="alert">
                Descrição invalida!
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Pessoas:</label>
            <select class="form-select" name='user_id' aria-label="Default select example">
                <option value="" selected>Test</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
              @error('user_id')
              <div class="alert alert-danger" role="alert">
                  User invalido!
              </div>
              @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
@endsection
