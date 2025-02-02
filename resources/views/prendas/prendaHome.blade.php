@extends('layouts.fo_layout')
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row mt-4 align-items-center">
            <div class="col-auto">
                <h1>Prendas</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-success" href="{{ route('prendas.add') }}">Adicionar</a>
            </div>
        </div>

        <table class="table text-center table-secondary border border-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor Previsto</th>
                    <th scope="col">Valor Gasto</th>
                    <th scope="col">Diferença</th>
                    <th scope="col">Para</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prendas as $prenda)
                    <tr class="table-dark">
                        <th scope="row">{{ $prenda->id }}</th>
                        <td>{{ $prenda->name }}</td>
                        <td>{{ $prenda->valorPrevisto }}€</td>
                        <td>{{ $prenda->valorGasto }}€</td>
                        @if ($prenda->valorPrevisto - $prenda->valorGasto < 0)
                            <td class="table-danger">{{ abs($prenda->valorPrevisto - $prenda->valorGasto) }}€</td>
                        @else
                            <td class="table-info">{{ abs($prenda->valorPrevisto - $prenda->valorGasto) }}€</td>
                        @endif
                        <td>{{ $prenda->user_name }}</td>
                        <td><a class="btn btn-info"
                                href="{{ route('prendas.show', ['id' => $prenda->id, 'action' => 1]) }}">Ver</a></td>
                        <td><a class="btn btn-danger" href="{{ route('prendas.delete', $prenda->id) }}">Apagar</a></td>
                        <td><a class="btn btn-warning"
                                href="{{ route('prendas.update', ['id' => $prenda->id, 'action' => 0]) }}">Atualizar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
