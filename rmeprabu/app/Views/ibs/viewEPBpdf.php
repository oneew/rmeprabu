<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style.min.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../css/colors/default-dark.css" id="theme" rel="stylesheet">

    <style type="text/css">
        div {
            border: 1px solid gray;
            padding: 8px;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
            color: #4CAF50;
        }

        p {
            text-indent: 50px;
            text-align: justify;
            letter-spacing: 3px;
        }

        a {
            text-decoration: none;
            color: #008CBA;
        }
    </style>


</head>


<body>
    <form class="form-horizontal form-material" method="post">
        <div class="form-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Dokumentasi Edukasi PraBedah</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="post">
                                <div class="form-body">
                                    <h5 class="p-2 rounded-title">Data Admisi</h5>
                                    <hr class="mt-0 mb-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">No.Rekam Medis</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"> <?= $pasienid; ?></p>
                                                    <input type="hidden" name="id" id="id" value="<?= $id_tproh; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Nama Pasien</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $pasienname; ?> (<?= $pasiendateofbirth; ?>)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">JournalNumber</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $journalnumber; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">ReferenceNumber</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $referencenumber; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Cara Bayar</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $paymentmethodname; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Ruangan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $roomname; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <h5 class="p-2 rounded-title">Isi Dokumentasi</h5>
                                    <hr class="mt-0 mb-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-md-6">Pemberi Informasi</label>
                                                <div class="col-lg-9 col-md-6">
                                                    <p class="form-control-static"><?= $pemberiinformasi; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Penerima Informasi</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $penerimainformasi; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">DPJP</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $doktername; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">SMF</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $smfname; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Diagnosis</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $diagnosis; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Kondisi Pasien</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $kondisipasien; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Manfaat Tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $manfaattindakan; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Tata cara Uraian singkat prosedur</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $tatacara; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Risiko Tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $risikotindakan; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Komplikasi Tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $komplikasitindakan; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Dampak tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $dampaktindakan; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Prognosis Tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $prognosistindakan; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Alternatif Tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $alternatif; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-lg-right col-lg-3 col-6">Bila tidak dilakukan tindakan</label>
                                                <div class="col-lg-9 col-6">
                                                    <p class="form-control-static"><?= $bilatidakditindak; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-success">

                                                <div class="card">
                                                    <div class="el-card-item">
                                                        <div class="el-card-avatar el-overlay-1"> <img src="<?= $signature ?>" alt="user" />
                                                            <div class="el-overlay">
                                                                <ul class="el-info">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="el-card-content">
                                                            <h5 class="mb-0"><?= $created_at; ?></h5>
                                                            <h5 class="mb-0"><?= $doktername; ?></h5> <small><?= $smfname; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>



</html>