<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Penjualan Depo Rawat Inap</title>
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
                                    <h6><b class="text-info">PEMERINTAH KABUPATAN MUARA ENIM</b></h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6><b>RSUD H. M. RABAIN</b></h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6> BUKTI RESEP RAWAT INAP</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 36px; font-size:60%" border="0">
                        <tbody>
                            <?php
                            foreach ($dataheaderpenjualan as $row) :

                            ?>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Nomor</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['journalnumber']; ?>(<?= $row['documentdate']; ?>)</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Pasien</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['pasienid']; ?></td>
                                </tr>
                                <tr style="height: 18px;">

                                    <td style="width: 25%; height: 18px;">Ruangan</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['paymentmethodname']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table style="border-collapse: collapse; width: 100%; font-size:60%" border="1">
                        <thead>
                            <tr>
                                <td style="width: 4.1111%; text-align: center;">No</td>
                                <td style="width: 8.1111%;">Keterangan</td>
                                <td style="width: 8.1111%;">Exp.Date</td>
                                <td style="width: 8.1111%;">Jumlah</td>
                                <td style="width: 15.1111%;">Satuan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noa = 0;
                            foreach ($tampildata as $rowjual) :
                                $noa++;
                            ?>

                                <tr>
                                    <td style="width: 4.1111%; text-align: center;"><?= $noa; ?></td>
                                    <td style="width: 8.1111%;"><?= $rowjual['name']; ?></td>

                                    <td style="width: 8.1111%;"><?= $rowjual['expireddate']; ?></td>
                                    <td style="width: 8.1111%;"><?= abs($rowjual['qty']); ?></td>
                                    <td style="width: 15.1111%;"><?= $rowjual['uom']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                foreach ($dataheaderpenjualan as $row) :

                ?>
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
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</body>

</html>