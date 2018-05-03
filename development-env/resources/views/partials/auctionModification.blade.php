<div class="list-group-item list-group-item-action text-muted mb-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto img-fluid media-object align-self-center ">
                <a href="{{ url('auction/')}}/{{$auction_modification->idapprovedauction}}"><img class="width100" src="{{ asset('img/book.png') }}" alt="the husbands secret"></a>
            </div>
            <a href="{{ url('auction/') }}/{{$auction_modification->idapprovedauction}}" class="col-lg-6 align-self-center text-left p-2 text-dark lead">
            {{$auction_to_mod->title}}
            </a>
            <div class="col-lg-4 text-center align-self-center p-3 text-danger">
                <a href="{{ url('moderator/approve_mod/')}}/{{$auction_modification->idapprovedauction}}"><i class="fas fa-check fa-2x btn btn-success align-self-center p-2 m-2"></i></a>
                <a href="{{ url('moderator/remove_mod/')}}/{{$auction_modification->idapprovedauction}}" class="fas fa-ban fa-2x btn btn-danger align-self-center p-2 m-2" id="reject" name="reject" type="text"></a>
            </div>
        </div>
    </div>
</div>