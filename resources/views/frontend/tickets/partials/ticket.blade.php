<div class="intro small-box table-wrapper full-width hidden-table-sms">
    <div class="col-sm-4 table-cell travelo-box">
        <dl class="term-description">
            <dt>Passenger Name:</dt><dd>{{ $ticket->description }}</dd>
            <dt>Operator:</dt><dd>{{ $trip->companyName() }}</dd>
            <dt>Bus Number:</dt><dd>{{ $trip->bus->bus_number }}</dd>
            <dt>Terms & Conditions:</dt><dd><a href="{{route('policy', $trip->company->id)}}">view</a></dd>
        </dl>
    </div>
    <div class="col-sm-8 table-cell">
        <div class="detailed-features clearfix">
            <div class="col-md-6">
                <h4 class="box-title">
                    {{ $trip->fromCity->city . ', ' . $trip->fromCity->state}}
                    <small>From</small>
                </h4>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-clock"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">departure time</dt>
                        <dd>{{ $date . ' ' . $trip_DS->pivot->time }}</dd>
                    </dl>
                </div>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-departure"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">Location</dt>
                        <dd><a class="yellow popup-map" href="#" data-box="{{$trip_DS->getLocationPoint()}}">
                            {{ $trip_DS->fullAddress() }} 
                        </a></dd>
                    </dl>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="box-title">
                    {{ $trip->toCity->city . ', ' . $trip->toCity->state}}
                    <small>To</small>
                </h4>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-clock"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">Arrival Time</dt>
                        <dd>{{ $date . ' ' . $trip_AS->pivot->time }} </dd>
                    </dl>
                </div>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-departure"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">Location</dt>
                        <dd><a class="yellow popup-map" href="#" data-box="{{$trip_AS->getLocationPoint()}}">
                            {{ $trip_AS->fullAddress() }}
                        </a></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>