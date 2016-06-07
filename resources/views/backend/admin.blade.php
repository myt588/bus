@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="/css/app.css">
@endsection

@section('title') Admin Dashboard @endsection 

@section('heading') 

Dashboard 
<small>Hello, {{auth()->user()->fullname()}}!</small>

@endsection

@section('breadcrumb')

<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active"><a href="/">Dashboard</a></li>

@endsection

@section('content')
<!-- Main content -->
<section class="content"></section>
<!-- /.content -->
@endsection

@section('js')

@endsection

