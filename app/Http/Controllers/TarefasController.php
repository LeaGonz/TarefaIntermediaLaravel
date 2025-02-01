<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Task;

class TarefasController extends Controller
{
    public function showTarefas()
    {

        $tarefas = $this->getTarefas();
        $availableTasks = $this->availableTasks();
        $users = $this->listUsers();

        return view("tarefas.allTarefas", compact('tarefas', 'availableTasks','users'));
    }

    public function listUsers(){
        if  (request()->query('user_id')){
            $users = User::where('id', request()->query('user_id'))->get();
        } else{
            $users = User::all();
        }
        return $users;
    }

    public function createTask(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:5',
            'user_id'=> 'required|string'
        ]);
        //dd($request->all()); valor gaasto valor previsto nome y user
        DB::table('tasks')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tarefas.allTarefas')->with('message', 'Tarefa criada com sucesso');
    }

    public function showTarefas2()
    {
        $allTarefas = $this->getAllTasksFromDB();
        return view("tarefas.todaTarefas", compact('allTarefas'));
    }

    protected function getAllTasksFromDB()
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->get();
        // dd($tasks);
        return $tasks;
    }

    public function viewTarefa($id)
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->where('tasks.id', $id)
            ->first();
        return view('tarefas.tarefa', compact('tasks'));
    }

    public function deleteTarefa($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->delete();
        return back();
    }

    private function getTarefas()
    {
        $tasks = [
            ['name' => 'Rita', 'task' => 'Estudar laravel'],
            ['name' => 'Luis', 'task' => 'Estudar PHP'],
            ['name' => 'Licinio', 'task' => 'Estudar Vue.js'],
            ['name' => 'Shiago', 'task' => 'Estudar React.js'],
            ['name' => 'Sara', 'task' => 'Ensinar laravel'],
        ];

        return $tasks;
    }

    private function availableTasks()
    {
        $availableTasks = ['sql', 'js', 'Java', 'POO'];

        return $availableTasks;
    }
}
