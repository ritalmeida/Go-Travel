{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/profile.css') }}" />

@section('title')
Go Travel | Perfil
@endsection

@section('content')
<div id="profile">
    <div id="profileDetails">
        <h1>Perfil</h1>
        <p id="user_id">ID: {{ $user->id}}</p>
        <p id="name">Nome: {{ $user->name }}</p>
        <p id="email">Email: {{ $user->email }}</p>
        <p id="spot">Localidade: {{ $user->spot }}</p>
        <p id=is_villager>Tipo: 
        @if($user->is_villager == 0)
            Utilizador
        @else
            Aldeão
        @endif</p>
    </div>
    @if($user->id == Auth::user()->id)
    <div id="editProfile">
        <form action="{{ route('profile.destroy',$user) }}" method="POST">
            @csrf
            <a class="btn btn-primary" id="edit" href="{{ route('profile.edit', $user->id) }}">Editar perfil</a>
            <button id="delete" type="submit" class="btn btn-danger">Apagar perfil</button>
            <a class="btn btn-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </form>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @if(Auth::user()->is_villager == 1)
            <a href="{{ route('users') }}" class="btn btn-primary">Gerir</a>
        @endif

        @if(Auth::user()->is_villager == 1)
            <a href="{{ route('spots.create', $user->id) }}" class="btn btn-success">Criar Aldeia</a>
        @endif

        @if(Auth::user()->is_villager == 1)
            <a href="{{ route('mySpots', $user->id) }}" class="btn btn-info">Minhas Aldeias</a>
        @endif

    </div>
    @endif
</div>
@endsection