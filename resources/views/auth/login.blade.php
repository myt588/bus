@extends('layouts.frontend')

@section('title') Login @endsection @section('heading') Login @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Login</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Login</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content" class="grey-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @include('auth.partials.login-form')
            </div>
        </div>
    </div>
</section>
@endsection
