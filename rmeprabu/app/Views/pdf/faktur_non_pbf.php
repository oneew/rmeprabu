<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Faktur Terima Barang Masuk PBF</title>
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
                                    <h6> FAKTUR PENERIMAAN BARANG MASUK DARI NON PBF</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 36px; font-size:60%" border="0">
                        <tbody>
                            <?php $no = 0;
                            foreach ($datapasien as $row) :
                                $no++;
                            ?>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">No Faktur</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['invoicenumber']; ?>(<?= $row['invoicedate']; ?>)</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Dari</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['suppliername']; ?></td>
                                </tr>
                                <tr style="height: 18px;">

                                    <td style="width: 25%; height: 18px;">No Transaksi Penerimaan</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['journalnumber']; ?>(<?= $row['documentdate']; ?>)</td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table style="border-collapse: collapse; width: 100%; font-size:60%" border="1">
                        <thead>
                            <tr>
                                <td style="width: 4.1111%; text-align: center;">No</td>
                                <td style="width: 8.1111%;">KodeObat</td>
                                <td style="width: 8.1111%;">No.Batch</td>
                                <td style="width: 12.1111%;">Exp.Date</td>
                                <td style="width: 8.1111%;">Jumlah Box</td>
                                <td style="width: 8.1111%;">Jumlah Isi</td>
                                <td style="width: 8.1111%;">Jumlah</td>
                                <td style="width: 15.1111%;">Satuan</td>
                                <td style="width: 15.1111%;">Harga</td>
                                <td style="width: 15.1111%;">PPN</td>
                                <td style="width: 15.1111%;">TotalDiscount</td>
                                <td style="width: 15.1111%;">SubTotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noa = 0;
                            foreach ($detail as $row) :
                                $noa++;
                            ?>

                                <tr>
                                    <td style="width: 4.1111%; text-align: center;"><?= $noa; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['code']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['batchnumber']; ?></td>
                                    <td style="width: 12.1111%;"><?= $row['expireddate']; ?></td>

                                    <td style="width: 8.1111%;"><?= $row['qtybox']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['volume']; ?></td>
                                    <td style="width: 8.1111%;"><?= abs($row['qty']); ?></td>
                                    <td style="width: 15.1111%;"><?= $row['uom']; ?></td>
                                    <td style="width: 15.1111%;"><?php echo number_format($row['price'], 2, ",", "."); ?></td>
                                    <td style="width: 15.1111%;"><?php echo number_format($row['taxamount'], 2, ",", "."); ?></td>
                                    <td style="width: 15.1111%;"><?php echo number_format($row['totaldiscount'], 2, ",", "."); ?></td>
                                    <td style="width: 15.1111%;"><?php echo number_format($row['subtotal'], 2, ",", "."); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                foreach ($datapasien as $row) :

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
                                <td style="width: 50%; text-align: center; height: 18px;">Dikirim Oleh</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Penerima</td>
                            </tr>

                            <tr style="height: 40px;">
                                <td style="width: 50%; text-align: center; height: 18px;"></td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;"></td>
                            </tr>

                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>
                                <tr style="height: 100px;">
                                    <td style="width: 50%; text-align: center; height: 18px;"></td>
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