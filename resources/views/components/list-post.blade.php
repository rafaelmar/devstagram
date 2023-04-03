<div>
    @if ($posts->count())
       
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach ($posts as $post)<!-- tomando $posts del controlador y convirtiendolo a "$post" tipica sintaxis de foreach -->
                    <div>
                        {{-- la variable de post conecta al ser un objeto, con el archivo de rutas "web" ya que en el existe esta sintaxis "{post}" --}}
                        <a href="{{ route('posts.show' , ['post' => $post, 'user' =>$post->user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Image {{ $post->tittle }}"> 
                        </a>
                        <!-- Aqui accedemos a la carpeta con "asset" la concatenamos con el atributo "image" y en alt accedemos al titulo de la imagen -->
                    </div>
            @endforeach
    @else

        <div>
            <p>
                No hay posts    
            </p>
        </div>

    @endif

</div>