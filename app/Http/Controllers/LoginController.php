<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|',
            'password' => 'required|'
        ]);


        if (!auth()->attempt($request->only('email', 'password',), $request->remember)) {
            return back()->with('message', 'Invalid Credentials');
        }

        // "back" te retorna a la vista desde donde fue enviado el formulario, "with" con un ('message', 'Mensaje de error');

        return redirect()->route('posts.index', auth()->user()->username); // le pasamos el usuario en el segundo parametro
    }
}
