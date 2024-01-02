{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/editSpot.css') }}" />

@section('title')
Go Travel | Editar Aldeia
@endsection

@section('content')
<div id="addSpot">
    <div id="spotDetails">
        <p>Editar Aldeia</p>
        <form action="{{ route('spots.update', $spot) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="villager" value="{{ Auth::user()->id }}">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome" value="{{$spot->name}}" required>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" placeholder="Descrição do produto" required>{{$spot->description}}</textarea>
            <label for="location">Localização</label>
            <input type="text" name="location" id="location" placeholder="Localização" value="{{old('location')}}" required>
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" placeholder="Preço" value="{{$spot->price}}" required>
            <label for="image">Imagem</label>
            <input type="file" accept="image/*" value="{{$spot->image}}" name="image" id="image">
            <select name="type" id="type" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div id="buttons">
                <button class="btn btn-primary" type="submit" id="submit">Adicionar</button>
                <a class="btn btn-danger" id="cancel" href="{{ route('mySpots',Auth::user()) }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
