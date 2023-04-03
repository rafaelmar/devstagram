<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function __construct()
        {
            $this->middleware('auth');
        }

    public function __invoke() // "invoke" es como un "construct" se llama automaticamente cuando se instancia el controlador y no es necesario colocar el nombre del metodo en la ruta
    {

        //Obtain the user->id

        $ids = auth()->user()->follow->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        // con pluck nos deja traernos los atributos por seleccion y "toArray" nos convierte la informacion de la base de datos a arreglo

        return view('home', [
            'posts' => $posts
        ]); // Con esto pasamos toda la informacion a la vista para poder usar la variable "$posts"
    }
}
