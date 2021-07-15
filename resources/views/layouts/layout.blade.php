<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('assets/front/images/apple-touch-icon.png') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/front/css/front.css') }}">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<div id="wrapper">
    @include('layouts.navbar')

    @yield('header')

    <section class="section lb @if(!Request::is('/')) m3rem @endif">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">

                    @yield('content')

                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.sidebar')
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <footer class="main-footer" style="padding: 0px 20px">
        <div class="float-right d-none d-sm-block">
            <b>MyVersion</b> 1
        </div>
        <img src="{{asset('assets/admin/img/footer.jpg')}}" >

        <strong>Copyright &copy; 2021 <a href="https://github.com/Imposter80" target="_blank">GitHub - Imposter</a>.</strong> All rights reserved.

    </footer>


</div><!-- end wrapper -->


<script src="{{ asset('assets/front/js/front.js') }}"></script>

</body>
</html>

