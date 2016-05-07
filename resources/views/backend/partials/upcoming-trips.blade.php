{{-- */$x=0;/* --}}
@foreach($trips as $trip)
    @foreach($trip as $item)
        <div class="panel panel-success event">
            <div class="panel-heading">
                <div class="event-date">
                    <div class="month" style="text-transform:uppercase;">
                        {{getMonth($date = stringToDate($dateSign . $x . ' day'))}}
                    </div>
                    <div class="day">
                        {{getDay($date)}}
                    </div>
                </div>
                <ul class="event-meta">
                    <li class="event-title">
                        <a href="http://attendize.website/event/1/dashboard"> {{$item->name}}</a>
                    </li>
                    <li class="event-organiser">
                        <a href="http://attendize.website/organiser/1/dashboard">{{$item->subname()}}</a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section text-center">
                            <h4 >{{$count = $item->ticketsBookedCountOn($date)}}</h4>
                            <p>Tickets Booked</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section text-center">
                            <h4>{{$count * $item->price()}}</h4>
                            <p>Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    @endforeach
    {{-- */$x++;/* --}}
@endforeach
