@extends('layouts.app')

@section('tittle')
    Login
@endsection()

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-8/12 p-3">
        <img src="{{ asset('img/login.jpg') }}" alt="Login Image">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf <!-- Para evitar ataques csrf, es una tactica de defensa que tiene laravel -->
            
            @if(session('message'))
                <p class="text-red-500 italic my-1" >{{ session('message') }}
                </p>
            @endif
            
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
                <input type="checkbox" name="remember"><label class="text-gray-500 text-sm" for="">Keep Session Open</label>
            </div>

            <input type="submit" value="Login" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold rounded-lg w-full p-3 text-white">
        </form>
    </div>
</div>
@endsection