<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Kasir Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 12px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.5;
            font-family: "Arial", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            color: black;
        }

        body {
            font-size: 10px;
            line-height: 1.5;
            font-family: "Arial", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            color: black;
        }

        table {

            width: 100%;
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
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 3%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/pemkab.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 90%; text-align: center; font: size 100px;">
                                <b>
                                    <font size="2"><?= $header1; ?> </font>
                                </b>
                            </td>
                            <td style="width: 3%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/muaraenim.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 90%; text-align: center; font: size 100px;">
                                <b>
                                    <font size="3"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 90%; text-align: center;">
                                <font size="1"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80%; text-align: center; line-height :1" colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100%; text-align: center; line-height :1" colspan="3">
                                <br>
                                <b>
                                    <font size="4"> <?php echo $deskripsi; ?> </font>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <font size="13px">
                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>
                                    <tr>
                                        <td style="border-collapse: collapse; width: 100%;" colspan="4"><u><b>Sudah Terima Dari</b></u></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 8%;">No. Kwitansi</td>
                                        <td style="width: 45%;">: <?php echo $row['journalnumber']; ?></td>
                                        <td style="width: 5%;">No. Rekam medik</td>
                                        <td style="width: 42%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?> [TL : <?php echo $row['pasiendateofbirth']; ?>]</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 8%;">No. Pendaftaran</td>
                                        <td style="width: 45%;">: <?php echo $row['referencenumber']; ?></td>
                                        <td style="width: 5%;">Pembayaran</td>
                                        <td style="width: 42%;">: <?php echo $row['paymentmethodname']; ?> | <?php echo $row['poliklinikname']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 8%;">Nama Pasien</td>
                                        <td style="width: 92%;" colspan="3">: <b><?php echo $row['pasienname']; ?></b></td>

                                    </tr>
                                    <tr>
                                        <td style="width: 8%;">Alamat</td>
                                        <td style="width: 92%;" colspan="3">: <?php echo $row['pasienaddress']; ?></td>

                                    </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                            <tbody>

                                <tr>
                                    <td style="width: 100%; line-height: 1.5;" colspan="4"><u><b>Rincian Biaya Rawat Jalan</b></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Biaya Pendaftaran</td>
                                    <td style="width: 45%;">: <?php echo number_format($row['totaldaftar'], 0, ",", "."); ?></td>
                                    <td style="width: 5%;">Biaya Tindakan</td>
                                    <td style="width: 42%;">: <?php echo number_format($row['totaltindakan'], 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Biaya penunjang</td>
                                    <td style="width: 45%;">: <?php echo number_format($row['totalpenunjang'], 0, ",", "."); ?></td>
                                    <td style="width: 5%;">Farmasi & BHP</td>
                                    <td style="width: 42%;">: <?php $farmasi = $row['totalfarmasi'] + $row['totalbhp'];
                                                                echo  number_format($farmasi, 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="height:2mm;"></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1; " border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 70%; text-align: left; line-height: 1;"><u><b>Total Biaya Rawat Jalan</b></u></td>
                                    <td style="width: 30%; text-align: left;"><u><b>Jumlah Pembayaran</b></u></td>
                                    <?php
                                    /* <td style="width: 25%; text-align: center;"><u><b>Sisa Pembayaran</b></u></td>*/
                                    ?>
                                </tr>
                                <tr>
                                    <td style="width: 70%; text-align: left; line-height: 1;"><?php echo number_format($row['subtotal'], 0, ",", "."); ?>
                                        <?php if ($row['paymentmethodname'] == "TUNAI") { ?> =
                                            (Karcis : <?= number_format($row['totaldaftar'], 0, ",", "."); ?>) + (Pel: <?php $bersih = $row['subtotal'] - $row['totaldaftar'];
                                                                                                                        echo number_format($bersih, 0, ",", "."); ?>)
                                        <?php } ?>
                                    </td>
                                    <td style="width: 30%; text-align: left;"><?php echo number_format($row['kasirpenunjang'], 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%; text-align: left; line-height: 1.5 ;"> <?php
                                                                                                    $bayar = $row['paymentamount'] + $row['nominaldebet'];
                                                                                                    $karcis = $row['totaldaftar'];
                                                                                                    if ($row['paymentmethodname'] == "TUNAI") {
                                                                                                        if ($row['subtotal'] > ($bayar + $karcis)) {
                                                                                                            $sisabayar = ($row['subtotal'] - ($row['paymentamount'] + $row['nominaldebet'] + $row['totaldaftar']));
                                                                                                            $uangkembali = 0;
                                                                                                            $bilang = $bayar;
                                                                                                        } else {
                                                                                                            $sisabayar = 0;
                                                                                                            $uangkembali = ($bayar + $karcis) - $row['subtotal'];
                                                                                                            $bilang = $row['subtotal'];
                                                                                                        }
                                                                                                    } else {
                                                                                                        if ($row['subtotal'] > $bayar) {
                                                                                                            $sisabayar = ($row['subtotal'] - ($row['paymentamount'] + $row['nominaldebet']));
                                                                                                            $uangkembali = 0;
                                                                                                            $bilang = $bayar;
                                                                                                        } else {
                                                                                                            $sisabayar = 0;
                                                                                                            $uangkembali = $bayar - $row['subtotal'];
                                                                                                            $bilang = $row['subtotal'];
                                                                                                        }
                                                                                                    } ?>
                                        <?php /*echo number_format($sisabayar, 2, ",", "."); */ ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:1mm;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 70%;"></td>
                                    <td style="width: 30%; text-align: left;"><u><b>Pembayaran Pelayanan</b></u></td>
                                    <?php /*
                                    <td style="width: 25%; text-align: center;"><u><b>Pembulatan</b></u></td>
                                    <td style="width: 25%; text-align: center;"><u><b>Uang Kembali</b></u></td> */
                                    ?>
                                </tr>
                                <tr>
                                    <td style="width: 70%;"></td>
                                    <td style="width: 30%; text-align: left;"><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                                echo number_format($totalbayar, 0, ",", "."); ?></td>
                                </tr>
                                <td>

                                <td style="width: 25%; text-align: left;"><?php $bulat = round($totalbayar);
                                                                            /*echo number_format($bulat, 0, ",", "."); */  ?></td>
                                <td style="width: 25%; text-align: left;"><?php
                                                                            /*echo number_format($uangkembali, 2, ",", ".");*/ ?></td>

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
                    <b>Terbilang :</b> #<?php echo ucwords(terbilang($bilang)) . " Rupiah"; ?>#
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
                        <table style="border-collapse: collapse; width: 100%; height: 1px;" border="0">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 30%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 30%; text-align: center; height: 1px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 30%; text-align: center; height: 1px;">Penyetor</td>
                                    <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 30%; text-align: center; height: 1px;">Petugas Kasir</td>
                                </tr>
                                <?php
                                foreach ($datapasien as $tanda) :
                                ?>

                                    <tr style="height: 1px;">
                                        <td style="width: 45%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 8%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 5%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 40%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="height: 30px;">

                                        <td style="width: 30%; text-align: center; height: 1px;"><u><?= $tanda['payersname']; ?></u></td>
                                        <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 30%; text-align: center; height: 1px;"><u><?= $tanda['createdby']; ?></u></td>
                                    <?php endforeach; ?>
                                    </tr>
                            </tbody>

                        </table>
                    </div>
                </font>
            </div>
        </div>
    </div>


</body>

</html>