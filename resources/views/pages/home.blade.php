@extends('layouts.app')

@section('title', 'Bookhub - Home')

@section('content')

    <!-- Page Content -->
        <main>
          <div class="content p-4">
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
                <div class="album py-4">
                    <div class="row">

                        <!--- Items list -->
                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-6 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center">
                                        <img class="width100" src="img/theorphanstale.jpg" alt="the orphan stale">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down text-dark font-weight-bold" style="font-size: larger">The Orphan's Tale</p>
                                        <p class="card-text text-center hidden-p-md-down">By Pam Jennof</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                        &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/bornacrime.jpg" alt=" born a crime">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">Born a crime</p>
                                        <p class="card-text text-center hidden-p-md-down">By Trevor Noah</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="far fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                        &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/levithanwakes.jpg" alt="Levithan Wakes">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">Leviathan Wakes</p>
                                        <p class="card-text text-center hidden-p-md-down">By James Sacorey</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                        &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/knowinggodbyname.jpg" alt="knowing god by name">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">Knowing GOD</p>
                                        <p class="card-text text-center hidden-p-md-down">By David Wilkerson</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                    &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/thehusbandssecret.jpg" alt="the husbands secret">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">the Husband's Secret</p>
                                        <p class="card-text text-center hidden-p-md-down">By Liane Moriarty</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                    &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/knowinggodbyname.jpg" alt="knowing god by name">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">Knowing GOD</p>
                                        <p class="card-text text-center hidden-p-md-down">By David Wilkerson</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                    &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/levithanwakes.jpg" alt="Levithan Wakes">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">Leviathan Wakes</p>
                                        <p class="card-text text-center hidden-p-md-down">By James Sacorey</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                    &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="auction.html" class="list-group-item-action">
                                <div class="card mb-4 box-shadow">
                                    <div class="col-md-6 img-fluid media-object align-self-center ">
                                        <img class="width100" src="img/theorphanstale.jpg" alt="the orphan stale">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">The Orphan's Tale</p>
                                        <p class="card-text text-center hidden-p-md-down">By Pam Jennof</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-star btn btn-sm text-primary"></i>
                                            <small class="text-success">€ 4.17 </small>
                                            <small class="text-danger">
                                                    &lt; 5 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- show more button -->
                        <a href="#" class="btn btn-outline-primary my-2 btn-block">Show More</a>
                    </div>
                </div>
              </div>
            </main>
@endsection
