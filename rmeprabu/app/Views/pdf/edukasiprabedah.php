<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>Edukasi Pra bedah</title>
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
                <div>
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 0;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 100%; text-align: center; line-height: 0;">
                                    <h5><b class="text-info"><?= $header1; ?></b></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center; line-height: 0;">
                                    <h5><b><?= $header2; ?></b></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;"><?= $alamat; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h5> <?= $unit; ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6> <?= $deskripsi; ?></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="1">
                        <tbody>

                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <?php
                                $asaltanggal = $row['created_at'];
                                $date_arr = explode(" ", $asaltanggal);
                                $date = $date_arr[0];
                                $tanggal = $date;
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

                                <tr style="height: 36px;">
                                    <td style="width: 25%; height: 36px;">Nomor Rekam Medis</td>
                                    <td style="width: 25%; height: 36px;">: <?= $row['pasienid']; ?></td>
                                    <td style="width: 25%; height: 36px;">Nama Pasien</td>
                                    <td style="width: 25%; height: 36px;">: <?= $row['pasienname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Tanggal Lahir</td>
                                    <td style="width: 25%; height: 18px;">: <?= $row['pasiendateofbirth']; ?></td>
                                    <td style="width: 25%; height: 18px;">Diagnosa</td>
                                    <td style="width: 25%; height: 18px;">: <?= $row['diagnosis']; ?></td>
                                </tr>

                                <tr style="height: 36px;">
                                    <td style="width: 25%; height: 36px;">Pemberi Informasi</td>
                                    <td style="width: 25%; height: 36px;">: <?= $row['pemberiinformasi']; ?></td>
                                    <td style="width: 25%; height: 36px;">Penerima Informasi</td>
                                    <td style="width: 25%; height: 36px;">: <?= $row['penerimainformasi']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Kondisi Pasien</td>
                                    <td style="width: 25%; height: 18px;" colspan="3">: <?= $row['kondisipasien']; ?></td>
                                </tr>
                                <tr style="height: 54px;">
                                    <td style="width: 25%; height: 54px;">Tindakan Kedokteran Yang Diusulkan</td>
                                    <td style="width: 25%; height: 54px;" colspan="3">: <?= $row['name']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Manfaat Tindakan</td>
                                    <td style="height: 18px;" colspan="3">: <?= $row['manfaattindakan']; ?></td>
                                </tr>
                                <tr style="height: 36px;">
                                    <td style="width: 25%; height: 36px;">Tata Cara Uraian Singkat Prosedur</td>
                                    <td style="height: 36px;" colspan="3">: <?= $row['tatacara']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Risiko Tindakan</td>
                                    <td style="height: 18px;" colspan="3">: <?= $row['risikotindakan']; ?></td>
                                </tr>
                                <tr style="height: 36px;">
                                    <td style="width: 25%; height: 36px;">Komplikasi Tindakan</td>
                                    <td style="height: 36px;" colspan="3">: <?= $row['komplikasitindakan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Dampak Tindakan</td>
                                    <td style="height: 18px;" colspan="3">: <?= $row['dampaktindakan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Prognosis Tindakan</td>
                                    <td style="height: 18px;" colspan="3">: <?= $row['prognosistindakan']; ?></td>
                                </tr>
                                <tr style="height: 36px;">
                                    <td style="width: 25%; height: 36px;">Kemungkinan Alternatif Tindakan</td>
                                    <td style="height: 36px;" colspan="3">: <?= $row['alternatif']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Kemungkinan Bila Tidak Dilakukan Tindakan</td>
                                    <td style="width: 25%; height: 18px;" colspan="3">: <?= $row['bilatidakditindak']; ?></td>
                                </tr>

                        </tbody>
                    </table>



                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Pemberi Edukasi</td>
                            </tr>
                            <?php
                                foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signature']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr style="height: 30px;">

                                <td style="width: 50%; text-align: center; height: 18px;"><u></u></td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;"><u><?= $doktername; ?></u></td>

                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>