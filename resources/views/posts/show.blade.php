@extends('layouts.app')

@section('tittle')
    
    {{ $post->tittle }}

@endsection

@section('content')
    <div class="container mx-auto md:flex gap-5">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Image {{ $post->tittle }}"> 

            <div class="p-3 flex items-center gap-3">
                @auth

                <livewire:like-post :post="$post" /> <!-- Siempre se declaran las variables con comillas dobles ya que con las simples puede dar problemas -->

                @endauth
                
            </div>
            <div>
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE') <!-- METHOD SPOOFING, nativamente el navegador solo acepta POST y GET, para agregar otro tipo de peticiones como 'DELETE' 'PATH' y 'PUT' -->
                            @csrf
                            <input 
                            type="submit"
                            value="Delete"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                            />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Comments</p>

                @if (session('comment'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('comment') }}
                    </div>
                @endif

                <form action="{{ route('comment.store', ['post' => $post, 'user' =>$user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block text-gray-500 font-bold">
                            Comment
                        </label>
                        
                        <textarea 
                            id="comment"
                            name="comment"
                            placeholder="Add a Comment"
                            class="border p-3 w-full rounded-lg 
                                @error('comment')
                                    border-red-500
                                @enderror"></textarea>
    
                            @error('comment')
                                <p class="text-red-500 italic my-1">{{ $message }}</p>
                            @enderror
                    </div>

                        <input type="submit" value="Comment" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold rounded-lg w-full p-3 text-white">

                </form>
                @endauth
                    
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comment->count()) <!-- Con esto revisa si "existe" algo que mostrar -->

                    @foreach ($post->comment as $comment )
                       

                        <div class="p-5 border-gray-300 border-b">
                             
                        <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">
                            {{$comment->user->username}}
                        </a>
                            <p>{{ $comment->comment }}</p>
                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    
                    @endforeach

                    @else

                        <p class="p-10 text-center">No hay comentarios</p>

                    @endif
                </div>
                

            </div>
        </div>
    </div>
@endsection