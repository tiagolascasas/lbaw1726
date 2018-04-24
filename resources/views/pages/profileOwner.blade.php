    <!-- Profile Content -->
    <main  data-id="{{$user}}">
        <div class="container-fluid bg-white">
            <div class="bg-white mb-0 mt-4 panel">
                <h5><i class="fa fa-user-circle"></i> {{$user->username}}'s profile</h5>
            </div>
            <hr id="hr_space" class="mt-2">
            <div class="row">
                <div class="col-lg-2 col-sm-6 text-center mb-4">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/ruben.jpg') }}" alt="{{$user->name}} photo">
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

            <div class="list-group">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6">
                            <a class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#myModalEdit">
                                <i class="fa fa-user-plus"></i> Edit Info
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <a class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#myModalPassword">
                                <i class="fa fa-user-plus"></i> Change Password
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalEditLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalEditLabel">Edit Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="profile/{{Auth::user()->id}}/edit">
                                <div class="form-group">
                                    <label for="exampleInputName">Name</label>
                                    <input class="form-control" type="text" id="exampleInputName" placeholder="Jack Oliveira da Siva Smith">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDate">Age</label>
                                    <input class="form-control" id="exampleInputDate" type="number" placeholder="22">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input class="form-control" id="exampleInputEmail1" type="email" placeholder="jack.smith@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="address1">Address</label>
                                    <input class="form-control" id="address1" type="text" placeholder="Street A, 125">
                                </div>
                                <div class="form-group">
                                    <label for="postalcode1">Postal Code</label>
                                    <input class="form-control" id="postalcode1" type="text" placeholder="2000-132">
                                </div>
                                <div class="form-group">
                                    <label for="country1">Country</label>
                                    <input class="form-control" id="country1" type="text" placeholder="United Kingdom">
                                </div>
                                <div class="form-group">
                                    <label for="phone1">Phone Number</label>
                                    <input class="form-control" id="phone1" type="text" placeholder="123456789">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4">Save any new changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalPasswordLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalPasswordLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Current password</label>
                                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Your password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleNewPassword">New Password</label>
                                    <input class="form-control" id="exampleNewPassword" type="password" placeholder="New password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleConfirmPassword">Confirm Password</label>
                                    <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
                                </div>
                                <button class="btn btn-primary btn-block mb-4">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
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