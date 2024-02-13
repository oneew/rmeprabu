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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SIMRS RSUD M RABAIN</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url(); ?>/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?= base_url(); ?>/assets/images/background/note2.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url(); ?>/Users/loginafterlogout">

                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <div class="user-thumb text-center">
                                    <?php
                                    $foto = !is_null($foto) ? ($foto) : 'avataruser.png'; ?>
                                    <img alt="thumbnail" class="rounded-circle" width="100" src="<?= base_url(); ?>/assets/images/users_simrs/<?= $foto; ?>">
                                    <h3><?= $email; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" autocomplete="off" type="hidden" name="email" id="email" value="<?= $email; ?>">
                                <input class="form-control password" type="password" required="" name="password" id="password" value="" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-red lihat" />
                                <label for="md_checkbox_21">Show Password</label>
                            </div>
                        </div>
                        <?php if (isset($validation)) : ?>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group text-center">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                <div class="social">
                                    <img src="<?= base_url(); ?>/assets/images/aprialideni.png" alt="user" width="40" class="rounded-circle" />

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>/assets/plugins/popper/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url(); ?>/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url(); ?>/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url(); ?>/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url(); ?>/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.lihat').click(function() {
                if ($(this).is(':checked')) {
                    $('.password').attr('type', 'text');
                } else {
                    $('.password').attr('type', 'password');
                }
            });
        });
    </script>
</body>

</html>