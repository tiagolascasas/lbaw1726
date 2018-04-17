@extends('layouts.app')

@section('title', 'Bookhub - Home')

@php
  $auctions = App\Auction::all();
@endphp

@section('content')

@include(partials.errors)
<!-- Page Content -->
    <main>
      <div class="content p-4 mt-3">
        <!---  Welcome block --->
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><b>Welcome to Bookhub!</b></h1>
                    <h4 class="text-dark hidden-p-md-down">Introduced in May of 2018, BookHub is a web platform that allows EU residents to participate in online book auctions.</h4>
                    <span id="buttonsWelcome">
                    </span>
                </div>
            </section>



<!---  Active auctions grid --->
<div class="album py-2">
    <div class="row">
      <!--- Items list -->
      @each('partials.auctionItem', $auctions, 'auction')
    </div>
</div>

@endsection
