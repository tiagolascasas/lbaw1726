<div class="col-md-3 auctionItem"  data-id="{{$auction->id}}">
    <a href="auction/{{$auction->id}}" class="list-group-item-action">
        <div class="card mb-4 box-shadow">
            <div class="col-md-6 img-fluid media-object align-self-center ">
                <img class="width100" src="{{ asset('img/book.png') }}" alt="the orphan stale">
            </div>
            <div class="card-body">
                <p class="card-text text-center hidden-p-md-down font-weight-bold" style="font-size: larger">{{ $auction->title }} </p>
                <p class="card-text text-center hidden-p-md-down">By {{ $auction->author }} </p>
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fas fa-star btn btn-sm text-primary"></i>
                    <small class="text-success">€ 0.00 </small>
                    <small class="text-danger">
                            &lt; x mins</small>
                </div>
            </div>
        </div>
    </a>
</div>
