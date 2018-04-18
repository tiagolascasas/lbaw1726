@extends('layouts.app')

@section('title', 'Bookhub - Create Auction')

@php
    $sellerName =  App\Member::where('id', $auction->idseller)->get()->first()->name;
    $languagename = App\Language::where('id', $auction->idlanguage)->get()->first()->languagename;

    //get publisher name if exists
    if($auction->idpublisher!=NULL){
          $publishername = App\Publisher::where('id', $auction->idpublisher)->get()->first()->publishername;
    }
    else{
          $publishername = "No publisher";
    }

    //get category name if exists
    if($auction->idcategory!=NULL){
          $categoryname = App\CategoryAuction::where('id', $auction->idcategory)->get()->first()->categoryname;
    }
    else{
          $categoryname = "No category";
    }

    $categorynumber = App\CategoryAuction::where('idauction', $auction->id)->get()->first();
    if ($categorynumber!=NULL){
        $categoryname = App\Category::where('id', $categorynumber->idcategory )->get()->first();
        if ($categoryname != NULL){
          $categoryname = $categoryname->categoryname;
        }
        else {
          $categoryname = "No category";
        }
    }
    else {
      $categoryname = "No category";
    }


@endphp

@section('content')

    <!-- Page Content -->
            <main  data-id="{{$auction->id}}">
              <div class="container p-5">
                <table class="table">
                    <tbody>
                        <tr>
                            <!--<td rowspan="6" colspan="2"><img width=200px src="img/levithanwakes.jpg"></td>-->
                            <td rowspan="7" colspan="2" style="width: 26.33%">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset('img/book.png') }}" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('img/book.png') }}" alt="Second slide">
                                        </div>
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
                            <td>{{$publishername}}</td>
                        </tr>
                        <tr>
                            <td><strong>ISBN</strong></td>
                            <td>{{$auction->isbn}}</td>
                        </tr>
                        <tr>
                            <td><strong>Language</strong></td>
                            <td>{{$languagename}}</td>
                        </tr>
                        <tr>
                            <td><strong>Category</strong></td>
                            <td>{{$categoryname}}</td>
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
                            </td>
                            <td>
                                <a class="button btn btn-sm btn-outline-secondary p-2 " type="button" href="{{ url('profile/') }}">{{$sellerName}}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </main>
    @endsection
