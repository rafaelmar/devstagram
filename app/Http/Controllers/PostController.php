<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct() // con este constructor protegemos todo el controlador y la ruta, el cual es inicializado cuando se instancia su classe
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {

        // Asignamos a $posts desde el modelo "Post" donde "where" 'user_id' del modelo "Post" clave foranea que conecta con el modelo "User" sea igual a el id de "User" y con el get hacemos el pedido en concreto, y abajo lo pasamos a la vista asignandole el valor a 'posts'
        
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20); // con este codigo puedo hacer una paginacion, si decido no colcarlo, puedo llamar a desde el dashboard con $user->posts pero no me dejara paginarlo

        return view('layouts.dashborad', [
            'user' => $user,
            'posts' => $posts
        ]);
        // En este index estoy pasando el "usuario" como variable y poder usarlo en el html
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request) // Esta es una simple validacion desde el controlador, en el que volvemos "requeridos" a los datos de abajo
    {
        $this->validate($request, [
            'tittle' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        // Post::create([
        //     'tittle' => $request->tittle,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        // Otra forma de crear registro, instanciamos el modelo y le asignamos cada uno de los valores

        // $post = new Post;
        // $post->tittle = $request->tittle;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Otra forma de crear registro mas cercana a la manera laravel, simplificando las consultas usando las relaciones en los Modelos

        $request->user()->posts()->create([
            'tittle' => $request->tittle,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user , Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
       
        $this->authorize('delete', $post); // Este vendria siendo un sistema de proteccion extra

        $post->delete();

        // Eliminar la Imagen

        $image_path = public_path('uploads/' . $post->image);

        if(File::exists($image_path)){
            unlink($image_path);
            
        }

        return redirect()->route('posts.index', auth()->user()->username);
        
    }
}
