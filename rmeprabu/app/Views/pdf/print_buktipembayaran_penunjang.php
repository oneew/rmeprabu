<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Penunjang</title>
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
                                    <td style="width: 100%;" colspan="4"><u><b>Sudah Terima Dari</b></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">No. Kwitansi</td>
                                    <td style="width: 25%;">: <?php echo $row['validationnumber']; ?></td>
                                    <td style="width: 25%;">No. Rekam medik</td>
                                    <td style="width: 25%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">No. Pendaftaran</td>
                                    <td style="width: 25%;">: <?php echo $row['referencenumber']; ?></td>
                                    <td style="width: 25%;">Pembayaran</td>
                                    <td style="width: 25%;">: <?php echo $row['paymentmethodname']; ?> |<?php echo $row['poliklinikname']; ?> </td>
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
                                <td style="width: 100%;" colspan="4"><u><b>Kategori Pelayanan</b></u></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Jenis Pelayanan</td>
                                <td style="width: 25%;">: <?php if ($row['groups'] == 'RAD') {
                                                                $pemeriksaan = " Radiologi";
                                                            } else {
                                                                if ($row['groups'] == 'LPK') {
                                                                    $pemeriksaan = " Laboratorium Patologi Klinik";
                                                                } else {
                                                                    if ($row['groups'] == 'LPA') {
                                                                        $pemeriksaan = " Laboratorium Patologi Antomi";
                                                                    } else {
                                                                        if ($row['groups'] == 'BD') {
                                                                            $pemeriksaan = " Bank Darah";
                                                                        }
                                                                    }
                                                                }
                                                            } ?>
                                    <b><?= $pemeriksaan; ?></b>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; margin-left:auto;margin-right:auto" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;">Total Biaya</td>
                                <td style="width: 33.3333%; text-align: center;"></td>
                                <td style="width: 33.3333%; text-align: center;">Sisa Pembayaran</td>
                            </tr>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;"><b><?php echo number_format($row['grandtotal'], 2, ",", "."); ?></b></td>
                                <td style="width: 33.3333%; text-align: center;"><b></b></td>
                                <td style="width: 33.3333%; text-align: center;"><b><?php $sisabayar = ($row['grandtotal'] - ($row['paymentamount'] + $row['nominaldebet']));
                                                                                    echo number_format($sisabayar, 2, ",", "."); ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;">Jumlah Pembayaran</td>
                                <td style="width: 33.3333%; text-align: center;">Pembulatan</td>
                                <td style="width: 33.3333%; text-align: center;">Status</td>
                            </tr>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;"><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                                    echo number_format($totalbayar, 2, ",", "."); ?></b></td>
                                <td style="width: 33.3333%; text-align: center;"><b><?php $bulat = round($totalbayar);
                                                                                    echo number_format($bulat, 2, ",", "."); ?></b></td>
                                <td style="width: 33.3333%; text-align: center;"><b><?= $row['paymentstatus']; ?></b></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                    </table>
                </div>
                <?php
                function penyebut($nilai)
                {
                    $nilai = abs($nilai);
                    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                    $temp = "";
                    if ($nilai < 12) {
                        $temp = " " . $huruf[$nilai];
                    } else if ($nilai < 20) {
                        $temp = penyebut($nilai - 10) . " belas";
                    } else if ($nilai < 100) {
                        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
                    } else if ($nilai < 200) {
                        $temp = " seratus" . penyebut($nilai - 100);
                    } else if ($nilai < 1000) {
                        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                    } else if ($nilai < 2000) {
                        $temp = " seribu" . penyebut($nilai - 1000);
                    } else if ($nilai < 1000000) {
                        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
                    } else if ($nilai < 1000000000) {
                        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
                    } else if ($nilai < 1000000000000) {
                        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
                    } else if ($nilai < 1000000000000000) {
                        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
                    }
                    return $temp;
                }

                function terbilang($nilai)
                {
                    if ($nilai < 0) {
                        $hasil = "minus " . trim(penyebut($nilai));
                    } else {
                        $hasil = trim(penyebut($nilai));
                    }
                    return $hasil;
                }


                ?>
                <b>Terbilang : #<?php echo ucwords(terbilang($totalbayar)) . " Rupiah"; ?>#</b>
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
                                <td style="width: 50%; text-align: center; height: 18px;">Penyetor</td>
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