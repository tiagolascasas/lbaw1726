<!Doctype html>
<html lang="en">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
                    <a class="nav-link dropdown-toggle hidden-p-md-down" href="#" id="catDropDown" data-toggle="dropdown" aria-expanded="true">
                                All
                            </a>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="catDropDown">

                        <a href="#" class="dropdown-item">
                                    Arts&amp;Music</a>

                        <a href="#" class="dropdown-item">
                                    Biographies</a>


                        <a href="#" class="dropdown-item">
                                    Business</a>

                        <a href="#" class="dropdown-item">
                                    Kids</a>

                        <a href="#" class="dropdown-item">
                                    Comics</a>

                        <a href="#" class="dropdown-item">
                                    Cooking</a>

                        <a href="#" class="dropdown-item">
                                    Computation&amp;Tech</a>

                        <a href="#" class="dropdown-item">
                                    Education</a>

                        <a href="#" class="dropdown-item">
                                    Health&amp;Fitness</a>

                        <a href="#" class="dropdown-item">
                                    History</a>

                        <a href="#" class="dropdown-item">
                                    Horror</a>

                        <a href="#" class="dropdown-item">
                                                            Religion</a>

                        <a href="#" class="dropdown-item">
                                                            Science</a>

                        <a href="#" class="dropdown-item">
                                                                Self-Help</a>


                        <a href="#" class="dropdown-item">
                                                                    Travel</a>

                        <a href="#" class="dropdown-item">
                                                   Other</a>
                        <b class="px-2">
                                                        Literature</b>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="dropdown-item">All</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Anthologies</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Classics</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Contemporary</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Sci-Fi&amp;Fantasy</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Romance</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Crime</a>
                            </li>
                        </ul>

                    </div>
                </li>
                <li class="nav-item hidden-p-md-down">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2 ">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="searchfunc()">
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
                        <form class="form-inline">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search for...">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="searchfunc()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                 </span>
                            </div>
                        </form>
                    </div>

                </li>
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
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputUser">Username</label>
                            <input class="form-control" id="exampleInputUser" type="text" placeholder="Your Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPasswordL">Password</label>
                            <input class="form-control" id="exampleInputPasswordL" type="password" placeholder="Your password">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Remember Me</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary btn-block" href="#" data-dismiss="modal">LOGIN</a>
                </div>
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
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input class="form-control" id="exampleInputName" type="text" placeholder="Your Complete Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input class="form-control" id="exampleInputUsername" type="text" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAge">Age</label>
                            <input class="form-control" id="exampleInputAge" type="number" placeholder="Age" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email Address</label>
                            <input class="form-control" id="exampleInputEmail" type="email" placeholder="example@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input class="form-control" id="exampleInputAddress" type="text" placeholder="Example Address, 4441" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleConfirmPostalCode">Postal Code</label>
                                    <input class="form-control" id="exampleConfirmPostalCode" type="text" placeholder="XXXX-XXX" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCountry">Country</label>
                                    <input class="form-control" id="exampleInputCountry" type="text" placeholder="Your Country" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Phone Number</label>
                            <input class="form-control" id="exampleInputPhone" type="tel" placeholder="Your phone number" required>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="exampleInputPasswordR">Password</label>
                                    <input class="form-control" id="exampleInputPasswordR" type="password" placeholder="Your password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleConfirmPassword">Confirm Password</label>
                                    <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary btn-block" href="#" data-dismiss="modal">REGISTER</a>
                </div>
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

        <section id="content" class="w-100">
          @yield('content')
        </section>


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

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bsadmin.js"></script>

        <script type="text/javascript" src={{ asset('jquery.min/app.js') }} defer>
            </script>
        <script type="text/javascript" src={{ asset('js/bootstrap.min.js') }} defer>
            </script>
        <script type="text/javascript" src={{ asset('js/popper.min.js') }} defer>
            </script>
        <script type="text/javascript" src={{ asset('js/bsadmin.js') }} defer>
            </script>

    </body>

    </html>
