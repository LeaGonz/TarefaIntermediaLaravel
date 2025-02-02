@extends('layouts.fo_layout')
@section('content')
    <div class="container">
        <div class="row mt-4">
            <h1>Prenda {{ $prenda->id }}</h1>
        </div>

        <form method="POST" action="{{ route('prendas.updateFunction', ['id' => $prenda->id]) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="name" value="{{ $prenda->name }}"
                    @if ($action) readonly @endif>
                @error('name')
                    <div class="alert alert-danger" role="alert">
                        Nome da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valor Previsto:</label>
                <input type="number" class="form-control" name="valorPrevisto" value="{{ $prenda->valorPrevisto }}"
                    @if ($action) readonly @endif>
                @error('valorPrevisto')
                    <div class="alert alert-danger" role="alert">
                        Valor da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Valor Gasto:</label>
                <input type="number" class="form-control" name="valorGasto" value="{{ $prenda->valorGasto }}"
                    @if ($action) readonly @endif>
                @error('valorGasto')
                    <div class="alert alert-danger" role="alert">
                        Valor da prenda invalido!
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Para:</label>
                <select class="form-select" name='idUser' @if ($action) disabled @endif>>
                    <option selected value="{{ $prenda->idUser }}">{{ $prenda->user_name }}</option>
                    {{-- Ciclo para preencher o select com os USERS --}}
                    @foreach ($users as $user)
                        @if ($user->id != $prenda->idUser)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('idUser')
                    <div class="alert alert-danger" role="alert">
                        Comprador invalido!
                    </div>
                @enderror
            </div>

            @if ($action)
                <div class="mb-3">
                    <label class="form-label">Data de Compra:</label>
                    <input type="text" class="form-control" value="{{ $prenda->created_at }}" disabled>
                </div>

                <label class="form-label">Data de atualização:</label>
                @if (is_null($prenda->updated_at))
                    <input type="text" class="form-control" value="Sem atualização" disabled>
                @else
                    <input type="text" class="form-control" value="{{ $prenda->updated_at }}" disabled>
                @endif
            @endif

            <button type="submit" class="btn btn-warning mt-3"
                @if ($action) disabled @endif>Atualizar</button>
        </form>

        <a class="btn btn-dark mt-3 mb-3" href="{{ route('prendas.home') }}">Voltar</a>
    </div>
@endsection
