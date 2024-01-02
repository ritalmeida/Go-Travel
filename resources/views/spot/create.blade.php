{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/createSpot.css') }}" />

@section('title')
Go Travel | Criar Aldeia
@endsection

@section('content')
<div class="addSpot">
    <div id="title">
        <p>Adicionar Aldeia</p>
    </div>
    <div id="form">
        <form id="createForm" action="{{ route('spots.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="villager" value="{{ Auth::user()->id }}">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome" value="{{old('name')}}" required>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" placeholder="Descrição" value="{{old('description')}}" required></textarea>
            <label for="location">Localização</label>
            <input type="text" name="location" id="location" placeholder="Localização" value="{{old('location')}}" required>
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" placeholder="Preço" value="{{old('price')}}" required>
            <label for="image">Imagem</label>
            <input type="file" accept="image/*" name="image" id="image" required>
            <label for="type">Tipo</label>
            <select name="type" id="type" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div id="buttons">
                <button class="btn btn-primary" type="submit" id="submit">Adicionar</button>
                <a class="btn btn-danger" id="cancel" href="{{ route('profile') }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection