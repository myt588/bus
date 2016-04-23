<div class="box {{$type}}">
    <!-- /.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">{{ $header }}</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>Trip Name</th>
                    <th>Date</th>
                    <th>Depart</th>
                    <th>Arrive</th>
                    <th>Tickets</th>
                    <th>Price</th>
                    <th>Profit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($trips as $trip)
                @if($break && $x==1)
                @break; 
                @endif
                @foreach($trip as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $date = stringToDate($dateSign . $x . ' day')}}</td>
                        <td>{{ $item->depart_at }}</td>
                        <td>{{ $item->arrive_at }}</td>
                        @if($booked)
                        <td>{{ $count = $item->ticketsBookedCountOn($date) }}</td>
                        @else
                        <td>{{ $count = $item->ticketsSoldCountOn($date) }}</td>
                        @endif
                        <td>${{ $price = $item->price() }}</td>
                        <td>${{ $count * $price }} </td>
                        <td>
                            <a class="btn btn-info btn-xs" href="{{route('admin::admin.tickets.show', ['id' => $item->id, 'date' => $date])}}">
                               Details
                            </a> 
                        </td>
                    </tr>
                @endforeach
                {{-- */$x++;/* --}}
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Total:</th>
                    <th colspan="2" style="text-align:right"></th>
                    <th colspan="2" style="text-align:right"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>