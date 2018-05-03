<div class="list-group-item list-group-item-action text-muted">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto img-fluid media-object align-self-center ">
                <a href="auction/{{$auction->id}}"><img class="width100" src="{{ asset('img/book.png') }}" alt="the husbands secret"></a>
            </div>
            <a href="auction/{{$auction->id}}" class="col-lg-6 align-self-center text-left p-2 text-dark lead">
               {{ $auction->title }}
            </a>
            <div class="col-lg-4 text-center align-self-center p-3 text-danger">
                <a href="#"><i class="fa fa-thumbs-up fa-2x btn btn-success align-self-center p-2 m-2"></i></a>
                <a href="{{ action('ModeratorController@reject', ['id' => $auction->id]) }}" class="fa fa-trash fa-2x btn btn-danger align-self-center p-2 m-2"></a>
            </div>
        </div>
    </div>
</div>