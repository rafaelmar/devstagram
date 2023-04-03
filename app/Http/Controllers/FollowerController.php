<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        $user->followers()->attach( auth()->user()->id ); 
        
        // La linea de arriba lee el usuario que estamos visitando y le agrega que la persona que esta autenticada lo esta siguiendo

        // En este caso se usa el 'attach' ya que la relacion que existe es dentro de la misma tabla 'user' en los casos normales de tablas pibote se usa el "create".

        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
