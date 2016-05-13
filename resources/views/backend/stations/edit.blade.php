@extends('layouts.backend')

@section('css')

<link rel="stylesheet" type="text/css" href="/css/app.css" />

@endsection

@section('title') Station Homepage @endsection @section('heading') Station @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/stations">Station</a></li>
    <li><a href="/admin/stations/%{{$station->id}}/edit">Edit</a></li>

@endsection

@section('content')

<div class="box box-warning"> 
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                {!! Form::model($station, [
                    'method' => 'PATCH',
                    'url' => ['admin/stations', $station->id],
                    'class' => 'form-horizontal'
                ]) !!}
                
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} @can('admin') @else hidden @endcan">
                    {!! Form::label('company_id', 'Company: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        @can('admin')
                        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
                        @else
                        {!! Form::select('company_id', $companies, Auth::user()->company_id, ['class' => 'form-control']) !!}
                        @endcan
                        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    {!! Form::label('address', 'Address: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                    {!! Form::label('city', 'City: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('city', $station->city->city, ['class' => 'form-control', 'placeholder' => 'Enter..', 'readonly']) !!}
                        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                    {!! Form::label('state', 'State: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('state', $station->city->state, ['class' => 'form-control', 'placeholder' => 'Enter..', 'readonly']) !!}
                        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
                    {!! Form::label('zipcode', 'ZipCode: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('zipcode', $station->city->zipcode, ['class' => 'form-control', 'placeholder' => 'Enter..', 'readonly']) !!}
                        {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
                
                <!-- hidden form for lat and lng -->
                {!! Form::text('lat', null, ['hidden', 'id' => 'lat']) !!}
                {!! Form::text('lng', null, ['hidden', 'id' => 'lng']) !!}

                {!! Form::close() !!}
            </div>
            <div id="map" class="col-md-6"></div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBUdG-LWODBF8OiWvhRy8t0b2KGF69jjpE"></script>
<script src="/js/typeahead.bundle.js"></script>
<script src="/js/typeahead-addresspicker.min.js"></script>
<script>

// instantiate the addressPicker suggestion engine (based on bloodhound)
var addressPicker = new AddressPicker({
    map: {
        id: '#map',
        zoom: 14,
        center: MAP_CENTER = new google.maps.LatLng({{$station->lat}}, {{$station->lng}}),
    },
    autocompleteService: {
        componentRestrictions: { country: 'US' }
    },
    marker: {
        visible: true,
        position: MAP_CENTER
    }
});

// instantiate the typeahead UI
$('#address').typeahead({
    hint: false,
    highlight: true 
    }, {
    displayKey: 'description',
    source: addressPicker.ttAdapter(),
    templates: {
      empty: '<div class="tt-suggestion"><p style="white-space: normal;">Nothing Found..</p></div>'
    }//templates
});


// Bind some event to update map on autocomplete selection
$('#city').bind("typeahead:selected", addressPicker.updateMap);
$('#city').bind("typeahead:cursorchanged", addressPicker.updateMap);

// Proxy inputs typeahead events to addressPicker
addressPicker.bindDefaultTypeaheadEvent($('#address'));

// Listen for selected places result
$(addressPicker).on('addresspicker:selected', function (event, result) {
    console.log(result);
    var address = result.placeResult.adr_address;
    var addr = $(address).filter(".street-address").text();
    var city = $(address).filter(".locality").text();
    var state = $(address).filter(".region").text();
    var zipcode = $(address).filter(".postal-code").text();
    $('#address').typeahead('val', addr);
    $('#city').val(city);
    $('#state').val(state);
    $('#zipcode').val(zipcode);
    $('#address').typeahead('close');
});

</script>
@endsection