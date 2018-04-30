@extends('layouts.app')

@section('title', 'Home')

@php
  $auctions = App\Auction::all();
@endphp

@section('content')
<div class="content p-4 mt-3">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading"><b>Welcome to Bookhub!</b></h1>
                <h4 class="text-dark hidden-p-md-down">Introduced in May of 2018, BookHub is a web platform that allows EU residents to participate in online book auctions.</h4>
                @if (Auth::check())
                <span id="buttonsWelcome">
                    <a href="{{ url('myauctions/')}}" class="btn btn-primary btn-lg my-2 mx-3 jumbotron-buttons">My Auctions</a>
                    <a href="{{ url('auctionsim_in/')}}" class="btn btn-secondary btn-lg my-2 mx-3 jumbotron-buttons">Auctions I'm in</a>
                </span>
                 @endif
            </div>
        </section>
        <!---  Active auctions grid -->
        <div id="auctionAlbum" class="album py-2">
        </div>
</div>
@endsection
