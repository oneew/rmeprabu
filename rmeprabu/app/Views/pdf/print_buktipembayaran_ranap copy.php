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
            /* margin: 25px 12px; */
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.3.cm;
            margin-right: 1.3.cm;
            line-height: 1.2;
            color: black;
        }

        body {
            font-size: 14px;
            line-height: 1.5;
            font-family: "Arial", "sans-serif," "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
        <div class="row" style="font-size: 100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1.2" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 5%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50px;" src="./assets/images/gallery/pemkab.png" width="50" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 90%; text-align: center; font: size 100px;">
                                <b class="text-info"><?= $header1; ?></b>
                            </td>
                            <td style="width: 5%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50px;" src="./assets/images/gallery/muaraenim.png" width="50" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 90%; text-align: center; font: size 100px;">
                                <b>
                                    <font size="22px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 90%; text-align: center;">
                                <font size="1"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 100%; text-align: center; line-height: 1.2" colspan="3">
                                <br>
                                <b>
                                    <font size="4"> <?php echo $deskripsi; ?> </font>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <font size="14px">
                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>
                                    <tr>
                                        <td style="border-collapse: collapse; width: 100%; line-height: 2;" colspan="4"><u>SUDAH TERIMA DARI</u></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">No. Kwitansi</td>
                                        <td style="width: 45%">: <?php echo $row['validationnumber']; ?></td>
                                        <td style="width: 15%">No. Rekam medik</td>
                                        <td style="width: 25%">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">No. Pendaftaran</td>
                                        <td style="width: 45%">: <?php echo $row['referencenumber']; ?></td>
                                        <td style="width: 15%">Pembayaran</td>
                                        <td style="width: 25%">: <?php echo $row['paymentmethodname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Nama pasien</td>
                                        <td style="width: 45%">: <b><?php echo $row['pasienname']; ?></b></td>
                                        <td style="width: 15%">Tgl Lahir</td>
                                        <td style="width: 25%">: <?php echo $row['pasiendateofbirth']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Alamat</td>
                                        <td style="width: 85%" colspan="3">: <?php echo $row['pasienaddress']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Ruangan</td>
                                        <td style="width: 85%" colspan="3">: <?php echo $row['roomname']; ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php /* kondisi mencari angka rata kanan .......*/ ?>

                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 100%; line-height: 1.5;" colspan="7"><u>RINCIAN BIAYA PELAYANAN RAWAT INAP</u></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%">Biaya Kamar</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totalkamar'], 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Biaya Visite & Tindakan</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php $visite_tindakan = $row['totalvisite'] + $row['totaltindakanruang'];
                                                                                echo number_format($visite_tindakan, 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%">Biaya penunjang & BHP</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php $penunjang = $row['totalpenunjang'] + $row['totalbhppenunjang'];
                                                                                echo number_format($penunjang, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Farmasi & BHP</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php $farmasi = $row['totalfarmasi'] + $row['totalbhptindakanruang'] + $row['totalbhptindakanoperasi'];
                                                                                echo  number_format($farmasi, 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%">Tindakan Operasi</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totaltindakanoperasi'], 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Gizi</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totalmakan'], 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><?php if ($row['groups'] == "IRJ") {
                                                                $asal = 'Pelayanan Rawat Jalan';
                                                            } else {
                                                                $asal = 'Pelayanan IGD';
                                                            }
                                                            ?>Tagihan <?= $asal; ?> </td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php $totalasal = $row['totalTagihanAsal'];
                                                                                echo number_format($totalasal, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Pembayaran Penunjang</td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totalkasirpenunjang'], 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="height:2mm" colspan="7"> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 50%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 5%"></td>
                                    <td style="width: 30%; line-height: 1"><b>Biaya Total</b></td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 20%; text-align: right;"><?php echo number_format($row['grandtotal'], 0, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 5%"></td>
                                    <td style="width: 30%; line-height: 1"><b>Jumlah Pembayaran</b></td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 20%; text-align: right;"><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                                    echo number_format($totalbayar, 0, ",", "."); ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 5%"></td>
                                    <td style="width: 30%; line-height: 1.2">Sisa Pembayaran</td>
                                    <td style="width: 1%">:</td>
                                    <td style="width: 20%; text-align: right"><?php
                                                                                $pembayaran = $row['paymentamount'] + $row['nominaldebet'];
                                                                                if ($pembayaran >= $row['grandtotal']) {
                                                                                    $sisabayar = 0;
                                                                                    $uangkembali = $pembayaran - $row['grandtotal'];
                                                                                } else {
                                                                                    if ($pembayaran < $row['grandtotal']) {
                                                                                        $sisabayar = ($row['grandtotal'] - ($row['paymentamount'] + $row['nominaldebet']));
                                                                                        $uangkembali = 0;
                                                                                    }
                                                                                }
                                                                                echo number_format($sisabayar, 0, ",", ".");  ?></td>
                                </tr>
                                <?php /*
                                <tr>
                                    <td style="width: 45%; text-align: center;">Jumlah Pembayaran</td>
                                    <td style="width: 45%; text-align: center;">Pembulatan</td>
                                    <td style="width: 33.3333%; text-align: center;">Uang Kembali</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                                        echo number_format($totalbayar, 0, ",", "."); ?></b></td>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php $bulat = round($totalbayar);
                                                                                        echo number_format($bulat, 0, ",", "."); ?></b></td>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php echo number_format($uangkembali, 0, ",", ".");  ?></b></td>
                                </tr>
                                */ ?>
                            </tbody>
                        <?php endforeach; ?>
                        </table>

                    </div>

                    <?php /*
                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; margin-left:auto;margin-right:auto" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 45%; text-align: center;">Total Biaya</td>
                                    <td style="width: 45%; text-align: center;">Pembayaran Penunjang</td>
                                    <td style="width: 33.3333%; text-align: center;">Sisa Pembayaran</td>
                                </tr>
                                <tr>
                                    <td style="width: 45%; text-align: center;"><b><?php echo number_format($row['grandtotal'], 0, ",", "."); ?></b></td>
                                    <td style="width: 45%; text-align: center;"><b><?php echo number_format($row['totalkasirpenunjang'], 0, ",", "."); ?></b></td>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php
                                                                                        $pembayaran = $row['paymentamount'] + $row['nominaldebet'];
                                                                                        if ($pembayaran >= $row['grandtotal']) {
                                                                                            $sisabayar = 0;
                                                                                            $uangkembali = $pembayaran - $row['grandtotal'];
                                                                                        } else {
                                                                                            if ($pembayaran < $row['grandtotal']) {
                                                                                                $sisabayar = ($row['grandtotal'] - ($row['paymentamount'] + $row['nominaldebet']));
                                                                                                $uangkembali = 0;
                                                                                            }
                                                                                        }

                                                                                        echo number_format($sisabayar, 0, ",", ".");  ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 45%; text-align: center;">Jumlah Pembayaran</td>
                                    <td style="width: 45%; text-align: center;">Pembulatan</td>
                                    <td style="width: 33.3333%; text-align: center;">Uang Kembali</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                                        echo number_format($totalbayar, 0, ",", "."); ?></b></td>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php $bulat = round($totalbayar);
                                                                                        echo number_format($bulat, 0, ",", "."); ?></b></td>
                                    <td style="width: 33.3333%; text-align: center;"><b><?php echo number_format($uangkembali, 0, ",", ".");  ?></b></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                        </table>
                    </div>
                    */ ?>

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
                    <br>
                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 35%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 35%; text-align: center; height: 1px">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 35%; text-align: center; height: 1px;">Penyetor</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 35%; text-align: center; height: 1px;">Petugas Kasir</td>
                                </tr>
                                <?php
                                foreach ($datapasien as $tanda) :
                                ?>

                                    <tr style="height: 1px;">
                                        <td style="width: 35%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width:35%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="height: 30px;">

                                        <td style="width: 35%; text-align: center; height: 1px;"><u><?= $tanda['payersname']; ?></u></td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 35%; text-align: center; height: 1px;"><u><?= $tanda['createdby']; ?></u></td>
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