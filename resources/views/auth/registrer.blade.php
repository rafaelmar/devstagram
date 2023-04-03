@extends('layouts.app')

@section('tittle')
    Registrer
@endsection()

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-8/12 p-3">
        <img src="{{ asset('img/registrar.jpg') }}" alt="Register Image">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf <!-- Para evitar ataques csrf, es una tactica de defensa que tiene laravel -->
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                Name</label>
                <input 
                id="name"
                name="name"
                type="text"
                placeholder="Name"
                class="border p-3 w-full rounded-lg 
                    @error('name')
                         border-red-500
                    @enderror" 
                    value="{{old('name')}}"/>

                    @error('name')
                        <p class="text-red-500 italic my-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-5">
                
                <label for="username" 
                class="mb-2 
                block 
                uppercase 
                text-gray-500 
                font-bold">
                Username
                </label>
                
                <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Username"
                    class="border p-3 w-full rounded-lg 
                    @error('username')
                         border-red-500
                    @enderror" 
                value="{{ old('username') }}"/>
                
                    @error('username')
                        <p class="text-red-500 italic my-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                Email</label>
                <input 
                id="email"
                name="email"
                type="email"
                placeholder="Email"
                class="border p-3 w-full rounded-lg 
                    @error('email')
                         border-red-500
                    @enderror" 
                value=" {{old('email')}}"/>
                    @error('email')
                         <p class="text-red-500 italic my-1" >{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                Password</label>
                <input 
                id="password"
                name="password"
                type="password"
                placeholder="Password"
                class="border p-3 w-full rounded-lg 
                    @error('password')
                         border-red-500
                    @enderror" 
                    value="{{old('password')}}"//>
               
                    @error('password')
                        <p class="text-red-500 italic my-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                Password</label>
                <input 
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Repeat your Password"
                class="border p-3 w-full rounded-lg">
            </div>
            <input type="submit" value="Send" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold rounded-lg w-full p-3 text-white">
        </form>
    </div>
</div>
@endsection