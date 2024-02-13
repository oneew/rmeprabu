<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Biaya Instalasi Gawat Darurat</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 12px;
            margin-top: 0.8.cm;
            margin-bottom: 1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.3;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-size: 12px;
            line-height: 1.3;
            /* font-family: "Arial", "sans-serif,""Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: black;
        }

        .wgaris {
            border-width: 1px;
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
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                        <td style="width: 2.cm; text-align: left;" rowspan="3">
                                    <div class="img">
                                        <img style="height: 45px;" src="./assets/images/gallery/pemkab.png" width="45px" class="dark-logo" />
                                    </div>
                                </td>
                            <td style="text-align: left;">
                                <b>
                                    <font size=16px><?= $header1; ?></font>
                                </b>
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <b>
                                    <font size="20px"><?= $header2; ?></font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="text-align: left;">
                                <font size="1"><?php echo $alamat; ?></font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr style="margin-top: 2px; margin-bottom: 2px;">
                <table style="border-collapse: collapse; width: 100%; line-height: 1.3;" border="0">
                    <tbody>
                        <?php
                        foreach ($datapasien as $row) :
                            $nokwitansi = $row['journalnumber'];
                            //     $bayarkasir = $row['paymentamount'];
                            $klinik = strtolower($row['poliklinikname']);
                        ?>
                        <?php endforeach ?>

                        <?php $textdeskripsi = ucwords($klinik)
                        ?>
                        <tr>
                            <td style="text-align: center; line-height :1" colspan="3">
                                <br>
                                <u>
                                    <!-- <font size="4">?php echo $deskripsi; ?></font> -->

                                    <font size="4">
                                        Rincian Biaya <?= ucwords($klinik) ?>
                                    </font>
                                </u>

                                <?php if ($statusvalidasi == 'sudah') { ?>
                                    <br style="line-height: 3">No. : <?= $nokwitansi; ?>
                                <?php } ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <br>


                <table class="verifikasi" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
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

                            <tr>
                                <td style="width: 15%;">No. Pendaftaran</td>
                                <td style="width: 32%;">: <?= $row['journalnumber']; ?></td>
                                <td style="width: 16%;">Tgl Pendaftaran</td>
                                <td style="width: 39%;">: <?= date('d-m-Y', strtotime($documentdate)); ?> | <?= $createdby; ?></td>
                                <!-- <td style="width: 25%;">: <?php echo tgl_indo($tanggal); ?></td> -->
                            </tr>
                            <tr>
                                <td>Poliklinik</td>
                                <td>: <?= $row['poliklinikname']; ?></td>
                                <td>Pembayaran</td>
                                <td>: <?= $row['paymentmethodname']; ?></td>
                            </tr>

                            <tr>
                                <td>No. RM</td>
                                <td>: <?= $row['pasienid']; ?></td>
                                <td>Dokter Pemeriksa</td>
                                <td rowspan="0">: <?= $row['doktername']; ?></td>
                            </tr>

                            <tr>
                                <td>Nama Pasien</td>
                                <td colspan="3">: <b><?= $row['pasienname']; ?></b></td>

                            </tr>
                            <tr>
                                <td>ALamat</td>
                                <td colspan="3">: <?= $row['pasienaddress']; ?></td>

                            </tr>

                            <?php //endforeach; 
                            ?>
                    </tbody>
                </table>
                <br>
                <table class="verifikasi" id="dataGabung" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <hr style="margin-bottom: 2; margin-top: 2">
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: left; width: 4%">No</th>
                            <th style="text-align: left; width: 10%">Tanggal</th>
                            <th style="text-align: left; width: 31%">Keterangan</th>
                            <th style="text-align: left; width: 27%">Dokter</th>
                            <th style="text-align: right; width: 13%">Harga</th>
                            <!-- <th style="text-align: right; width: 5%">Qty</th> -->
                            <th style="text-align: right; width: 15%">Total</th>
                        </tr>
                        <tr>
                            <th colspan="6">
                                <hr style="margin-bottom: 2; margin-top: 2">
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- menghitung jumlah pemeriksaan -->
                        <?php
                            $no = 1;
                            foreach ($pasien as $row) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td style="text-align: left;"><?= date('d-m-Y', strtotime($row['documentdate'])) ?></td>
                                <td style="text-align: left;"><?= $row['description'] ?> [<?= number_format(1, 2, ",", ".") ?>]</td>
                                <td style="text-align: left;"><?= $row['doktername'] ?></td>
                                <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".") ?></td>
                                <?php $TotPemeriksaan[] = $row['price'];  ?>

                            </tr>
                        <?php endforeach; ?>
                        <?php
                            $check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                            $TotalPemeriksaan = $check_TotPem; ?>

                        <?php
                            $no = 1;
                            if ($TotalPemeriksaan > 0) { ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td style="text-align: right;" colspan="3">
                                    <hr style="margin-bottom: 2; margin-top: 2">
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td style="text-align: right;" colspan="2"><b>Sub Total</b></td>
                                <td style="text-align: right;">
                                    <b>
                                        <?= number_format($TotalPemeriksaan, 2, ",", "."); ?>
                                    </b>
                                </td>
                            </tr>

                        <?php } ?>
                        < <!-- menghitung tindakan non operatif -->
                            <?php
                            foreach ($TNO as $rowTNO) :


                            ?>
                                <tr>

                                    <td><?= $no++ ?></td>
                                    <td><?= date('d-m-Y', strtotime($rowTNO['documentdate'])) ?></td>
                                    <td>
                                        <?= $rowTNO['name'] ?>[<?= $rowTNO['qty'] ?>]
                                    </td>
                                    <td><?= $rowTNO['doktername'] ?></td>
                                    <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                    <?php $TotTNO[] = $rowTNO['subtotal'];  ?>

                                </tr>
                            <?php endforeach; ?>
                            <?php
                            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                            $TotalTNO = $check_TotTNO;
                            ?>

                            <?php
                            $no = 1;
                            if ($TotalTNO > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="3">
                                        <hr style="margin-bottom: 2; margin-top: 2">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="2"><b>Sub Total Tindakan Non Operatig</b></td>
                                    <td style="text-align: right;">
                                        <b>
                                            <?= number_format($TotalTNO, 2, ",", "."); ?>
                                        </b>
                                    </td>
                                </tr>

                            <?php } ?>

                            <!-- menghitung penunjang -->
                            <?php
                            foreach ($PENUNJANG as $P) :


                            ?>
                                <tr>
                                    <?php if ($P['groups'] == "RAD") {
                                        $deskripsi = 'Radiologi';
                                    }
                                    if ($P['groups'] == "LPK") {
                                        $deskripsi = 'Lab Patologi Klinik';
                                    }
                                    if ($P['groups'] == "LPA") {
                                        $deskripsi = 'Lab Patologi Anatomi';
                                    }
                                    if ($P['groups'] == "BD") {
                                        $deskripsi = 'Bank Darah';
                                    }
                                    ?>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d-m-Y', strtotime($P['documentdate'])) ?></td>
                                    <td><?= $P['types'] ?> | <?= $P['name']; ?> [<?= number_format($P['qty'], 2, ",", ".") ?>]</td>
                                    <td><?= $P['doktername'] ?></td>
                                    <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                            $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                            $TotalPenunjang = $check_TotPenunjang;
                            ?>

                            <?php
                            $no = 1;
                            if ($TotalPenunjang > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="3">
                                        <hr style="margin-bottom: 2; margin-top: 2">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                                    <td style="text-align: right;">
                                        <b>
                                            <?= number_format($TotalPenunjang, 2, ",", "."); ?>
                                        </b>
                                    </td>
                                </tr>

                            <?php } ?>

                            <!-- Menghitung Farmasi -->
                            <!-- Farmasi ranap -->
                            <?php
                            $i = 0;
                            foreach ($FARMASI as $F) :
                                // if ($F['roomname'] == $ruangan) {
                                    $TotFAR[] = abs($F['subtotal']);
                                    $TotFr[] = abs($F['subtotal']);
                                // };
                            endforeach ?>
                            <?php
                            $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                            $TotalFAR = $check_TotFAR;

                            $sub_TotFr = isset($TotFr) ? array_sum($TotFr) : 0;
                            if ($sub_TotFr > 0) { ?>
                                <tr>
                                    <td colspan="6"><u>Farmasi</u></td>
                                </tr>
                            <?php } ?>
                            <?php
                            foreach ($FARMASI as $F) :
                                // if ($F['roomname'] == $ruangan) { ?>
                                    <?php
                                    unset($TotFr[$i]);
                                    $i++; ?>
                                    <?php if (abs($F['subtotal']) > 0) { ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td> <?= date('d-m-Y', strtotime($F['documentdate'])) ?></td>
                                            <td><?= $F['name']  ?> [<?= number_format(abs($F['qty']), 2, ",", ".") ?>]</td>
                                            <td><?= $F['doktername']  ?></td>
                                            <td style="text-align: right;"><?= number_format($F['price'], 2, ",", ".") ?></td>

                                            <td style="text-align: right;"><?php $awal = (abs($F['subtotal']));
                                                                            $far = $awal + $F['embalase'];
                                                                            $deni = ceil($far);
                                                                            echo number_format($awal, 2, ",", ".") ?></td>
                                            <?php $no++; ?>
                                        </tr>
                            <?php };
                                // };
                            endforeach; ?>

                            <?Php if ($i > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3">
                                        <hr style="margin-top: 2px; margin-bottom: 2px">
                                    </td>
                                </tr>
                                <tr>
                                    <!-- <td style="text-align: right" colspan="5">Sub Total (Farmasi) . ?= $ruangan ?></td> -->
                                    <td style="text-align: right" colspan="5">Sub Total (Farmasi)</td>
                                    <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotFr, 2, ",", ".") ?></b></td>
                                </tr>
                                <tr style="font-size: 4px; line-height:1">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                            <?php   } ?>


                            <!-- menghitung BHP -->
                            <?php
                            foreach ($BHP as $behape) :
                            ?>
                                <?php
                                if ($behape['totalbhp'] > 0) { ?>
                                    <tr>

                                        <td><?= $no++ ?></td>
                                        <td><?= $behape['documentdate'] ?></td>
                                        <td>BHP <?= $behape['types'] ?> | <?= $behape['name'] ?> [<?= number_format($behape['qty'], 2, ",", ".") ?>]</td>
                                        <td><?= $behape['doktername'] ?></td>
                                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                        <td><?= number_format(($behape['totalbhp'] * $behape['qty']), 2, ",", ".")  ?></td>
                                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>

                            <?php
                            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                            $TotalBHP = $check_TotBHP;
                            ?>
                            <?php
                            $no = 1;
                            if ($TotalBHP > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="3">
                                        <hr style="margin-bottom: 2; margin-top: 2">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                                    <td style="text-align: right;">
                                        <b>
                                            <?= number_format($TotalBHP, 2, ",", "."); ?>
                                        </b>
                                    </td>
                                </tr>

                            <?php } ?>

                            <!-- menghitung operasi -->
                            <?php
                            foreach ($OPERASI as $OP) :
                            ?>
                                <tr>
                                    <td>
                                        <?= $no++; ?>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($OP['documentdate'])) ?></td>
                                    <td><?= $OP['name'] ?> [<?= number_format($OP['qty'], 2, ",", "."); ?></td>
                                    <td><?= $OP['doktername'] ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".")  ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>

                            <?php
                            $check_TotOperasi = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                            $TotalOperasi = $check_TotOperasi;
                            ?>
                            <?php
                            $no = 1;
                            if ($TotalOperasi > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="3">
                                        <hr style="margin-bottom: 2; margin-top: 2">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td style="text-align: right;" colspan="2"><b>Sub Total Operasi</b></td>
                                    <td style="text-align: right;">
                                        <b>
                                            <?= number_format($TotalOperasi, 2, ",", "."); ?>
                                        </b>
                                    </td>
                                </tr>

                            <?php } ?>
                    </tbody>

                    <!-- ########## mengambil data dari tindakan atau dari tabel kasir ################-->
                    <?php
                            if ($statusvalidasi == "sudah") {
                                $subtotal;
                                $grandtotal;
                                $paymentamount;
                                $deposit = abs($subtotal) - abs($grandtotal);
                    ?>
                    <?php } else {
                                $subtotal = abs($TotalPemeriksaan) + abs($TotalTNO) +
                                    abs($TotalPenunjang) + abs($TotalFarmasi) +
                                    abs($TotalBHP) + abs($TotalOperasi);

                                $grandtotal = abs($subtotal) - (abs($TotalKasirApotek_RJ) + abs($TotalKasirPnj_RJ) +
                                    abs($TotalKasir_RJ) + abs($TotalKasir_TNO) + abs($TotalKasir_Daftar));
                                $paymentamount = 0;
                                $deposit = abs($subtotal) - abs($grandtotal);
                            } ?>



                    <tfoot>
                        <?php
                            foreach ($datapasien as $rowbayar) :
                        ?>

                            </tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;"></td>
                            <td></td>
                            <td>
                                <h6></h6>
                            </td>
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


                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <br style="margin-bottom: 2; margin-top: 10">
                            </td>
                        </tr>

                        <?php
                    $totalbiaya = abs($TotalPemeriksaan) + abs($TotalTNO) +
                        abs($TotalPenunjang) + abs($TotalFarmasi) + abs($TotalBHP) + abs($TotalOperasi);
                    $totalbayarawal = $TotalKasirApotek_RJ + $TotalKasirPnj_RJ  + $TotalKasir_Tindakan;
                    ?>
                        <?php if ($statusvalidasi == "sudah" or $deposit > 0) { ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="text-align: right;"><b>Total Biaya</b></td>
                                <td style="text-align: right;">
                                    <b><?= number_format($subtotal+$totalbayarawal, 2, ",", ".") ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="text-align: right;">Deposit</td>
                                <td style="text-align: right;">
                                    <?= number_format($totalbayarawal, 2, ",", ".") ?>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">
                                <hr style="margin-bottom: 2; margin-top: 2">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2" style="text-align: right;"><b>Tagihan Biaya</b></td>
                            <td style="text-align: right;">
                                <b><?= number_format($grandtotal, 2, ",", ".") ?></b>
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td>
                            <td></td>
                            <td></td> -->
                            <td colspan="6">
                                <hr style="margin-bottom: 2; margin-top: 2">
                            </td>
                        </tr>

                        <?php if ($statusvalidasi == 'sudah') { ?>
                            <tr>
                                <!-- <td></td>
                                <td></td>
                                <td></td> -->
                                <td colspan="2" style="text-align: left;"><b>Bayar Tagihan :</b></td>
                                <td style="text-align: left;">
                                    <b><?= number_format($paymentamount, 2, ",", ".") ?></b>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td></td>
                                <td></td>
                                <td></td> -->
                                <td colspan="3">
                                    <!-- <hr style="margin-bottom: 2; margin-top: 2"> -->
                                </td>
                            </tr>
                            <tr>
                                <!-- <td></td>
                                <td></td>
                                <td></td> -->
                                <td colspan="2" style="text-align: left;"></td>
                                <td colspan="4" style="text-align: left;">
                                    Terbilang : #<?php echo ucwords(terbilang($paymentamount)) . " Rupiah"; ?>#
                                </td>
                            </tr>
                        <?php } ?>


                    </tfoot>
                </table>

                <?php if ($statusvalidasi == 'sudah') { ?>
                    <!-- <font size="1">sudah dilakukan validasi pembayaran</font> -->
                <?php } else { ?>
                    <font size="1">belum dilakukan validasi pembayaran</font>
                <?php } ?>


                <?php if ($statusvalidasi == 'sudah') { ?>
                    <table style="border-collapse: collapse; width: 95%; height: 90px;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 35%; text-align: center;">&nbsp;</td>
                                <td style="width: 30%; text-align: center;">&nbsp;</td>
                                <td style="width: 35%; text-align: center;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Penyetor</td>
                                <td rowspan="2" style="text-align: center;"><?= $barcode; ?></td>
                                <td style="text-align: center;">Petugas Kasir</td>
                            </tr>

                            <?php
                                foreach ($datapasien as $tanda) :
                            ?>

                                <tr>
                                    <td style="text-align: center;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                            </div>
                                        </div>
                                    </td>

                                    <!-- <td rowspan="2" style="text-align: center;">&</td> -->
                                    <td style="text-align: center;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>

                                    <td style="text-align: center;"><u><?= $tanda['payersname']; ?></u></td>
                                    <td style="text-align: center;">
                                        <font size="1">Cetak <?= date('d-m-Y H:i:s'); ?> WIB </font>
                                    </td>
                                    <td style="text-align: center;"><u><?= $tanda['createdby']; ?></u></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                <?php } ?>
            <?php endforeach; ?>

            </div>
        </div>
    </div>
    </div>

</body>

</html>