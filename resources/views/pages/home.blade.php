@extends('layouts.app')

@section('title', 'Home')

@php
  $auctions = App\Auction::all();
@endphp

@section('content')

<!-- Page Content -->
    <main>
      <div class="content p-4 mt-3">
        <!---  Welcome block -->
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><b>Welcome to Bookhub!</b></h1>
                    <h4 class="text-dark hidden-p-md-down">Introduced in May of 2018, BookHub is a web platform that allows EU residents to participate in online book auctions.</h4>
                    @if (Auth::check())
                    <span id="buttonsWelcome">
                        <a href="myAuctions.html" class="btn btn-primary btn-lg my-2 mx-3 jumbotron-buttons">My Auctions</a>
                        <a href="auctionsIm_in.html" class="btn btn-secondary btn-lg my-2 mx-3 jumbotron-buttons">Auctions I'm in</a>
                    </span>
                    @endif
                </div>
            </section>



<!---  Active auctions grid -->
<div class="album py-2">
    <div class="row">
      <!--- Items list -->
      @include('pages.auctionItems')
    </div>
</div>

@endsection
