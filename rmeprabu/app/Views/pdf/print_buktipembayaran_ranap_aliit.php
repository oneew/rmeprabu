<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Kasir Rawat INap</title>
    <style type="text/css">
        @page {
            /* margin: 25px 12px; */
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.5.cm;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="font-size: 100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1;" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 10%; text-align: left;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/pemkab.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="text-align: left;">
                                <font size=16px>
                                    <?= $header1; ?>
                                </font>
                            </td>
                            <!-- <td style="width: 5%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/garut.png" width="60" class="dark-logo" />

                                </div>
                            </td> -->
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <font size=20px>
                                    <b><?= $header2; ?></b></h5>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;"><?= $alamat; ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr style="margin-top: 4px;">
                <table style="border-collapse: collapse; width: 100%;" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 100%; text-align: center;">
                                <font size=16px>
                                    <b> <?= $deskripsi; ?></b>
                                </font>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- ==================== -->
                <?php
                foreach ($PEMIGD as $PEM_IGD) :
                ?>
                    <?php
                    $TotPEMIGD[] = $PEM_IGD['price'];
                    $room_op = $PEM_IGD['poliklinik'];
                    ?>
                <?php endforeach; ?>

                <?php
                $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                $TotalPEMIGD = $check_TotPEMIGD;
                ?>

                <?php
                foreach ($TINIGD as $TIN_IGD) :
                ?>
                    <?php $TotTINIGD[] = $TIN_IGD['subtotal'];  ?>
                <?php endforeach; ?>

                <?php
                $check_TotTINIGD = isset($TotTINIGD) ? array_sum($TotTINIGD) : 0;
                $TotalTINIGD = $check_TotTINIGD;
                ?>


                <?php
                foreach ($OPERASIIGD as $OP_IGD) :
                    if ($room_op == $OP_IGD['room']) {
                ?>
                        <?php $TotOPIGD[] = $OP_IGD['totaltarif'];  ?>
                <?php };
                endforeach; ?>

                <?php
                $check_TotOPIGD = isset($TotOPIGD) ? array_sum($TotOPIGD) : 0;
                $TotalOPIGD = $check_TotOPIGD;
                ?>

                <?php
                foreach ($PENUNJANGIGD as $PNJIGD) :
                ?>
                    <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                <?php endforeach; ?>

                <?php
                $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                ?>

                <?php
                foreach ($FARMASIIGD as $FIGD) :
                ?>
                    <?php $awaligd = abs($FIGD['totalharga']);
                    $farigd = $awaligd + $FIGD['embalase'];
                    $deniigd = ceil($farigd);
                    // echo number_format($awaligd, 2, ",", ".") 
                    ?>
                    <?php $TotFARIGD[] = $awaligd;  ?>
                <?php endforeach; ?>
                <?php
                $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                $TotalFARIGD = $check_TotFARIGD;
                ?>


                <!-- ==================== -->


                <?php
                $i = 1;
                foreach ($kasir_igd_aliit as $ksr_pnj) :
                    $totbayar_igd[] = $ksr_pnj['paymentamount'];
                    $totbiaya_igd[] = $ksr_pnj['grandtotal'];
                ?>

                <?php endforeach;
                $check_totbayar_igd = isset($totbayar_igd) ? array_sum($totbayar_igd) : 0;
                $TotalBayar_igd = $check_totbayar_igd;

                $check_totbiaya_igd = isset($totbiaya_igd) ? array_sum($totbiaya_igd) : 0;
                $TotalBiaya_igd = $check_totbiaya_igd;
                ?>
                <font size="12px">
                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>

                                    <!-- mencari nilai ok igd atau ranap -->
                                    <?php
                                    if (
                                        abs($row['totaltindakanoperasi']) === abs($TotalOPIGD)
                                    ) {
                                        $operasiigd = abs($row['totaltindakanoperasi']);
                                        $operasiinap = 0;
                                    } elseif (abs($row['totaltindakanoperasi']) > abs($TotalOPIGD)) {
                                        $operasiigd = abs($row['totaltindakanoperasi']) - abs($TotalOPIGD);
                                        $operasiinap = abs($row['totaltindakanoperasi']) - abs($operasiigd);
                                    } else {
                                        $operasiigd = 0;
                                        $operasiinap = abs($row['totaltindakanoperasi']);
                                    }
                                    ?>

                                    <?php
                                    $TotalIGD = $TotalPEMIGD + $TotalTINIGD + abs($operasiigd) + $TotalPENUNJANGIGD + $TotalFARIGD
                                    ?>
                                    <tr>
                                        <td style="width: 100%;" colspan="4"><u><b>Sudah Terima Dari</b></u></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 7%;">No. Kwitansi</td>
                                        <td style="width: 56%;">: <?php echo $row['journalnumber']; ?></td>
                                        <td style="width: 7%;">No. Rekam medik</td>
                                        <td style="width: 30%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Pendaftaran</td>
                                        <td>: <?php echo $row['referencenumber']; ?></td>
                                        <td>Pembayaran</td>
                                        <td>: <?php echo $row['paymentmethodname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama pasien</td>
                                        <td>: <b><?php echo $row['pasienname']; ?></b></td>
                                        <td>Tgl Lahir</td>
                                        <td>: <?php echo date('d-m-Y', strtotime($row['pasiendateofbirth'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td colspan="3">: <?php echo $row['pasienaddress']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan</td>
                                        <td colspan="3">: <?php echo $row['roomname']; ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- kondisi mencari angka rata kanan .......* -->
                    <!-- menghitung jumlah bayar awal -->
                    <?Php
                                    $TotalKasirAwal =
                                        abs($TotalKasirApotek_RI) + abs($TotalKasirApotek_RJ) +
                                        abs($TotalKasirPnj_RI) + abs($TotalKasirPnj_RJ) +
                                        abs($TotalKasir_RJ) + abs($TotalKasir_Tindakan);

                                    $TotalKasirRI_Awal = abs($TotalKasirApotek_RI) + abs($TotalKasirPnj_RI);
                                    $TotalKasirRajalAwal = abs($TotalKasir_RJ) + abs($TotalKasirApotek_RJ) + abs($TotalKasirPnj_RJ);

                                    $TotalKasirPnjAwal = abs($TotalKasirPnj_RI) + abs($TotalKasirPnj_RJ);

                                    $TotalKasirApotekAwal = abs($TotalKasirApotek_RI) + abs($TotalKasirApotek_RJ);
                    ?>

                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 100%;line-height: 1.5;" colspan="7"><u><b>Rincian Biaya Pelayanan Rawat Inap</b></u></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 30%;">Biaya Kamar</td>
                                    <td style="width: 1%;">:</td>
                                    <td style="text-align: right; width: 8%;"><?php echo number_format($row['totalkamar'], 2, ",", "."); ?></td>
                                    <td style="width: 15%;"> </td>
                                    <td style="text-align: left; width: 30%;">Biaya Visite & Tindakan</td>
                                    <td style="width: 1%;">:</td>
                                    <td style="text-align: right; width: 8%;"><?php $visite_tindakan = $row['totalvisite'] + $row['totaltindakanruang'];
                                                                                echo number_format($visite_tindakan, 2, ",", "."); ?></td>
                                </tr>

                                <tr>
                                    <td>Biaya penunjang & BHP</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php $penunjang = $row['totalpenunjang'] + $row['totalbhppenunjang'];
                                                                    echo number_format($penunjang, 2, ",", "."); ?></td>
                                    <td></td>
                                    <td>Farmasi & BHP R. Inap</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php $farmasi = $row['totalfarmasi'] + $row['totalbhptindakanruang'];
                                                                    echo  number_format($farmasi, 2, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <td>Tindakan Operasi</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php echo number_format($row['totaltindakanoperasi'], 2, ",", "."); ?></td>
                                    <td></td>
                                    <td>Gizi</td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php echo number_format($row['totalmakan'], 2, ",", "."); ?></td>
                                </tr>
                                <tr>
                                    <!-- <td>Pembayaran Penunjang</td> -->
                                    <!-- <td>:</td> -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td style="text-align: right;">?php echo number_format($row['totalkasirpenunjang'], 0, ",", "."); ?></td> -->

                                    <td></td>
                                    <td><?php if ($row['groups'] == "IRJ") {
                                            $asal = 'Pelayanan R.Jalan';
                                        } else {
                                            $asal = 'Pelayanan IGD';
                                        }
                                        ?>Biaya<?= $asal; ?> </td>
                                    <td>:</td>
                                    <td style="text-align: right;"><?php $totalasal = $TotalIGD - $operasiigd;
                                                                    echo number_format($totalasal, 2, ",", "."); ?></td>

                                </tr>
                                <tr>
                                    <td style="height:2mm" colspan="7"> </td>
                                </tr>

                                <tr>
                                    <!-- <td> </td>
                                <td> </td> -->
                                    <td colspan="7">
                                        <hr style="margin-bottom: 2px; margin-top: 0px">
                                    </td>
                                </tr>

                                <tr>
                                    <?php $totalRANAP = abs($row['totalkamar']) + $visite_tindakan + $penunjang + $farmasi + abs($operasiinap) + abs($row['totalmakan']); ?>
                                    <font style="font-size: 14px;">
                                        <td><b>Total Biaya</b></td>
                                        <td><b>:</b></td>
                                        <!-- <td style="text-align: right;"><b>?php echo number_format($row['grandtotal'], 2, ",", "."); -->
                                        <td style="text-align: right;"><b><?php echo number_format($totalRANAP + $TotalIGD, 2, ",", ".");
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
                                        <?php
                                        $bayarwal_gab = $TotalKasirRajalAwal + $TotalKasirPnj_RI + $TotalKasirApotek_RJ;
                                        ?>
                                        <!-- <td style="text-align: right;">?php echo number_format($total, 2, ",", "."); ?></td> -->
                                        <td style="text-align: right;"><?php echo number_format($TotalKasirAwal, 2, ",", "."); ?></td>
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
                                        <td><b>Diskon</b></td>
                                        <td><b>:</b></td>
                                        <td style="text-align: right;"><b><?php echo number_format($row['discount'], 2, ",", ".");
                                                                            ?></b></td>
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
                                        <td>SisaTagihan</td>
                                        <td>:</td>
                                        <!-- <td style="text-align: right;">?php $tagihanAwal = $row['grandtotal'] - $TotalBayar_igd; -->
                                        <td style="text-align: right;"><?php $tagihanAwal = ($totalRANAP + $TotalIGD) -
                                                                            ($TotalKasirAwal + $row['discount']);
                                                                        echo number_format($tagihanAwal, 2, ",", ".");
                                                                        ?></td>
                                        <td> </td>
                                        <td><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                echo number_format($totalbayar, 2, ",", "."); ?></b></td>
                                        <td> </td>
                                        <!-- menghitung Piutang -->

                                        <?php
                                        // $bayar = $row['paymentamount'] + $row['nominaldebet'] + abs($TotalBayar_igd);
                                        // if ($row['grandtotal'] > $bayar) {
                                        //     $sisabayar = ($row['grandtotal'] - ($row['paymentamount'] +
                                        //         $row['nominaldebet'] + $TotalBayar_igd));
                                        //     $uangkembali = 0;
                                        //     $bilang = $bayar;
                                        // } else {
                                        //     $sisabayar = 0;
                                        //     $uangkembali = $sisabayar - $row['paymentamont'];
                                        //     // $uangkembali = $bulat - $bayar;
                                        //     $bilang = $row['grandtotal'];
                                        // };
                                        ?>
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
                    </div>

                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; margin-left:auto;margin-right:auto" border="0">
                            <tbody>
                                <?php
                                    $cara = $row['paymentmethod'];
                                    if (strpos($cara, 'JAMKESDA') !== false) {
                                        $plafon = 5000000;
                                        $textplafon = 'JAMKESDA';
                                    } else if (strpos($cara, 'JKN JASARAHRJA') !== false) {
                                        $plafon = 20000000;
                                        $textplafon = 'JKN JASARAHRJA';
                                    } else {
                                        $plafon = 0;
                                        $textplafon = "";
                                    }
                                ?>

                            </tbody>
                        <?php endforeach;
                        ?>
                        </table>
                        <!-- <hr style="margin-top: 1px;"> -->
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
                    */ ?> <?php
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
                            ?> Terbilang : #<?php echo ucwords(terbilang($totalbayar)) . " Rupiah"; ?># <?php
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

                                                                                                        ?> <br>
                    <div class="pull-text">
                        <br>
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 40%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 1px;">&nbsp;</td>
                                    <!-- <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td> -->
                                    <td style="width: 40%; text-align: center; height: 1px">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="text-align: center; height: 1px;">Penyetor</td>
                                    <td style="text-align: center; margin-top: 1px; margin-top: 1px" rowspan="3"><?= $barcode ?></td>
                                    <td style="text-align: center; height: 1px;">Petugas Kasir</td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="text-align: center; height: 1px;">&nbsp;</td>
                                </tr>
                                <?php
                                foreach ($datapasien as $tanda) :
                                ?>

                                    <tr style="height: 1px;">
                                        <td style="text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td> -->
                                        <td style="text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="height: 30px;">

                                        <td style="text-align: center; height: 1px;"><u><?= $tanda['payersname']; ?></u></td>
                                        <td class="bpjs" style="text-align: center;" colspan="1">ctk: <?= date('d-m-Y H:i:s'); ?></td>
                                        <td style="text-align: center; height: 1px;"><u><?= $tanda['createdby']; ?></u></td>
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