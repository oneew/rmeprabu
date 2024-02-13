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
    <title>Halaman Register</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url(); ?>/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->

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
        <div class="login-register" style="background-image:url(<?= base_url(); ?>/assets/images/background/hospitalmac2.jpg);">
            <div class="login-box card">
                <div class="card-body">




                    <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url(); ?>/register">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                            <div class="social">
                                <h3 class="p-2 rounded-title mb-3"><b>Register</b> Aplikasi SIMRS</h3>
                            </div>
                        </div>

                        <?= csrf_field(); ?>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="firstname" id="firstname" autocomplete="off" value="<?= set_value('firstname'); ?>" placeholder="Nama lengkap">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="lastname" id="lastname" autocomplete="off" value="<?= set_value('lastname'); ?>" placeholder="Alias ">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" id="email" value="<?= set_value('email'); ?>" autocomplete="off" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="password" value="" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <select name="locationname" id="locationname" class="select2" style="width: 100%">
                                    <option>Pilih Lokasi</option>
                                    <?php foreach ($lokasi as $l) : ?>
                                        <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" readonly placeholder="Kode Lokasi">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <select name="levelname" id="levelname" class="select2" style="width: 100%">
                                        <option>Pilih Kelompok Pengguna</option>
                                        <?php foreach ($role as $peran) : ?>
                                            <option data-id="<?= $peran['id']; ?>" class="select-levelname"><?php echo $peran['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="level" name="level" class="form-control" readonly>
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

                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="col-sm-12 text-center">
                                    Sudah Punya akun? <a href="/Users" class="text-info ml-1"><b>Login</b></a>
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
    <script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();

            $(".ajax").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                //templateResult: formatRepo, // omitted for brevity, see the source of this page
                //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#locationname').on('change', function() {
                $.ajax({
                    'type': "POST",

                    'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                    'data': {
                        key: $('#locationname option:selected').data('id')
                    },
                    'success': function(response) {

                        let data = JSON.parse(response);
                        $('#locationname').val(data.name);
                        $('#locationcode').val(data.code);

                        $('#autocomplete-dokter').html('');
                    }
                })
            })

            $('#levelname').on('change', function() {
                $.ajax({
                    'type': "POST",

                    'url': "<?php echo base_url('Autocomplete/fill_role') ?>",
                    'data': {
                        key: $('#levelname option:selected').data('id')
                    },
                    'success': function(response) {

                        let data = JSON.parse(response);
                        $('#levelname').val(data.name);
                        $('#level').val(data.code);

                        $('#autocomplete-dokter').html('');
                    }
                })
            })


        });
    </script>

</body>

</html>