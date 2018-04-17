
<form method="POST" action="{{ route('register') }}">
  {{ csrf_field() }}
  <div class="modal-body">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name"name" type="text" placeholder="Your Complete Name" required>
    </div>
    <div class="form-group">
      <label for="usernameR">Username</label>
      <input class="form-control" id="usernameR" name="username" type="text" placeholder="Username" required>
    </div>
    <div class="form-group">
      <label for="age">Age</label>
      <input class="form-control" id="age" name="age" type="number" placeholder="Age" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input class="form-control" id="email" name="email" type="email" placeholder="example@email.com" required>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input class="form-control" id="address" name="address" type="text" placeholder="Example Address, 4441" required>
    </div>
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label for="postalcolde">Postal Code</label>
          <input class="form-control" id="postalcode" name="postalcode" type="text" placeholder="XXXX-XXX" required>
        </div>
        <div class="col-md-6">
          <label for="idcountry">Country</label>
          <input class="form-control" id="idcountry" name="idcountry" type="text" placeholder="Your Country" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your phone number" required>
    </div>
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <label for="passwordR">Password</label>
          <input class="form-control" id="passwordR" name="password" type="password" placeholder="Your password" required>
        </div>
        <div class="col-md-6">
          <label for="password-confirm">Confirm Password</label>
          <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" required>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-block" type"submit">REGISTER</button>
  </div>
</form>

