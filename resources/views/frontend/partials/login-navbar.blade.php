<div class="topnav hidden-xs">
    <div class="container">
        <ul class="quick-menu pull-left">
            @if(Auth::check())
                @if(Auth::user()->isAdmin() || Auth::user()->isCompanyAdmin())
                    <li><a href="{{ route('admin::dashboard') }}">MY DASHBOARD</a></li>
                    <li><a href="{{ route('user.booking') }}">MY PAGE</a></li>
                @else
                    <li><a href="{{ route('user.booking') }}">MY PAGE</a></li>
                @endif
            @endif
            <li class="ribbon">
                <a href="#">English</a>
                <ul class="menu mini">
                    <li><a href="#" title="Chinese">Chinese</a></li>
                    <li class="active"><a href="#" title="English">English</a></li>
                </ul>
            </li>
        </ul>
        <ul class="quick-menu pull-right">
            @if(Auth::check())
            <li><a href="{{ url('/logout') }}">LOGOUT</a></li>
            @else
            <li><a href="{{ url('/login') }}">LOGIN</a></li>
            <li><a href="{{ url('/register') }}">SIGNUP</a></li>
            @endif
            
            <li class="ribbon currency">
                <a href="#" title="">USD</a>
                <ul class="menu mini">
                    <li><a href="#" title="CNY">CNY</a></li>
                    <li class="active"><a href="#" title="USD">USD</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>