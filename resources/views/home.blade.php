@extends('layouts.fo_layout')
@section('content')
<h5>Olá estou em casa.</h5>
<h6>{{$myVar}}</h6>
<h6>{{$contactInfo['nome']}}</h6>

<img src="{{asset('img/carrossel-3.jpg')}}" alt="">
<ul>
    <li><a href="{{ route('users.show') }}">Todos os users</a></li>
    <li><a href="{{ route('users.add') }}">Adicionar Utilizador</a></li>
    <li><a href="{{ route('tarefas.allTarefas') }}">Tarefas</a></li>
    <li><a href="{{ route('tarefas.allTarefas2') }}">Todas as Tarefas</a></li> 
</ul>
@endsection
@section('content2')
<h3>Content 2</h3>
@endsection
