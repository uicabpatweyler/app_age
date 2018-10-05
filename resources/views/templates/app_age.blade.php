<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>A.G.E | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome 4.7.0 by @davegandy - http://fontawesome.io -->
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <!-- Daterange picker - http://www.daterangepicker.com/  -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css">
    <!-- Sweet Alert CSS/JS -->
    <script src="{{asset('sweetalert/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/all.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- Theme style AdminLTE v2.3.8 -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/skin-blue.min.css')}}">

    @yield('css')

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

    <!-- Begin Wrapper -->
    <div class="wrapper">

        @include('templates.main-header')


    @yield('content')

    @include('templates.main-footer')


    </div>
    <!-- /.End Wrapper -->


<!-- jQuery 2.2.3 -->
<script src="{{asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte//plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask https://github.com/RobinHerbots/Inputmask -->
<script src="{{asset('adminlte/plugins/input-mask/dist/jquery.inputmask.bundle.js')}}"></script>
<!-- date-range-picker -->
<script type="text/javascript" src="{{asset("adminlte/plugins/moment/moment.min.js")}}"></script>
<script type="text/javascript" src="{{asset("adminlte/plugins/moment/moment-with-locales.js")}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
<!-- jQuery Validation https://jqueryvalidation.org/ -->
<script src="{{asset('jquery-validation/dist/jquery.validate.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

@yield('scripts')
</body>
</html>