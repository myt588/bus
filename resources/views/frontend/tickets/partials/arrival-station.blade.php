
<div class="check-in">
    <label>{{ $trip_two_DS->name }}</label>
    <span>{{ $data['return'] . ' ' . $trip_one_DS->stationTime() }}</span>
</div>
<div class="duration text-center">
    <i class="soap-icon-clock"></i>
    <span>{{ $trip_two->totalTime() }}</span>
</div>
<div class="check-out">
    <label>{{ $trip_two_AS->name }}</label>
    <span>{{ $data['return'] . ' ' . $trip_one_AS->stationTime() }}</span>
</div>
