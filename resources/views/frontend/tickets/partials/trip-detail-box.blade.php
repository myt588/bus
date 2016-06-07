{{-- */$a=['0', '1', '2', '3', '4'];/* --}}
<div class="intro small-box table-wrapper full-width hidden-table-sms">
    @if($checkout)
    <div class="col-sm-4 table-cell cruise-itinerary">
        <div class="travelo-box">
            <h4 class="box-title">Traveler's Names</h4>
            <label>Adults:</label>
            @for($i = 0 ; $i < $adults ; $i ++)
            <div class="form-group">
                @if ($errors->has($adults_id . '_' . $i))
                    <span>
                        <strong>required</strong>
                    </span>
                @endif
                <input name="{{$adults_id}}[]" type="text" class="input-text full-width" value="" placeholder="Traveler Name {{$i + 1}}" />
            </div>
            @endfor
            @for($i = 0 ; $i < $kids ; $i ++)
            @if($i == 0)
            <label>Kids:</label>
            @endif
            <div class="form-group">
                @if ($errors->has($kids_id . '_' . $i))
                    <span>
                        <strong>required </strong>
                    </span>
                @endif
                <input name="{{$kids_id}}[]" type="text" class="input-text full-width" value="" placeholder="Child Name {{$i + 1}}" />
            </div>
            @endfor
        </div>
    </div>
    @else
    <div class="col-sm-4 table-cell travelo-box">
        <dl class="term-description">
            <dt>Operator:</dt><dd>{{ $trip->companyName() }}</dd>
            <dt>Bus Number:</dt><dd>{{ $trip->bus->bus_number }}</dd>
            <dt>Terms & Conditions:</dt><dd><a href="{{route('policy', $trip->company->id)}}">view</a></dd>
            <dt>Adult:</dt><dd>{!! Form::select('adults[]', $a, $adults, ['id' => $adults_id, 'style' => 'height: 10px']) !!}</dd>
            <dt>Children:</dt><dd>{!! Form::select('kids[]', $a, $kids, ['id' => $kids_id, 'style' => 'height: 10px']) !!}</dd>
            <dt>Price / Person:</dt><dd id="{{'price_'.$adults_id}}">${{ ($adults + $kids) * $trip->fee }} / Person</dd>
            <dt>Total Fare:</dt><dd id="{{'fare_'.$adults_id}}">${{ ($adults + $kids) * $trip->fee }}</dd>
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
                        <dd>{{ $date . ' ' . $trip_AS->stationTime() }} </dd>
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