@extends('layouts.app')

@section('title', 'About')

@section('content')        

        <!-- Content -->
        <div class="container-fluid bg-white">
            <!-- Title-->
            <div class="bg-white mb-0 mt-4 panel">
                <h5>
                    <i class="fa fa-star"></i> Auctions waiting approval </h5>
            </div>
            <hr id="hr_space" class="mt-2">

                <!---  Active auctions grid --->
                      <!--- Items list -->
                      @each('partials.moderatingAuction', $auctions, 'auction')


        </div>


@endsection