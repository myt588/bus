<h4 class="search-results-title"><i class="soap-icon-search"></i><b>{{ $rentals->count() }}</b> results found.</h4>
<div class="toggle-container filters-container">
    <div class="panel style1 arrow-right">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#price-filter" class="filter collapsed">Price</a>
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
            <a data-toggle="collapse" href="#cartype-filter" class="filter collapsed">Type</a>
        </h4>
        <div id="cartype-filter" class="panel-collapse collapse filters-container">
            <div class="panel-content">
                <ul class="check-square filters-option">
                    {{-- */$i = 0/* --}}
                    @foreach($types as $type => $count)
                    <li id="type_{{$i}}"><a href="#">{{$type}}<small>({{$count}})</small></a></li>
                    {{-- */$i ++/* --}}
                    @endforeach
                </ul>
                <a id="type_count" class="button btn-mini">{{count($types)}} Types</a>
            </div>
        </div>
    </div>
    
    <div class="panel style1 arrow-right">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#airlines-filter" class="filter collapsed">Operators</a>
        </h4>
        <div id="airlines-filter" class="panel-collapse collapse">
            <div class="panel-content">
                <ul class="check-square filters-option">
                    <li id="all" class="active"><a href="">All</a></li>
                    {{-- */$temp = null/* --}}
                    {{-- */$x = 0/* --}}
                    @foreach($rentals as $item)
                    @if($temp != null && $temp->company == $item->company) 
                    @else
                    <li id="company_{{$x}}" class="company_options"><a href="">{{$item->company->name}}</a></li>
                    @endif 
                    {{-- */$temp = $item;/* --}}
                    {{-- */$x ++/* --}}
                    @endforeach
                </ul>
                <a id="count" class="button btn-mini">{{$x-1}} Companies</a>
            </div>
        </div>
    </div>
    <div class="panel style1 arrow-right">
        <button id="filter" class="full-width">Filter Results</button>
    </div>
</div>
