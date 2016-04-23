@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Ticket Homepage @endsection 

@section('heading') 

    Ticket 

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/tickets">Ticket</a></li>
    <li><a href="/admin/tickets">Index</a></li>

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Booked For Today',
                    'type'      => 'box-primary',
                    'trips'     => $trips_today,
                    'dateSign'  => 'today +',
                    'break'     => true,
                    'booked'    => true,
                    ])
            @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Booked For Tomorrow',
                    'type'      => 'box-primary',
                    'trips'     => $trips_booked,
                    'dateSign'  => 'tomorrow +',
                    'break'     => true,
                    'booked'    => true,
                    ])
            @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Booked For Next Week',
                    'type'      => 'box-warning',
                    'trips'     => $trips_booked,
                    'dateSign'  => 'tomorrow +',
                    'break'     => false,
                    'booked'    => true,
                    ])
        </div>
        <div class="col-md-6">
            @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Sold Today',
                    'type'      => 'box-success',
                    'trips'     => $trips_today,
                    'dateSign'  => 'today -',
                    'break'     => true,
                    'booked'    => false,
                    ])
            @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Sold Last Week',
                    'type'      => 'box-success',
                    'trips'     => $trips_sold,
                    'dateSign'  => 'yesterday -',
                    'break'     => false,
                    'booked'    => false,
                    ])
        </div>
    </div>

</section>

@endsection

@section('js')
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
    $(function () {
        $(".dataTable").DataTable({
            "searching": true,
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            totalMoney = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotalMoney = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

             // Update footer
            $( api.column( 6 ).footer() ).html(
                '$' + pageTotalMoney +' ($'+ totalMoney +' total)'
            );

            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                pageTotal +' ('+ total +' total)'
            );
        }
    } );
    });
</script>
@endsection
