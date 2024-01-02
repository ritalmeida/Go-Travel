{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

@section('title')
Go Travel | Contacto
@endsection

@section('content')
<form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNome">Nome</label>
        <input type="text" class="form-control" id="inputNome" placeholder="Ana Pinto">
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmai" placeholder="exemplo@email.pt">
          </div>

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Mensagem</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
        placeholder="Escreva a sua mensagem aqui..."></textarea>
  </div>
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Enviar</button>
  </form>
@endsection