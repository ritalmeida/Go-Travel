{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/cart.css') }}" />

@section('title')
Go Travel | Carrinho
@endsection

@section('content')

<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Aldeia</th>
            <th style="width:10%">Preço</th>
            <th style="width:8%">Quantidade</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="spot">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">€{{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                    </td>
                    <td data-th="Subtotal" class="text-center">€{{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <form action="{{ route('remove_from_cart') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Apagar</button>
                
                        </form> 
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align:right;"><h3><strong>Total €{{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right;">
                <form action="/session" method="POST">
                <a href="{{ url('/spots') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-success" type="submit" id="checkout-live-button"><i class="fa fa-money"></i> Checkout</button>
                </form>
            </td>
        </tr>
    </tfoot>
</table>
@endsection