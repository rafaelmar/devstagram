@extends('layouts.app')

@section('tittle')
    Create post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
    @vite('resources/js/app.js')
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" action="{{ route('image.store') }}" method="POST" enctype="multipart/from-data">
            @csrf
            </form>
        </div>
        <!--El ecntype="multipart/from-data" es necesario por el lado de html para subir las imagenes -->

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf <!-- Para evitar ataques csrf, es una tactica de defensa que tiene laravel -->
                <div class="mb-5">
                    <label for="tittle" class="mb-2 block text-gray-500 font-bold">
                    Tittle</label>
                    <input 
                    id="tittle"
                    name="tittle"
                    type="text"
                    placeholder="Your Tittle"
                    class="border p-3 w-full rounded-lg 
                        @error('tittle')
                             border-red-500
                        @enderror" 
                        value="{{old('tittle')}}"/>
    
                        @error('tittle')
                            <p class="text-red-500 italic my-1">{{ $message }}</p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="mb-2 block text-gray-500 font-bold">
                    Description
                    </label>
                    
                    <textarea 
                        id="description"
                        name="description"
                        placeholder="Description"
                        class="border p-3 w-full rounded-lg 
                            @error('description')
                                border-red-500
                            @enderror"></textarea>

                        @error('description')
                            <p class="text-red-500 italic my-1">{{ $message }}</p>
                        @enderror
                </div>
                    <div class="mb-5">
                        <input 
                        name="image"
                        type="hidden"
                        value="{{ old('image') }}"
                        />
                    </div>

                    <input type="submit" value="Create Post" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold rounded-lg w-full p-3 text-white">
                </div>
        </div>
@endsection