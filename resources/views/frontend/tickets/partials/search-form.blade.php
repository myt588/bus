{!! Form::open(['id' => 'ticketForm', 'method' => 'GET', 'url' => '/tickets/search']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group" id="the-basics">
                <label class="control-label">Leaving From</label>
                {{ Form::select('leaving_from', $cities, null, ['class' => 'input-text full-width leaving_from', 'multiple']) }}
            </div>
            <div class="form-group">
                <label class="control-label">Going To</label>
                {{ Form::select('going_to', $cities, null, ['class' => 'input-text full-width going_to', 'multiple']) }}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Depart</label>
                <div class="datepicker-wrap">
                    <input type="text" name="depart" class="input-text full-width" placeholder="mm/dd/yy" value="{{ old('depart') }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Return</label>
                <div id="return-div" class="datepicker-wrap">
                    <input type="text" id = "return" name="return" class="input-text full-width" placeholder="mm/dd/yy" value="{{ old('return') }}"/>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group row">
                <div class="col-xs-3">
                    <label>Adults</label>
                    <div class="selector">
                        <select class="full-width" name="adults">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-3">
                    <label>Kids</label>
                    <div class="selector">
                        <select class="full-width" name="kids">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 pull-right">
                    <label>&nbsp;</label>
                    <button class="full-width icon-check">SEARCH NOW</button>
                </div>
            </div>
            <div class="form-group">
            <label>&nbsp;</label>
                <div class="radio radio-inline">
                    <label>
                    {!! Form::radio('options', 'one-way', (old('options') == 'one-way') ? true : false, ['id' => 'one-way']) !!}
                        One way
                    </label>
                </div>
                <div class="radio radio-inline">
                    <label>
                    {!! Form::radio('options', 'round-trip', (old('options') == 'one-way') ? false : true, ['id' => 'round-trip']) !!}
                        Round Trip
                    </label>
                </div>
            </div>
        </div>
    </div>
    @include('errors.error-list')
{!! Form::close() !!}