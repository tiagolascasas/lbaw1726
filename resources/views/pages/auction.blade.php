@extends('layouts.app')

@section('title', 'Bookhub - Create Auction')

@section('content')

    <!-- Page Content -->
            <main>
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
                                            <img class="d-block w-100" src="img/leviathanwakes.jpg" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="img/leviathanwakes_1.jpg" alt="Second slide">
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
                            <td>Leviathan Wakes (The Expanse #1)</td>
                        </tr>
                        <tr>
                            <td><strong>Author</strong></td>
                            <td>James S.A. Corey</td>
                        </tr>
                        <tr>
                            <td><strong>Publisher</strong></td>
                            <td>Orbit UK</td>
                        </tr>
                        <tr>
                            <td><strong>ISBN</strong></td>
                            <td>1841499889</td>
                        </tr>
                        <tr>
                            <td><strong>Language</strong></td>
                            <td>English</td>
                        </tr>
                        <tr>
                            <td><strong>Categories</strong></td>
                            <td>Literature - Sci-Fi&Fantasy</td>
                        </tr>

                        <tr>
                            <td><strong>Description</strong></td>
                            <td>First edition of the book, brand-new</td>
                        </tr>
                        <tr>
                            <td><strong>Time left: </strong>
                                <p class="text-danger">5 mins</p>
                            </td>
                            <td><strong>Current bid: </strong>
                                <p class="text-success">€ 7.16</td>
                            <td>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="number" min="7.17" placeholder="8.17" step="0.01" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button id="bid-box" type="submit" class="btn btn-primary col-md-6">Bid a new price</button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary p-2 " type="button" onclick="profile_func()">nelsoncosta</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </main>
    @endsection
