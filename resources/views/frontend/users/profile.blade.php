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
                        <div class="view-profile">
                            <article class="image-box style2 box innerstyle personal-details">
                                <figure>
                                    <a title="" href="#"><img width="270" height="263" alt="" src="{{$user->photo}}"></a>
                                </figure>
                                <div class="details">
                                    <a href="{{route('user.edit')}}" class="button btn-mini pull-right edit-profile-btn">EDIT PROFILE</a>
                                    <h2 class="box-title fullname">{{$user->fullname()}}</h2>
                                    <dl class="term-description">
                                        <dt>first name:</dt><dd>{{$user->first_name}}</dd>
                                        <dt>last name:</dt><dd>{{$user->last_name}}</dd>
                                        <dt>email:</dt><dd>{{$user->email}}</dd>
                                        <dt>phone:</dt><dd>{{$user->phone}}</dd>
                                    </dl>
                                </div>
                            </article>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

