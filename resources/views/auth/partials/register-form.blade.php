<form role="form" method="POST" action="{{ url('/register') }}">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label class="control-label">First Name</label>
        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        <label class="control-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>

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

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="control-label">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox"> Tell me about Travelo news
            </label>
        </div>
    </div>
    <div class="form-group">
        <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
    </div>

    <div class="form-group">
        <button type="submit" class="full-width btn-medium">Register</button>
    </div>
</form>
<div class="seperator"></div>
<p>Already a Travelo member? <a href="{{ url('/login') }}" class="goto-login soap-popupbox">Login</a></p>