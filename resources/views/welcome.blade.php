<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Number Tracking | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b></a>
        </div>
        @if (Session::has('success'))
            <script>
                swal("Success", "{{ Session::get('success') }}", "success", {
                    button: true,
                    button: "OK",
                    //timer: 3000,
                    dangerMode: true,
                });
            </script>
        @elseif (Session::has('delete'))
            <script>
                swal("Success", "{{ Session::get('delete') }}", "success", {
                    button: true,
                    button: "OK",
                    //timer: 3000,
                    dangerMode: true,
                });
            </script>
        @elseif(Session::has('error'))
            <script>
                swal("Error", "{{ Session::get('error') }}", "info", {
                    button: true,
                    button: "OK",
                    //timer: 3000,
                    dangerMode: true,
                });
            </script>
        @endif
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="admin@admin.com">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Validation message for username -->
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Validation message for password -->
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>


</body>

</html>
