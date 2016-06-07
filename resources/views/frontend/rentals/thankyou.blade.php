@extends('layouts.frontend')

@section('title') Thank you @endsection @section('heading') Thank you @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Thank You</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li><a href="#">TICKETS</a></li>
            <li class="active">Thank you</li>
        </ul>
    </div>
</div>

@endsection

@section('content')

<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sm-8 col-md-9">
                <div class="booking-information travelo-box">
                    <h2>Booking Confirmation</h2>
                    <hr />
                    <div class="booking-confirmation clearfix">
                        <i class="soap-icon-recommend icon circle"></i>
                        <div class="message">
                            <h4 class="main-message">Thank You. Your Booking Order is Confirmed Now.</h4>
                            <p>A confirmation email has been sent to your provided email address.</p>
                        </div>
                        <a href="#" class="print-button button btn-small">PRINT DETAILS</a>
                    </div>
                    <hr />
                    <h2>Traveler Information</h2>
                    <dl class="term-description">
                        <dt>First name:</dt><dd>{{ $rent->user->first_name }}</dd>
                        <dt>Last name:</dt><dd>{{ $rent->user->last_name }}</dd>
                        <dt>E-mail address:</dt><dd>{{ $rent->user->email }}</dd>
                        <dt>Start Date & Time:</dt><dd>{{ $rent->start }}</dd>
                        <dt>End Date & Time:</dt><dd>{{ $rent->end }}</dd>
                        <dt>Pickup Location:</dt><dd>{{ $rent->description }}</dd>
                    </dl>
                    <hr />
                    <h2>Payment</h2>
                    <p></p>
                    <br />
                    <p class="red-color">No Payment is being charged.</p>
                    <hr />
                    <h2>View Booking Details</h2>
                    <p>You may view the booking details through the link below or find it in your personal page. A confirmation email is also sent to your email address<</p>
                    <br />
                    <a href="#" class="red-color underline view-link">{{url()->current()}}</a>
                </div>
            </div>
            <div class="sidebar col-sm-4 col-md-3">
                @include('frontend.partials.help-box')
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Google Map Api -->
<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

<script type="text/javascript" src="/js/calendar.js"></script>
@endsection