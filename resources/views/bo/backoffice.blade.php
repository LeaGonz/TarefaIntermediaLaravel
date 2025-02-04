@extends('layouts.fo_layout')

@section('content')
    <div class="container mt-4">

        @auth
            @if (Auth::user()->user_type == 0)
                <div class="alert alert-success" role="alert">
                    UTILIZADOR ADMIN!
                </div>
            @endif
            <h5 class="mb-3">Olá {{ Auth::user()->name }}</h5>
        @endauth
    @endsection
