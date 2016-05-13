@extends('layouts.backend')

@section('title') Transaction Homepage @endsection @section('heading') Transaction @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/transactions">Transaction</a></li>
    <li><a href="/admin/transactions/create">Create</a></li>


@endsection

@section('content')

<div class="box box-warning"> 
    <div class="box-body">

        {!! Form::open(['url' => 'admin/transactions', 'class' => 'form-horizontal', 'id' => 'payment-form']) !!}

          <span class="payment-errors"></span>

          <div class="form-row">
            <label>
              <span>Card Number</span>
              <input type="text" size="20" data-stripe="number"/>
            </label>
          </div>

          <div class="form-row">
            <label>
              <span>CVC</span>
              <input type="text" size="4" data-stripe="cvc"/>
            </label>
          </div>

          <div class="form-row">
            <label>
              <span>Expiration (MM/YYYY)</span>
              <input type="text" size="2" data-stripe="exp-month"/>
            </label>
            <span> / </span>
            <input type="text" size="4" data-stripe="exp-year"/>
          </div>

          <button type="submit">Submit Payment</button>

<!--                 <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('source_id') ? 'has-error' : ''}}">
            {!! Form::label('source_id', 'Source Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('source_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('source_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('credit') ? 'has-error' : ''}}">
            {!! Form::label('credit', 'Credit: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('credit', null, ['class' => 'form-control']) !!}
                {!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('debit') ? 'has-error' : ''}}">
            {!! Form::label('debit', 'Debit: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('debit', null, ['class' => 'form-control']) !!}
                {!! $errors->first('debit', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div> -->

        {!! Form::close() !!}

    </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_xnJM4eg3x5Fcse8fSFj1LnxQ');
    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form');
      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        $form.get(0).submit();
      }
    };
    jQuery(function($) {
      $('#payment-form').submit(function(event) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
      });
    });
</script>

@endsection