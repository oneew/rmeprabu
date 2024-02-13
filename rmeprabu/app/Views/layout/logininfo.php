<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>SIMRS</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Custom CSS -->
    <!-- Custom CSS -->

    <style type="text/css">
        .fix-sidebar .left-sidebar {
            position: fixed;
        }

        @media (min-width: 992px) {
            .fix-sidebar .navbar-header {
                position: fixed;
            }

            .fix-sidebar .navbar-collapse {
                margin-left: 240px;
            }
        }

        .card-no-border .card {
            border-radius: 4px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
        }

        .card-no-border .sidebar-footer {
            background: #f2f6f8;
        }

        .card-no-border .sidebar-nav>ul>li>a.active {
            background: #fff;
        }

        .card-no-border .shadow-none {
            box-shadow: none;
        }

        .error-box {
            height: 100%;
            position: fixed;
            background: url(../../assets/images/background/error-bg.jpg) no-repeat center center #fff;
            width: 100%;
        }

        .error-box .footer {
            width: 100%;
            left: 0px;
            right: 0px;
        }

        .error-body {
            padding-top: 5%;
        }

        .error-body h1 {
            font-size: 210px;
            font-weight: 900;
            line-height: 210px;
        }

        .text-center {
            text-align: center !important;
        }

        .text-info {
            color: #1e88e5 !important;
        }

        a.text-info:hover,
        a.text-info:focus {
            color: #1360a4 !important;
        }

        .text-muted {
            color: #99abb4 !important;
        }

        .mt-4,
        .my-4 {
            margin-top: 1.5rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5,
        .my-5 {
            margin-bottom: 3rem !important;
        }

        .btn-rounded {
            border-radius: 60px;
        }

        .btn-rounded.btn-xs {
            padding: .25rem .5rem;
            font-size: 10px;
        }

        .btn-rounded.btn-md {
            padding: 12px 35px;
            font-size: 16px;
        }

        .waves-effect {
            position: relative;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            vertical-align: middle;
            z-index: 1;
            will-change: opacity, transform;
            -webkit-transition: all 0.1s ease-out;
            -moz-transition: all 0.1s ease-out;
            -o-transition: all 0.1s ease-out;
            -ms-transition: all 0.1s ease-out;
            transition: all 0.1s ease-out;
        }

        .waves-effect .waves-ripple {
            position: absolute;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            opacity: 0;
            background: rgba(0, 0, 0, 0.2);
            -webkit-transition: all 0.7s ease-out;
            -moz-transition: all 0.7s ease-out;
            -o-transition: all 0.7s ease-out;
            -ms-transition: all 0.7s ease-out;
            transition: all 0.7s ease-out;
            -webkit-transition-property: -webkit-transform, opacity;
            -moz-transition-property: -moz-transform, opacity;
            -o-transition-property: -o-transform, opacity;
            transition-property: transform, opacity;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            transform: scale(0);
            pointer-events: none;
        }

        .waves-effect.waves-light .waves-ripple {
            background-color: rgba(255, 255, 255, 0.45);
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .footer {
            bottom: 0;
            color: #67757c;
            left: 0px;
            padding: 17px 15px;
            position: absolute;
            right: 0;
            border-top: 1px solid rgba(120, 130, 140, 0.13);
            background: #fff;
        }
    </style>


</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <div class="error-box">
        <div class="error-body text-center">
            <h3 class="text-info">Akun anda terdeteksi telah login ke Aplikasi SIMRS</h3>
            <h5 class="text-info">Pada tanggal <?= date('Y-m-d h:m:s'); ?> </h5>
            <p class="text-muted mt-4 mb-4">Dari perangkat dengan IP : </p>
            <a href="#" class="btn btn-rounded waves-effect waves-light mb-5"><img src="../assets/images/favicon.ico" alt="user" width="40" class="rounded-circle" /></a>
        </div>
        <footer class="footer text-center">© 2021 SIMRS</footer>
    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

</body>

</html>