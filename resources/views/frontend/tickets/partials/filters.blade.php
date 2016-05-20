<h4 class="search-results-title"><i class="soap-icon-search"></i><b>{{ $trips->count() }}</b> results found.</h4>
<div class="toggle-container filters-container">
    <div class="panel style1 arrow-right">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
        </h4>
        <div id="price-filter" class="panel-collapse collapse">
            <div class="panel-content">
                <div id="price-range"></div>
                <br />
                <span class="min-price-label pull-left"></span>
                <span class="max-price-label pull-right"></span>
                <div class="clearer"></div>
            </div><!-- end content -->
        </div>
    </div>
    
    <div class="panel style1 arrow-right">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Departure Times</a>
        </h4>
        <div id="flight-times-filter" class="panel-collapse collapse">
            <div class="panel-content">
                <div id="flight-times" class="slider-color-yellow"></div>
                <br />
                <span class="start-time-label pull-left"></span>
                <span class="end-time-label pull-right"></span>
                <div class="clearer"></div>
            </div><!-- end content -->
        </div>
    </div>
    
    <div class="panel style1 arrow-right">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Operators</a>
        </h4>
        <div id="airlines-filter" class="panel-collapse collapse">
            <div class="panel-content">
                <ul class="check-square filters-option">
                    <li><a href="#">Major Airline<small>($620)</small></a></li>
                    <li><a href="#">United Airlines<small>($982)</small></a></li>
                    <li class="active"><a href="#">delta airlines<small>($1,127)</small></a></li>
                    <li><a href="#">Alitalia<small>($2,322)</small></a></li>
                    <li><a href="#">US airways<small>($3,158)</small></a></li>
                    <li><a href="#">Air France<small>($4,239)</small></a></li>
                    <li><a href="#">Air tahiti nui<small>($5,872)</small></a></li>
                </ul>
                <a class="button btn-mini">MORE</a>
            </div>
        </div>
    </div>
</div>