<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Surat Pesanan Gudang</title>
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
</head>

<body>

    <table style="border-collapse: collapse; width: 100%; height: 306px;" border="0">
        <tbody>
            <?php $no = 0;
            foreach ($dataopname as $row) :
                $no++;
            ?>
                <tr style="height: 18px;">
                    <td style="width: 5%; text-align: center; height: 54px;" rowspan="7">
                        <div class="img">
                            <img style="height: 40px;" src="./assets/images/bunut-icon.png" width="40" class="dark-logo" />

                        </div>
                    </td>
                    <td style="width: 94.7723%; text-align: center; height: 18px;"><strong>PEMERINTAH KABUPATEN MUARA ENIM</strong></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 94.7723%; text-align: center; height: 18px;"><strong>RUMAH SAKIT UMUM DAERAH</strong></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 94.7723%; text-align: center; height: 18px;"><strong>H. M. RABAIN</strong></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 100%; height: 18px;" colspan="2">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px; width: 100%;" colspan="2"></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px; width: 100%;" colspan="2">
                        <hr />
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px; width: 100%;" colspan="2"><b>No. SP : <?= $row['journalnumber']; ?></b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="text-align: right; height: 18px; width: 100%;" colspan="2">Kepada:</td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px; text-align: right;  width: 100%;" colspan="2"><?= $row['destinationname']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="text-align: right; height: 18px; width: 100%;" colspan="2">Di</td>
                </tr>
                <tr style="height: 18px;">
                    <td style="text-align: right; height: 18px; width: 100%;" colspan="2"><?= $row['destinationaddress']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="text-align: center; height: 18px; width: 100%;" colspan="2"><strong>DAFTAR PESANAN BARANG</strong></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="text-align: right; height: 18px;" colspan="2">
                        <table style="border-collapse: collapse; width: 100%;" border="1">
                            <tbody>
                                <tr>
                                    <td style="width: 25%;">No</td>
                                    <td style="width: 25%;">NAMA BARANG</td>
                                    <td style="width: 25%;">JUMLAH</td>
                                    <td style="width: 25%;">KETERANGAN</td>
                                </tr>
                                <?php $noa = 0;
                                foreach ($tampildata as $row) :
                                    $noa++;
                                ?>
                                    <tr>
                                        <td style="width: 25%;"><?= $noa; ?></td>
                                        <td style="width: 25%;"><?= $row['name']; ?></td>
                                        <td style="width: 25%;"><?= $row['qty']; ?></td>
                                        <td style="width: 25%;">&nbsp;</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; width: 100%;" colspan="2">
                        <table style="border-collapse: collapse; width: 100%; height: 186px;" border="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
                                    <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
                                    <td style="width: 33.3333%; text-align: center; height: 18px;">Muara Enim, <?= date('d-m-Y'); ?></td>
                                </tr>
                                <tr style="height: 78px;">
                                    <td style="width: 33.3333%; height: 78px;">&nbsp;</td>
                                    <td style="width: 33.3333%; height: 78px;">&nbsp;</td>
                                    <td style="width: 33.3333%; height: 78px;">
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>