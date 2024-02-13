<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Biaya Pelayanan Rawat Inap</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 12px;
        }

        body {
            font-size: 12px;
            line-height: 1;
        }

        table {
            width: 100%;
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
                            <td style="width: 15%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50px;" src="./assets/images/gallery/pemkab.png" width="50" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 70%; text-align: center; font: size 100px;">
                                <b class="text-info"><?= $header1; ?></b>
                            </td>
                            <td style="width: 15%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50px;" src="./assets/images/gallery/muaraenim.png" width="50" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 70%; text-align: center; font: size 100px;">
                                <b>
                                    <font size="22px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 70%; text-align: center;">
                                <font size="1"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                        <tr style="height: 100px">
                            <td style="width: 100%; text-align: center; line-height :1" colspan="3">
                                <br>
                                <b>
                                    <font size="4"> RINCIAN BIAYA PERAWATAN KASUS KOINSIDEN </font>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="pull-text">
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width: 100%; height: 14px;" border="0">
                            <tbody>

                                <?php
                                foreach ($datapasien as $row) :
                                ?>

                                    <tr style="height: 14px;">
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
                                        <td style="text-align:justify; line-height:2;">No. Bukti</td>
                                        <td>: <?php echo $row['journalnumber']; ?></td>
                                        <td></td>
                                        <td>Waktu Pembuatan</td>
                                        <td colspan="2">: <?php echo tgl_indo($tanggal); ?></td>

                                    </tr>
                                    <tr>
                                        <td>Nomor RM</td>
                                        <td>: <?= $row['pasienid']; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2"></td>

                                    </tr>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>: <?= $row['pasienname']; ?></td>
                                        <td></td>
                                        <td>Pembayaran</td>
                                        <td colspan="2">: <?php if ($cabar == "") {
                                                                $carabayar = $row['paymentmethodname'];
                                                            } else {
                                                                $carabayar = $cabar;
                                                            }
                                                            echo $carabayar; ?></td>

                                    </tr>
                                    <tr>
                                        <td>ALamat</td>
                                        <td>: <?= $row['pasienaddress']; ?></td>
                                        <td>&nbsp;</td>
                                        <td>No. Pendaftaran</td>
                                        <td colspan="2">: <?= $row['referencenumber']; ?></td>

                                    </tr>


                                    <tr>
                                        <td>Dokter</td>
                                        <td colspan="2">: <?= $row['doktername']; ?></td>

                                        <td>Waktu pendaftaran</td>
                                        <td colspan="2">: <?= $documentdate; ?> | <?= $createdby; ?></td>

                                    </tr>
                            </tbody>
                        </table>
                        <br>

                        <table id="dataGabung" class="table table-sm" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>


                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th style="text-align: right;">Harga</th>
                                    <th style="text-align: right;"> Qty</th>
                                    <th style="text-align: right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php
                                    foreach ($VISITE as $row) :
                                ?>
                                    <tr>
                                        <td><?php echo "$no" ?></td>
                                        <td><?= $row['documentdate'] ?> </td>
                                        <td> <?= $row['name'] ?></td>
                                        <td style="text-align: right;"><?= number_format($row['totaltarif'], 2, ",", ".")  ?></td>
                                        <td style="text-align: right;">1</td>
                                        <td style="text-align: right;"><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotPemeriksaan[] = $row['totaltarif'];  ?>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>

                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Visit)</td>
                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotPemeriksaan), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php
                                    foreach ($TNO as $rowTNO) :
                                ?>
                                    <tr>

                                        <td><?php echo "$no" ?></td>
                                        <td><?= $rowTNO['documentdate'] ?> </td>
                                        <td> <?= $rowTNO['name']  ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['qty'], 0) ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                        <?php $TotTNO[] = $rowTNO['subtotal'];  ?>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>
                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Tindakan Non Operatif)</td>
                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotTNO), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php foreach ($PENUNJANG as $P) : ?>
                                    <?php if ($P['totalamount'] > 0) { ?>
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
                                            <td><?php echo $no ?></td>
                                            <td><?= $P['documentdate'] ?>|<?= $P['journalnumber'] ?> </td>
                                            <td colspan="3"><?= $P['groups'] ?> | <?= $P['name'] ?></td>

                                            <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                                            <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php } ?>
                                <?php endforeach; ?>

                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Penunjang)</td>

                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotPENUNJANG), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php
                                    foreach ($FARMASI as $F) :
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?= $F['documentdate'] ?> </td>
                                        <td colspan="3">Farmasi | <?= $F['journalnumber'] ?></td>

                                        <td style="text-align: right;"><?php $awal = abs($F['price']);
                                                                        $far = $awal + $F['embalase'];
                                                                        $deni = ceil($far);
                                                                        echo number_format($deni, 2, ",", ".") ?></td>
                                        <?php $TotFAR[] = $deni;  ?>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>

                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Farmasi)</td>
                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotFAR), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php if ('totalbhp' > 0) { ?>
                                    <?php
                                        foreach ($BHP as $behape) :
                                    ?>
                                        <tr>
                                            <td>BHP <?php echo $no ?></td>
                                            <td><?= $behape['documentdate'] ?></td>
                                            <td><?= $behape['name']  ?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                            <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                            <?php $no++ ?>
                                        </tr>
                                    <?php endforeach;  ?>
                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique;">
                                            <td style="text-align: right;" colspan="5">Sub Total (BHP)</td>
                                            <td style="text-align: left;"><?php echo number_format(array_sum($TotBHP), 2, ",", ".") ?></td>
                                        </tr> <?php } ?>

                                    <?php $no = 1; ?>
                                <?php } ?>


                                <?php
                                    foreach ($GIZI as $GZ) :
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?= $GZ['documentdate'] ?></td>
                                        <td> <?= $GZ['name']  ?></td>
                                        <td style="text-align: right;"><?= number_format($GZ['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($GZ['qty'], 0) ?></td>
                                        <td style="text-align: right;"><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>

                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Gizi)</td>
                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotGIZI), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php
                                    foreach ($OPERASI as $OP) :
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?= $OP['documentdate'] ?></td>
                                        <td><?= $OP['name']  ?></td>
                                        <td></td>
                                        <td style="text-align: right;"><?= number_format($OP['qty'], 0) ?></td>
                                        <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                        <?php $no++; ?>
                                    </tr>
                                <?php endforeach; ?>

                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique;">
                                        <td style="text-align: right;" colspan="5">Sub Total (Tindakan Operatif)</td>
                                        <td style="text-align: left;"><?php echo number_format(array_sum($TotOPERASI), 2, ",", ".") ?></td>
                                    </tr> <?php } ?>

                                <?php $no = 1; ?>

                                <?php
                                    foreach ($datapasien as $DP) :
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?= $DP['documentdate'] ?> </td>
                                        <td colspan="3"><?php if ($DP['groups'] == "IRJ") {
                                                            $asal = "Biaya Pelayanan Rawat Jalan";
                                                        } else {
                                                            $asal = "Biaya Pelayanan Gawat Darurat";
                                                        } ?>
                                            <?= $asal; ?>
                                        </td>
                                        <?php //$totalasal = $DP['totaldaftarklinik'] + $DP['totaltindakanklinik'] +$DP['totalbhptindakanklinik'] + $DP['totalfarmasiklinik'] + $DP['totalpenunjangklinik'] + $DP['totalbhppenunjangklinik'];
                                        $totalasal = 0;  ?>
                                        <td style="text-align: right;"><?= number_format($totalasal, 2, ",", ".") ?></td>

                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;"><b>Total Biaya</b></td>

                                    <?php $check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                                    $TotalPemeriksaan = $check_TotPem;
                                    $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                                    $TotalTNO = $check_TotTNO;
                                    $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                                    $TotalPenunjang = $check_TotPenunjang;
                                    $check_TotFar = isset($TotFAR) ? array_sum($TotFAR) : 0;
                                    $TotalFarmasi = $check_TotFar;
                                    $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                                    $TotalBHP = $check_TotBHP;
                                    $check_TotOperasi = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                                    $TotalOperasi = $check_TotOperasi;
                                    // $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                                    // $TotalBK = $check_TotBK;
                                    $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                                    $TotalGIZI = $check_TotGIZI;

                                    $totalbiaya = $TotalPemeriksaan + $TotalTNO + $TotalPenunjang + $TotalFarmasi + $TotalBHP + $TotalOperasi + $TotalGIZI + $totalasal;



                                    ?>
                                    <td style="text-align: right;" colspan="2">
                                        <b> <?= number_format($totalbiaya, 2, ",", ".") ?></b>
                                    </td>
                                    <?php
                                    foreach ($datapasien as $rowbayar) :
                                    ?>

                                </tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><b>Pembayaran</b></td>

                                <td style="text-align: right;" colspan="2">
                                    <?= number_format(($rowbayar['paymentamount'] + $rowbayar['nominaldebet']), 2, ",", ".") ?>
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
                                <tr>

                                </tr>
                            <?php endforeach; ?>

                            </tfoot>
                        </table>
                        <b>Terbilang : #<?php echo ucwords(terbilang($rowbayar['paymentamount'] + $rowbayar['nominaldebet'])) . " Rupiah"; ?>#</b>

                        <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 30%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 30%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 30%; text-align: center; height: 18px;">Penyetor</td>
                                    <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 30%; text-align: center; height: 18px;">Petugas Kasir</td>
                                </tr>
                                <?php
                                    foreach ($datapasien as $tanda) :
                                ?>

                                    <tr style="height: 18px;">
                                        <td style="width: 30%; text-align: center; height: 18px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                        <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                        <td style="width: 30%; text-align: center; height: 18px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="height: 30px;">

                                        <td style="width: 30%; text-align: center; height: 18px;"><u><?= $tanda['payersname']; ?></u></td>
                                        <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                        <td style="width: 20%; text-align: center; height: 18px;">&nbsp;</td>
                                        <td style="width: 30%; text-align: center; height: 18px;"><u><?= $tanda['createdby']; ?></u></td>
                                    <?php endforeach; ?>
                                    </tr>
                            </tbody>
                        <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>