@extends('layouts.fo_layout')

@section('content')

<h4>Dados da tarefa {{$tasks->id}}</h4>
<h6>Nome: {{$tasks->name}}</h6>
<h6>Descrição: {{$tasks->description}}</h6>
<h6>Status: {{$tasks->status}}</h6>
<h6>Creada: {{$tasks->created_at}}</h6>
<h6>Atualizada: {{$tasks->updated_at}}</h6>
<h6>Pessoa: {{$tasks->user_name}}</h6>

@endsection
