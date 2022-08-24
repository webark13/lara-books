@extends('layouts.base')
@section('content')
<div class="swiper mySwiper min-h-screen shadow-lg p-4">
    <div class="swiper-wrapper">

        @foreach ($books as $book)  
        <div class="swiper-slide shadow-lg flex flex-col">
            <div class="">
                <a href=""><img class="" src="{{ $book->img ? asset('storage/' . $book->img) : asset('storage/book.png') }}" alt=""></a>
            </div>
            <h2 class="text-center text-2xl">{{ $book->title }}</h2>
        </div>
        @endforeach
        
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
@endsection