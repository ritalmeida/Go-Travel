{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

@section('title')
Go Travel | Utilizadores
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <ul class="list-group">
            @forelse($users as $user)
            <li class="list-group-item">
                <h5>{{$user->id}} - {{$user->name}}</h5>
                <form action="{{ url('users/destroy/'.$user->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ url('users/show', $user->id) }}">Info</a>
                    <a class="btn btn-primary" href="{{ url('users/edit', $user->id) }}">Editar</a>
                    @csrf
                    <button type="submit" class="btn btn-danger">Apagar</button>
                </form>
            </li>
        
            @empty
            <h5 class="text-center">Não foram encontrados utilizadores!</h5>
            @endforelse
        </ul>
        {!! $users->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection