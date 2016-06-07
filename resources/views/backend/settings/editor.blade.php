@extends('layouts.backend')

@section('css')

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

@endsection

@section('title') Company Policy @endsection 

@section('heading') 

    Company Policy 

@endsection

@section('breadcrumb')

    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="">Company Policy</a></li>

@endsection

@section('content')

<div class="box box-primary">
    {!! Form::open(['route' => $route]) !!}
    <div class="box-header">
      <h3 class="box-title">Set your policies
    </h3>
    <!-- tools box -->
    <div class="pull-right box-tools">
        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
    <!-- /. tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
        <textarea name="policy" class="textarea" placeholder="Place some text here" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
    </div>

    <div class="box-footer">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>

<!-- /.row -->  

@endsection

@section('js')
<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    $('.textarea').html('{{ $item }}');
  });
</script>
@endsection
