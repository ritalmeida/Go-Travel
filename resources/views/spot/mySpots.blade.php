{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/userSpots.css') }}" />

@section('title')
Go Travel | Minha Aldeia
@endsection

@section('content')
<div class="container">
    @if($spots->isEmpty())
        <p id="empty">Não tens nenhuma aldeia</p>
    @else
        <p id="title">Minhas Aldeias</p>
        @foreach($spots as $spot)
            <div id="spot">
                <div id="details">
                    <img src="{{ asset('storage/images/'.$spot->image) }}" alt="image">
                    <a id="name" href="{{ route('spots.show',$spot) }}">{{ $spot->name }}</a>
                    <p id="price">{{ $spot->price }}€</p>
                </div>
                <div id="buttons">
                    <input type="hidden" name="spot_id" value="{{ $spot->id }}">
                    <a id="edit" href="{{ route('spots.edit',$spot) }}">Editar</a>
                    <form action="{{ route('spots.destroy',$spot) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user" value="{{Auth::user()->id }}">
                        <button type="submit" id="delete">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
