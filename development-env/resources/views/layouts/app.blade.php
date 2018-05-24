<!DOCTYPE html>
<html lang="en">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel')}} - @yield('title') </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrfToken" name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bsadmin.css') }}" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <a href="#" class="sidebar-toggle hidden-p-md-up pb-1 text-light mr-3 navbar-brand">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="{{ url('home/') }}">BOOKHUB</a>

        <div class="navbar-collapse collapse">

            <ul class="navbar-nav ml-auto" id="navbarList">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-p-md-down" href="#" id="catDropDown" data-toggle="dropdown" aria-expanded="false">
                                All
                            </a>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="catDropDown">

                        <a href="#" class="category-dropdown dropdown-item">
                                    Arts&amp;Music</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Biographies</a>


                        <a href="#" class="category-dropdown dropdown-item">
                                    Business</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Kids</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Comics</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Cooking</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Computation&amp;Tech</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Education</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Health&amp;Fitness</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    History</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                    Horror</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                                            Religion</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                                            Science</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                                                Self-Help</a>


                        <a href="#" class="category-dropdown dropdown-item">
                                                                    Travel</a>

                        <a href="#" class="category-dropdown dropdown-item">
                                                   Other</a>
                        <b class="px-2">
                                                        Literature</b>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">All</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Anthologies</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Classics</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Contemporary</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Sci-Fi&amp;Fantasy</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Romance</a>
                            </li>
                            <li>
                                <a href="#" class="category-dropdown dropdown-item">Crime</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item hidden-p-md-down">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2 searchNav" method="POST" action="{{ route('search') }}">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="category" value="All">
                            <input name="searchTerm" class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                         </span>
                        </div>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link hidden-p-md-up" href="#" id="navbarDropDownSearch" data-toggle="dropdown">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-label="navbarDropdownSearch">
                        <form class="form-inline searchNav" method="POST" action="{{ route('search') }}">
                            <div class="input-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="category" value="All">
                                <input name="searchTerm" class="form-control" type="text" placeholder="Search for...">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                 </span>
                            </div>
                        </form>
                    </div>

                </li>
                @if (Auth::check())
        <li class="nav-item dropdown"  id = "dropdown_noti">
            <a class="nav-link dropdown-toggle container" id="alertsDropdown" href="#" data-toggle="dropdown"  onclick="notificationsClick()" aria-haspopup="true" aria-expanded="false">
                <i class="label label-pill label-light count" id = "counter" style="border-radius:10px;"></i>
                <span class="badge badge-danger"></span>
                <i class="fa fa-fw fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right notifications" id = "not_itens" aria-labelledby="alertsDropdown">
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle  hidden-p-md-down" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown">
                <i class="fa fa-user"></i> {{Auth::user()->username}}
            </a>
            <a class="nav-link dropdown-toggle  hidden-p-md-up" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown">
                <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1 navbarDropdownMenuLink2">
                <a class="dropdown-item" href="{{ url("profile/") }}/{{Auth::user()->id}}">Profile</a>
                @if(Auth::user()->users_status=="moderator")
                <a class="dropdown-item" href="{{ url("moderator") }}">Moderator Panel</a>
                @endif
                @if(Auth::user()->users_status=="admin")
                <a class="dropdown-item" href="{{ url("admin") }}">Admin Panel</a>
                @endif                
                <a class="dropdown-item" href="{{ url("create/") }}">Create auction</a>
                <a class="dropdown-item" href="myAuctions.html">My Auctions</a>
                <a class="dropdown-item" href="auctionsIm_in.html">Auctions I'm in</a>
                <a class="dropdown-item" href="history.html">History</a>
                <a class="dropdown-item" href="wishlist.html">WishList</a>
                <a class="dropdown-item" href="messages.html">Messages</a>
                <a class="dropdown-item" href="{{ url("logout") }}">Logout</a>
            </div>
        </li>
                @else
                <li class="nav-item ">
                    <a class="nav-link hidden-p-md-down" data-toggle="modal" href="#" data-target="#myModalLogin">
                        <i class="fa fa-sign-in-alt"></i> Login
                    </a>
                    <a class="nav-link hidden-p-md-up" data-toggle="modal" href="#" data-target="#myModalLogin">
                        <i class="fa fa-sign-in-alt"></i>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link hidden-p-md-down" data-toggle="modal" href="#" data-target="#myModalRegister">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                    <a class="nav-link hidden-p-md-up" data-toggle="modal" href="#" data-target="#myModalRegister">
                        <i class="fa fa-user-plus"></i>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="modal fade" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLoginLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLoginLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                @include('auth.login')
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalRegisterLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalRegisterLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
               @include('auth.register')
            </div>
        </div>
    </div>


    <div class="d-flex">
        <nav class="sidebar bg-dark hidden-p-md-up pb-4">
            <ul class="list-unstyled mt-4">
                <li>
                    <h5 class="text-white pl-3 pb-2 ">Categories</h5>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Arts&amp;Music</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                            Biographies</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Business</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Kids</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Comics</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Cooking</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                    Computation&amp;Tech</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Education</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Health&amp;Fitness</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                History</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                Horror</a>
                </li>
                <li>
                    <a href="#submenu1" data-toggle="collapse">
                            Literature</a>
                    <ul id="submenu1" class="list-unstyled collapse">
                        <li>
                            <a href="#" class="sidebar-toggle">All</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Anthologies</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Classics</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Contemporary</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Sci-Fi&amp;Fantasy</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Romance</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Crime</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                    Religion</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                    Science</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                        Self-Help</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                                            Travel</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                           Other</a>
                </li>
            </ul>
        </nav>
    </div>



        @include('partials.errors')
        @yield('content')



        <!-- Footer -->
        <footer class="footer footer-offset py-2 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; BookHub 2018</p>
                <p class="m-0 text-center text-white">
                    <a class="text-white" href="{{ url('about/') }}"> About</a> &nbsp; | &nbsp;
                    <a class="text-white" href="{{ url('faq/') }}"> FAQ</a> &nbsp; | &nbsp;
                    <a class="text-white" href="{{ url('contact/') }}"> Contact</a>
                </p>
            </div>
        </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/easytimer.min.js') }}"></script>
    <script src="{{ asset('js/bsadmin.js') }}"></script>
    </body>

    </html>
