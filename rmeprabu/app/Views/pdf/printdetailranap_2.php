<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" type="image/png/icon" sizes="16x16" href="<?= base_url(); ?>/assets/images/rud45.png"> -->
    <link rel="shortcut icon" type="image/png" href="./assets/images/gallery/muaraenim.png">
    <title>Rincian Biaya Pelayanan Rawat Inap</title>
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
            font-size: 14px;
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

    <div class="container">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">

                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 1%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50" src="./assets/images/gallery/muaraenim.jpg" width="60px" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="20px"> <?= $header1; ?></font>
                                </b>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="22px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 99%; text-align: center;">
                                <font size="14px"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <div>
                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                        <tbody>
                            <tr style="height: 100px">
                                <td style="width: 100%; text-align: center; line-height :1">
                                    <br>
                                    <b>
                                        <font size="4"> <?php echo $deskripsi; ?> </font>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <!-- <hr> -->
                <div class="pull-text;">
                    <div class="col-md-12">
                        <!-- <font aria-setsize="18px"> <b> -->
                        <table style="border-collapse: collapse; width: 100%; height: 14px; line-height:1.2">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>

                                    <tr style="height: 14px;">
                                        <?php
                                        // $tanggal = $row['documentdate'];
                                        $tanggal = $row['dateout'];
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
                                        <td style="text-align:justify; line-height:1;">No. Bukti</td>
                                        <td>: <?php echo $row['journalnumber']; ?></td>
                                        <td>Tanggal Pulang</td>
                                        <td>: <?php echo $row['dateout']; ?></td>

                                    </tr>
                                    <tr>
                                        <td>Nomor RM</td>
                                        <td>: <?= $row['pasienid']; ?></td>
                                        <td>Pembayaran</td>
                                        <td>: <?= $row['paymentmethodname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>: <?= $row['pasienname']; ?></td>
                                        <td>No. Pendaftaran</td>
                                        <td>: <?= $row['referencenumber']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ALamat</td>
                                        <td colspan="3">: <?= $row['pasienaddress']; ?></td>

                                    </tr>


                                    <tr>
                                        <td>Dokter</td>
                                        <td>: <?= $row['doktername']; ?></td>
                                        <td>Waktu pendaftaran</td>
                                        <td>: <?= $documentdate; ?> | <?= $createdby; ?></td>

                                    </tr>
                            </tbody>
                        </table>
                        <!-- </b></font> -->

                        <hr>
                        <table style="width: 100%; border-collapse: collapse;text-align: top;"" border=" 0">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">Type</th>
                                    <th style="text-align: left;">Periode</th>
                                    <!-- <th style=" text-align: center;">HariRawat</th> -->
                                    <th style="text-align: left;">Ruangan</th>
                                    <th style=" text-align: center;">LamaRawat</th>
                                    <th style="text-align: right;">Tarif</th>
                                    <th style="text-align: right;">TotalTarif</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                    $i = 0 ?>
                                <?php
                                    foreach ($KAMAR as $K) :
                                ?>
                                    <?php
                                        if (($K['statusrawatinap'] == "PINDAH") or ($K['statusrawatinap'] == "PULANG")) {
                                            $hari_ini = strtotime($K['datetimeout']);
                                        } else {
                                            $hari_ini = time();
                                        }
                                        $tgl_masuk = strtotime($K['datetimein']);

                                        $Y = (floor(($hari_ini - $tgl_masuk) / 86400)) / 365;
                                        $tahun = floor($Y);
                                        $M = (floor(($hari_ini - $tgl_masuk) / 86400)) % 365;
                                        $bulan = floor($M / 30);
                                        $D  = (floor(($hari_ini - $tgl_masuk) / 86400));
                                        $hari  = $D % 1440;
                                        $H    = (floor(($hari_ini - $tgl_masuk) / 3600));
                                        $jam        = $H    % 24;
                                        $MN = (floor(($hari_ini - $tgl_masuk) / 60));
                                        $menit        = $MN % 60;

                                        // ----- tambahan perhitungan hari
                                        $tgl1 = new DateTime($K['datein']);
                                        $tgl2 = new DateTime($K['dateout']);
                                        $selisih = $tgl1->diff($tgl2)->days + 1;
                                    ?>

                                    <?php if ($K['types'] == "BARU" and $K['statusrawatinap'] == "PULANG") {
                                            $selisiha = $selisih;
                                        } ?>

                                    <?php if ($K['types'] == "BARU" and $K['statusrawatinap'] == "PINDAH" and strtotime($K['timeout']) < strtotime('01:00:1')) { ?>
                                        <?php $selisiha = $selisih - 1; ?>
                                    <?php } elseif ($K['types'] == "PINDAHAN" and $K['statusrawatinap'] == "PINDAH" and strtotime($K['timein']) > strtotime('01:00:01')) { ?>
                                        <?php $selisiha = $selisih - 1; ?>
                                    <?php } elseif ($K['types'] == "PINDAHAN" and $K['statusrawatinap'] == "PULANG" and strtotime($K['timein']) > strtotime('01:00:01')) { ?>
                                        <?php $selisiha = $selisih - 1; ?>
                                    <?php } else {
                                            $selisiha = $selisih;
                                        } ?>

                                    <?php if ($selisiha > 0 or $jam > 5) { ?>
                                        <tr>
                                            <td><?= $K['types'] ?></td>
                                            <td>(<?= $K['datetimein'] ?>) s.d. (<?= $K['datetimeout']; ?>)</td>
                                            <!-- <td style=" text-align: center;"><?php echo $selisiha . " Hari"; ?></td> -->
                                            <td><?= $K['roomname']  ?> | <?= $K['bednumber'] ?></td>

                                            <td style=" text-align: center;"><?php echo $hari . " Hr " . $jam . " Jm " . $menit . " Mn "; ?></td>
                                            <td style=" text-align: right;"><?php
                                                                            $ruangan = $K['roomname'];
                                                                            if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                                                                $tarif = 156815;
                                                                            } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                                                                $tarif = 256815;
                                                                            } else {
                                                                                $tarif = $K['price'];
                                                                            }
                                                                            echo  number_format($tarif, 2, ",", "."); ?></td>

                                            <td style=" text-align: right;">
                                                <?php
                                                $waktu = 6;
                                                $waktu2 = 6;
                                                $ruangan = $K['roomname'];

                                                if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                                    $tarif = 156815;
                                                } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                                    $tarif = 256815;
                                                } else {
                                                    $tarif = $K['price'];
                                                }

                                                if (($jam <= $waktu) and ($menit < 5)) {
                                                    $tm = 0.5;
                                                    $tambahan = 0 * $tarif;
                                                } else if (($jam <= $waktu) and ($menit > 5)) {
                                                    $tm = 0.5;
                                                    $tambahan = 0.5 * $tarif;
                                                } else if ($jam >= $waktu2) {
                                                    $tm = 1;
                                                    $tambahan = 1 * $tarif;
                                                }

                                                $jumlah_hari = $hari;
                                                $tot_hari = $jumlah_hari + $tm;
                                                $biayakamar = ($jumlah_hari * $tarif);
                                                $biayakamar = $biayakamar + $tambahan;
                                                echo  number_format($biayakamar, 2, ",", ".");
                                                ?>
                                                <?php $TotBK[] = $biayakamar;  ?>
                                                <?php $no++; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>

                                <?php endforeach; ?>


                                <?Php if ($no > 2) { ?>
                                    <tr style="font-style:oblique; line-height: 1.3;">
                                        <td style="text-align: right;" colspan="6">Sub Total (Kelas Ruangan)</td>
                                        <td style="text-align: right;"><b><?php echo number_format(array_sum($TotBK), 2, ",", ".") ?></b></td>

                                    </tr> <?php } ?>

                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%">No</th>
                                    <th style="text-align: left; width: 53%">Keterangan</th>
                                    <th style="text-align: right;width: 15%">Harga</th>
                                    <th style="text-align: right; width: 10%">Qty</th>
                                    <th style="text-align: right; width: 17%">Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $kelasruangan = "IRJ / IGD";
                                    foreach ($PEMIGD as $PIGD) :
                                        if ($PIGD['groups'] == "IRJ") {
                                            $kelasruangan = "Rawat Jalan";
                                        } elseif ($PIGD['groups'] == "IGD") {
                                            $kelasruangan = "IGD";
                                        }
                                    endforeach; ?>

                                <?php $no = 1;
                                    $i = 0; ?>

                                <?php
                                    foreach ($VISITE as $row) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <tr style="font-style:oblique; line-height :1.3;">
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= $row['name'] ?></td>
                                        <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                        <td style="text-align: right;"><?= number_format($row['qty'], 2); ?></td>
                                        <td style="text-align: right;"><b><?= number_format($row['totaltarif'], 2, ",", ".") ?></b></td>
                                        <?php $TotPemeriksaan[] = $row['totaltarif'];  ?>
                                        <?php $no++; ?>
                                    </tr>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                <?php } else { ?>

                                    <?php
                                        foreach ($VISITE as $row) :
                                    ?>
                                        <tr>
                                            <td><?php echo "$no" ?></td>
                                            <td> <?= $row['name'] ?></td>
                                            <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                            <td style="text-align: right;"><?= number_format($row['qty'], 2); ?></td>
                                            <td style="text-align: right;"><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                            <?php $TotPemeriksaan[] = $row['totaltarif'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Visit dan Askep)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotPemeriksaan), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($TNO as $rowTNO) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <tr style="font-style:oblique; line-height :1.3;">
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= $rowTNO['name']  ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['qty'], 2) ?></td>
                                        <td style="text-align: right;"><b><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></b></td>
                                        <?php $TotTNO[] = $rowTNO['subtotal'];  ?>
                                    </tr>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php
                                        foreach ($TNO as $rowTNO) :
                                    ?>
                                        <tr>

                                            <td><?php echo "$no" ?></td>
                                            <td> <?= $rowTNO['name']  ?></td>
                                            <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($rowTNO['qty'], 2) ?></td>
                                            <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                            <?php $TotTNO[] = $rowTNO['subtotal'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Tindakan Non Operatif)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotTNO), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($PENUNJANG as $P) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <?php if ($P['subtotal'] > 0) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <?php if ($P['types'] == "RAD") {
                                                $deskripsi = 'Radiologi';
                                            }
                                            if ($P['types'] == "LPK") {
                                                $deskripsi = 'Lab Patologi Klinik';
                                            }
                                            if ($P['types'] == "LPA") {
                                                $deskripsi = 'Lab Patologi Anatomi';
                                            }
                                            if ($P['types'] == "BD") {
                                                $deskripsi = 'Bank Darah';
                                            }
                                            ?>
                                            <td><?php echo $no ?></td>
                                            <td><?= $P['types'] ?> | <?= $P['name']; ?></td>
                                            <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($P['qty'], 2) ?></td>
                                            <td style="text-align: right;"><b><?= number_format($P['subtotal'], 2, ",", ".") ?></b></td>
                                            <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php foreach ($PENUNJANG as $P) : ?>
                                        <?php if ($P['subtotal'] > 0) { ?>
                                            <tr>
                                                <?php if ($P['types'] == "RAD") {
                                                    $deskripsi = 'Radiologi';
                                                }
                                                if ($P['types'] == "LPK") {
                                                    $deskripsi = 'Lab Patologi Klinik';
                                                }
                                                if ($P['types'] == "LPA") {
                                                    $deskripsi = 'Lab Patologi Anatomi';
                                                }
                                                if ($P['types'] == "BD") {
                                                    $deskripsi = 'Bank Darah';
                                                }
                                                ?>
                                                <td><?php echo $no ?></td>
                                                <td><?= $P['types'] ?> | <?= $P['name']; ?></td>
                                                <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                                                <td style="text-align: right;"><?= number_format($P['qty'], 2) ?></td>
                                                <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                                                <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                                                <?php $no++; ?>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height: 1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Penunjang)</td>

                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotPENUNJANG), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5"> </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ('totalbhp' > 0) { ?>
                                    <?php
                                        foreach ($BHP as $behape) :
                                            $i++;
                                        endforeach; ?>

                                    <?php if ($i == 1) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td><?= $behape['name']  ?></td>
                                            <td style="text-align: right"><?= number_format($behape['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right"><?= number_format($behape['qty'], 2) ?></td>
                                            <td style="text-align: right"><b><?= number_format($behape['totalbhp'], 2, ",", ".") ?></b></td>
                                            <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } else { ?>

                                        <?php
                                            foreach ($BHP as $behape) :
                                        ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?= $behape['name']  ?></td>
                                                <td style="text-align: right"><?= number_format($behape['price'], 2, ",", ".") ?></td>
                                                <td style="text-align: right"><?= number_format($behape['qty'], 2) ?></td>
                                                <td style="text-align: right"><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                                <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                                <?php $no++ ?>
                                            </tr>
                                        <?php endforeach;  ?>
                                        <?Php if ($no > 2) { ?>
                                            <tr style="font-style:oblique; line-height: 1.3;">
                                                <td style="text-align: right" colspan="3">Sub Total (BHP)</td>
                                                <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotBHP), 2, ",", ".") ?></b></td>
                                            </tr>
                                            <tr style="font-size: 4px; line-height:1">
                                                <td colspan="5">&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0 ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($GIZI as $GZ) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <tr style="font-style:oblique; line-height :1.3;">
                                        <td><?php echo $no ?></td>
                                        <td> <?= $GZ['name']  ?></td>
                                        <td style="text-align: right;"><?= number_format($GZ['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($GZ['qty'], 2) ?></td>
                                        <td style="text-align: right;"><b><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></b></td>
                                        <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
                                    </tr>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php
                                        foreach ($GIZI as $GZ) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td> <?= $GZ['name']  ?></td>
                                            <td style="text-align: right;"><?= number_format($GZ['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($GZ['qty'], 2) ?></td>
                                            <td style="text-align: right;"><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                                            <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height: 1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Gizi)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotGIZI), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($OPERASI as $OP) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <tr style="font-style:oblique; line-height :1.3;">
                                        <td><?php echo $no ?></td>
                                        <td><?= $OP['name']  ?></td>
                                        <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($OP['qty'], 2) ?></td>
                                        <td style="text-align: right;"><b><?= number_format($OP['totaltarif'], 2, ",", ".") ?></b></td>
                                        <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                    </tr>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php
                                        foreach ($OPERASI as $OP) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?= $OP['name']  ?></td>
                                            <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($OP['qty'], 2) ?></td>
                                            <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                            <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height: 1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Tindakan Operatif)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotOPERASI), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table style="width: 93%;" class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    foreach ($FARMASI as $F) :
                                        $i++;
                                    endforeach; ?>

                                <?php
                                    foreach ($FARMASIIGD as $FIGD) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <?php
                                        foreach ($FARMASI as $F) :
                                    ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td style="text-align: left;" colspan="3">Farmasi | <?= $F['journalnumber'] ?></td>
                                            <td style="text-align: right;"><b><?php $awal = abs($F['price']);
                                                                                $far = $awal + $F['embalase'];
                                                                                $deni = ceil($far);
                                                                                $deni_cadas = ceil($far);
                                                                                echo number_format($deni, 2, ",", ".") ?></b>
                                            </td>

                                            <?php if ($F['paymentvalidation'] == "SUDAH") { ?>
                                            <?php
                                                $mas_al_bayar_ranap = $deni_cadas;
                                            } else {
                                                $mas_al_bayar_ranap = 0;
                                                // $mas_al = 1;
                                            }
                                            ?>

                                            <?php $TotFAR[] = $deni;
                                            $TotBayarFAR[] = $mas_al_bayar_igd;
                                            $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php
                                        foreach ($FARMASIIGD as $FIGD) :
                                    ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td style="text-align: left;" colspan="3">Farmasi | <?= $FIGD['journalnumber'] ?></td>
                                            <td style="text-align: right;"><b><?php $awal = abs($FIGD['totalharga']);
                                                                                $farigd = $awal + $FIGD['embalase'];
                                                                                $deniigd = ceil($farigd);
                                                                                $deni_cadas_igd = ceil($farigd);
                                                                                echo number_format($deniigd, 2, ",", ".") ?></b>
                                            </td>

                                            <?php if ($FIGD['paymentvalidation'] == "SUDAH") { ?>
                                            <?php
                                                $mas_al_bayar_igd = $deni_cadas_igd;
                                                // $mas_al = 0;
                                            } else {
                                                $mas_al_bayar_igd = 0;
                                                // $mas_al = 1;
                                            } ?>

                                            <?php $TotFARIGD[] = $deniigd;
                                            $TotBayarFARIGD[] = $mas_al_bayar_igd;
                                            $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php
                                        $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                                        $TotalFAR = $check_TotFAR;

                                        $check_TotBayarFAR = isset($TotBayarFAR) ? array_sum($TotBayarFAR) : 0;
                                        $TotalBayarFAR = $check_TotBayarFAR;
                                    ?>

                                    <?php
                                        $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                                        $TotalFARIGD = $check_TotFARIGD;

                                        $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                                        $TotalFARIGD = $check_TotFARIGD;
                                    ?>

                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>

                                <?php } else { ?>
                                    <?php
                                        foreach ($FARMASI as $F) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td style="text-align: left;" colspan="3">Farmasi | <?= $F['journalnumber'] ?> </td>
                                            <td style="text-align: right;"><?php $awal = abs($F['price']);
                                                                            $far = $awal + $F['embalase'];
                                                                            $deni = ceil($far);
                                                                            $deni_cadas = ceil($far);
                                                                            echo number_format($deni, 2, ",", ".") ?>
                                            </td>
                                            <?php if ($F['paymentvalidation'] == "SUDAH" and ceil(abs($F['paymentamount'])) > 0) { ?>
                                            <?php
                                                $mas_al_bayar_ranap = ceil(abs($F['paymentamount']));
                                                $mas_al = 0;
                                            } else {
                                                $mas_al_bayar_ranap = 0;
                                            }
                                            ?>

                                            <?php $TotFAR[] = $deni;
                                            $TotBayarFAR[] = $mas_al_bayar_ranap;
                                            $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php
                                        $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                                        $TotalFAR = $check_TotFAR;

                                        $check_TotBayarFAR = isset($TotBayarFAR) ? array_sum($TotBayarFAR) : 0;
                                        $TotalBayarFAR = $check_TotBayarFAR;
                                    ?>


                                    <?php
                                        foreach ($FARMASIIGD as $FIGD) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td style="text-align: left;" colspan="3">Farmasi | <?= $FIGD['journalnumber'] ?> </td>
                                            <td style="text-align: right;"><?php $awal = abs($FIGD['totalharga']);
                                                                            $farigd = $awal + $FIGD['embalase'];
                                                                            $deniigd = ceil($farigd);
                                                                            $deni_cadas_igd = ceil($farigd);
                                                                            echo number_format($deniigd, 2, ",", "."); ?>
                                            </td>
                                            <?php if ($FIGD['paymentvalidation'] == "SUDAH" and ceil(abs($FIGD['paymentamount'])) > 0) {

                                                $mas_al_bayar_igd = ceil(abs($FIGD['paymentamount']));
                                                $mas_al = 0;
                                            } else {
                                                $mas_al_bayar_igd = 0;
                                            } ?>

                                            <?php
                                            $TotFARIGD[] = $deniigd;
                                            $TotBayarFARIGD[] = $mas_al_bayar_igd;
                                            $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php
                                        $check_TotBayarFARIGD = isset($TotBayarFARIGD) ? array_sum($TotBayarFARIGD) : 0;
                                        $TotalBayarFARIGD = $check_TotBayarFARIGD;

                                        $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                                        $TotalFARIGD = $check_TotFARIGD;

                                    ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td style="text-align: right;" colspan="3">Sub Total (Farmasi)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format($TotalFAR + $TotalFARIGD, 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>

                                <?php } ?>
                            </tbody>
                        </table>


                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    foreach ($PEMIGD as $PIGD) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <?php
                                        foreach ($PEMIGD as $PIGD) :
                                    ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td><?= $PIGD['description']  ?></td>
                                            <td style="text-align: right;"><b><?= number_format($PIGD['price'], 2, ",", ".") ?></b></td>
                                            <td style="text-align: right;"><b><?= number_format(1, 2) ?></b></td>
                                            <td style="text-align: right;"><b><?= number_format($PIGD['price'], 2, ",", ".") ?></b></td>
                                            <?php $TotPEMIGD[] = $PIGD['price']; ?>

                                        </tr>
                                    <?php endforeach; ?>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <?php $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                                        $TotalPemIGD = $check_TotPEMIGD; ?>


                                <?php } else { ?>

                                    <?php
                                        foreach ($PEMIGD as $PIGD) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?= $PIGD['description']  ?></td>
                                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format(1, 2) ?></td>
                                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                                            <?php $TotPEMIGD[] = $PIGD['price']; ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tr>
                                    <?php $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                                        $TotalPemIGD = $check_TotPEMIGD; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Konsul Dokter <?= $kelasruangan . ")"; ?> </td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format($TotalPemIGD, 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    foreach ($KONSULIGD as $KIGD) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <?php
                                        foreach ($KONSULIGD as $KIGD) :
                                    ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td><?= $KIGD['name']  ?></td>
                                            <td style="text-align: right;"><b><?= number_format($KIGD['price'], 2, ",", ".") ?></b></td>
                                            <td style="text-align: right;"><b><?= number_format($KIGD['qty'], 2) ?></td>
                                            <td style="text-align: right;"><b><?= number_format($KIGD['price'], 2, ",", ".") ?></b></td>
                                            <?php $TotKonsulIGD[] = $KIGD['price']; ?>

                                        </tr>
                                    <?php endforeach; ?>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <?php $check_TotKonsulIGD = isset($TotKonsulIGD) ? array_sum($TotKonsulIGD) : 0;
                                        $TotalKonsulIGD = $check_TotKonsulIGD; ?>


                                <?php } else { ?>

                                    <?php
                                        foreach ($KONSULIGD as $KIGD) :
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?= $KIGD['name']  ?></td>
                                            <td style="text-align: right;"><?= number_format($KIGD['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($KIGD['qty'], 2) ?></td>
                                            <td style="text-align: right;"><?= number_format($KIGD['price'], 2, ",", ".") ?></td>
                                            <?php $TotKonsulIGD[] = $KIGD['price']; ?>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tr>
                                    <?php $check_TotKonsulIGD = isset($TotKonsulIGD) ? array_sum($TotKonsulIGD) : 0;
                                        $TotalKonsulIGD = $check_TotKonsulIGD; ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Konsul Dokter <?= $kelasruangan . ")"; ?> </td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format($TotalKonsulIGD, 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0 ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <?php
                                    foreach ($TINIGD as $TGD) :
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?= $TGD['name']  ?></td>
                                    <td style="text-align: right;"><?= number_format($TGD['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($TGD['qty'], 2) ?></td>
                                    <td style="text-align: right;"><?= number_format($TGD['subtotal'], 2, ",", ".") ?></td>
                                    <?php $TotTINDIGD[] = $TGD['subtotal']; ?>
                                    <?php $no++; ?>
                                </tr>

                            <?php endforeach;
                                    $check_TotTINDIGD = isset($TotTINDIGD) ? array_sum($TotTINDIGD) : 0;
                                    $TotalTindIGD = $check_TotTINDIGD;
                            ?>

                            <?Php if ($no > 2) { ?>
                                <tr style="font-style:oblique; line-height: 1.3;">
                                    <td style="text-align: right" colspan="3">Sub Total (Tindakan <?= $kelasruangan . ")" ?></td>
                                    <td style="text-align: right;" colspan="2">
                                        <b><?php echo number_format($TotalTindIGD, 2, ",", ".") ?></b>
                                    </td>
                                </tr>
                                <tr style="font-size: 4px; line-height:1">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <?php $no = 1;
                                    $i = 0; ?>

                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($PENUNJANGIGD as $PNJIGD) :
                                        $i++;
                                    endforeach; ?>

                                <?php if ($i == 1) { ?>
                                    <?php if ($PNJIGD['subtotal'] > 0) { ?>
                                        <tr style="font-style:oblique; line-height :1.3;">
                                            <td><?php echo $no ?></td>
                                            <td><?= $PNJIGD['types']; ?> | <?= $PNJIGD['name']; ?></td>
                                            <td style="text-align: right;"><?= number_format($PNJIGD['price'], 2, ",", ".") ?></td>
                                            <td style="text-align: right;"><?= number_format($PNJIGD['qty'], 2) ?></td>
                                            <td style="text-align: right;"><b><?= number_format($PNJIGD['subtotal'], 2, ",", ".") ?></b></td>
                                            <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                                        </tr>
                                    <?php } ?>
                                    <tr style="font-size: 4px; line-height:1">
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <?php
                                        $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                                        $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                                    ?>
                                <?php } else { ?>
                                    <?php foreach ($PENUNJANGIGD as $PNJIGD) : ?>
                                        <?php if ($PNJIGD['subtotal'] > 0) { ?>
                                            <tr>

                                                <td><?php echo $no ?></td>
                                                <td><?= $PNJIGD['types']; ?> | <?= $PNJIGD['name']; ?></td>
                                                <td style="text-align: right;"><?= number_format($PNJIGD['price'], 2, ",", ".") ?></td>
                                                <td style="text-align: right;"><?= number_format($PNJIGD['qty'], 2) ?></td>
                                                <td style="text-align: right;"><?= number_format($PNJIGD['subtotal'], 2, ",", ".") ?></td>
                                                <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                                                <?php $no++; ?>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <?php
                                        $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                                        $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                                    ?>

                                    <?Php if ($no > 2) { ?>
                                        <tr style="font-style:oblique; line-height: 1.3;">
                                            <td style="text-align: right" colspan="3">Sub Total (Penunjang IGD)</td>
                                            <td style="text-align: right;" colspan="2"><b><?php echo number_format(array_sum($TotPENUNJANGIGD), 2, ",", ".") ?></b></td>
                                        </tr>
                                        <tr style="font-size: 4px; line-height:1">
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                            <tfoot>
                                <tr>
                                    <th style="text-align: left; width: 5%"></th>
                                    <th style="text-align: left; width: 53%"></th>
                                    <th style="text-align: right; width: 15%"></th>
                                    <th style="text-align: center; width: 10%"></th>
                                    <th style="text-align: right; width: 17%"></th>
                                </tr>
                                <tr style=" line-height: 1">
                                    <?php
                                    foreach ($TagihanAsal as $tagihan_asal) :
                                        $totaldaftarklinik = $tagihan_asal['totaldaftar'];
                                        $totaltindakanklinik = $tagihan_asal['totaltindakan'];
                                        $totalbhptindakanklinik = $tagihan_asal['totalbhp'];
                                        $totalfarmasiklinik = $tagihan_asal['totalfarmasi'];
                                        $totalpenunjangklinik = $tagihan_asal['totalpenunjang'];
                                        $totalkasirklinik = $tagihan_asal['grandtotal'];
                                        $asalpelayanan = $tagihan_asal['groups'];
                                        $pembayaran_igd = $tagihan_asal['paymentamount']; ?>
                                    <?php endforeach; ?>

                                    <td style="text-align: right;" colspan="2">Biaya (<?= $kelasruangan . ") :"; ?></td>
                                    <?php $TotalBiayaIGD = $TotalPENUNJANGIGD + $TotalTindIGD + $TotalPemIGD + $TotalFARIGD + $TotalKonsulIGD;
                                    $sisatagihanasal = $TotalBiayaIGD - $tagihan_asal['paymentamount'] - $TotalBayarFARIGD; ?>

                                    <td style="text-align: right;" colspan="2"><i><?php echo number_format($TotalBiayaIGD, 2, ",", ".") ?></i>
                                        <font size=12px><br><span class="badge badge-danger">- <?php
                                                                                                echo number_format($tagihan_asal['paymentamount'] + $TotalBayarFARIGD, 2, ",", ".");
                                                                                                $tagihan_asal = $tagihan_asal['paymentamount'] - $TotalBayarFARIGD;
                                                                                                ?> </span> </font>
                                    </td>
                                    <td style="text-align: right;"><i><?php echo number_format($TotalBiayaIGD - $TotalBayarFARIGD - $pembayaran_igd, 2, ",", ".") ?></i></td>
                                    <?php //endforeach; 
                                    ?>
                                </tr>
                                <tr style="font-size: 4px; line-height:1.2">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr style="line-height: 1.3;">
                                    <td colspan="2" style="text-align: right;">Biaya Rawat Inap (RI) :</td>
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

                                    $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                                    $TotalBK = $check_TotBK;
                                    $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                                    $TotalGIZI = $check_TotGIZI;

                                    $totalbiaya = $TotalPemeriksaan + $TotalTNO +
                                        $TotalPenunjang + $TotalFarmasi + $TotalBHP +
                                        $TotalOperasi + $TotalBK + $TotalGIZI +
                                        $TotalTindIGD + $TotalPemIGD + $TotalPENUNJANGIGD + $TotalFARIGD + $TotalKonsulIGD;

                                    ?>
                                    <td style="text-align: right;" colspan="2"><i><?php echo number_format($totalbiaya - $TotalBiayaIGD, 2, ",", ".") ?></i>
                                        <font size=12px> <br><span class="badge badge-danger">- <?php
                                                                                                echo number_format($TotalBayarFAR, 2, ",", ".");
                                                                                                ?> </span></font>
                                    </td>
                                    <td style="text-align: right;"><i><?= number_format($totalbiaya - $TotalBiayaIGD - $TotalBayarFAR, 2, ",", ".") ?></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" style="text-align: right; line-height: 2;">
                                        <!-- <b>TOTAL BIAYA KESELURUHAN</b> -->
                                    </td>
                                    <td style="text-align: right;" colspan="1">
                                        <!-- <b> <?= number_format($totalbiaya, 2, ",", ".") ?></b> -->
                                    </td>
                                </tr>

                                <?php
                                    foreach ($UangMuka as $um) :
                                        $uangdeposit = $um['paymentamount'];
                                ?>
                                    <tr>
                                        <td colspan="2" style="text-align: right; line-height: 2;">
                                            <b>Uang Muka</b>
                                        </td>
                                        <td style="text-align: right;" colspan="2">
                                            <b>
                                                <span class="badge badge-danger">-
                                                    <?php
                                                    echo number_format($uangdeposit, 2, ",", "."); ?></span></b>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php
                                    foreach ($datapasien as $row) :
                                        $paymentmethod = $row['paymentmethod'];
                                    endforeach; ?>

                                <?php if ($paymentmethod == 'JAMKESDA') { ?>
                                    <tr><?php
                                        $cara = $paymentmethod;
                                        if (strpos($cara, 'JAMKESDA') !== false) {
                                            $plafon = 5000000;
                                            $txtplafon = $paymentmethod;
                                        } else if (strpos($cara, 'JKN JASARAHRJA') !== false) {
                                            $plafon = 20000000;
                                            $txtplafon = $paymentmethod;
                                        } else {
                                            $plafon = 0;
                                        } ?>

                                        <td colspan="2" style="text-align: right; line-height: 2;">
                                            <b>Plafon <?= $paymentmethod ?> :;</b>
                                        </td>
                                        <td style="text-align: right;" colspan="2">
                                            <b><?php
                                                echo number_format($plafon, 2, ",", "."); ?></b>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php } else {
                                        $plafon = 0;
                                    } ?>

                                <tr>
                                    <td colspan="4" style="text-align: right; line-height: 2;">
                                        <b>TOTAL BIAYA TAGIHAN</b>
                                    </td>
                                    <td style="text-align: right;" colspan="1">
                                        <b><?php
                                            $check_uangdeposit = isset($uangdeposit) ? ($uangdeposit) : 0;
                                            $Totaldeposit = $check_uangdeposit;

                                            $check_bayar_asal = isset($tagihan_asal) ? ($tagihan_asal) : 0;
                                            $TotalBayarAsal = $check_bayar_asal;
                                            $SisaTagihan = $totalbiaya - ($Totaldeposit + $plafon);
                                            $cara = $paymentmethod;
                                            if ((strpos($cara, 'JAMKESDA') !== false) and ($plafon > $totalbiaya)) {
                                                $SisaTagihan = 0;
                                            } else {
                                                $SisaTagihan = $totalbiaya - ($Totaldeposit + $plafon + $TotalBayarAsal + $TotalBayarFARIGD + $TotalBayarFAR + $TotalBayarFARIGD);
                                            }
                                            echo number_format($SisaTagihan, 2, ",", "."); ?></b>
                                    </td>
                                </tr>

                                <?php
                                    foreach ($datapasien as $rowbayar) :
                                ?>
                                    <td colspan="4" style="text-align: right;"><b>PEMBAYARAN</b></td>

                                    <td style="text-align: right;">
                                        <b><?= number_format(($rowbayar['paymentamount'] + $rowbayar['nominaldebet']), 2, ",", ".") ?></b>
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
                        <hr>
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
    <a href="printdetailranap.php" target="_BLANK"></a>
</body>

</html>