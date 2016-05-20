<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>@yield('title')</title>
    
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Travelo - Travel, Tour Booking HTML5 Template">
    <meta name="author" content="SoapTheme">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Theme Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/animate.min.css">
    
    <!-- Current Page Styles -->
    <link rel="stylesheet" type="text/css" href="/components/revolution_slider/css/settings.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/components/revolution_slider/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/components/jquery.bxslider/jquery.bxslider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/components/flexslider/flexslider.css" media="screen" />
    
    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="/css/style.css">
    
    <!-- Updated Styles -->
    <link rel="stylesheet" href="/css/updates.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/css/custom.css">
    
    <!-- Responsive Styles -->
    <link rel="stylesheet" href="/css/responsive.css">
    
    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->
    
    @yield('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    
</head>
<body>
    <div id="page-wrapper">
        <header id="header" class="navbar-static-top">
            @include('frontend.partials.login-navbar')
            
            @include('frontend.partials.main-header')
        </header>

        @yield('breadcrumb')
        
        @yield('content')

        @include('frontend.partials.footer')
        
        
    </div>
    
    <!-- Javascript -->
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.noconflict.js"></script>
    <script type="text/javascript" src="/js/modernizr.2.7.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.1.10.4.min.js"></script>
    
    <!-- Twitter Bootstrap -->
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    
    <!-- load revolution slider scripts -->
    <script type="text/javascript" src="/components/revolution_slider/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="/components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Flex Slider -->
    <script type="text/javascript" src="/components/flexslider/jquery.flexslider-min.js"></script>
    
    <!-- load BXSlider scripts -->
    <script type="text/javascript" src="/components/jquery.bxslider/jquery.bxslider.min.js"></script>
    
    <!-- parallax -->
    <script type="text/javascript" src="/js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="/js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="/js/theme-scripts.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
    
    @yield('js')

    <script type="text/javascript">
        tjq(".flexslider").flexslider({
            animation: "fade",
            controlNav: false,
            animationLoop: true,
            directionNav: false,
            slideshow: true,
            slideshowSpeed: 5000
        });
    </script>
</body>
</html>

