@extends('layouts.app')

@section('title', 'Moderator Panel')

@section('content')

        <!-- Approve new auctions -->
        <div class="container-fluid bg-white">
            <!-- Title-->
            <div class="bg-white mb-0 mt-4 panel">
                <h5 class="mb-4">
                    <i class="fas fa-check-square"></i> Pending Auction Requests</h5>
            </div>

              <!-- Tab design -->
              <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Creation Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Modification Requests</a>
                </li>
              </ul>
              <!-- Tab content -->
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <!-- Approve new auctions list -->
                    @each('partials.moderatingAuction', $auctions, 'auction')
                    @empty($auctions)
                      <div class="alert alert-info" role="alert">
                      Nothing to approve here.
                      </div>
                    @endempty
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Approve modifying auctions list -->
                    @foreach ($auction_modifications as $auction_modification)

                      {{-- Get the data from of auctions to modify --}}
                      @foreach ($auctions_to_mod as $auction_to_mod)
                          @break ($auction_modification->idapprovedauction == $auction_to_mod->id)
                      @endforeach

                      @include('partials.auctionModification',['auction_to_mod'=>$auction_to_mod,'auction_modification'=>$auction_modification])
                    @endforeach

                    @empty($auction_modifications)
                      Nothing to approve here.
                    @endempty

                </div>
              </div>
        </div>

@endsection