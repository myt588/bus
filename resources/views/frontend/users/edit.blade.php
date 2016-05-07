@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="/css/app.css">
@endsection

@section('title') TriponBus @endsection

@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            <div class="tab-container full-width-style arrow-left dashboard">
                @include('frontend.users.partials.nav')
                <div class="tab-content">
                    <div id="profile" class="tab-pane fade active in">
                        <div>
                            {!! Form::model($user, [
                                'method' => 'PATCH',
                                'url' => 'user/update',
                                'class' => 'edit-profile-form',
                                'files' => true
                            ]) !!}
                                <h2>Personal Details</h2>
                                <div class="col-sm-9 no-padding no-float">
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>First Name</label>
                                            <input name="first_name" type="text" class="input-text full-width" value="{{ $user->first_name }}" placeholder="" />
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Last Name</label>
                                            <input name="last_name" type="text" class="input-text full-width" value="{{ $user->last_name }}" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Email Address</label>
                                            <input name="email" type="text" class="input-text full-width" value="{{ $user->email }}" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Country Code</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>United States (+1)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Phone Number</label>
                                            <input name="phone" type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Upload Profile Photo</h2>
                                    <div class="row form-group">
                                        <div class="col-sms-12 col-sm-6 no-float">
                                            <div class="fileinput full-width">
                                                <input name="photo" type="file" class="input-text" data-placeholder="select image/s">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="from-group">
                                        <button type="submit" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                    </div>
                                </div>
                                @include('errors.error-list')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

