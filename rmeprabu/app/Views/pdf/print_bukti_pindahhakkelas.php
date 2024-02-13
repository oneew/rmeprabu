<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pindah Hak kelas Rawat Inap</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; border=" 0">
                    <tbody>
                        <tr>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkab.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text-info"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <h5><b><?= $header2; ?></b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;"><?= $alamat; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <b>
                                    <h6> <?= $deskripsi; ?></h6>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr>
                                    <td style="width: 100%;" colspan="4"><u><b>Berikut Informasi Pindah Hak kelas :</b></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">No. Validasi Pindah Cara Bayar</td>
                                    <td style="width: 25%;">: <?php echo $row['validationnumber']; ?></td>
                                    <td style="width: 25%;">No. Rekam medik</td>
                                    <td style="width: 25%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">No. Pendaftaran</td>
                                    <td style="width: 25%;">: <?php echo $row['referencenumber']; ?></td>
                                    <td style="width: 25%;">Pembayaran</td>
                                    <td style="width: 25%;">: <?php echo $row['paymentmethodname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Nama pasien</td>
                                    <td style="width: 25%;">: <?php echo $row['pasienname']; ?></td>
                                    <td style="width: 25%;">Tgl Lahir</td>
                                    <td style="width: 25%;">: <?php echo $row['pasiendateofbirth']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Alamat</td>
                                    <td style="width: 25%;" colspan="3">: <?php echo $row['pasienaddress']; ?></td>
                                </tr>

                        </tbody>
                    </table>
                </div>
                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>

                            <tr>
                                <td style="width: 100%;" colspan="4"><u><b></b></u></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;"></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; margin-left:auto;margin-right:auto" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;"><u><b>Hak Kelas Perawatan Lama</b></u></td>
                                <td style="width: 33.3333%; text-align: center;">&nbsp;</td>
                                <td style="width: 33.3333%; text-align: center;"><u><b>Hak Kelas Perawatan Baru</b></u></td>
                            </tr>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;"><b><?= $row['pasienclassroom']; ?></b></td>
                                <td style="width: 33.3333%; text-align: center;">&nbsp;</td>
                                <td style="width: 33.3333%; text-align: center;"><b><?= $row['pasienclassroomnew']; ?></b></td>
                            </tr>

                            <tr>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                    </table>

                </div>

                <b></b>
                <?php
                $tanggal = $row['created_at'];
                function tgl_indo($tanggal)
                {
                    $bulan = array(
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
                    $pecahkan = explode('-', $tanggal);
                    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                }

                ?>

                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">Pasien/ Keluarga </td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Petugas Kasir</td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['payersname']; ?></u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['createdby']; ?></u></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>