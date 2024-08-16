  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">

  <style>
    .grid-container {
        /* display: grid;
        grid-template-columns: repeat(11, 110px);
        grid-template-rows: repeat(10, 110px);
        gap: 5px;
        justify-content: center;
        align-items: center; */
    display: grid;
    grid-template-columns: repeat(11, 107px);
    grid-template-rows: repeat(10, 63px);
    gap: 0px;
    justify-content: center;
    align-items: center;
    }
    .grid-item {
        border: 1px solid black;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 14px;
    }
    .row-sum {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    .header-item {
        grid-column: span 10;
        text-align: center;
        font-weight: bold;
    }
    .highlight {
        background-color: red; /* Change this to your desired highlight color */
        color: white; /* Change text color if needed */
    }
</style>
