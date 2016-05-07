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
        <div class="col-md-9">
            @if(isset($today))
                @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Booked For Today',
                    'type'      => 'box-success',
                    'dates'     => $today,
                    'dateSign'  => 'today +',
                    ])
                @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets Booked For Next Week',
                    'type'      => 'box-success',
                    'dates'     => $dates,
                    'dateSign'  => 'tomorrow +',
                    ])
            @else
                @include('backend.partials.tickets-report-box-2', [
                    'header'    => 'Tickets',
                    'type'      => 'box-success',
                    'dates'     => $dates,
                    'dateSign'  => $date . ' +',
                    ])
            @endif
        </div>
        <div class="col-md-3">
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Filters</h3>
            </div>
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                    <label>Start Date:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="start_date" type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                  <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                    <label>End Date:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="end_date" type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="box-footer">
                <button id="search" type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
    
</section>

@endsection

@section('js')
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- input mask -->
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- page script -->
<script>
    $(function () {
        //Datemask dd/mm/yyyy
        $("#start_date, #end_date").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

        $('#search').on('click', function() {
            var start = document.getElementById("start_date").value;
            var end = document.getElementById("end_date").value;
            if (start == "" || end == "")
            {
                alert("start and end dates must be filled");
                return;
            }
            href = updateQueryStringParameter(window.location.href, 'start_date', start);
            window.location = updateQueryStringParameter(href, 'end_date', end);
        });

        function updateQueryStringParameter(uri, key, value) {
           var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
           var separator = uri.indexOf('?') !== -1 ? "&" : "?";
           if (uri.match(re)) {
             return uri.replace(re, '$1' + key + "=" + value + '$2');
           }
           else {
             return uri + separator + key + "=" + value;
           }
        }

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
                '$' + parseFloat(Math.round(pageTotalMoney * 100) / 100).toFixed(2) +' ($'+ parseFloat(Math.round(totalMoney * 100) / 100).toFixed(2) +' total)'
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
