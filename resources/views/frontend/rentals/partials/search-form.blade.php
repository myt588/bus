{!! Form::open(['id' => 'rentalForm', 'method' => 'GET', 'url' => '/rentals/search']) !!}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Location</label>
                <div>
                    {{ Form::select('location', $cities, null, ['class' => 'input-text full-width location', 'multiple']) }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <div class="datepicker-wrap">
                    <input type="text" name="start" class="input-text full-width" placeholder="mm/dd/yy" value="{{ old('start') }}"/>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">End Date</label>
                <div class="datepicker-wrap">
                    <input type="text" name="end" class="input-text full-width" placeholder="mm/dd/yy" value="{{ old('end') }}"/>
                </div>
            </div>
            
        </div>
        
        <div class="col-md-3">
            <div class="form-group row">
                <div class="col-xs-6">
                    <label>Passengers</label>
                    <div class="selector">
                        {!! Form::select('passengers', ['5' => '5+', '10' => '10+', '20' => '20+', '30' => '30+', '40' => '40+'], '5') !!}
                    </div>
                </div>
                <div class="col-xs-6 pull-right">
                    <label>&nbsp;</label>
                    <button class="full-width icon-check">SEARCH NOW</button>
                </div>
            </div>
        </div>
    </div>
    @include('errors.error-list')
{!! Form::close() !!}