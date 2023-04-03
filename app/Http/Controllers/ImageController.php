<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    //
    public function store(Request $request) // Si es un "Store" deberia de recibir la variable de "$request" instanciando la clase "Request"
    {

        $file = $request->file('file');

        $imageName = Str::uuid() . '.' . $file->extension();

        $imageServer = Image::make($file);
        $imageServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $imageName;
        $imageServer->save($imagePath);

        // return response(['file' => $imageName]);
        
        return response()->json(['file' => $imageName]);
        // Siempre se guarda el nombre de la imagen en el servidor, nunca el archivo
    }

        // Funcion para eliminar las imagenes

    // public function eliminar()
    // {
    //     $imagenes = glob(public_path('uploads') . '/*');
    //     $imagenesBaseDatos = \App\Models\Post::pluck('imagen')->toArray();
 
    //     foreach ($imagenes as $imagen) {
    //         if (!in_array(basename($imagen), $imagenesBaseDatos)) {
    //             unlink($imagen);
    //         }
    //     }
 
    //     return response()->json(['mensaje' => 'Imagenes eliminadas']);
    // }
}
