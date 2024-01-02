{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/indexSpot.css') }}" />

@section('title')
Go Travel | Aldeias
@endsection

@section('content')
<div class="container">
    @if($spots->isEmpty())
        <p id="empty">Não foi possível encontrar nenhuma aldeia!</p>
    @else
        <div id="spots">
            @foreach($spots as $spot)
            <div id="spot">
                <img src="{{ asset('storage/images/'.$spot->image) }}" alt="image" width="200px" height="200px">
                <a id="name" href="{{ route('spots.show',$spot) }}">{{ $spot->name }}</a>
                <p id="price">{{ $spot->price }}€</p>
            </div>
            @endforeach
        </div>
    @endif
    {!! $spots->appends($_GET)->links('pagination::bootstrap-4') !!}
</div>
@endsection
