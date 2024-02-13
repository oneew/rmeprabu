<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Kasir IGD</title>
    <style type="text/css">
        @page {
            /* margin: 25px 12px; */
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.3.cm;
            margin-right: 1.5.cm;
            line-height: 1.2;
            color: black;
        }

        body {
            font-size: 12px;
            line-height: 1.3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
</head>

<body>

    <!-- <div class="container-fluid"> -->
    <div class="container">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1;" border="0">
                    <tbody>
                    <tr>
                            <td style="width: 12%; text-align: left;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px; text-align: left;" src="./assets/images/gallery/pemkab.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="text-align: left;">
                                <!-- <b> -->
                                    <font size=16px><?= $header1; ?></font>
                                <!-- </b> -->
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <b>
                                    <font size="20px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="text-align: left;">
                                <font size="1"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr style="margin-top: 4px;">
                <table style="border-collapse: collapse; width: 100%;" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 100%; text-align: center;">
                                <font size=16px>
                                    <b> <?= $deskripsi; ?> IGD</b>
                                </font>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php
                $i = 1;
                // $totalbayarkasir_RJ = abs($TotalKasirApotek_RJ) + abs($TotalKasirPnj_RJ) + abs($TotalKasir_Tindakan);
                ?>


                <div class="pull-text">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr>
                                    <td style="width: 100%;" colspan="4"><u><b>Sudah Terima Dari</b></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">No. Kwitansi</td>
                                    <td style="width: 45%;">: <?php echo $row['journalnumber']; ?></td>
                                    <td style="width: 10%;">No. Rekam medik</td>
                                    <td style="width: 35%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                </tr>
                                <tr>
                                    <td>No. Pendaftaran</td>
                                    <td>: <?php echo $row['referencenumber']; ?></td>
                                    <td>Pembayaran</td>
                                    <td>: <?php echo $row['paymentmethodname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama pasien</td>
                                    <td>: <?php echo $row['pasienname']; ?></td>
                                    <td>Tgl Lahir</td>
                                    <td>: <?php echo date('d-m-Y', strtotime($row['pasiendateofbirth'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td colspan="3">: <?php echo $row['pasienaddress']; ?></td>
                                </tr>

                        </tbody>
                    </table>
                </div>
                <br>
                <div class="pull-text">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>

                            <tr>
                                <td style="width: 100%;" colspan="7"><u><b>Rincian Biaya Instalasi Gawat Darurat</b></u></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 25%;">Biaya Pendaftaran</td>
                                <td style="width: 2%;">:</td>
                                <td style="text-align: right; width: 10%;"><?php echo number_format($row['totaldaftar'], 2, ",", "."); ?></td>
                                <td style="width: 15%;"> </td>
                                <td style="text-align: left; width: 35%;">Biaya Pelayanan & Operasi</td>
                                <td style="width: 2%;">:</td>
                                <td style="text-align: right; width: 10%;"><?php echo number_format($row['totaltindakan'], 2, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <td>Biaya Penunjang</td>
                                <td>:</td>
                                <td style="text-align: right;"><?php echo number_format($row['totalpenunjang'], 2, ",", "."); ?></td>
                                <td></td>
                                <td>Farmasi & BHP</td>
                                <td>:</td>
                                <td style="text-align: right;"><?php $farmasi = $row['totalfarmasi'] + $row['totalbhp'];
                                                                echo  number_format($farmasi, 2, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <!-- <td> </td>
                                <td> </td> -->
                                <td colspan="7">
                                    <hr style="margin-bottom: 2px; margin-top: 0px">
                                </td>
                            </tr>
                            <?php
                    $totalbiaya = abs($TotalPemeriksaan) + abs($TotalTNO) +
                        abs($TotalPenunjang) + abs($TotalFarmasi) + abs($TotalBHP) + abs($TotalOperasi);
                    $totalbayarawal = $TotalKasirApotek_RJ + $TotalKasirPnj_RJ  + $TotalKasir_Tindakan;
                    ?>
                            <tr>
                                <font style="font-size: 14px;">
                                    <td><b>Total Biaya</b></td>
                                    <td><b>:</b></td>
                                    <td style="text-align: right;"><b><?php echo number_format($row['subtotal']+$totalbayarawal, 2, ",", ".");
                                                                        ?></b></td>
                                </font>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                            
                                <font style="font-size: 14px;">
                                    <td>Deposit</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php echo number_format($totalbayarawal, 2, ",", "."); ?></td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </font>
                            </tr>
                            <!-- <tr>
                                    <td colspan="3">
                                    </td>
                                    <td> </td>
                                    <td>
                                        <hr style="margin-bottom: 2px; margin-top: 2px">
                                    </td>
                                    <td> </td>
                                    <td>
                                        <hr style="margin-bottom: 2px; margin-top: 2px">
                                    </td>
                                </tr> -->
                            <tr>
                                <font style="font-size: 14px;">
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php echo number_format($row['disc'], 2, ",", ".");
                                                                    ?></td>
                                    <td> </td>
                                    <td><b>PembayaranTagihan</b></td>
                                    <td> </td>
                                    <td><b>Piutang</b></td>
                                </font>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-bottom: 2px; margin-top: 2px">
                                </td>
                                <td> </td>
                                <td>
                                    <hr style="margin-bottom: 2px; margin-top: 2px">
                                </td>
                                <td> </td>
                                <td>
                                    <hr style="margin-bottom: 2px; margin-top: 2px">
                                </td>
                            </tr>

                            <tr>
                                <font style="font-size: 14px;">
                                    <td><b>TotalTagihanBiaya</b></td>
                                    <td><b>:</b></td>
                                    <td style="text-align: right;"><b><?php
                                                                        $tagihanAwal = abs($row['grandtotal']);
                                                                        echo number_format($tagihanAwal, 2, ",", ".");
                                                                        ?></b></td>
                                    <td> </td>
                                    <td><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                            echo number_format($totalbayar, 2, ",", "."); ?></b></td>
                                    <td> </td>
                                    <!-- menghitung Piutang -->
                                    <?php
                                    $bayar = $tagihanAwal - $totalbayar;
                                    if (round($bayar, 2) > 2) {
                                        $sisabayar = $tagihanAwal - $totalbayar;
                                    } else {
                                        $sisabayar = 0;
                                    }; ?>
                                    <td> <?php echo number_format($sisabayar, 2, ",", "."); ?> </td>

                                    <!-- <td>?php echo number_format($uangkembali, 2, ",", "."); ?></td> -->
                                </font>
                            </tr>
                            <tr>
                                <!-- <td> </td>
                                <td> </td> -->
                                <td colspan="7">
                                    <hr style="margin-bottom: 1px; margin-top: 8px">
                                </td>
                            </tr>

                        </tbody>
                    </table>


                <?php endforeach; ?>



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
                Terbilang : #<?php echo ucwords(terbilang($totalbayar)) . " Rupiah"; ?>#
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
                            <tr>
                                <td style="width: 35%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 30%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 35%; text-align: center; height: 18px;">Muara Enin, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; height: 18px;">Penyetor</td>
                                <td rowspan="2" style="text-align: center; height: 18px;"><?= $barcode; ?></td>
                                <td style="text-align: center; height: 18px;">Petugas Kasir</td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>

                                <tr>
                                    <td style="text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td style="text-align: center; height: 18px;">&nbsp;</td> -->
                                    <td style="text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="text-align: center; height: 18px;"><u><?= $tanda['payersname']; ?></u></td>
                                    <td style="text-align: center; height: 18px;">
                                        <font size="1">Cetak <?= date('d-m-Y H:i:s'); ?> WIB </font>
                                    </td>
                                    <td style="text-align: center; height: 18px;"><u><?= $tanda['createdby']; ?></u></td>
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