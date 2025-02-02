<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PrendasController extends Controller
{
    /**
     * Passo 1: função que devolve a view principal com a tabela de prendas
     */
    public function prendasHome()
    {
        $prendas = $this->prendasGetFromDB();
        return view('prendas.prendaHome', compact('prendas'));
    }

    /**
     * Passo 2: função para obter as prendas da base de dados e usar os dados
     * na função prendasHome. Foi feito um join com a tabela users para obter o nome do user
     */
    public function prendasGetFromDB()
    {
        $prendas = DB::table('gifts')
            ->join('users', 'gifts.idUser', '=', 'users.id')
            ->select('gifts.*', 'users.name as user_name')
            ->get();
        return $prendas;
    }

    /**
     * Passo 3: função que devolve a view para adicionar uma prenda
     */
    public function prendasAdd()
    {
        $users = $this->usersList();
        return view('prendas.prendaAdd', compact('users'));
    }

    /**
     * Passo 4: função que devolve os dados de users para preencher o select
     * na função prendaAdd
     */
    public function usersList()
    {
        if (request()->query('user_id')) {
            $users = User::where('id', request()
                ->query('user_id'))
                ->get();
        } else {
            $users = User::all();
        }
        return $users;
    }

    /**
     * Passo 5: função que faz validação e cria uma prenda na base de dados
     * retorna a função prendasHome com uma mensagem de sucesso
     * @param Request $request
     */
    public function prendasAddFunction(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'valorPrevisto' => 'required|numeric',
            'valorGasto' => 'required|numeric',
            'idUser' => 'required|numeric'
        ]);
        DB::table('gifts')
            ->insert([
                'name' => $request->name,
                'valorPrevisto' => $request->valorPrevisto,
                'valorGasto' => $request->valorGasto,
                'idUser' => $request->idUser,
                'created_at' => now(),
            ]);
        return redirect()->route('prendas.home')->with('message', 'Prenda criada com sucesso');
    }

    /**
     * Passo 6: função que devolve a view com toda a informação duma prenda
     * foi feito um join com a tabela users para obter o nome do user.
     * Passo 8: função que mostra a view para editar uma prenda na base de dados
     * @param $id $action
     */
    public function prendasShow($id, $action)
    {
        $prenda = DB::table('gifts')
            ->join('users', 'gifts.idUser', '=', 'users.id')
            ->select('gifts.*', 'users.name as user_name')
            ->where('gifts.id', '=', $id)
            ->first();

        $users = $this->usersList();
        return view('prendas.prendaShow', compact('prenda', 'users', 'action'));
    }

    /**
     * Passo 7: função que elimina uma prenda da base de dados
     * retorna back() com uma mensagem de sucesso
     * @param $id
     */
    public function prendasDelete($id)
    {
        DB::table('gifts')
            ->where('id', $id)
            ->delete();
        return back()->with('message', 'Prenda eliminada com sucesso');
    }

    /**
     * Passo 9: função que faz validação e atualiza uma prenda na base de dados
     * retorna a função prendasHome com uma mensagem de sucesso
     * @param Request $request
     */
    public function prendasUpdateFunction(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'valorPrevisto' => 'required|numeric',
            'valorGasto' => 'required|numeric',
            'idUser' => 'required|numeric',
        ]);

        DB::table('gifts')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'valorPrevisto' => $request->valorPrevisto,
                'valorGasto' => $request->valorGasto,
                'idUser' => $request->idUser,
                'updated_at' => now(),
            ]);
        return redirect()->route('prendas.home')->with('message', 'Prenda atualizada com sucesso');
    }
}
