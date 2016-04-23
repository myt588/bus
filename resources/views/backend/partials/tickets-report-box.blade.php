<div class="box {{ $type }}">
    <!-- /.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">{{$header}}</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Trip Name</th>
                    <th>Depart Time</th>
                    <th>Arrive Time</th>
                    <th># of passengers</th>
                </tr>
            </thead>
            <tbody>
            @foreach($trips as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->depart_at }}</td>
                    <td>{{ $item->arrive_at }}</td>
                    <td>{{ $item->ticketsCountOn(stringToDate($date)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>