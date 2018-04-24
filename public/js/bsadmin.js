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

if (window.location.pathname = "/home") {
    let auctions = JSON.parse(ajaxCall("GET", "api/search", ""));
    let album = document.querySelector('#auctionAlbum');
    album.innerHTML = `<div class="row">`;
    for (let i = 0; i < auctions.length; i++) {
        if (i % 4 === 0 && i !== 0) {
            album.innerHTML += `</div><div class="row">`;
        }
        album.innerHTML += `<div class="col-md-3 auctionItem"  data-id="${auctions[i].id}">
        <a href="auction/${auctions[i].id}" class="list-group-item-action">
            <div class="card mb-4 box-shadow">
                <div class="col-md-6 img-fluid media-object align-self-center ">
                    <img class="width100" src="{{ asset('img/book.png') }}" alt="the orphan stale">
                </div>
                <div class="card-body">
                    <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">{{ $auction->title }} </p>
                    <p class="card-text text-center hidden-p-md-down">By ${auctions[i].author} </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-star btn btn-sm text-primary"></i>
                        <small class="text-success">€ 0.00 </small>
                        <small class="text-danger">
                                &lt; x mins</small>
                    </div>
                </div>
            </div>
        </a>
    </div>`
    }
    album.innerHTML += `</div>`;
}

function ajaxCall(method, url, data) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open(method, url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            return this.responseText;
        }
    };
    xmlhttp.send(data);
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