@extends('layouts.fo_layout')
@section('content')
    <h1>Todas as Tarefas</h1>
    <br>

    <table class="table text-center table-secondary border border-dark mt-4">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Descrição</th>
                <th scope="col">Due at</th>
                <th scope="col">Status</th>
                <th scope="col">Criada</th>
                <th scope="col">Atualizada</th>
                <th scope="col">Usuario</th>
                <th scope="col">Pessoa responsável</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allTarefas as $task)
                <tr class="table-dark">
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_at }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->updated_at }}</td>
                    <td>{{ $task->user_id }}</td>
                    <td>{{ $task->user_name }}</td>
                    <td><a class="btn btn-info" href="{{ route('tasks.view_task', $task->id) }}">Ver</a></td>
                    <td><a class="btn btn-danger" href="{{ route('tasks.delete_task', $task->id) }}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
