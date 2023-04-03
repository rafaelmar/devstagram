@extends('layouts.app')

@section('tittle')
    Main Page
@endsection

@section('content')
    
    <x-list-post :posts="$posts"/>

@endsection