{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/editProfile.css') }}" />

@section('title')
Go Travel | Editar Utilizador
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Utilizador</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('/users') }}"> Voltar</a>
        </div>
    </div>
</div>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome: </strong>
                <input type="text" name="name" value="{{ $user->name }}" 
                class="form-control" placeholder="Nome">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email: </strong>
                <input type="text" name="email" value="{{ $user->email }}" 
                class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Localidade: </strong>
                <input type="text" name="spot" value="{{ $user->spot }}" 
                class="form-control" placeholder="Localidade">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <select id="is_villager" name="is_villager">
                    <option value="1">Aldeão</option>
                    <option value="0">Utilizador</option>
                    @if($user->is_villager == 0)
                        Utilizador
                    @else
                        Aldeão
                    @endif
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a class="btn btn-danger" href="{{ route('users') }}">Cancelar</a>
        </div>
    </div>
</form>
@endsection