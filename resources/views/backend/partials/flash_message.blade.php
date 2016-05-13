@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::pull('info') }}
    </div>
@endif

@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    	{{ Session::pull('danger') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    	{{ Session::pull('success') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    	{{ Session::pull('warning') }}
    </div>
@endif

