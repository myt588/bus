@extends('layouts.frontend')

@section('title') Booking @endsection @section('heading') Booking @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Flight Booking</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Flight Booking</li>
        </ul>
    </div>
</div>

@endsection

@section('content')

<section id="content" class="grey-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                <div class="booking-section travelo-box">
                    
                    <form class="booking-form">
                        <div class="person-information">
                            <h2>Your Personal Information</h2>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>first name</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>last name</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>email address</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Verify E-mail Address</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Country code</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option>United Kingdom (+44)</option>
                                            <option>United States (+1)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Phone number</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Meal preference <small>(optional)</small></label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option>United Kingdom (+44)</option>
                                            <option>United States (+1)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I want to receive <span class="skin-color">Travelo</span> promotional offers in the future
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="card-information">
                            <h2>Your Card Information</h2>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Credit Card Type</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option>select a card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Card holder name</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Card number</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Card identification number</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Expiration Date</label>
                                    <div class="constant-column-2">
                                        <div class="selector">
                                            <select class="full-width">
                                                <option>month</option>
                                            </select>
                                        </div>
                                        <div class="selector">
                                            <select class="full-width">
                                                <option>year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <label>billing zip code</label>
                                    <input type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-md-5">
                                <button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                <div class="booking-details travelo-box">
                    <h4>Booking Details</h4>
                    <article class="flight-booking-details">
                        <figure class="clearfix">
                            <a title="" href="flight-detailed.html" class="middle-block"><img class="middle-item" alt="" src="http://placehold.it/75x75"></a>
                            <div class="travel-title">
                                <h5 class="box-title">Indianapolis to paris<small>Oneway flight</small></h5>
                                <a href="flight-detailed.html" class="button">EDIT</a>
                            </div>
                        </figure>
                        <div class="details">
                            <div class="constant-column-3 timing clearfix">
                                <div class="check-in">
                                    <label>Take off</label>
                                    <span>NOV 30, 2013<br />7:50 am</span>
                                </div>
                                <div class="duration text-center">
                                    <i class="soap-icon-clock"></i>
                                    <span>13h, 40m</span>
                                </div>
                                <div class="check-out">
                                    <label>landing</label>
                                    <span>Nov 13 2013<br />9:20 am</span>
                                </div>
                            </div>
                        </div>
                    </article>
                    
                    <h4>Other Details</h4>
                    <dl class="other-details">
                        <dt class="feature">Airline:</dt><dd class="value">Delta</dd>
                        <dt class="feature">Flight type:</dt><dd class="value">Economy</dd>
                        <dt class="feature">base fare:</dt><dd class="value">$320</dd>
                        <dt class="feature">taxes and fees:</dt><dd class="value">$300</dd>
                        <dt class="total-price">Total Price</dt><dd class="total-price-value">$620</dd>
                    </dl>
                </div>
                
                <div class="travelo-box contact-box">
                    <h4>Need Travelo Help?</h4>
                    <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                    <address class="contact-details">
                        <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                        <br>
                        <a class="contact-email" href="#">help@travelo.com</a>
                    </address>
                </div>
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