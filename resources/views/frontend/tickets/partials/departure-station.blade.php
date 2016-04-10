<div class="check-in">
    <label>{{ $trip_one_DS->name }}</label>
    <span>{{ $data['depart'] . ' ' . $trip_one_DS->stationTime() }}</span>
</div>
<div class="duration text-center">
    <i class="soap-icon-clock"></i>
    <span>{{ $trip_one->totalTime() }}</span>
</div>
<div class="check-out">
    <label>{{ $trip_one_AS->name }}</label>
    <span>{{ $data['depart'] . ' ' . $trip_one_AS->stationTime() }}</span>
</div>