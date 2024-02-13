<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Stock Opname Gudang</title>
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
        <div class="row">
            <div class="col-md-12">
                <div>
                    <table style="border-collapse: collapse; width: 100%; font-size:50%" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6><b class="text-info"><?= $header1; ?></b></h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6><b><?= $header2; ?></b></h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;"><?= $alamat; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6> STOCK OPNAME RUANGAN/UNIT </h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 36px; font-size:60%" border="0">
                        <tbody>
                            <?php $no = 0;
                            foreach ($dataopname as $row) :
                                $no++;
                            ?>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">No Register</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['journalnumber']; ?>(<?= $row['documentdate']; ?>)</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Lokasi</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['locationname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">

                                    <td style="width: 25%; height: 18px;">Catatan</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['memo']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table style="border-collapse: collapse; width: 100%; font-size:60%" border="1">
                        <thead>
                            <tr>
                                <td style="width: 11.1111%; text-align: center;">No</td>
                                <td style="width: 11.1111%;">Kode</td>
                                <td style="width: 11.1111%;">Uraian</td>
                                <td style="width: 11.1111%;">No.Batch</td>
                                <td style="width: 11.1111%;">Exp.Date</td>
                                <td style="width: 11.1111%;">Sistem</td>
                                <td style="width: 11.1111%;">Fisik</td>
                                <td style="width: 11.1111%;">Selisih</td>
                                <td style="width: 11.1111%;">Satuan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noa = 0;
                            foreach ($tampildata as $row) :
                                $noa++;
                            ?>

                                <tr>
                                    <td style="width: 2.1111%; text-align: center;"><?= $noa; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['code']; ?></td>
                                    <td style="width: 20.1111%;"><?= $row['name']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['batchnumber']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['expireddate']; ?></td>
                                    <td style="width: 4.1111%;"><?= $row['stockqty']; ?></td>
                                    <td style="width: 4.1111%;"><?= $row['realqty']; ?></td>
                                    <td style="width: 4.1111%;"><?= $row['qty']; ?></td>
                                    <td style="width: 11.1111%;"><?= $row['uom']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 90px; font-size:60%" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">Pelaksana</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Pemeriksa</td>
                            </tr>

                            <tr style="height: 40px;">
                                <td style="width: 50%; text-align: center; height: 18px;"></td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;"></td>
                            </tr>

                            <?php
                            foreach ($dataopname as $tanda) :
                            ?>
                                <tr style="height: 100px;">
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['createdby']; ?></u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u></u></td>
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