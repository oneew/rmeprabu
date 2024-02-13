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
    <title>Reborn 2022</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- chartist CSS -->
    <link href="<?= base_url(); ?>/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- Custom CSS -->



    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <!--<link href="<?= base_url(); ?>/css/colors/blue.css" id="theme" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>/css/colors/default-dark.css" id="theme" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets/plugins/icheck/skins/all.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/jquery.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= base_url(); ?>/js/jquery.dataTables.min.js"></script>

    <link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">






    <style type="text/css">
        .ui-autocomplete {
            z-index: 1050;
        }
    </style>
    <link href="<?= base_url(); ?>/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="<?= base_url(); ?>/assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="<?= base_url(); ?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>




</head>

<body class="fix-header fix-sidebar card-no-border">
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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">

                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item d-none d-md-block search-box"> <a class="nav-link d-none d-md-block text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-3 col-xlg-2 mb-4">
                                        <h4 class="mb-3">Galeri Rumah Sakit</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container"> <img class="d-block img-fluid" src="<?= base_url(); ?>/assets/images/big/bed.jpg" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="<?= base_url(); ?>/assets/images/big/radiology.jpg" alt="Second slide">
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="<?= base_url(); ?>/assets/images/big/rs3.jpg" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </li>
                                    <li class="col-lg-3 mb-4">
                                        <h4 class="mb-3">Sepintas Aplikasi</h4>
                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Simrs
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body"> Simrs yang terinegrasi dari mulai layanan pada front office hingga back office" </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Konektivitas Aplikasi
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body">Semua modul sudah terintegrasi satu sama lain </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingThree">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Diseminasi data
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="card-body"> Aplikasi remunerasi, Aplikasi Singlesalary </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3  mb-4">
                                        <h4 class="mb-3">Catatan Pengguna</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" name="created_at" class="form-control" readonly id="exampleInputname1" value="<?= date('Y-m-d Hh:m:s'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="subjek" class="form-control" placeholder="Tentang catatan">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="catatan" id="exampleTextarea" rows="3" placeholder="tulis catatan anda..!"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Simpan</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 mb-4">
                                        <h4 class="mb-3">Fitur Aplikasi</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Rawat Jalan</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul IGD</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Rawat Inap</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Radiologi</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Patologi Klinik</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Patologi Anatomi</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Bank Darah</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Bedah Sentral</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Forensik</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Ambulance</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Kasir</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Modul Rekam Medis</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <h5 class="font-medium py-3 px-4 border-bottom mb-0">Notifications</h5>
                                    </li>
                                    <li>
                                        <div class="message-center position-relative">
                                            <!-- Message -->
                                            <a href="#" class="border-bottom d-block text-decoration-none py-2 px-3">
                                                <div class="btn btn-danger btn-circle mr-2"><i class="fa fa-link"></i>
                                                </div>
                                                <div class="mail-contnet d-inline-block align-middle">
                                                    <h5 class="my-1">Luanch Admin</h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block">Just
                                                        see the my new
                                                        admin!</span> <span class="time font-12 mt-1 text-truncate overflow-hidden text-nowrap d-block">9:30
                                                        AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <h5 class="font-medium py-3 px-4 border-bottom mb-0">You have 4 new messages</h5>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#" class="border-bottom d-block text-decoration-none py-2 px-3">
                                                <div class="user-img position-relative d-inline-block mr-2 mb-3"> <img src="<?= base_url(); ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle"> <span class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                                </div>
                                                <div class="mail-contnet d-inline-block align-middle">
                                                    <h5 class="my-1">Simrs</h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block">Just
                                                        see the my
                                                        admin!</span>
                                                    <span class="time font-12 mt-1 text-truncate overflow-hidden text-nowrap d-block">9:30
                                                        AM</span>
                                                </div>
                                            </a>


                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center border-top pt-3" href="javascript:void(0);">
                                            <strong>See all
                                                e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $foto = !is_null(session()->get('foto')) ? (session()->get('foto')) : 'avataruser.png'; ?>
                                <img src="<?= base_url(); ?>/assets/images/users_simrs/<?= $foto; ?>" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                                <?php

                                                $foto = !is_null(session()->get('foto')) ? (session()->get('foto')) : 'avataruser.png'; ?>
                                                <a data-foto="<?= session()->get('foto'); ?>" data-id="<?= session()->get('email'); ?>" class="btn-form-upload">
                                                    <img id="foto-<?= session()->get('foto'); ?>" src="<?= base_url(); ?>/assets/images/users_simrs/<?= $foto; ?>" width="90" class="img-fluid"></a>

                                            </div>
                                            <div class="u-text">
                                                <h4><?= session()->get('lastname'); ?></h4>
                                                <p class="text-muted"><?= session()->get('locationname'); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> Profil Saya</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> Workload</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Pesan Masuk</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?= base_url(); ?>/Users/profile"><i class="ti-settings"></i> Pengaturan Akun</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?= base_url(); ?>/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-id"></i></a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?= $this->include('layout/sidebar'); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">simrs</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <?= $this->renderSection('content'); ?>

                <!-- Row -->
                <!-- Row -->

                <!-- Row -->

                <!-- Row -->
                <!-- Row -->

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->

                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <div class="modal-upload">
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // ajax dengan mengirimkan code dan foto dokter(database)
            $('.btn-form-upload').on('click', function() {
                $.ajax({
                    type: 'post',
                    url: "<?php echo base_url('Users/upload') ?>",
                    data: {
                        code: $(this).data('id'),
                        foto: $(this).data('foto')
                    },
                    success: function(response) {
                        $('.modal-upload').html(response);
                    }
                })
            })
        })
    </script>
    <?= $this->include('layout/footer'); ?>


</body>

</html>