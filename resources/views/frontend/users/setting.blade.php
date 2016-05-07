@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="/css/app.css">
@endsection

@section('title') TriponBus @endsection

@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            <div class="tab-container full-width-style arrow-left dashboard">
                @include('frontend.users.partials.nav')
                <div class="tab-content">
                    <div id="settings" class="tab-pane fade active in">
                        <h2>Account Settings</h2>
                        <h5 class="skin-color">Change Your Password</h5>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            {!! Form::text('email', $user->email, ['hidden']) !!}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#profile .edit-profile-btn").click(function(e) {
                e.preventDefault();
                tjq(".view-profile").fadeOut();
                tjq(".edit-profile").fadeIn();
            });

            setTimeout(function() {
                tjq(".notification-area").append('<div class="info-box block"><span class="close"></span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ab quis a dolorem, placeat eos doloribus esse repellendus quasi libero illum dolore. Esse minima voluptas magni impedit, iusto, obcaecati dignissimos.</p></div>');
            }, 10000);
        });
        tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
            tjq(".view-profile").show();
            tjq(".edit-profile").hide();
        });
    </script>
</body>
@endsection
