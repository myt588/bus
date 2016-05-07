<ul class="tabs">
    <li {!! set_active('user/booking') !!}><a href="{{route('user.booking')}}"><i class="soap-icon-businessbag circle"></i>Booking</a></li>
    <li {!! set_active(['user/profile', 'user/edit']) !!}><a href="{{route('user.profile')}}"><i class="soap-icon-user circle"></i>Profile</a></li>
    <li {!! set_active('user/setting') !!}><a href="{{route('user.setting')}}"><i class="soap-icon-settings circle"></i>Settings</a></li>
</ul>