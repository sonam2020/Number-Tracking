<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon.ico') }}">
  <title>@yield('title')</title>
  @yield('head')
  <style>
      .dataTables_processing {
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #b9cb89;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 18px;
        
        color: #333333;
    }
    
    img:hover {
      cursor: pointer;
    }

    /* Custom CSS to style the spinner (optional) */
    .custom-spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 4px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        border-top: 4px solid #3498db;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    #example2_processing {
        position: fixed;
        top: 50%;
        left: 60%;
        transform: translate(-50%, -50%);
        background:  #b9cb89;
        padding: 20px;
        border-radius: 5px;
    }
   
    
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">-->
  <!--  <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">-->
  <!--</div>-->

  <!-- Navbar -->
  @yield('header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @yield('sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('contentheader')
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('maincontent')
    <!-- /.content -->
  </div>
  @yield('footer')
</div>
<!-- ./wrapper -->
  @yield('scripts')
  

</body>
</html>
