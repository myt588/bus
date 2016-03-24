@extends('layouts.frontend')

@section('title') Details @endsection @section('heading') Details @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Hotel Detailed</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Hotel Detailed</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container flight-detail-page">
        <div class="row">
            <div id="main" class="col-md-9">
                <div class="tab-container style1 box" id="flight-main-content">
                    <ul class="tabs">
                        <li class="active"><a data-toggle="tab" href="#photo-tab">photo</a></li>
                        <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li>
                        <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">BEFORE YOU FLY</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="photo-tab" class="tab-pane fade in active">
                            <div class="featured-image image-container">
                                <img src="http://placehold.it/870x530" alt="">
                            </div>
                        </div>
                        <div id="calendar-tab" class="tab-pane fade">
                            <label>SELECT MONTH</label>
                            <div class="col-sm-6 col-md-4 no-float no-padding">
                                <div class="selector">
                                    <select class="full-width" id="select-month">
                                        <option value="2014-6">June 2014</option>
                                        <option value="2014-7">July 2014</option>
                                        <option value="2014-8">August 2014</option>
                                        <option value="2014-9">September 2014</option>
                                        <option value="2014-10">October 2014</option>
                                        <option value="2014-11">November 2014</option>
                                        <option value="2014-12">December 2014</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="calendar"></div>
                                    <div class="calendar-legend">
                                        <label class="available">available</label>
                                        <label class="unavailable">unavailable</label>
                                        <label class="past">past</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p class="description">
                                        The calendar is updated every five minutes and is only an approximation of availability.
<br /><br />
Some hosts set custom pricing for certain days on their calendar, like weekends or holidays. The rates listed are per day and do not include any cleaning fee or rates for extra people the host may have for this listing. Please refer to the listing's Description tab for more details.
<br /><br />
We suggest that you contact the host to confirm availability and rates before submitting a reservation request.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="flight-features" class="tab-container">
                    <ul class="tabs">
                        <li class="active"><a href="#flight-details" data-toggle="tab">Flight Details</a></li>
                        <li><a href="#inflight-features" data-toggle="tab">Inflight Features</a></li>
                        <li><a href="#flgiht-seat-selection" data-toggle="tab">Seat Selection</a></li>
                        <li><a href="#flight-baggage" data-toggle="tab">Baggage</a></li>
                        <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="flight-details">
                            <div class="intro table-wrapper full-width hidden-table-sm box">
                                <div class="col-md-4 table-cell travelo-box">
                                    <dl class="term-description">
                                        <dt>Airline:</dt><dd>delta</dd>
                                        <dt>Flight Type:</dt><dd>Economy</dd>
                                        <dt>Fare type:</dt><dd>Refundable</dd>
                                        <dt>Cancellation:</dt><dd>$78 / person</dd>
                                        <dt>Flight CHange:</dt><dd>$53 / person</dd>
                                        <dt>Seats &amp; Baggage:</dt><dd>Extra Charge</dd>
                                        <dt>Inflight Features:</dt><dd>Available</dd>
                                        <dt>Base fare:</dt><dd>$320.00</dd>
                                        <dt>Taxes &amp; Fees:</dt><dd>$300.00</dd>
                                        <dt>total price:</dt><dd>$620.00</dd>
                                    </dl>
                                </div>
                                <div class="col-md-8 table-cell">
                                    <div class="detailed-features booking-details">
                                        <div class="travelo-box">
                                            <a href="#" class="button btn-mini yellow pull-right">1 STOP</a>
                                            <h4 class="box-title">Indianapolis to Paris<small>Oneway flight</small></h4>
                                        </div>
                                        <div class="table-wrapper flights">
                                            <div class="table-row first-flight">
                                                <div class="table-cell logo">
                                                    <img src="http://placehold.it/140x30" alt="">
                                                    <label>AI-635 Economy</label>
                                                </div>
                                                <div class="table-cell timing-detail">
                                                    <div class="timing">
                                                        <div class="check-in">
                                                            <label>Take off</label>
                                                            <span>13 Nov 2013, 7:50 am</span>
                                                        </div>
                                                        <div class="duration text-center">
                                                            <i class="soap-icon-clock"></i>
                                                            <span>1h 30m</span>
                                                        </div>
                                                        <div class="check-out">
                                                            <label>landing</label>
                                                            <span>13 Nov 2013, 9:20 Am</span>
                                                        </div>
                                                    </div>
                                                    <label class="layover">Layover : 3h 50m</label>
                                                </div>
                                            </div>
                                            <div class="table-row second-flight">
                                                <div class="table-cell logo">
                                                    <img src="http://placehold.it/140x30" alt="">
                                                    <label>AI-635 Economy</label>
                                                </div>
                                                <div class="table-cell timing-detail">
                                                    <div class="timing">
                                                        <div class="check-in">
                                                            <label>Take off</label>
                                                            <span>13 Nov 2013, 7:50 am</span>
                                                        </div>
                                                        <div class="duration text-center">
                                                            <i class="soap-icon-clock"></i>
                                                            <span>8h 20m</span>
                                                        </div>
                                                        <div class="check-out">
                                                            <label>landing</label>
                                                            <span>13 Nov 2013, 9:20 Am</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="long-description">
                                <h2>About Delta Airlines</h2>
                                <p>
                                    Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.
<br /><br />
Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec nec velit non odio aliquam suscipit. Sed non neque faucibus, condimentum lectus at, accumsan enim. Fusce pretium egestas cursus. Etiam consectetur, orci vel rutrum volutpat, odio odio pretium nisiodo tellus libero et urna. Sed commodo ipsum ligula, id volutpat risus vehicula in. Pellentesque non massa eu nibh posuere bibendum non sed enim. Maecenas lobortis nulla sem, vel egestas dui ullamcorper ac.
<br /><br />
Sed scelerisque lectus sit amet faucibus sodales. Proin ut risus tortor. Etiam fermentum tellus auctor, fringilla sapien et, congue quam. In a luctus tortor. Suspendisse eget tempor libero, ut sollicitudin ligula. Nulla vulputate tincidunt est non congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus at est imperdiet, dapibus ipsum vel, lacinia nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus id interdum lectus, ut elementum elit. Nullam a molestie magna. Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="inflight-features">
                            <h2>Features Style 01</h2>
                            <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                            <ul class="amenities clearfix style1 box">
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-entertainment"></i>entertainment</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-juice"></i>drink</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-joystick"></i>games</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-winebar"></i>wines</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-shopping"></i>shopping</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-food"></i>food</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-comfort"></i>comfort</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style1"><i class="soap-icon-magazine"></i>magazines</div>
                                </li>
                            </ul>
                            <h2>Features Style 02</h2>
                            <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                            <ul class="amenities clearfix style2">
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-juice circle"></i>drink</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-joystick circle"></i>games</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wines</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-shopping circle"></i>shopping</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-food circle"></i>food</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-comfort circle"></i>comfort</div>
                                </li>
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i class="soap-icon-magazine circle"></i>magazines</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="flgiht-seat-selection">
                            <h2>Select your Seats</h2>
                            <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map.  You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                            <hr>
                            <div class="image-box style12">
                                <article class="box">
                                    <figure>
                                        <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Standard advance seat selection</h4>
                                        <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor  vulputate nisi, et fringilla ante convallis quis. </p>
                                    </div>
                                    <div class="action">
                                        <span class="price"><small>starting at</small>$18</span>
                                        <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                    </div>
                                </article>
                                <hr>
                                <article class="box">
                                    <figure>
                                        <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Standard advance seat selection</h4>
                                        <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor  vulputate nisi, et fringilla ante convallis quis. </p>
                                    </div>
                                    <div class="action">
                                        <span class="price"><small>starting at</small>$18</span>
                                        <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                    </div>
                                </article>
                                <hr>
                                <article class="box">
                                    <figure>
                                        <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Standard advance seat selection</h4>
                                        <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor  vulputate nisi, et fringilla ante convallis quis. </p>
                                    </div>
                                    <div class="action">
                                        <span class="price"><small>starting at</small>$18</span>
                                        <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                    </div>
                                </article>
                                <hr>
                                <article class="box">
                                    <figure>
                                        <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Standard advance seat selection</h4>
                                        <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor  vulputate nisi, et fringilla ante convallis quis. </p>
                                    </div>
                                    <div class="action">
                                        <span class="price"><small>starting at</small>$18</span>
                                        <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="flight-baggage">
                            <div class="travelo-box border-box box clearfix">
                                <form>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">From</h5>
                                            <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">To</h5>
                                            <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">Top Tier Status</h5>
                                            <div class="selector full-width">
                                                <select>
                                                    <option value="">super elite 100K</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">Bag weight</h5>
                                            <div class="selector full-width">
                                                <select>
                                                    <option value="">20kgs (44lbs)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">Class of service</h5>
                                            <input type="text" class="input-text full-width" placeholder="economy class">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <div class="form-group">
                                            <h5 class="title">&nbsp;</h5>
                                            <button class="full-width icon-check uppercase">View baggage allowance</button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox">Infant/child (0 to 11 years) occupying a seat (with own ticket)
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <h2>Baggage</h2>
                            <p>In this section you'll find information on baggage allowances, special equipment and sports items as well as restricted items. We've also included some tips to make your trip more enjoyable.</p>
                            <div class="baggage column-5">
                                <div class="icon-box style9">
                                    <i class="soap-icon-carryon"></i>
                                    <h5 class="box-title">Carry-on<br>Allowance</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-baggage"></i>
                                    <h5 class="box-title">Baggage<br>Allowance</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-delayed-baggage"></i>
                                    <h5 class="box-title">Delayed<br>Baggage</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-damaged-baggage"></i>
                                    <h5 class="box-title">Damaged<br>Baggage</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-baggage-status"></i>
                                    <h5 class="box-title">Baggage<br>Status</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-phone"></i>
                                    <h5 class="box-title">Baggage<br>Services</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-status"></i>
                                    <h5 class="box-title">Baggage<br>Tips</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-restricted"></i>
                                    <h5 class="box-title">Restricted<br>Items</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-liability"></i>
                                    <h5 class="box-title">Liability<br>Limitations</h5>
                                </div>
                                <div class="icon-box style9">
                                    <i class="soap-icon-lost-found"></i>
                                    <h5 class="box-title">Lost and<br>Found</h5>
                                </div>
                            </div>

                            <hr>
                            <h2>Basic Information</h2>
                            <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.</p>
                        </div>
                        <div class="tab-pane fade" id="flight-fare-rules">
                            <h2>Fare Rules for your Flight</h2>
                            <div class="topics">
                                <ul class="check-square clearfix">
                                    <li class="col-sm-6 col-md-4"><a href="#">Rules and Policies</a></li>
                                    <li class="col-sm-6 col-md-4"><a href="#">Flight Changes</a></li>
                                    <li class="col-sm-6 col-md-4"><a href="#">refunds</a></li>
                                    <li class="col-sm-6 col-md-4"><a href="#">Airline Penalties</a></li>
                                    <li class="col-sm-6 col-md-4 active"><a href="#">Flight Cancellation</a></li>
                                    <li class="col-sm-6 col-md-4"><a href="#">Airline terms of use</a></li>
                                </ul>
                            </div>
                            <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                            <div class="toggle-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question1" data-toggle="collapse">Flight cancellation charges</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question1">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question2" data-toggle="collapse">WAmendment in higher class charges</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question2">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="" href="#question3" data-toggle="collapse">Amendment in same class charges</a>
                                    </h4>
                                    <div class="panel-collapse collapse in" id="question3">
                                        <div class="panel-content">
                                            <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question4" data-toggle="collapse">Rebooking/cancellation charges</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question4">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question5" data-toggle="collapse">Canellation through the customer support</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question5">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question6" data-toggle="collapse">Do we accept cancellations through email?</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question6">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a class="collapsed" href="#question7" data-toggle="collapse">What is the minimum day limit of cancellation?</a>
                                    </h4>
                                    <div class="panel-collapse collapse" id="question7">
                                        <div class="panel-content">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-md-3">
                <article class="detailed-logo">
                    <figure>
                        <img src="http://placehold.it/270x160" alt="">
                    </figure>
                    <div class="details">
                        <h2 class="box-title">Indianapolis to Paris<small>Oneway flight</small></h2>
                        <span class="price clearfix">
                            <small class="pull-left">avg/person</small>
                            <span class="pull-right">$620</span>
                        </span>
                        
                        <div class="duration">
                            <i class="soap-icon-clock"></i>
                            <dl>
                                <dt class="skin-color">Total Time:</dt>
                                <dd>13 Hour, 40 minutes</dd>
                            </dl>
                        </div>
                        
                        <p class="description">Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                        <a href="flight-booking.html" class="button green full-width uppercase btn-medium">book flight now</a>
                    </div>
                </article>
                <div class="travelo-box contact-box">
                    <h4>Need Travelo Help?</h4>
                    <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                    <address class="contact-details">
                        <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                        <br>
                        <a class="contact-email" href="#">help@travelo.com</a>
                    </address>
                </div>
                <div class="travelo-box book-with-us-box">
                    <h4>Why Book with us?</h4>
                    <ul>
                        <li>
                            <i class="soap-icon-hotel-1 circle"></i>
                            <h5 class="title"><a href="#">135,00+ Hotels</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                            <i class="soap-icon-savings circle"></i>
                            <h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                            <i class="soap-icon-support circle"></i>
                            <h5 class="title"><a href="#">Excellent Support</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script type="text/javascript" src="/js/calendar.js"></script>
<script type="text/javascript">
    tjq(document).ready(function() {
        // calendar panel
        var cal = new Calendar();
        var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        var price_arr = {3: '$170', 4: '$170', 5: '$170', 6: '$170', 7: '$170', 8: '$170', 9: '$170', 10: '$170', 11: '$170', 12: '$170', 13: '$170', 14: '$170', 15: '$170', 16: '$170', 17: '$170'};

        var current_date = new Date();
        var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
        tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
        cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
        tjq(".calendar").html(cal.getHTML());
        
        tjq("#select-month").change(function() {
            var selected_year_month = tjq("#select-month option:selected").val();
            var year = parseInt(selected_year_month.split("-")[0], 10);
            var month = parseInt(selected_year_month.split("-")[1], 10);
            cal.generateHTML(month - 1, year, unavailable_days, price_arr);
            tjq(".calendar").html(cal.getHTML());
        });
        
        
        tjq(".goto-writereview-pane").click(function(e) {
            e.preventDefault();
            tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show');
        });
        
        // editable rating
        tjq(".editable-rating.five-stars-container").each(function() {
            var oringnal_value = tjq(this).data("original-stars");
            if (typeof oringnal_value == "undefined") {
                oringnal_value = 0;
            } else {
                oringnal_value = 10 * parseInt(oringnal_value);
            }
            tjq(this).slider({
                range: "min",
                value: oringnal_value,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });
    });
</script>
@endsection