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

$(window).on("load", function() {
    $("#myModalError").modal("show");
});

if (window.location.pathname === "/home") {
    ajaxCallGet("api/search?type_search=home", "homeHandler");
}

function ajaxCallGet(url, handler) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            window[handler](this.responseText);
        }
    };
    xmlhttp.send();
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

function searchfunc() {
    window.location.href = "search.html";
}

function profile_func() {
    window.location.href = "profile_not_owner.html";
}

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

if (window.location.pathname === "/search")
{
    let searchForm = document.querySelector("#searchForm");
    searchForm.onsubmit = function(event)
    {
        event.preventDefault();
        let params = "api/search";


        ajaxCallGet(params, "searchHandler");
    }
}

// Contact AJAX form validator and sender with notification alert
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

// Moderator AJAX actions
if (window.location.pathname === "/moderator")
{
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
}