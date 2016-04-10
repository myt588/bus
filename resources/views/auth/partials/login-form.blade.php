<form role="form" method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label">E-Mail Address</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label">Password</label>
        <input type="password" class="form-control" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <a href="{{ url('/password/reset') }}" class="forgot-password pull-right">Forgot password?</a>
        <div class="checkbox checkbox-inline">
            <label>
                <input type="checkbox"> Remember me
            </label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="full-width btn-medium">Sign In</button>
    </div>
</form>
<div class="seperator"></div>
<p>Don't have an account? <a href="{{ url('/register') }}" class="goto-login soap-popupbox">Sign up</a></p>