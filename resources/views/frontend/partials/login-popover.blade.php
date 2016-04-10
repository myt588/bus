<div id="travelo-signup" class="travelo-signup-box travelo-box">
    <!-- <div class="login-social">
        <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
        <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> -->
    <!-- <div class="simple-signup">
        <div class="text-center signup-email-section">
            <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
        </div>
        <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
    </div> -->
    @include('auth.partials.register-form')
</div>
<div id="travelo-login" class="travelo-login-box travelo-box">
    <!-- <div class="login-social">
        <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
        <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> -->

    @include('auth.partials.login-form')
</div>