<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth'); // Esta funcion se activa al momento que es instanciado el "PerfilController" y el "middleware('auth)" verifica si el usuario esta autenticado, en el caso que no este, lo redirige a la pagina de "login" por el contrario si esta autenticado podra acceder al metodo. 
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        // Modificar el Request a "Slug" con el metodo "Str" de laravel, para que no de errores en la base de datos con espacios y mayusculas y le asignamos el valor de username que viene de $request

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            //Cuando son 3 o mas reglas, se sugiere que se use un arreglo para agruparlas

            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,perfil-update'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60']

            // En este caso especifico llamamos a ":user,username" concatenando el id del usuario autenticado para crear una condicion especifica donde el usuario introduce su mismo usuario en el "update-perfil"

            // "not_in:" crea una lista negra para que no sean seleccionados esos nombres y "in" obliga a que sean escogidos esos nombres solamente
        ]);
    
        if($request->image)
        {
            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->extension();

            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('profile') . '/' . $imageName;
            $imageServer->save($imagePath);
        }



        //Save Chages

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->image = $imageName ?? auth()->user()->image ?? '';
        
        // Change Password

        // if($request->password || $request->new_password)
        // {
        //     $this->validate($request, [
        //         'password' => 'required|min:6',
        //         'new_password' => 'required|confirmed|min:6'
        //     ]);

        //     if(Hash::check($request->password, $usuario->password))
        //     {
        //         $usuario->password = Hash::make($request->new_password);
        //     } else {
        //         return back()->with('mensaje', 'El password antiguo no coincide');
        //     }
        // }
       
            $usuario->save();
       

        return redirect()->route('posts.index', $usuario->username);
    }
    
}
