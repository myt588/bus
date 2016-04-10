
<div class="main-header">
    <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
        Mobile Menu Toggle
    </a>

    <div class="container">
        <h1 class="logo navbar-brand">
            <a href="{{ route('home') }}" title="TriponBus - home">
                <img src="/images/logo.png" />
            </a>
        </h1>
        
        <nav id="main-menu" role="navigation">
            <ul class="menu">
                @include('frontend.partials.main-navbar')
            </ul>
        </nav>
    </div>

    <nav id="mobile-menu-01" class="mobile-menu collapse">
        <ul id="mobile-primary-menu" class="menu">
            @include('frontend.partials.main-navbar')
        </ul>
        
        <ul class="mobile-topnav container">
            <li><a href="#">MY ACCOUNT</a></li>
            <li class="ribbon language menu-color-skin">
                <a href="#" data-toggle="collapse">ENGLISH</a>
                <ul class="menu mini">
                    <li><a href="#" title="Chinese">Chinese</a></li>
                    <li class="active"><a href="#" title="English">English</a></li>
                </ul>
            </li>
            <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
            <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
            <li class="ribbon currency menu-color-skin">
                <a href="#">USD</a>
                <ul class="menu mini">
                    <li><a href="#" title="CNY">CNY</a></li>
                    <li class="active"><a href="#" title="USD">USD</a></li>
                </ul>
            </li>
        </ul>
        
    </nav>
</div>