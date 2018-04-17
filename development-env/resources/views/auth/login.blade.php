
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="form-group">
            <label for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text" placeholder="Your Username">
        </div>
        @if ($errors->has('username'))
            <span class="error">
            {{ $errors->first('username') }}
            </span>
        @endif

        <div class="form-group">
            <label for="password" >Password</label>
            <input class="form-control" id="password" type="password" name="password" required placeholder="Your password">
        </div>
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary btn-block" data-dismiss="modal" type="submit">
            LOGIN
        </button>
    </div>  
</form>


