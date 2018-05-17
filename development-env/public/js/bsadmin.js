/**
  * JS related to the style on all pages
  */
$(document).ready(function() {
    // toggle sidebar when button clicked
    $(".sidebar-toggle").on("click", function() {
        $(".sidebar").toggleClass("toggled");
        $("#fixed-footer")
            .removeClass("#fixed-footer")
            .addClass("footer");
    });

    // auto-expand submenu if an item is active
    var active = $(".sidebar .active");

    if (active.length && active.parent(".collapse").length) {
        var parent = active.parent(".collapse");

        parent.prev("a").attr("aria-expanded", true);
        parent.addClass("show");
    }
});


/**
  * Error handling
  */
$(window).on("load", function() {
    $("#myModalError").modal("show");
});

/**
  * Functions for GET and POST AJAX requests
  */
function ajaxCallGet(url, handler) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
/*    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            window[handler](this.responseText);
        }
    };*/
    xmlhttp.onload = handler;
    xmlhttp.send();
}

function ajaxCallPost(url, params, handler) {
    let data = encodeForAjax(params);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
/*    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            window[handler](this.responseText);
        }
    };*/
    xmlhttp.onload = handler;
    xmlhttp.send(data);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

/**
  * JS for the home page
  */
if (window.location.pathname === "/home") {
    ajaxCallGet("api/search?type_search=home", "homeHandler");
}

function homeHandler(response) {
    auctions = JSON.parse(response);
    let album = document.querySelector('#auctionAlbum');
    console.log(album);
    let htmlAuction = `<div class="row">`;
    let i = 0;
    auctions.forEach(element => {
        if (i % 4 === 0 && i !== 0) {
            htmlAuction += `</div><div class="row">`;
        }
        htmlAuction += `<div class="col-md-3 auctionItem"  data-id="${element.id}">
        <a href="auction/${element.id}" class="list-group-item-action">
            <div class="card mb-4 box-shadow">
                <div class="col-md-6 img-fluid media-object align-self-center ">
                    <img class="width100" src="../img/book.png" alt="the orphan stale">
                </div>
                <div class="card-body">
                    <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger"> ${element.title} </p>
                    <p class="card-text text-center hidden-p-md-down">By ${element.author} </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-star btn btn-sm text-primary"></i>
                        <small class="text-success">€ 0.00 </small>
                        <small class="text-danger">
                                &lt; x mins</small>
                    </div>
                </div>
            </div>
        </a>
    </div>`;
        i++;
    });
    htmlAuction += `</div>`;
    album.innerHTML = htmlAuction;
}

/**
  * JS for the feedback functionalities
  */
let feedback = document.querySelector("#myfeedback");

if (feedback !== null)
    feedback.innerHTML = `<form id="feedbackform">
                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-thumbs-up btn btn-success"></i>
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="fa fa-thumbs-down btn btn-danger"></i>
                    </button>
                </div>
                <div class="form-group">
                    <textarea rows="3" cols="30" class="form-control" placeholder="Your feedback"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary col-md-12">Post your feedback</button>
                    </div>
                </div>

            </form>`;

/**
  *JS for search-related stuff and APIs
  */
if (window.location.pathname === "/search") //use ajax on advanced search form
{
    let searchForm = document.querySelector("#advSearchSubmit");
    searchForm.onsubmit = function(event)
    {
        event.preventDefault();
        let params = "api/search";

        ajaxCallGet(params, "searchHandler");
    }
}

//set the category for the navbar search box
let cats = document.querySelectorAll(".category-dropdown");
let navbarSearches = document.querySelectorAll("input[name='category']");
let selectedCat = document.querySelector("#catDropDown");

for (let i = 0; i < cats.length; i++)
{
    cats[i].addEventListener("click", function()
    {
        let cat = cats[i].innerHTML;
        selectedCat.innerHTML = cat;
        for (let j = 0; j < navbarSearches.length; j++)
            navbarSearches[j].value = cat;
    });
}

/**
  * JS for bidding-related stuff and APIs
  */
if (window.location.href.includes("auction/"))
{
    //decrease time left every second
    let timeLeft = document.querySelector("#timeLeft").innerHTML;
    let elements = timeLeft.split(" ");
    let days, hours, minutes, seconds;

    switch(elements.length)
    {
        case 4:
            days = parseInt(elements[0].slice(0,-1));
            hours = parseInt(elements[1].slice(0,-1));
            minutes = parseInt(elements[2].slice(0,-1));
            seconds = parseInt(elements[3].slice(0,-1));
            break;
        case 3:
            days = 0;
            hours = parseInt(elements[1].slice(0,-1));
            minutes = parseInt(elements[2].slice(0,-1));
            seconds = parseInt(elements[3].slice(0,-1));
            break;
        case 2:
            days = 0;
            hours = 0;
            minutes = parseInt(elements[2].slice(0,-1));
            seconds = parseInt(elements[3].slice(0,-1));
            break;
        case 1:
            days = 0;
            hours = 0;
            minutes = 0;
            seconds = parseInt(elements[3].slice(0,-1));
            break;
    }

    let timer = new Timer();
    timer.start({countdown: true, startValues: {days: days, hours: hours, minutes: minutes, seconds: seconds}});
    timer.addEventListener('secondsUpdated', function(e)
    {
        let newTime = "";
        if (timer.getTimeValues().days > 0)
            newTime += timer.getTimeValues().days + "d ";
        if (timer.getTimeValues().hours > 0)
            newTime += timer.getTimeValues().hours + "h ";
        if (timer.getTimeValues().minutes > 0)
            newTime += timer.getTimeValues().minutes + "m ";
        if (timer.getTimeValues().seconds > 0)
            newTime += timer.getTimeValues().seconds + "s";
        if (newTime == "")
            newTime = "Auction has ended!";

        document.querySelector("#timeLeft").innerHTML = newTime;
    });

    //get the current highest bid value periodically
    window.setInterval(function()
    {
        console.log("Requesting bid value");
        let auctionID = getAuctionID();
        let requestURL = "/api/bid/?auctionID=" + auctionID;
        ajaxCallGet(requestURL, getBidHandler);
    }, 2000);

    //post new bid value
    let bidBox = document.querySelector("#bid-box");
    bidBox.addEventListener("click", function()
    {
        console.log("Sending a new bid");
        let currVal = document.querySelector("#currentBid");
        currVal = parseInt(currVal);

        let maxVal = document.querySelector("#currentMaxBid");
        maxVal = parseFloat(maxVal);

        if (currVal <= maxVal)  //replace by modal
            alert("You cannot bid a value lower than the current highest bid");

        let auctionID = getAuctionID();

        let params = {"auctionID": auctionID, "value": currVal};
        ajaxCallPost("api/bid", params, postBidHandler);
    });
}

function getAuctionID()
{
    let auctionID = window.location.href.split('/').pop();
    if (auctionID.endsWith('#'))
        auctionID = auctionID.susbstring(0, auctionID.length - 1);
    return auctionID;
}

function getBidHandler()
{
    console.log("Received current bid value");
    let answer = JSON.parse(this.responseText);
    console.log(this.responseText);
    let newVal = answer['max'];
    let currentBidValue = document.querySelector("#currentMaxBid").value = newVal + "€";
}

function postBidHandler(response)
{
    console.log("Received bidding result");
/*    let answer = JSON.parse(response);
    let success = answer['success'];
    if (!success)   //replace with modals
        alert("Bid was successful, you are now leading the auction");
    else
        alert("Unable to bid; someone bidded a higher value than yours");*/
}

/**
  * Contact AJAX form validator and sender with notification alert
  */
if (window.location.pathname === "/contact")
{
    $("#contactForm").click(function( event ) {
    event.preventDefault();
    });

    function submitContactMessage(){
        let openAlertF="<div class='alert alert-danger alert-dismissible mb-4' id='contactAlert'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        let closeAlert="</div>";

        if ( $('#contactForm')[0].checkValidity() ){
            let spinningCircle = "<i class='fa fas fa-circle-notch fa-spin' style='font-size:24px'></i>";
            let defaultText="Send Message";
            let openAlertS="<div class='alert alert-success alert-dismissible mb-4' id='contactAlert' data-dismiss='alert'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";

            $("#contactSubmitButton").html(spinningCircle);
            $.ajax({
                   type: "POST",
                   url: "/contact",
                   data: $("#contactForm").serialize(),
                   success: function(data)
                   {
                        $("#contactAlert").html(openAlertS+data+closeAlert);
                        $("#contactSubmitButton").html(defaultText);
                        $("#contactForm")[0].reset();
                   },
                   error: function(data)
                   {
                     $("#contactSubmitButton").html(defaultText);
                     $("#contactAlert").html(openAlertF+"Something unexpected hapened. Please contact directly at: admin@bookhub.com"+closeAlert);
                   }
            });
        } else {
            $("#contactAlert").html(openAlertF+"Please fill all above fields correctly to send message."+closeAlert);
        }
    }
}

/**
  * JS for moderation actions
  */
function moderatorAction(modAction,auctionId,auctionModId=-1){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

   $.ajax({
          url: "/moderator",
          method: 'post',
          data: {
             ida: auctionId,
             idm: auctionModId,
             action: modAction
          },
          success: function(result){
            location.reload();
          },
          error: function(data){
            console.log(data);
            alert("fail" + ' ' + this.data)
          }
    });
}
