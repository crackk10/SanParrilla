<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('titulo', 'SanParrilla')</title>
  <title>Document</title>
    <!-- jQuery  -->
  <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>  
  @yield('metadata')
  {{-- notificaciones --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  @yield("styles")
  <!-- custom -->
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">
    <!--inicio header -->
    @include("theme/$theme/header")
    <!--fin header -->
    <!--inicio aside -->
    @include("theme/$theme/aside")
    <!--fin aside -->
    <div class="content-wrapper">
        <section class="content">
            @yield("contenido")        
         </section>
    </div>
    <!-- Inicio footer-->
    @include("theme/$theme/footer")
     <!--fin footer -->
  </div> 
  
@yield('scripts')
  <!-- Bootstrap 4 -->
  <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script> --}}
  <!-- toastr -->
  <script src="{{asset("assets/$theme/plugins/toastr/toastr.min.js")}}"></script>

  
</body>
</html>