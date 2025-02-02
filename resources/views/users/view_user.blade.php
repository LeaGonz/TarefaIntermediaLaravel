@extends('layouts.fo_layout')

@section('content')

<h2>Dados do User</h2>
<h6><strong>Nome:</strong> {{$user->name}}</h6>
<h6><strong>Morada:</strong> {{$user->address}}</h6>
<h6><strong>Nif:</strong> {{$user->nif}}</h6>

@endsection
