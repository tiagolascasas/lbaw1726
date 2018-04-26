    <!-- Profile Content -->
    <main  data-id="{{$user}}">
        <div class="container-fluid bg-white">
            <div class="bg-white mb-0 mt-4 panel">
                <h5><i class="fa fa-user-circle"></i> {{$user->username}}'s profile</h5>
            </div>
            <hr id="hr_space" class="mt-2">
            <div class="row">
                <div class="col-lg-2 col-sm-6 text-center mb-4">
                    <img class="img-fluid d-block mx-auto" src="{{asset('avatars/default.png')}}" alt="{{$user->name}} photo">
                </div>
                <table class="table table-striped col-lg-4">
                    <tbody>
                        <tr>
                            <td style="width:16.33%">
                                <strong>Full name</strong>
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Email address</strong>
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Phone Number</strong>
                            </td>
                            <td>
                                {{$user->phone}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Country</strong>
                            </td>
                            <td>
                                {{$user->country->countryname}}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!--feedback-->
            <div class="bg-white mb-0 mt-3 mb-3 panel">
                <h5><i class="fa fa-comments"></i> Feedback</h5>
            </div>
            <div id="myfeedback">

            </div>



            <div class="list-group panel">
                <a href="#" class="list-group-item list-group-item-action text-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <span class="btn btn-secondary" onclick="profile_func()">nelsoncosta</span>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <i class="fa fa-thumbs-up btn btn-success"></i>
                            </div>
                            <div class="col-lg-6  text-left text-dark lead">
                                <p>Everything was delivered as promised. I reccomend.</p>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <p>5 days ago</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action text-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <span class="btn btn-secondary" onclick="profile_func()">rubentorres</span>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <i class="fa fa-thumbs-down btn btn-danger"></i>
                            </div>
                            <div class="col-lg-6  text-left text-dark lead">
                                <p>Took way too long to arrive.</p>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <p>7 days ago</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action text-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <span class="btn btn-secondary">tiagolascasas</span>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <i class="fa fa-thumbs-up btn btn-success"></i>
                            </div>
                            <div class="col-lg-6  text-left text-dark lead">
                                <p>Always has the best deals!</p>
                            </div>
                            <div class="col-lg-2  text-left text-dark lead">
                                <p>10 days ago</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
      </div>
  	</main>
