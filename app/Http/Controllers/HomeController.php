<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $myVar = "Hello World";

        $contactInfo = $this->getContactInfo();
        // Usamos para fazer debug
        // dd($contactInfo);

        return view('home', compact('myVar', 'contactInfo'));
    }

    private function getContactInfo()
    {
        $contactInfo = [
            'nome' => 'Luis Gonzalez',
            'email' => 'luis@gmail.com'
        ];
        return $contactInfo;
    }


}
