@extends('layouts.app')

@section('title', 'Auction')

@section('content')

    <!-- Auction Content -->
            <main  data-id="{{$auction, $categoryName}}">
              <div class="container p-5">
                @if (Auth::check())
                @if (Auth::user()->users_status=="moderator")
                <!-- Moderator additional info alert box -->
                <div class="alert alert-secondary" role="alert">
                    <h5>
                        <i class="fas fa-info"></i>
                        Moderating additional info:
                    </h5>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item bg-secondary text-white"><b>Status:</b> {{$auction->auction_status}}</li>
                        <li class="list-group-item"><b>Date approved:</b> {{$auction->dateapproved}}</li>
                        <li class="list-group-item bg-secondary text-white"><b>Date removed:</b> {{$auction->dateremoved}}</li>
                    </ul>
                </div>
                <!-- Moderator remove auction modal pop-up -->
                <div class="modal fade" id="removeAuctionModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" >Auction action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @if ($auction->auction_status!="removed")
                        Are you sure you want to mark this auction as removed?
                        @else
                        Do you want to undo the remove?
                        @endif
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if ($auction->auction_status!="removed")
                        <button type="button" class="btn btn-danger" id="mod_remove_auction" onclick="moderatorAction('remove_auction',{{$auction->id}})">Yes</button>
                        @else
                        <button type="button" class="btn btn-success" id="mod_restore_auction" onclick="moderatorAction('restore_auction',{{$auction->id}})">Yes</button>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endif
                <table class="table">
                    <tbody>
                        <tr>
                            <td rowspan="7" colspan="2" style="width: 26.33%">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach($images as $key => $image)
                                        <li data-target="#carouselExampleIndicators" data-slide-to={{$key}} @if ($key === 0) class="active" @endif></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach($images as $key => $image)
                                        <div class=@if ($key === 0) "carousel-item active" @else "carousel-item" @endif >
                                            <img class="d-block w-100" src="{{asset('img/'.$image)}}" alt="{{$image}}" >
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </td>
                            <td style="width: 16.66%"><strong>Title</strong></td>
                            <td>{{$auction->title}}</td>
                        </tr>
                        <tr>
                            <td><strong>Author</strong></td>
                            <td> {{$auction->author}} </td>
                        </tr>
                        <tr>
                            <td><strong>Publisher</strong></td>
                            <td>{{$auction->publisher->publishername}}</td>
                        </tr>
                        <tr>
                            <td><strong>ISBN</strong></td>
                            <td>{{$auction->isbn}}</td>
                        </tr>
                        <tr>
                            <td><strong>Language</strong></td>
                            <td>{{$auction->language->languagename}}</td>
                        </tr>
                        <tr>
                            <td><strong>Category</strong></td>
                            <td>{{$categoryName}}</td>
                        </tr>

                        <tr>
                            <td><strong>Description</strong></td>
                            <td>{{$auction->description}}</td>
                        </tr>
                        <tr>
                            <td><strong>Time left: </strong>
                                <p id="timeLeft" class="text-danger">1d 12h 34m 12s</p>
                            </td>
                            <td><strong>Current bid: </strong>
                                <p id="currentMaxBid" class="text-success">{{$maxBid}}€</td>
                            <td>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            @if (Auth::check())
                                            <input id="currentBid" type="number" min="0.00" placeholder="0.00" step="0.01" class="form-control">
                                            @else
                                            <input id="currentBid" disabled type="number" min="0.00" placeholder="0.00" step="0.01" class="form-control">
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                @if (Auth::check())
                                <button id="bid-box" type="submit" class="btn btn-primary col-md-6">Bid a new price</button>
                                    @if (Auth::user()->users_status=="moderator")
                                    <!-- Moderator remove auction button -->
                                        @if($auction->auction_status!="removed")
                                        <button id="mod_remove_auction" data-toggle="modal" data-target="#removeAuctionModal"" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        @else
                                        <button id="mod_remove_auction" data-toggle="modal" data-target="#removeAuctionModal"" class="btn btn-success"><i class="fas fa-undo"></i></button>
                                        @endif
                                    @endif
                                @else
                                <button id="bid-box" type="submit" disabled class="btn btn-outline-secondary col-md-8">You must be logged in to bid</button>
                                @endif
                            </td>
                            <td>
                                <a class="button btn btn-sm btn-outline-secondary p-2 " type="button" href="{{ url("profile/{$auction->user->id}") }}"><b>{{$auction->user->name}}</b></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </main>

@endsection
