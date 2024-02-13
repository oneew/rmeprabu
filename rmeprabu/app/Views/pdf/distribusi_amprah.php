<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Distribusi Barang Amprah</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 12px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.5;
            color: black;
        }

        body {
            font-size: 16px;
            line-height: 1.5;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: black;
        }

        .wgaris {
            border-width: 0.5 px;
            /* border-style: solid; */
            border-top: 2px black;
            border-bottom: 2px black;
            border-left: 0px white;
            border-right: 0px white;
            /* border-left: #ff0000;
            border-right: #ff0000; */
        }

        .table {
            width: 100%;
        }
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
                                    <h6> <?= $deskripsi; ?></h6>
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
                                    <td style="width: 25%; height: 18px;">No Permintaan</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['journalnumber']; ?>(<?= $row['documentdate']; ?>)</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">Dari</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['locationname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">

                                    <td style="width: 25%; height: 18px;">Kirim Ke</td>
                                    <td style="width: 75%; height: 18px;">: <?= $row['referencelocationname']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table style="border-collapse: collapse; width: 100%; font-size:60%" border="1">
                        <thead>
                            <tr>
                                <td style="width: 4.1111%; text-align: center;">No</td>
                                <td style="width: 8.1111%;">KodeObat</td>
                                <td style="width: 15.1111%;">No.Batch</td>
                                <td style="width: 8.1111%;">Exp.Date</td>
                                <td style="width: 21.1111%;">Uraian</td>
                                <td style="width: 8.1111%;">JumlahPesan</td>
                                <td style="width: 8.1111%;">Jumlah Kirim</td>
                                <td style="width: 15.1111%;">Satuan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $noa = 0;
                            foreach ($tampildata as $row) :
                                $noa++;
                            ?>

                                <tr>
                                    <td style="width: 4.1111%; text-align: center;"><?= $noa; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['code']; ?></td>
                                    <td style="width: 15.1111%;"><?= $row['batchnumber']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['expireddate']; ?></td>

                                    <td style="width: 20.1111%;"><?= $row['name']; ?></td>
                                    <td style="width: 8.1111%;"><?= $row['qtyrequest']; ?></td>
                                    <td style="width: 8.1111%;"><?= abs($row['qty']); ?></td>
                                    <td style="width: 15.1111%;"><?= $row['uom']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                foreach ($dataopname as $row) :

                ?>


                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 90px; font-size:60%" border="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 100%; text-align: center; height: 20px;">Muara Enim, <?php $tanggal = $row['documentdate'];
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
                                                                                                            echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">Validasi Oleh</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 100%; text-align: center; height: 18px;">Petugas Penyedia(Gudang)</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">Pengirim</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">Penerima</td>
                                </tr>

                                <tr style="height: 40px;">
                                    <td style="width: 50%; text-align: center; height: 18px;"></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
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
                                        <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                        <td style="width: 50%; text-align: center; height: 18px;"><u></u></td>
                                    <?php endforeach; ?>
                                    </tr>
                            </tbody>

                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>