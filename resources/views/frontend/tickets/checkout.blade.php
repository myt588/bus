@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Checkout @endsection @section('heading') Checkout @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Ticket Checkout</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Ticket Checkout</li>
        </ul>
    </div>
</div>

@endsection

@section('content')

<section id="content" class="grey-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                {!! Form::open(['route' => 'tickets.pay', 'class' => 'booking-form', 'id' => 'payment-form']) !!}
                    @if(array_key_exists('trip_two_id', $data)) 
                    {!! Form::number('trip_two_id', $data['trip_two_id'], ['hidden']) !!}
                    {!! Form::number('trip_two_DS', $data['trip_two_DS'], ['hidden']) !!}
                    {!! Form::number('trip_two_AS', $data['trip_two_DS'], ['hidden']) !!}
                    {!! Form::text('adults_return', $data['adults_return'], ['hidden']) !!}
                    {!! Form::text('kids_return', $data['kids_return'], ['hidden']) !!}
                    {!! Form::text('return', $data['return'], ['hidden']) !!}
                    @endif
                    {!! Form::number('trip_one_id', $data['trip_one_id'], ['hidden']) !!}
                    {!! Form::number('trip_one_DS', $data['trip_one_DS'], ['hidden']) !!}
                    {!! Form::number('trip_one_AS', $data['trip_one_AS'], ['hidden']) !!}
                    {!! Form::text('totalPrice', (array_key_exists('trip_two_id', $data) ? 
                    $trip_one->price() * ($data['adults_depart'] + $data['kids_depart']) + $trip_two->price() * ($data['adults_return'] + $data['kids_return']) : 
                    $trip_one->price() * ($data['adults_depart'] + $data['kids_depart'])), ['hidden']) !!}
                    @include('frontend.tickets.partials.search-form-hidden', $data)
                    <div class="booking-section travelo-box">
                        <div class="tab-pane fade in active" id="car-details">
                            @include('frontend.tickets.partials.trip-detail-box', [
                                'trip'      => $trip_one, 
                                'trip_DS'   => $trip_one_DS, 
                                'trip_AS'   => $trip_one_AS, 
                                'date'      => $data['depart'], 
                                'adults'    => $data['adults_depart'],
                                'kids'      => $data['kids_depart'],
                                'adults_id' => 'adults_depart',
                                'kids_id'   => 'kids_depart',
                                'checkout'  => true    
                            ])
                            @if(array_key_exists('trip_two_id', $data))
                            @include('frontend.tickets.partials.trip-detail-box', [
                                'trip'      => $trip_two, 
                                'trip_DS'   => $trip_two_DS, 
                                'trip_AS'   => $trip_two_AS, 
                                'date'      => $data['depart'], 
                                'adults'    => $data['adults_return'],
                                'kids'      => $data['kids_return'],
                                'adults_id' => 'adults_return',
                                'kids_id'   => 'kids_return',
                                'checkout'  => true
                            ])
                            @endif
                        </div>
                        <hr />
                        <div class="person-information">
                            <h2>Your Personal Information</h2>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>first name</label>
                                    <input name="first_name" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->first_name : "" }}" placeholder="" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>last name</label>
                                    <input name="last_name" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->last_name : "" }}" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>email address</label>
                                    <input name="email" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->email : "" }}" placeholder="" />
                                </div>
                                @if(!Auth::check())
                                <div class="col-sm-6 col-md-5">
                                    <label>Verify E-mail Address</label>
                                    <input name="email_re" type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Country code</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option>United States (+1)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Phone number</label>
                                    <input name="phone" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->phone : "" }}" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input name="subscribe" type="checkbox"> I want to receive <span class="skin-color">Travelo</span> promotional offers in the future
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <div class="card-information">
                            <span class="payment-errors"></span>
                            <h2>Your Card Information</h2>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Card number</label>
                                    <input type="text" class="input-text full-width" size="20" data-stripe="number" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>CVC</label>
                                    <input type="text" class="input-text full-width" size="4" data-stripe="cvc"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>
                                        <span>Expiration (MM/YYYY)</span>
                                        <input type="text" class="input-text" size="2" data-stripe="exp-month"/>
                                        <span> / </span>
                                        <input type="text" class="input-text" size="4" data-stripe="exp-year"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input name="agreement" type="checkbox"> By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-md-5">
                                <button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
                            </div>
                        </div>
                    </div>
                    @include('errors.error-list')
                {{ Form::close() }}
            </div>
            <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                <div class="booking-details travelo-box">
                    <h4>Booking Details</h4>
                    <article class="flight-booking-details">

                        <div class="travel-title">
                            <h5 class="box-title">{{$trip_one->name}}<small>{{ array_key_exists('trip_two_id', $data) ? 'round-trip' : 'one-way' }}</small></h5>
                            <a href="{{URL::route('tickets.picked', $data, null)}}" class="button">EDIT</a>
                        </div>

                        @include('frontend.tickets.partials.trip-detail-box2', ['trip' => $trip_one, 'trip_DS' => $trip_one_DS, 'trip_AS' => $trip_one_AS, 'date' => $data['depart']])
                        @if(array_key_exists('trip_two_id', $data))
                        @include('frontend.tickets.partials.trip-detail-box2', ['trip' => $trip_two, 'trip_DS' => $trip_two_DS, 'trip_AS' => $trip_two_AS, 'date' => $data['return']])
                        @endif
                    </article>
                    
                    <h4>Other Details</h4>
                    <dl class="other-details">
                        <dt class="feature">Operator:</dt><dd class="value">{{$trip_one->companyName()}}</dd>
                        <dt class="total-price">Total Price</dt><dd class="total-price-value">$@include('frontend.tickets.partials.total-price')</dd>
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

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    // This identifies your website in the createToken call below
    jQuery(document).ready(function($) {
        Stripe.setPublishableKey('pk_test_xnJM4eg3x5Fcse8fSFj1LnxQ');
        var stripeResponseHandler = function(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and re-submit
                $form.get(0).submit();
            }
        };
        $('#payment-form').submit(function(event) {
            var $form = $(this);

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });
</script>

@endsection