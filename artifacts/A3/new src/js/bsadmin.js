$(document).ready(function() {
    // toggle sidebar when button clicked
    $(".sidebar-toggle").on("click", function() {
        $(".sidebar").toggleClass("toggled");
    });

    // auto-expand submenu if an item is active
    var active = $(".sidebar .active");

    if (active.length && active.parent(".collapse").length) {
        var parent = active.parent(".collapse");

        parent.prev("a").attr("aria-expanded", true);
        parent.addClass("show");
    }
});


let navbarList = document.getElementById("navbarList");

let loginButton = document.querySelector("#myModalLogin a");

let buttonWelcome = document.getElementById("buttonsWelcome");


loginButton.addEventListener("click", function() {
    navbarList.innerHTML = `
<li class="nav-item hidden-p-md-down">
   <form class="form-inline my-2 my-lg-0 mr-lg-2">
       <div class="input-group">
           <input class="form-control" type="text" placeholder="Search for...">
           <span class="input-group-append">
                       <button class="btn btn-primary" type="button">
                           <i class="fa fa-search"></i>
                       </button>
                   </span>
       </div>
   </form>
</li>
<li class="nav-item dropdown ">
   <a class="nav-link dropdown-toggle container" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fa fa-fw fa-bell"></i>
   </a>
   <div class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="alertsDropdown">
       <h6 class="dropdown-header">New Alerts:</h6>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <span class="text-success text-left">
               <strong>Memorial do Convento Update</strong>
           </span>
           <span class="small text-right text-muted">11:21 AM</span>
           <div class="dropdown-message"><span class="text-left small">Your auction has ended.</span><span class="float-right hover"><i class="far fa-check-circle"></i></span></div>
       </a>
       <a class="dropdown-item" href="#">
           <span class="text-danger text-left">
               <strong>Os Maias Update</strong>
           </span>
           <span class="small text-right text-muted">11:21 AM</span>
           <div class="dropdown-message"><span class="text-left small">This auction has ended.</span><span class="float-right hover"><i class="far fa-check-circle"></i></span></div>
       </a>
       <a class="dropdown-item" href="#">
           <span class="text-danger text-left">
               <strong>Os Maias Update</strong>
           </span>
           <span class="small text-right text-muted">11:21 AM</span>
           <div class="dropdown-message"><span class="text-left small">Someone covered your offer.</span><span class="float-right hover"><i class="far fa-check-circle"></i></span></div>
       </a>
   </div>
</li>

<li class="nav-item dropdown">
   <a class="nav-link dropdown-toggle  hidden-p-md-down" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown">
       <i class="fa fa-user"></i> Username
   </a>
   <a class="nav-link dropdown-toggle  hidden-p-md-up" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown">
       <i class="fa fa-user"></i>
   </a>
   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1 navbarDropdownMenuLink2">
       <a class="dropdown-item" href="profile_not_owner.html">Profile</a>
       <a class="dropdown-item" href="create.html">Create auction</a>
       <a class="dropdown-item" href="myAuctions.html">My Auctions</a>
       <a class="dropdown-item" href="auctionsIm_in.html">Auctions I'm in</a>
       <a class="dropdown-item" href="history.html">History</a>
       <a class="dropdown-item" href="wishlist.html">WishList</a>
       <a class="dropdown-item" href="#">Logout</a>
   </div>
</li>`;

    buttonWelcome.innerHTML = `<a href="#" class="btn btn-primary btn-lg my-2 mx-3 jumbotron-buttons">My Auctions</a>
<a href="#" class="btn btn-secondary btn-lg my-2 mx-3 jumbotron-buttons">Auctions I'm in</a>`;
});