<!DOCTYPE html>
<html lang="en">

<head>

    <title>BookHub - FAQ</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CDN-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/bsadmin.css">
</head>

<body>

    <!-- Navigation top-->
    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <a href="#" class="sidebar-toggle hidden-p-md-up pb-1 text-light mr-3 navbar-brand">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="home.html">BOOKHUB</a>

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
                    <a class="nav-link hidden-p-md-down" data-toggle="modal" data-target="#myModalLogin">
                        <i class="fa fa-sign-in-alt"></i> Login
                    </a>
                    <a class="nav-link hidden-p-md-up" data-toggle="modal" data-target="#myModalLogin">
                        <i class="fa fa-sign-in-alt"></i>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link hidden-p-md-down" data-toggle="modal" data-target="#myModalRegister">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                    <a class="nav-link hidden-p-md-up" data-toggle="modal" data-target="#myModalRegister">
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




    <!-- Page Content -->
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
        <div class="container p-5">
            <main>
                <h1 class="my-4 text-center">FAQ - Frequently Asked Questions</h1>

                <!-- FAQ block start -->
                <div class="container py-5">
                    <div class="panel-group" id="faqAccordion">

                        <!-- Question 1 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
                                <h4 class="panel-title">
                                    <a href="#question0" class="ing">What is BookHub?</a>
                                </h4>
                            </div>

                            <div id="question0" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>BookHub is a web platform that allows EU residents to register and pariticipate in online book auctions. The auctions are limited to literary items and can last from 5 minutes to 7 days. The payment is processed through
                                        Paypal.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
                                <h4 class="panel-title">
                                    <a href="#question1" class="ing">What should I know before I start participating in book auctions?</a>
                                </h4>
                            </div>

                            <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>After registration, you can participate in book auctions as a buyer and as a seller. You must follow the rules concerning each of these roles described in this FAQ or you may subjected to a ban by the moderating team.
                                        Only one registred account is allowed per person. </p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 3 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
                                <h4 class="panel-title">
                                    <a href="#question2" class="ing">What should I do if I want to participate in an auction as a buyer?</a>
                                </h4>
                            </div>

                            <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>As a buyer you are allowed to bid in other user's auctions. If you win the auction, you are charged immediately through your associated PayPal account. Any misbehavior regarding PayPal may result in a permanent ban.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
                                <h4 class="panel-title">
                                    <a href="#question3" class="ing">What should I do if I want to create an auction and participate as a seller?</a>
                                </h4>
                            </div>

                            <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>As a seller you are allowed to create new auctions and wait for other users biddings until the auction ends. You are not allowed to bid your own auctions. A new auction will only be made public after it's been aproved
                                        by the moderator team. After the auction closes, you should ship the item using a method that provides tracking information. All shipping costs will have to be covered by you, and you must ensure that the item reaches
                                        the buyer in 40 or less days. You will receive the buyer's shipping address through a notification. You should receive the payment to your Paypal account within 48h. The buyer is allowed to leave a feedback in your
                                        profile regarding his experience.</p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 5 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question4">
                                <h4 class="panel-title">
                                    <a href="#question4" class="ing">What should I do if I bought a book but it never came?</a>
                                </h4>
                            </div>

                            <div id="question4" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p> You must give 40 full days after the shipping of the book. After that time, if you still haven't receive the book, <a href="contact.html">message</a> the moderating team about your issue and you will be contacted within
                                        48 hours through your specified e-mail address. Alternatively, contact the seller directly.</p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 6 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question5">
                                <h4 class="panel-title">
                                    <a href="#question5" class="ing">The auction of my book has ended but the winner didn't pay, what should I do?</a>
                                </h4>
                            </div>

                            <div id="question5" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>You should give 48h after the auction is over. Payments are done via PayPal and are automatic, but it is not guaranteed that the transaction will be successfully finished. If after 48h the you haven't yet received your
                                        payment, message us, and we will find out the reason. If it happens to be the work of a fraudulent user and/or PayPal account, you will be allowed to create a new auction for the same item. </p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 7 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question6">
                                <h4 class="panel-title">
                                    <a href="#question6" class="ing">What information should I leave as a feedback?</a>
                                </h4>
                            </div>

                            <div id="question6" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>As a buyer, after a purchase, you are expected to express your apreciation or depreciation related to your purchase experience. After the positive or negative feedback choice you can leave a customized message that
                                        can detail the experience related to the shipping, packaging, resemblence of the item to the decription and communication with the seller. </p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 8 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question7">
                                <h4 class="panel-title">
                                    <a href="#question7" class="ing">How do I contact the seller if I want more information about an item?</a>
                                </h4>
                            </div>

                            <div id="question7" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>BookHub provides its users with a messaging system. Alternatively, you can contact users through their email address, which is shown on their profiles.</p>
                                </div>
                            </div>
                        </div>


                        <!-- Question 9 -->
                        <div class="panel panel-default py-2">
                            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question8">
                                <h4 class="panel-title">
                                    <a href="#question8" class="ing">I created an auction but made some mistakes, can I edit the auction after it's already active?</a>
                                </h4>
                            </div>

                            <div id="question8" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                    <p>Editing auctions should be avoided, but it is possible to do so. Every modification must be additive rather than destructive (eg. you can only add more things, such as extra images), and it must be approved by the moderator
                                        team before it updates. Repeated erroneous use of this feature may end up in a ban.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- FAQ block end -->
            </main>

        </div>

    </div>


    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container align-self-center">
            <p class="mt-2 mb-0 text-center text-white">Copyright &copy; BookHub 2018</p>
            <p class="m-0 text-center text-white">
                <a class="text-white" href="about.html"> About</a> &nbsp; | &nbsp;
                <a class="text-white" href="faq.html"> FAQ</a> &nbsp; | &nbsp;
                <a class="text-white" href="contact.html"> Contact</a>
            </p>
        </div>
    </footer>

    <!-- Javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bsadmin.js"></script>
</body>

</html>