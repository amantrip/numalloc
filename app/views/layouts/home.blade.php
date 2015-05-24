<!DOCTYPE html>
<html>
<head>
    @yield('title')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">

    <!-- Styles -->
    <link href="/clean/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/clean/css/compiled/bootstrap-overrides.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/clean/css/compiled/theme.css" />

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="/clean/css/compiled/features.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/clean/css/lib/animate.css" />
    <style type="text/css">
        img.logo{
            height: 30px;
        }
    </style>
    @yield('styling')

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="pull_top">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a href="index.html" class="navbar-brand"><strong>PSAP</strong> DATABASE</a>-->
                <a href="/"><img class="logo" src="/img/logo.png"></a>

            </div>
        </div>
    </div>

    <div id="features" class="features_page">
        <div class="container">
            <!-- Feature Wrapper -->
            @yield('content')
        </div>
    </div>


    <!-- starts footer -->
    <footer id="footer">
        <div class="container">
            <div class="row info">
                <div class="col-sm-6 residence">
                    <ul>
                        <li>Columbia University, New York City</li>
                        <li>United States, NY 10025.</li>
                    </ul>
                </div>
                <div class="col-sm-5 touch">
                    <ul>
                        <li><strong>P.</strong> 1 800 000 0000</li>
                        <li><strong>E.</strong><a href="#"> admin@numalloc.app</a></li>
                    </ul>
                </div>
            </div>
            <div class="row credits">
                <div class="col-md-12">

                    <div class="row copyright">
                        <div class="col-md-12">
                            © 2015 Num-Alloc. All rights reserved. Akhilesh Mantripragada and Abhyuday Polineni.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="clean/js/bootstrap.min.js"></script>
    <script src="clean/js/theme.js"></script>
    @yield('footer')
</body>
</html>