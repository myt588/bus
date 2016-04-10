@extends('layouts.frontend')

@section('title') Reset @endsection @section('heading') Reset @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Reset</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Reset</li>
        </ul>
    </div>
</div>

@endsection

<!-- Main Content -->
@section('content')
<section id="content" class="grey-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label">E-Mail Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
