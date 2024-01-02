{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<link rel="icon" type="imagem/png" href="logo_icon.png" />
@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/spotPage.css') }}" />

@section('title')
Go Travel | Aldeia
@endsection

@section('content')
<div id="spot">
    <img src="{{ asset('storage/images/'.$spot->image) }}" alt="image">
    <div id="spotInfo">
        <p id="name">{{ $spot->name }}</p>
        <div class="description">
            <p id="descriptionTitle">Descrição</p>
            <p id="description">{{ $spot->description }}</p>
        </div>
        <p id="location">{{ $spot->location }}</p>
        <form action="{{ route('add_to_cart', $spot->id) }}" method="POST">
            @csrf
            <button type="submit" id="newBuy">Comprar</button>

        </form>
        
            <div class="reviews">
            <p id="reviewsTitle">Reviews</p>
            @if(!$reviews->isEmpty())
                @foreach($reviews as $review)
                    <div class="review">
                        <p id="reviewUser"> {{ $users->find($review->user_id)->name }} </p>
                        <p id="reviewTitle">{{ $review->title }}</p>
                        <p id="reviewDescription">{{ $review->comment }}</p>
                        <p id="reviewRating">Rating: {{ $review->rating }}/5</p>
                    </div>
                @endforeach
            @endif
            <form id="newReview" action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <p id="newReviewHeader">Deixe uma review da Aldeia:</p>
                <input type="hidden" name="spot_id" value="{{ $spot->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="text" id="newReviewTitle" name="title" placeholder="Título">
                <textarea id="newReviewComment" name="comment" placeholder="Comentário"></textarea>
                <label id="newRatingLabel">Rating</label>
                <select name="rating" id="newReviewRating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit" id="newReviewSubmit">Submeter</button>
            </form>
        </div>
    </div>
</div>
@endsection