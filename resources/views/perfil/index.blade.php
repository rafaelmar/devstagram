@extends('layouts.app')

@section('tittle')
    Edit Profile: {{ auth()->user()->username }}
@endsection

@section('content')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username</label>
                    <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Your Username"
                    class="border p-3 w-full rounded-lg 
                        @error('username')
                             border-red-500
                        @enderror" 
                            value="{{ auth()->user()->username }}"/>
                        @error('username')
                            <p class="text-red-500 italic my-1">*{{ $message }}</p>
                        @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email</label>
                    <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Your email"
                    class="border p-3 w-full rounded-lg 
                        @error('email')
                             border-red-500
                        @enderror" 
                            value="{{ auth()->user()->email }}"/>
                        @error('email')
                            <p class="text-red-500 italic my-1">*{{ $message }}</p>
                        @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password</label>
                    <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Your password"
                    class="border p-3 w-full rounded-lg
                        @error('password')
                            <p class="text-red-500 italic my-1">*{{ $message }}</p>
                        @enderror
                </div>


                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold mt-2">
                    Image</label>
                    <input 
                    id="image"
                    name="image"
                    type="file"
                    class="border p-3 w-full rounded-lg"
                    accept=".png, .jpg, .jpeg" 
                    />
                </div>
                <input type="submit" value="Save Changes" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold rounded-lg w-full p-3 text-white">
            </form>
        </div>
    </div>

@endsection