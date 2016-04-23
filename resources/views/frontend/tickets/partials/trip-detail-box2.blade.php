
<div class="details">
    <div class="constant-column-3 timing clearfix">
		<div class="check-in">
		    <span>{{ $date . ' ' . $trip_DS->stationTime() }}</span>
		</div>
		<div class="duration text-center">
		    <i class="soap-icon-clock"></i>
		    <span>{{ $trip->totalTime() }}</span>
		</div>
		<div class="check-out">
		    <span>{{ $date . ' ' . $trip_AS->stationTime() }}</span>
		</div>
    </div>
</div>