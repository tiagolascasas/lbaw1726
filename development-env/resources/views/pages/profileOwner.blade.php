    <!-- Profile Content -->
    <main  data-id="{{$user}}">
        <div class="container-fluid bg-white">
            <div class="bg-white mb-0 mt-4 panel">
                <h5><i class="fa fa-user-circle"></i> {{$user->username}}&rsquo;s profile</h5>
            </div>
            <hr id="hr_space" class="mt-2">
            <div class="row"">
                <div class="col-lg-2 col-sm-6 text-center mb-5">
                    <img class="img-thumbnail d-block mx-auto" src="{{asset('img/'.$image)}}" alt="{{$user->name}} photo">
                </div>
                <table class="table table-striped col-lg-9">
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

            @if(Auth::User()->id == $user->id)
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
            @endif



            <!--feedback-->
            <div class = "container-fluid bg-white">
                <div class="bg-white mb-0 mt-3 mb-3 panel">
                    <h5><i class="fa fa-comments"></i> Feedback</h5>
                </div>
                @if(Auth::User()->id !== $user->id)
                    <form id="feedbackform">
                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <button type="button" onclick="setLike()" class="btn btn-success">
                                <i class="fa fa-thumbs-up btn btn-success"></i>
                            </button>
                            <button type="button" onclick="setUnlike()" class="btn btn-danger">
                                <i class="fa fa-thumbs-down btn btn-danger"></i>
                            </button>
                        </div>
                        <div class="form-group">
                            <textarea rows="3" cols="30" class="form-control" id = "left-feedback" placeholder="Your feedback"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <span onclick="postFeedback({{Auth::user()->id}})" class="btn btn-primary col-md-12">Post your feedback</span>
                            </div>
                        </div>
                    </form>
                @endif
                <div class = "list-group panel" id="myfeedback"  style = "margin-bottom: 20px;">

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
                            <form method="POST" action="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="InputName">Name</label>
                                    <input class="form-control" type="text" id="InputName" name="name" placeholder="Jack Oliveira da Siva Smith" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="InputAge">Age</label>
                                    <input class="form-control" id="InputAge" name="age" type="number" placeholder="22" value="{{ old('age') }}">
                                </div>

                                <div class="form-group">
                                    <label for="InputEmail1">Email address</label>
                                    <input class="form-control" type="email" name="email" placeholder="jack.smith@gmail.com" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="address1">Address</label>
                                    <input class="form-control" id="address1" name="address" type="text" placeholder="Street A, 125" value="{{ old('address') }}">
                                </div>
                                <div class="form-group">
                                    <label for="postalcode1">Postal Code</label>
                                    <input class="form-control" id="postalcode1" name="postalcode" type="text" placeholder="2000-132" value="{{ old('postalcode') }}">
                                </div>
                                <div class="form-group">
                                        <label for="Inputidcountry">Country</label>
                                        <select class="form-control" id="Inputidcountry" name="idcountry">
                                          <option selected value> -- select an option -- </option>
                                          <option value="1" {{ old('idcountry') == 1 ? 'selected' : '' }}>Austria</option>
                                          <option value="2" {{ old('idcountry') == 2 ? 'selected' : '' }}>Italy</option>
                                          <option value="3" {{ old('idcountry') == 3 ? 'selected' : '' }}>Belgium</option>
                                <option value="4" {{ old('idcountry') == 4 ? 'selected' : '' }}>Latvia</option>
                                <option value="5" {{ old('idcountry') == 5 ? 'selected' : '' }}>Bulgaria</option>
                                <option value="6" {{ old('idcountry') == 6 ? 'selected' : '' }}>Lithuania</option>
                                <option value="7" {{ old('idcountry') == 7 ? 'selected' : '' }}>Croatia</option>
                                <option value="8" {{ old('idcountry') == 8 ? 'selected' : '' }}>Luxembourg</option>
                                <option value="9" {{ old('idcountry') == 9 ? 'selected' : '' }}>Cyprus</option>
                                <option value="10" {{ old('idcountry') == 10 ? 'selected' : '' }}>Malta</option>
                                <option value="11" {{ old('idcountry') == 11 ? 'selected' : '' }}>Czech Republic</option>
                                <option value="12" {{ old('idcountry') == 12 ? 'selected' : '' }}>Netherlands</option>
                                <option value="13" {{ old('idcountry') == 13 ? 'selected' : '' }}>Denmark</option>
                                <option value="14" {{ old('idcountry') == 14 ? 'selected' : '' }}>Indonesia</option>
                                <option value="15" {{ old('idcountry') == 15 ? 'selected' : '' }}>Poland</option>
                                <option value="16" {{ old('idcountry') == 16 ? 'selected' : '' }}>Estonia</option>
                                <option value="17" {{ old('idcountry') == 17 ? 'selected' : '' }}>Portugal</option>
                                <option value="18" {{ old('idcountry') == 18 ? 'selected' : '' }}>Finland</option>
                                <option value="19" {{ old('idcountry') == 19 ? 'selected' : '' }}>Romania</option>
                                <option value="20" {{ old('idcountry') == 20 ? 'selected' : '' }}>France</option>
                                <option value="21" {{ old('idcountry') == 21 ? 'selected' : '' }}>Slovakia</option>
                                <option value="22" {{ old('idcountry') == 22 ? 'selected' : '' }}>Germany</option>
                                <option value="23" {{ old('idcountry') == 23 ? 'selected' : '' }}>Slovenia</option>
                                <option value="24" {{ old('idcountry') == 24 ? 'selected' : '' }}>Greece</option>
                                <option value="25" {{ old('idcountry') == 25 ? 'selected' : '' }}>Spain</option>
                                <option value="26" {{ old('idcountry') == 26 ? 'selected' : '' }}>Hungary</option>
                                <option value="27" {{ old('idcountry') == 27 ? 'selected' : '' }}>Sweden</option>
                                <option value="28" {{ old('idcountry') == 28 ? 'selected' : '' }}>Ireland</option>
                                <option value="29" {{ old('idcountry') == 29 ? 'selected' : '' }}>United Kingdom</option>
                              </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone1">Phone Number</label>
                                    <input class="form-control" id="phone1" name="phone" type="tel" placeholder="123456789" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                            <label>Your profile picture</label>
                                            <input id="image" name="image" class="form-control" type="file" accept="image/*">
                                            @if ($errors->has('images'))
                                              <span class="error">
                                                {{ $errors->first('images') }}
                                              </span>
                                            @endif
                                  </div>
                                <input  type="submit" class="btn btn-primary btn-block mb-4">Save any new changes</input>
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

            <div class="modal fade" id="paypalUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalPasswordLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalPasswordLabel">Link a PayPal account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('profile.paypal',$user->id) }}">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Your new PayPal email</label>
                                    <input class="form-control" name="paypalEmail" type="email" placeholder="example@example.com">
                                </div>
                                <button class="btn btn-primary btn-block mb-4">Link your PayPal account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="paypalRemoveModal" tabindex="-1" role="dialog" aria-labelledby="myModalPasswordLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalPasswordLabel">Unlink your PayPal account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="DELETE" action="{{ route('profile.paypal.remove',$user->id) }}">
                                <p>Are you sure you wish to unlink your PayPal account? You won't be able to buy or sell without it.</p>
                                <button class="btn btn-primary btn-block mb-4">Unlink your PayPal account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::User()->id == $user->id)

            <div class="container-fluid bg-white">
                <div class="bg-white mb-0 mt-4 mb-4 panel">
                    <h6><i class="fa fa-th-large"></i> Payments and transfers</h6>
                </div>
                <p>BookHub requires the use of PayPal in order to bid and/or create auctions. Be mindful of these three points:</p>
                <ul>
                    <li>All transactions related to an auction are performed automatically once that auction is over and cannot be reverted;</li>
                    <li>You can neither create nor bid on auctions until you associate a valid PayPal account to your BookHub account;</li>
                    <li>You cannot unlink your PayPal account if you have bid on an ongoing auction or if you have any auction of your own still active.</li>
                </ul>
                <p><strong>{{$paypalMsg}}</strong></p>

                <div class="list-group" style = "margin-bottom: 30px;">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6">
                                <a class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#paypalUpdateModal">
                                    <i class="fa fa-link"></i> Associate a Paypal account
                                </a>
                            </div>

                            <div class="col-lg-6">
                                <a class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#paypalRemoveModal">
                                    <i class="fa fa-unlink"></i> Unlink your Paypal account
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
      </div>
  	</main>
