    <a class="list-group-item list-group-item-action text-muted">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center text-left p-2 text-dark lead">
                    {{$delRequests->user->username}}
                </div>
                <div class="btn-group">
                    <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2" onclick="location.href=' {{ url("profile/") }}/{{$delRequests->user->id}}'">Profile</span>
                </div>
                <div class="btn-group">
                    <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2">Delete</span>
                </div>
                <div class="btn-group">
                    <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2">Ignore</span>
                </div>
            </div>
        </div>
    </a>


   