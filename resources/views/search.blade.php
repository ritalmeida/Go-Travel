{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

@section('tittle', 'Search')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Resultados da Pesquisa</h4>
                <div class="underline mb-4"></div>
            </div>

            @forelse ($searchProducts as $productItem)
            <div class="col-md-10">


@endsection
                