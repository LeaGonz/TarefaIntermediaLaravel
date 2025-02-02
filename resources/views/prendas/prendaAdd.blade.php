@extends('layouts.fo_layout')
@section('content')
    <div class="container">
        <h1>Adicionar uma Prenda</h1>

        <form method="POST" action="{{ route('prendas.addFunction') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <div class="alert alert-danger" role="alert">
                        Nome da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valor Previsto:</label>
                <input type="number" class="form-control" name="valorPrevisto">
                @error('valorPrevisto')
                    <div class="alert alert-danger" role="alert">
                        Valor da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valor Gasto:</label>
                <input type="number" class="form-control" name="valorGasto">
                @error('valorGasto')
                    <div class="alert alert-danger" role="alert">
                        Valor da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Para:</label>
                <select class="form-select" name='idUser'>
                    <option selected>Selecione um comprador</option>
                    {{-- Ciclo para preencher o select com os USERS --}}
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                </select>
                @error('idUser')
                    <div class="alert alert-danger" role="alert">
                        Comprador invalido!
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
        </form>
    </div>
@endsection
