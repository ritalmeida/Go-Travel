{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/editProfile.css') }}" />

@section('title')
Go Travel | Editar Utilizador
@endsection

@section('content')
<div id="editProfile">
    <div id="profileDetails">
        <p>Editar perfil</p>
        <form action="{{ route('profile.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" />
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ $user->email }}" />
            <label for="spot">Localidade:</label>
            <input type="text" name="spot" id="spot" value="{{ $user->spot }}" />
            <label for="type">Tipo:</label>
            <select id="is_villager" name="is_villager">
                <option value="0">Utilizador</option>
                <option value="1">Aldeão</option>
                @if($user->is_villager == 0)
                    Utilizador
                @else
                    Aldeão
                @endif
            </select>
            <div id="buttons">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{ route('profile', $user) }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection