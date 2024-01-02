{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

@section('title')
Go Travel | Info Utilizador
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Informação do Utilizador </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Localidade:</strong>
                    {{ $user->spot }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo de Utilizador:</strong>
                    @if($user->is_villager == 0)
                        Utilizador
                    @else
                        Aldeão
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('/users') }}"> Voltar </a>
            </div>
        </div>
    </div>
</div>
@endsection