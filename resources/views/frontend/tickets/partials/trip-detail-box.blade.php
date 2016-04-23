<div class="intro small-box table-wrapper full-width hidden-table-sms">
    @if($checkout)
    <div class="col-sm-4 table-cell cruise-itinerary">
        <div class="travelo-box">
            <h4 class="box-title">Traveler's Names</h4>
            <label>Adults:</label>
            @for($i = 1 ; $i < $adults + 1 ; $i ++)
            <div class="form-group">
                @if ($errors->has($adults_id . '_' . $i))
                    <span>
                        <strong>required</strong>
                    </span>
                @endif
                <input name="{{$adults_id . '_' . $i}}" type="text" class="input-text full-width" value="" placeholder="Traveler Name {{$i}}" />
            </div>
            @endfor
            @if($kids != 0)
            <label>Kids:</label>
            @for($i = 1 ; $i < $kids + 1 ; $i ++)
            <div class="form-group">
                @if ($errors->has($kids_id . '_' . $i))
                    <span>
                        <strong>required </strong>
                    </span>
                @endif
                <input name="{{$kids_id . '_' . $i}}" type="text" class="input-text full-width" value="" placeholder="Child Name {{$i}}" />
            </div>
            @endfor
            @endif
        </div>
    </div>
    @else
    <div class="col-sm-4 table-cell travelo-box">
        <dl class="term-description">
            <dt>Operator:</dt><dd>{{ $trip->companyName() }}</dd>
            <dt>Bus Number:</dt><dd>{{ $trip->bus->bus_number }}</dd>
            <dt>Terms & Conditions:</dt><dd>view</dd>
            <dt>Adult:</dt><dd>{!! Form::select('adults', ['0', '1', '2', '3', '4'], $adults, ['id' => $adults_id]) !!}</dd>
            <dt>Children:</dt><dd>{!! Form::select('kids', ['0', '1', '2', '3', '4'], $kids, ['id' => $kids_id]) !!}</dd>
            <dt>Fare:</dt><dd>${{ ($adults + $kids) * $trip->price() }}</dd>
        </dl>
    </div>
    @endif
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
                        <dd>{{ $date . ' ' . $trip_DS->stationTime() }}</dd>
                    </dl>
                </div>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-departure"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">Location</dt>
                        <dd>{{ $trip_DS->fullAddress() }}</dd>
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
                        <dd>{{ $date . ' ' . $trip_AS->stationTime() }} </dd>
                    </dl>
                </div>
                <div class="icon-box style11">
                    <div class="icon-wrapper">
                        <i class="soap-icon-departure"></i>
                    </div>
                    <dl class="details">
                        <dt class="skin-color">Location</dt>
                        <dd>{{ $trip_AS->fullAddress() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>