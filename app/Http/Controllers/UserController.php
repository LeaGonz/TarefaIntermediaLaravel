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
     * Função que devolve a view principal com a tabela de users
     * @return \Illuminate\Contracts\View\View
     */
    public function userAll()
    {
        $cesaeInfo = $this->getCesaeInfo();
        $contacts = $this->getContacts();

        // $this->insertUserIntoDB();
        // $this->updateUserIntoDB();
        // dd($allUsers);

        // sem ternario
        // $search = null;
        // if (request()->query("search")) {
        //     $search = request()->query("search");
        // } else {
        //     $search = null;
        // }

        // con ternario
        $search = request()->query("search") ? request()->query("search") : null;
        $allUsers = $this->getAllUsersFromDB($search);

        return view('users.all_users', compact('cesaeInfo', 'contacts', 'allUsers'));
    }

    /**
     * Metodo para produca de users por input search
     * @param mixed $search
     * @return \Illuminate\Support\Collection<int, \stdClass>
     */
    protected function getAllUsersFromDB($search)
    {
        $users = DB::table('users');
        if ($search) {
            $users = $users
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }
        $users = $users->select('*')
            ->get();
        return $users;
    }

    /**
     * Função que devolve a view para adicionar um utilizador
     * @return \Illuminate\Contracts\View\View
     */
    public function userAdd()
    {
        return view('users.add_user');
    }

    /**
     * Metodo para adicionar ou atualizar um user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        if (isset($request->id)) {
            $request->validate([
                'name' => 'required|string|min:3',
                'address' => 'max:100',
                'nif' => 'max:15'
            ]);

            User::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'nif' => $request->nif,
                    'address' => $request->address
                ]);

            return redirect()->route('users.show')->with('message', 'User actualizado com sucesso');
        } else {

            $request->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]);

            User::insert(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                ]
            );

            return redirect()->route('users.show')->with('message', 'User adicionado com sucesso');
        }
    }

    /**
     * Summary of viewUser
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function viewUser($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        return view('users.view_user', compact('user'));
    }

    /**
     * Metodo para apagar um user
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
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


    // **************************** codigo para trabalhar com arrays ****************************
    public function insertUserIntoDB()
    {
        DB::table('users')->insert([
            'name' => 'Shiago',
            'email' => 'shiago@luis.com',
            'password' => '1234luis'
        ]);

        return response()->json('utilizador inserido com sucesso');
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
