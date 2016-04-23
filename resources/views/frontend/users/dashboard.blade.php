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
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#booking"><i class="soap-icon-businessbag circle"></i>Booking</a></li>
                    <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-user circle"></i>Profile</a></li>
                    <li class=""><a data-toggle="tab" href="#settings"><i class="soap-icon-settings circle"></i>Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div id="booking" class="tab-pane fade active in">
                        <h2>Trips You have Booked!</h2>
                        <div class="booking-history">
                            @foreach($tickets as $item)
                            <div class="booking-info clearfix {{$item->isPast() ? 'cancelled' : ''}}">
                                <div class="date">
                                    <label class="month">{{getMonth($item->depart_date)}}</label>
                                    <label class="date">{{getDay($item->depart_date)}}</label>
                                    <label class="day">{{getWeekday($item->depart_date)}}</label>
                                </div>
                                <h4 class="box-title"><i class="icon soap-icon-car blue-color circle"></i>{{$item->trip->name}}</h4>
                                <dl class="info">
                                    <dt>Booking Number</dt>
                                    <dd>{{$item->transaction->confirmation_number}}</dd>
                                    <dt>booked on</dt>
                                    <dd>{{$item->created_at}}</dd>
                                </dl>
                                <button class="btn-mini status">{{$item->isPast() ? 'PAST' : 'UPCOMMING'}}</button>
                            </div>
                            @endforeach
                        </div>
                        {!! $tickets->links() !!}
                    </div>
                    <div id="profile" class="tab-pane fade">
                        <div class="view-profile">
                            <article class="image-box style2 box innerstyle personal-details">
                                <figure>
                                    <a title="" href="#"><img width="270" height="263" alt="" src="http://placehold.it/270x263"></a>
                                </figure>
                                <div class="details">
                                    <a href="#" class="button btn-mini pull-right edit-profile-btn">EDIT PROFILE</a>
                                    <h2 class="box-title fullname">Jessica Brown</h2>
                                    <dl class="term-description">
                                        <dt>user name:</dt><dd>info@jessica.com</dd>
                                        <dt>first name:</dt><dd>jessica</dd>
                                        <dt>last name:</dt><dd>brown</dd>
                                        <dt>phone number:</dt><dd>1-800-123-HELLO</dd>
                                        <dt>Date of birth:</dt><dd>15 August 1985</dd>
                                        <dt>Street Address and number:</dt><dd>353 Third floor Avenue</dd>
                                        <dt>Town / City:</dt><dd>Paris,France</dd>
                                        <dt>ZIP code:</dt><dd>75800-875</dd>
                                        <dt>Country:</dt><dd>United States of america</dd>
                                    </dl>
                                </div>
                            </article>
                            <hr>
                            <h2>About You</h2>
                                <div class="intro">
                                <p>Vestibulum tristique, justo eu sollicitudin sagittis, metus dolor eleifend urna, quis scelerisque purus quam nec ligula. Suspendisse iaculis odio odio, ac vehicula nisi faucibus eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere semper sem ac aliquet. Duis vel bibendum tellus, eu hendrerit sapien. Proin fringilla, enim vel lobortis viverra, augue orci fringilla diam, sed cursus elit mi vel lacus. Nulla facilisi. Fusce sagittis, magna non vehicula gravida, ante arcu pulvinar arcu, aliquet luctus arcu purus sit amet sem. Mauris blandit odio sed nisi porttitor egestas. Mauris in quam interdum purus vehicula rutrum quis in sem. Integer interdum lectus at nulla dictum luctus. Sed risus felis, posuere id condimentum non, egestas pulvinar enim. Praesent pretium risus eget nisi ullamcorper fermentum. Duis lacinia nisi ac rhoncus vestibulum.</p>
                            </div>
                            <hr>
                            <h2>Today’s Suggestions</h2>
                            <div class="suggestions image-carousel style2" data-animation="slide" data-item-width="170" data-item-margin="22">
                                <ul class="slides">
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">Adventure</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">Beaches &amp; Sun</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">Casinos</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">Family Fun</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">History</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="hover-effect">
                                            <img src="http://placehold.it/170x170" alt="" />
                                        </a>
                                        <h5 class="caption">Adventure</h5>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Benefits of Tavelo Account</h4>
                                    <ul class="benefits triangle hover">
                                        <li><a href="#">Faster bookings with lesser clicks</a></li>
                                        <li><a href="#">Track travel history &amp; manage bookings</a></li>
                                        <li class="active"><a href="#">Manage profile &amp; personalize experience</a></li>
                                        <li><a href="#">Receive alerts &amp; recommendations</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 previous-bookings image-box style14">
                                    <h4>Your Previous Bookings</h4>
                                    <article class="box">
                                        <figure class="no-padding">
                                            <a title="" href="#">
                                                <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                            </a>
                                        </figure>
                                        <div class="details">
                                            <h5 class="box-title"><a href="#">Half-Day Island Tour</a><small class="fourty-space"><span class="price">$35</span> Family Package</small></h5>
                                        </div>
                                    </article>
                                    <article class="box">
                                        <figure class="no-padding">
                                            <a title="" href="#">
                                                <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                            </a>
                                        </figure>
                                        <div class="details">
                                            <h5 class="box-title"><a href="#">Ocean Park Tour</a><small class="fourty-space"><span class="price">$26</span> Per Person</small></h5>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-md-4">
                                    <h4>Need Travelo Help?</h4>
                                    <div class="contact-box">
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
                        <div class="edit-profile">
                            <form class="edit-profile-form">
                                <h2>Personal Details</h2>
                                <div class="col-sm-9 no-padding no-float">
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>First Name</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Last Name</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Email Address</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Verify Email Address</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Country Code</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>United Kingdom (+44)</option>
                                                    <option>United States (+1)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Phone Number</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <label>Date of Birth</label>
                                    <div class="row form-group">
                                        <div class="col-sms-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">date</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Contact Details</h2>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Street Name</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Address</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>City</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Country</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Region State</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Upload Profile Photo</h2>
                                    <div class="row form-group">
                                        <div class="col-sms-12 col-sm-6 no-float">
                                            <div class="fileinput full-width">
                                                <input type="file" class="input-text" data-placeholder="select image/s">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Describe Yourself</h2>
                                    <div class="form-group">
                                        <textarea rows="5" class="input-text full-width" placeholder="please tell us about you"></textarea>
                                    </div>
                                    <div class="from-group">
                                        <button type="submit" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="settings" class="tab-pane fade">
                        <h2>Account Settings</h2>
                        <h5 class="skin-color">Change Your Password</h5>
                        <form>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Old Password</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Enter New Password</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Confirm New password</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn-medium">UPDATE PASSWORD</button>
                            </div>
                        </form>
                        <hr>
                        <h5 class="skin-color">Change Your Email</h5>
                        <form>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Old email</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Enter New Email</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Confirm New Email</label>
                                    <input type="text" class="input-text full-width">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn-medium">UPDATE EMAIL ADDRESS</button>
                            </div>
                        </form>
                        <hr>
                        <h5 class="skin-color">Send Me Emails When</h5>
                        <form>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Travelo has periodic offers and deals on really cool destinations.
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Travelo has fun company news, as well as periodic emails.
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> I have an upcoming reservation.
                                </label>
                            </div>
                            <button class="btn-medium uppercase">Update All Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
