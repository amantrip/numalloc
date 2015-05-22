<!DOCTYPE html>
<html>
<head>

	@yield('title')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <!-- bootstrap -->
    <link href="/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="/css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="/css/compiled/icons.css" />
    <link rel="stylesheet" type="text/css" href="/css/compiled/skins/dark.css" />

    <!-- libraries -->
    <link href="/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="/css/lib/morris.css" type="text/css" rel="stylesheet" />

    <!-- this page specific styles -->
    @yield('styling')

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

    <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="logo" /></a>
        </div>
        @yield('header')
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
        <div id="sidebar-nav">
            @yield('sidebar')
        </div>
        <!-- end sidebar -->



	<!-- main container -->
    <div class="content">
        @yield('content')
    </div>
    <!-- end main container -->


	<!-- scripts for this page -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="/js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="/js/jquery.flot.js"></script>
    <script src="/js/jquery.flot.stack.js"></script>
    <script src="/js/jquery.flot.resize.js"></script>
    <!-- morrisjs -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/js/morris.min.js"></script>
    <!-- call all plugins -->
    <script src="/js/theme.js"></script>

    <!-- Other Scripts -->
    @yield('footer')
</body>
</html>