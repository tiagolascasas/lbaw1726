@extends('layouts.app')

@section('title', 'Auction')

@section('content')

    <!-- Auction Content -->
            <main  data-id="{{$auction, $categoryName}}">
              <div class="container p-5">
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
                                <p class="text-danger">x mins</p>
                            </td>
                            <td><strong>Current bid: </strong>
                                <p class="text-success">€ 0.00</td>
                            <td>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="number" min="0.00" placeholder="0.00" step="0.01" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button id="bid-box" type="submit" class="btn btn-primary col-md-6">Bid a new price</button>
                                @if (Auth::user()->users_status=="moderator")
                                <button id="mod_remove_auction" onclick="moderatorAction('remove_auction',{{$auction->id}})" class="btn btn-danger p-2" type="button" href="{{ url("profile/{$auction->user->id}") }}"><i class="far fa-trash-alt"></i></button>
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
