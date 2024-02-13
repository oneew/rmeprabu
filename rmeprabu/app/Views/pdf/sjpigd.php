<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>SJP IGD</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
        }

        h5 {
            display: block;
            font-size: 2em;
            margin-top: 0.67em;
            margin-bottom: 0.67em;
            margin-left: 0.2;
            margin-right: 0.2;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="container-fluid text-dark">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table style="border-collapse: collapse; width: 100%; height: 25px;" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 50%; height: 18px;"><?= $header2; ?></td>
                                    <td style="width: 50%; height: 18px; text-align: right;" rowspan="2">
                                        <h4><?= $row['paymentmethodname']; ?></h4>
                                    </td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 50%; height: 18px;"><?= $deskripsi; ?></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 60px;" border="0">
                        <tbody>
                            <tr>
                                <?php
                                $tanggal = $row['documentdate'];
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
                                <td style="text-align">Tanggal</td>
                                <td>: <?php echo tgl_indo($tanggal); ?></td>
                                <td></td>
                                <td>Dokter</td>
                                <td colspan="2">: <?= $row['doktername']; ?></td>

                            </tr>
                            <tr>
                                <td>No. Register</td>
                                <td>: <?= $row['journalnumber']; ?></td>
                                <td></td>
                                <td>Asal Rujukan</td>
                                <td colspan="2">: <?= $row['faskesname']; ?></td>

                            </tr>
                            <tr>
                                <td>Klinik</td>
                                <td colspan="6">: <?= $row['poliklinikname']; ?></td>

                            </tr>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>: <?= $row['pasienname']; ?></td>
                                <td></td>
                                <td>Pembayaran</td>
                                <td colspan="2">: <?= $row['paymentmethodname']; ?></td>

                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>: <?= $row['pasienage']; ?></td>
                                <td>&nbsp;</td>
                                <td>No. Kartu</td>
                                <td colspan="2">: <?= $row['paymentcardnumber']; ?></td>

                            </tr>
                            <tr>
                                <td>Wilayah</td>
                                <td colspan="2">: <?= $row['pasiensubareaname']; ?></td>

                                <td>Pelayanan</td>
                                <td colspan="2">: <?= $row['description']; ?></td>

                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td colspan="6">: <?= $row['pasienaddress']; ?></td>


                            </tr>
                            <tr>
                                <td>Petugas</td>
                                <td colspan="2">: <?= $row['createdby']; ?>[<?= $row['createddate']; ?>]</td>

                                <td>Tindakan</td>
                                <td colspan="2">:</td>

                            </tr>
                            <tr>
                                <td>Diagnosa</td>
                                <td colspan="6">: <?= $row['icdx']; ?>[<?= $row['icdxname']; ?>]</td>
                            </tr>
                            <tr>
                                <td>Berat Lahir</td>
                                <td colspan="6">: .............gram</td>
                            </tr>
                            <tr>
                                <td>Dirujuka Ke</td>
                                <td colspan="2">:</td>
                                <td>Penunjang</td>
                                <td colspan="2">:</td>
                            </tr>
                            <tr>
                                <td>Cara pulang</td>
                                <td colspan="6">:</td>
                            </tr>


                        </tbody>
                    </table>

                    <table style="border-collapse: collapse; width: 100%; height: 50px;" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 23.4672%; height: 18px;">No. Rekam Medis</td>
                                <td style="width: 19.4525%; height: 18px;">Antrian Klinik</td>
                                <td style="width: 17.0803%; height: 18px;">Petugas</td>
                                <td style="width: 20%; height: 18px;">Dokter</td>
                                <td style="width: 20%; height: 18px;">Pasien</td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 23.4672%; height: 54px;" rowspan="3">
                                    <h5><?= $row['pasienid']; ?></h5>
                                </td>
                                <td style="width: 19.4525%; height: 18px;" rowspan="3">
                                    <h5><?= number_format($row['noantrian'], 0, ",", "."); ?></h5>
                                </td>
                                <td style="width: 17.0803%; height: 18px;">&nbsp;</td>
                                <td style="width: 20%; height: 18px;">&nbsp;</td>
                                <td style="width: 20%; height: 18px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 17.0803%; height: 18px;">&nbsp;</td>
                                <td style="width: 20%; height: 18px;">&nbsp;</td>
                                <td style="width: 20%; height: 18px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 17.0803%; height: 18px;">__________</td>
                                <td style="width: 35%; height: 18px;"><u><?= $row['doktername']; ?></u></td>
                                <td style="width: 60%; height: 18px;"><u><?= $row['pasienname']; ?></u></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>