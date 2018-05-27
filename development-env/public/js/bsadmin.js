/**
 * JS related to the style on all pages
 */
$(document).ready(function()
{
    // toggle sidebar when button clicked
    $(".sidebar-toggle").on("click", function()
    {
        $(".sidebar").toggleClass("toggled");
        $("#fixed-footer")
            .removeClass("#fixed-footer")
            .addClass("footer");
    });

    // auto-expand submenu if an item is active
    var active = $(".sidebar .active");

    if (active.length && active.parent(".collapse").length)
    {
        var parent = active.parent(".collapse");

        parent.prev("a").attr("aria-expanded", true);
        parent.addClass("show");
    }
});


/**
 * Error handling
 */
$(window).on("load", function()
{
    $("#myModalError").modal("show");
});

/**
 * Functions for GET and POST AJAX requests
 */
function ajaxCallGet(url, handler)
{
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", url, true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.onload = handler;
    xmlhttp.send();
}

function ajaxCallGet2(url,params, handler)
{
    $.ajax(
    {
        url: url,
        type: 'GET',
        data: params,
        success: handler
    });
}

function ajaxCallPost(url, params, handler)
{
    let token = document.querySelector("#csrfToken").content;
    params._token = token;
    $.ajax(
    {
        url: url,
        type: 'POST',
        data: params,
        success: handler
    });
}

function encodeForAjax(data)
{
    return Object.keys(data).map(function(k)
    {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

/**
 * JS for the home page
 */
if (window.location.pathname === "/home")
{
    ajaxCallGet("api/search?auctionStatus=approved", auctionAlbumHandler);
}

function auctionAlbumHandler()
{
    console.log(this.responseText);
    auctions = JSON.parse(this.responseText);
    let album = document.querySelector('#auctionsAlbum');
    album.innerHTML = makeAlbum(auctions);
}

function makeAlbum(auctions)
{
    console.log(auctions);
    let htmlAuction = `<div class="row">`;
    let i = 0;
    auctions.forEach(element =>
    {
        if (i % 4 === 0 && i !== 0)
        {
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
                        <small class="text-success">${element.maxBid}€ </small>
                        <small class="text-danger">
                                &lt; ${element.time}</small>
                    </div>
                </div>
            </div>
        </a>
    </div>`;
        i++;
    });
    htmlAuction += `</div>`;
    return htmlAuction;
}

/**
 * JS for the notifications
 */
let counter = document.querySelector("#counter");

function notificationsClick()
{
    let params = {};
    counter.innerHTML = "";
    ajaxCallGet2('api/notifications', params,notificationsHandler);
}


function notificationsHandler(response)
{
    let notifications = JSON.parse(JSON.stringify(response));
    let notification_list = document.querySelector("#not_itens");
    let html_notification = `<h6 class="dropdown-header">New Alerts:</h6>
                          <div class="dropdown-divider"></div>`;
    if (notifications.length == 0)
    {
        html_notification += `<a class="dropdown-item">
                                <div class="dropdown-message"><span class="text-left small">No new notifications.</span></div>
                              </a>`;
    }
    else
    {
        counter.innerHTML = notifications.length;
        notifications.forEach(function(element)
        {
            let time_sent = element.datesent.substring(10, 16);
            html_notification += `<a class="dropdown-item" data-id="${element.id}" method = "GET" href="{{route(auction/${element.idAuction})}}">
                              <span class="text text-left">
                                <strong>${element.title}</strong>
                              </span>
                              <span class="small text-right text-muted">${time_sent}</span>
                              <div class="dropdown-message">
                                <span class="text-left small">${element.information}</span>
                              </div>
                            </a>`;
            let params = {
                "notification_id": element.id
            };
            ajaxCallPost('../api/notifications/{id}', params, 'sucess');
        });
    }
    notification_list.innerHTML = html_notification;
}

setInterval(function()
{
    let params = {};
    ajaxCallGet2('../api/notifications', params, notificationsHandler);
}, 5000);

/**
 * JS for the feedback functionalities
 */
let feedback = document.querySelector("#myfeedback");
if(window.location.href.includes('profile')){
    let profile_id = getProfileID();
    console.log(profile_id);
    let params = {"user": profile_id};
    console.log("On profile.");
    ajaxCallGet2('/users/{id}/comments',params,commentsHandler);
}


function commentsHandler(response){
    let comments = JSON.parse(JSON.stringify(response));
    if(comments.length == 0){
        feedback.innerHTML = `<a class="list-group-item list-group-item-action text-muted">
                                <div class="container">
                                    <span> No feedback.</span>
                                </div>
                              </a>`;
    }
    else{
        let comments_html = "";
        comments.forEach(function(element){
            let date_sent = element.dateposted.substring(0, 11);
            comments_html += `<a class="list-group-item list-group-item-action text-muted">
                                <div class="row">
                                    <div class="col-lg-2">
                                            <span onclick="changeurl('/profile/${element.idsender}')" class="btn btn-outline-secondary">${element.username}</span>
                                    </div>`;
            if(element.liked){
                comments_html += `<div class="col-lg-1  text-left text-dark lead">
                                            <i class="fa fa-thumbs-up btn btn-success"></i>
                                        </div>`;
            }else{
                comments_html += `<div class="col-lg-1  text-left text-dark lead">
                                            <i class="fa fa-thumbs-down btn btn-danger"></i>
                                        </div>`;
            }
            comments_html += ` <div class="col-lg-5  text-left text-dark lead">
                                        <p>${element.comment_text}</p>
                                    </div>
                                    <div class="col-lg-2  text-left text-dark lead">
                                        <p>${date_sent}</p>
                                    </div>
                                    <div class="col-lg-2  text-left text-dark lead">
                                        <span class="btn btn-secondary">Reply</span>
                                    </div>
                                </div>
                            
                        </a>`;
        });
        feedback.innerHTML = comments_html;


    }
}
let like;
function setLike(){
    like = true;
    console.log(like);
}
function setUnlike(){
    like = false;
    console.log(like);
}

function postFeedback(senderID){
    let feedback = document.querySelector('#left-feedback').value;
    console.log(feedback);
    if(feedback !== null){
       let params = {
            "id_sender": senderID,
            "text": feedback,
            "id_receiver": getProfileID(),
            "liked": like
        };
        ajaxCallPost('/users/{id}',params,null);
        window.location.reload();


    }
}

function showAlert(response) {
    let message = JSON.parse(JSON.stringify(response));
    alert(message.message);
}

function getProfileID(){
    return window.location.pathname.substring(9,window.location.pathname.length);
}
function changeurl(newUrl){
    window.location = newUrl;
}


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
    if (timeLeft !== "Auction hasn't been approved yet" && timeLeft !== "Auction has ended!")
    {
        let elements = timeLeft.split(" ");
        let days, hours, minutes, seconds;

        switch (elements.length)
        {
            case 4:
                days = parseInt(elements[0].slice(0, -1));
                hours = parseInt(elements[1].slice(0, -1));
                minutes = parseInt(elements[2].slice(0, -1));
                seconds = parseInt(elements[3].slice(0, -1));
                break;
            case 3:
                days = 0;
                hours = parseInt(elements[0].slice(0, -1));
                minutes = parseInt(elements[1].slice(0, -1));
                seconds = parseInt(elements[2].slice(0, -1));
                break;
            case 2:
                days = 0;
                hours = 0;
                minutes = parseInt(elements[0].slice(0, -1));
                seconds = parseInt(elements[1].slice(0, -1));
                break;
            case 1:
                days = 0;
                hours = 0;
                minutes = 0;
                seconds = parseInt(elements[0].slice(0, -1));
                break;
        }

        let timer = new Timer();
        timer.start(
        {
            countdown: true,
            startValues:
            {
                days: days,
                hours: hours,
                minutes: minutes,
                seconds: seconds
            }
        });
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
    }

    //get the current highest bid value periodically
    window.setInterval(function()
    {
        let auctionID = getAuctionID();
        let requestURL = "/api/bid/?auctionID=" + auctionID;
        ajaxCallGet(requestURL, getBidHandler);
    }, 2000);

    //post new bid value
    let bidBox = document.querySelector("#bid-box");
    bidBox.addEventListener("click", function()
    {
        let currVal = document.querySelector("#currentBid").value;
        if (currVal == "")
        {
            let header = document.querySelector("#bidResultHeader");
            let body = document.querySelector("#bidResultBody");
            header.innerHTML = "Bidding value not set";
            body.innerHTML = "You must choose a value to bid";
            body.className = "alert alert-danger";
            $("#bidResult").modal();
            return;
        }
        currVal = parseFloat(currVal);

        let maxVal = document.querySelector("#currentMaxBid").innerHTML;
        maxVal = parseFloat(maxVal);

        if (currVal <= maxVal)
        {
            let header = document.querySelector("#bidResultHeader");
            let body = document.querySelector("#bidResultBody");
            header.innerHTML = "Insufficient bidding value";
            body.innerHTML = "Your bid cannot be lower or equal to the current bid.";
            body.className = "alert alert-danger";
            $("#bidResult").modal();
            return;
        }

        let auctionID = getAuctionID();

        let params = {
            "auctionID": auctionID,
            "value": currVal
        };
        ajaxCallPost("/api/bid", params, postBidHandler);
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
    let answer = JSON.parse(this.responseText);
    let newVal = answer['max'];
    let currentBidValue = document.querySelector("#currentMaxBid").innerHTML = newVal + "€";
}

function postBidHandler(data)
{
    let header = document.querySelector("#bidResultHeader");
    let body = document.querySelector("#bidResultBody");

    let success = data['success'];
    let message = data['message'];
    if (success)
    {
        header.innerHTML = "Successful bid";
        body.innerHTML = message;
        body.className = "alert alert-success";
    }
    else
    {
        header.innerHTML = "Unsuccessful bid";
        body.innerHTML = message;
        body.className = "alert alert-danger";
    }
    $("#bidResult").modal();
}

/**
 * JS for the advanced search page
 */
if (window.location.href.includes("search"))
{
    let advSearch = document.querySelector("#advSearch");
    advSearch.addEventListener('submit', function(event)
    {
        event.preventDefault();
        let data = $("form").serialize();
        console.log(data);
        ajaxCallGet("api/search?" + data, advSearchHandler);
    });
}

function advSearchHandler()
{
    let header = document.querySelector("#responseSentence");
    let album = document.querySelector("#auctionsAlbum");

    let answer = JSON.parse(this.responseText);
    console.log(answer);
    if (answer.length == 0)
    {
        header.innerHTML = "No results were found";
        album.innerHTML = "";
        return;
    }

    let sentence = "";
    if (answer.length == 1)
        sentence ="1 result found:";
    else
        sentence = answer.length + " results found";

    header.innerHTML = sentence;
    htmlAlbum = makeAlbum(answer);
    album.innerHTML = htmlAlbum;
}

/**
 * Contact AJAX form validator and sender with notification alert
 */
if (window.location.pathname === "/contact")
{
    $("#contactForm").click(function(event)
    {
        event.preventDefault();
    });

    function submitContactMessage()
    {
        let openAlertF = "<div class='alert alert-danger alert-dismissible mb-4' id='contactAlert'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        let closeAlert = "</div>";

        if ($('#contactForm')[0].checkValidity())
        {
            let spinningCircle = "<i class='fa fas fa-circle-notch fa-spin' style='font-size:24px'></i>";
            let defaultText = "Send Message";
            let openAlertS = "<div class='alert alert-success alert-dismissible mb-4' id='contactAlert' data-dismiss='alert'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";

            $("#contactSubmitButton").html(spinningCircle);
            $.ajax(
            {
                type: "POST",
                url: "/contact",
                data: $("#contactForm").serialize(),
                success: function(data)
                {
                    $("#contactAlert").html(openAlertS + data + closeAlert);
                    $("#contactSubmitButton").html(defaultText);
                    $("#contactForm")[0].reset();
                },
                error: function(data)
                {
                    $("#contactSubmitButton").html(defaultText);
                    $("#contactAlert").html(openAlertF + "Something unexpected hapened. Please contact directly at: admin@bookhub.com" + closeAlert);
                }
            });
        }
        else
        {
            $("#contactAlert").html(openAlertF + "Please fill all above fields correctly to send message." + closeAlert);
        }
    }
}

/**
 * JS for moderation actions
 */
function moderatorAction(modAction, auctionId, auctionModId = -1)
{
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax(
    {
        url: "/api/moderator",
        method: 'post',
        data:
        {
            ida: auctionId,
            idm: auctionModId,
            action: modAction
        },

        success: function(result)
        {
            // Fade elements on approve/remove
            if (window.location.pathname === "/moderator")
            {
                if (modAction == "approve_creation" || modAction == "remove_creation")
                {
                    $(`#cr-${auctionId}`).fadeOut();
                }
                else if (modAction == "get_new_description")
                {
                    let description = JSON.parse(result);
                    let action_approve = "moderatorAction('approve_modification'," + auctionId + "," + auctionModId + ")";
                    let action_remove = "moderatorAction('remove_modification'," + auctionId + "," + auctionModId + ")";
                    //put description text in modal
                    $("#bookTitle").text(description.title);
                    $("#oldDescription").text(description.old);
                    $("#newDescription").text(description.new);
                    //change action of modal buttons
                    $("#approveBtn").attr("onclick", action_approve);
                    $("#removeBtn").attr("onclick", action_remove);

                }
                else
                {
                    $(`#mr-${auctionId}`).fadeOut();
                }
            }
            else
            {
                location.reload();
            }
        },
        error: function(data)
        {
            console.log(data);
            alert("Check the log.")
        }
    });
}

/**
 * JS for Administrator actions
 */
function adminAction(adminAction, id_member = -1, username = "")
{
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax(
    {
        url: "/api/admin",
        method: 'post',
        data:
        {
            id_member: id_member,
            username: username,
            action: adminAction
        },

        success: function(result)
        {
            // Fade elements on approve/remove
            console.log(result);
            if (window.location.pathname === "/admin")
            {
                if (adminAction == "remove_profile" || adminAction == "ignore_del_request")
                {
                    $(`#dr-${id_member}`).fadeOut();
                }
            }
            else
            {
                location.reload();
            }
        },
        error: function(data)
        {
            console.log(data);
            alert("Check the log.")
        }
    });

}
