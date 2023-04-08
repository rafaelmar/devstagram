<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.registrer');
    }
    

    public function store(Request $request, User $user) 
    {
        
        // dd($request);
        // dd($request->get('email'));


        // Validacion
        
        $this->validate($request, [
            'name' => 'required|max:20',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:2'
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => Str::lower($request->email),
            'password' => Hash::make($request->password)
        ]);

        //Auth

        auth()->attempt([
             'email' => $request->email,
             'password' => $request->password

        ]);

        // Another way to make Auth

        // auth()->attempt($request->only('email', 'password'));
        
        return redirect()->route('posts.index', auth()->user()->username);
        }
    }