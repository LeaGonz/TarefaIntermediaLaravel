<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Passo 1: função que devolve a view principal com a tabela de users
     * @return \Illuminate\Contracts\View\View
     */
    public function userAll()
    {
        $cesaeInfo = $this->getCesaeInfo();
        $contacts = $this->getContacts();

        // $this->insertUserIntoDB();
        // $this->updateUserIntoDB();
        $allUsers = $this->getAllUsersFromDB();
        // dd($allUsers);

        return view('users.all_users', compact('cesaeInfo', 'contacts', 'allUsers'));
    }

    /**
     * Passo 2: função que devolve a view para adicionar um utilizador
     * @return \Illuminate\Contracts\View\View
     */
    public function userAdd()
    {
        return view('users.add_user');
    }

    /**
     * Passo 3: função que faz validação e cria um user na base de dados
     * retorna a função userAll com uma mensagem de sucesso
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        if(isset( $request->id)){
            $request->validate([
                'name' => 'required|string|min:3',
                'address' =>'max:100',
                'nif' =>'max:15'
            ]);

            User::where('id',  $request->id)
            ->update([
                'name' => $request->name,
                    'nif' => $request->nif,
                    'address' => $request->address
            ]);

            return redirect()->route('users.show')->with('message', 'User actualizado com sucesso');
        }else{

            $request->validate([
                'name' => 'required|string|min:3',
                'email' =>'required|email|unique:users',
                'password' =>'required|min:8'
            ]);

            User::insert(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

            ]);

            return redirect()->route('users.show')->with('message', 'User adicionado com sucesso');
        }
    }



    public function insertUserIntoDB()
    {
        DB::table('users')->insert([
            'name' => 'Shiago',
            'email' => 'shiago@luis.com',
            'password' => '1234luis'
        ]);

        return response()->json('utilizador inserido com sucesso');
    }

    public function viewUser($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        return view('users.view_user', compact('user'));
    }

    public function deleteUser($id)
    {
        DB::table('tasks')
            ->where('user_id', $id)
            ->delete();
        DB::table('users')
            ->where('id', $id)
            ->delete();
        return back();
    }

    public function updateUserIntoDB()
    {
        DB::table('users')
            ->where('id', 1)
            ->update([
                'updated_at' => now()
            ]);
    }

    protected function getAllUsersFromDB()
    {
        $users = DB::table('users')
            ->get();
        return $users;
    }

    private function getCesaeInfo()
    {
        $cesaeInfo = [
            'name' => 'Cesae',
            'address' => 'Rua Ciríaco Cardoso 186, 4150-212 Porto',
            'email' => 'cesae@cesae.pt'
        ];
        return $cesaeInfo;
    }

    private function getContacts()
    {
        $contacts = [
            ['id' => 1, 'name' => 'Luis', 'phone' => '900901901'],
            ['id' => 2, 'name' => 'Licinio', 'phone' => '900901902'],
            ['id' => 3, 'name' => 'Shiago', 'phone' => '900901903'],
        ];
        return $contacts;
    }
}
