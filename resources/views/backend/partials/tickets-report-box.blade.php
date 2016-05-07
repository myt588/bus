@foreach($trips as $trip)
<div class="box box-success">
    <!-- /.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ $trip->name }}
            <small>{{$trip->subname()}}</small>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Tickets</th>
                    <th>Price</th>
                    <th>Profit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$start_date = isSet($start) ? $start : 'today';/* --}}
            {{-- */$end_date = isSet($end) ? $end : 'today - 10 days';/* --}}
            @foreach($trip->availableDatesBetween($start_date, $end_date) as $date)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $count = $trip->ticketsBookedCountOn($date) }}</td>
                    <td>${{ $price = $trip->price() }}</td>
                    <td>${{ $count * $price }} </td>
                    <td>
                        <a class="btn btn-info btn-xs" href="{{route('admin::tickets.show', ['id' => $trip->id, 'date' => $date])}}">
                           Details
                        </a> 
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="1">Total:</th>
                    <th colspan="1"></th>
                    <th colspan="2" style="text-align:right"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endforeach