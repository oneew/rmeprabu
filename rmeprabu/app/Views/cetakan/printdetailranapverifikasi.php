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
        body {
            margin: 5px;
            margin-left: 10;
            margin-right: 20;
            margin-top: 0px;
            padding-top: 0px;
        }

        table {

            width: 10%;
        }


        table,
        th,
        td {
            text-align: left;
        }

        .verifikasi {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 25px;

        }

        .alamat {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;

        }

        .header1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: bold;

        }

        .header2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: bold;

        }

        hr {
            border: none;
            border-top: 3px double #333;
            color: #333;
            overflow: visible;
            text-align: center;
            height: 5px;
        }

        hr:after {
            background: #fff;
            content: '§';
            padding: 0 4px;
            position: relative;
            top: -13px;
        }
    </style>
    </style>
</head>

<body>

    <table class="verifikasi" style="width: 100%; border-collapse: collapse; height: 72px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 18px;">
                <td class="header1" style="width: 100%; text-align: center; height: 18px;"><b>PEMERINTAH KABUPATEN MUARAENIM<b></td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;">RUMAH SAKIT UMUM DAERAH H. M. RABAIN</td>
            </tr>
            <tr style="height: 18px;">
                <td class="alamat" style="width: 100%; text-align: center; height: 18px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;">Rincian Biaya Instalasi Rawat Inap</td>
            </tr>
        </tbody>
    </table>


    <table class="verifikasi" style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
        <tbody>

            <?php
            foreach ($datapasien as $row) :
            ?>

                <tr>
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
                    <td style="text-align">Nomor Bukti</td>
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
                    <td colspan="2">: <?= $row['paymentmethodname']; ?></td>

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
    <hr>
    <table id="datakamar" class="verifikasi" style="width: 100%; border-collapse: collapse; height: 72px;" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Type</th>
                <th>Periode</th>
                <th>Ruangan</th>
                <th>LamaRawat</th>
                <th>Tarif</th>
                <th>TotalTarif</th>


            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($KAMAR as $K) :
            ?>
                <tr>
                    <td><?= $K['types'] ?></td>
                    <td><?= $K['datetimein'] ?> - <?= $K['datetimeout']; ?></td>
                    <td><?= $K['roomname']  ?> | <?= $K['bednumber'] ?></td>
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
                    ?>
                    <td><?php echo $hari . " Hr " . $jam . "Jm" . $menit . "Mn"; ?></td>
                    <td><?= $K['price'] ?></td>
                    <td>
                        <?php
                        $waktu = 6;
                        $waktu2 = 6;
                        $tarif = $K['price'];
                        if ($jam <= $waktu) {
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
                        echo  number_format($biayakamar, 0, ",", ".");
                        ?>
                        <?php $TotBK[] = $biayakamar;  ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">
                    <b>Biaya Kamar</b>
                </td>
                <td><b><?php
                        $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                        $TotalBK = $check_TotBK;
                        echo number_format($TotalBK, 2, ",", "."); ?></b>
                </td>
            </tr>

        </tbody>
    </table>
    <hr>
    <table id="dataGabung" class="verifikasi" style="width: 100%; border-collapse: collapse; height: 72px;" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($VISITE as $row) :
            ?>
                <tr>

                    <td>VISITE</td>
                    <td style="text-align: left;"><?= $row['name'] ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".")  ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotPemeriksaan[] = $row['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"></td>
                <td style="text-align: left;">
                    <b>TotalBiaya Visite & Asuhan</b>
                </td>
                <td><b><?php
                        $check_TotVISITE = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                        $TotalVISITE = $check_TotVISITE;
                        echo number_format($TotalVISITE, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($TNO as $rowTNO) :
            ?>
                <tr>

                    <td><?= $rowTNO['types'] ?></td>
                    <td><?= $rowTNO['journalnumber'] ?> <?= $rowTNO['name']  ?></td>
                    <td><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                    <td><?= $rowTNO['qty'] ?></td>
                    <td><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotTNO[] = $rowTNO['subtotal'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Tindakan</b>
                </td>
                <td><b><?php
                        $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                        $TotalTNO = $check_TotTNO;
                        echo number_format($TotalTNO, 2, ",", "."); ?></b>
                </td>

            </tr>


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
                    <td><?= $P['groups'] ?></td>
                    <td><?= $deskripsi; ?> | <?= $P['journalnumber'] ?></td>
                    <td><?= number_format($P['totalamount'], 2, ",", ".") ?></td>
                    <td><?= $P['totalqty'] ?></td>
                    <td><?= number_format($P['totalamount'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $P['totalamount'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Penunjang :</h6>
                </td>
                <td><b><?php
                        $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                        $TotalPENUNJANG = $check_TotPENUNJANG;
                        echo number_format($TotalPENUNJANG, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($FARMASI as $F) :
            ?>
                <tr>
                    <td>FAR</td>
                    <td><?= $F['documentdate'] ?></td>
                    <td><?= $F['journalnumber'] ?></td>
                    <td><?= $F['poliklinikname']  ?></td>
                    <td><?= $F['doktername']  ?></td>
                    <td><?php $awal = abs($F['price']);
                        $far = $awal + $F['embalase'];
                        $deni = ceil($far);
                        echo number_format($deni, 2, ",", ".") ?></td>
                    <?php $TotFAR[] = $deni;  ?>
                </tr>
            <?php endforeach; ?>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Farmasi :</b>
                </td>
                <td><b><?php
                        $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                        $TotalFAR = $check_TotFAR;
                        echo number_format($TotalFAR, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($BHP as $behape) :
            ?>
                <?php
                    if ($behape['totalbhp'] > 0) { ?>
                    <tr>
                        <td>BHP <?= $behape['types'] ?></td>
                        <td><?= $behape['journalnumber'] ?></td>
                        <td><?= number_format($behape['totalbhp'], 2, ",", ".")  ?></td>
                        <td></td>
                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya BHP</b>
                </td>
                <td><b><?php
                        $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                        $TotalBHP = $check_TotBHP;
                        echo number_format($TotalBHP, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($GIZI as $GZ) :
            ?>
                <tr>
                    <td><?= $GZ['types'] ?></td>
                    <td><?= $GZ['journalnumber'] ?></td>
                    <td><?= $GZ['name']  ?></td>
                    <td><?= $GZ['doktername'] ?></td>
                    <td><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Gizi</b>
                </td>
                <td><b><?php
                        $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                        $TotalGIZI = $check_TotGIZI;
                        echo number_format($TotalGIZI, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($OPERASI as $OP) :
            ?>
                <tr>
                    <td><?= $OP['types'] ?></td>
                    <td><?= $OP['documentdate'] ?> | <?= $OP['journalnumber'] ?></td>
                    <td><?= $OP['name']  ?></td>
                    <td><?= $OP['qty'] ?></td>
                    <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Operasi</b>
                </td>
                <td><b><?php
                        $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                        $TotalOPERASI = $check_TotOPERASI;
                        echo number_format($TotalOPERASI, 2, ",", "."); ?></b>
                </td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Rawat Inap</b>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $TotalBHP;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>
            <?php
                foreach ($datapasien as $DP) :
            ?>
                <tr>
                    <td></td>
                    <td><?php if ($DP['groups'] == "IRJ") {
                            $asal = "Tagihan Biaya pelayanan Rawat Jalan";
                        } else {
                            $asal = "Tagihan Biaya Pelayanan Gawat Darurat";
                        } ?>
                        <b><?= $asal; ?></b>
                    </td>
                    <td><?php $totalasal = 0; ?></td>
                    <td></td>
                    <td></td>

                </tr>
            <?php endforeach; ?>

            <?php
                foreach ($PEMIGD as $PEM_IGD) :
            ?>
                <tr>
                    <td><b><?= $PEM_IGD['groups'] ?></b></td>
                    <td><?= $PEM_IGD['description'] ?> | <?= $PEM_IGD['doktername'] ?></td>
                    <td><?= number_format($PEM_IGD['price'], 2, ",", ".") ?></td>
                    <td></td>
                    <td><?= number_format($PEM_IGD['price'], 2, ",", ".") ?></td>
                    <?php $TotPEMIGD[] = $PEM_IGD['price'];  ?>
                </tr>
            <?php endforeach; ?>
            <?php
                foreach ($TINIGD as $TIN_IGD) :
            ?>
                <tr>

                    <td><b><?= $TIN_IGD['types'] ?></b></td>
                    <td><?= $TIN_IGD['name']  ?> [<b><?= $TIN_IGD['qty']; ?></b>] [<?= $TIN_IGD['doktername'] ?>]</td>
                    <td><?= number_format($TIN_IGD['price'], 2, ",", ".") ?></td>
                    <td><?= $TIN_IGD['qty']; ?></td>
                    <?php $TotTINIGD[] = $TIN_IGD['price'];  ?>
                    <td><?= number_format($TIN_IGD['subtotal'], 2, ",", ".") ?></td>
                </tr>
            <?php endforeach; ?>
            <?php
                foreach ($PENUNJANGIGD as $PNJIGD) :
            ?>
                <tr>
                    <td><b><?= $PNJIGD['groups'] ?></b></td>
                    <td><?= $PNJIGD['documentdate'] ?></td>
                    <td>Penunjang <?= $PNJIGD['groups']; ?></td>
                    <td><?= $PNJIGD['employeename'] ?></td>
                    <td><?= number_format($PNJIGD['totalamount'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANGIGD[] = $PNJIGD['totalamount'];  ?>
                </tr>
            <?php endforeach; ?>
            <?php
                foreach ($BHPIGD as $behapeIGD) :
            ?>
                <?php
                    if ($behapeIGD['totalbhp'] > 0) { ?>
                    <tr>

                        <td><b><?= $behapeIGD['types'] ?></b></td>
                        <td><?= $behapeIGD['documentdate'] ?></td>
                        <td></td>
                        <td><?= number_format($behapeIGD['totalbhp'], 2, ",", ".") ?></td>
                        <?php $TotBHPIGD[] = $behapeIGD['totalbhp'];  ?>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <?php
                    foreach ($PEMIGD as $D) :
                    ?>
                        <b>TotalBiaya <?= $D['groups']; ?></b>
                    <?php endforeach; ?>
                </td>
                <td><b><?php
                        $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                        $TotalPEMIGD = $check_TotPEMIGD;

                        $check_TotTINIGD = isset($TotTINIGD) ? array_sum($TotTINIGD) : 0;
                        $TotalTINIGD = $check_TotTINIGD;

                        $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                        $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;

                        $check_TotBHPIGD = isset($TotBHPIGD) ? array_sum($TotBHPIGD) : 0;
                        $TotalBHPIGD = $check_TotBHPIGD;

                        $biayaIGD = $TotalPEMIGD + $TotalTINIGD + $TotalPENUNJANGIGD + $TotalBHPIGD;
                        echo number_format($biayaIGD, 2, ",", "."); ?></b>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>TotalBiaya Seluruh</b>
                </td>
                <td><b><?php

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $biayaIGD;
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
<?php endforeach; ?>

</body>

<script type="text/javascript">
    window.print();
</script>

</html>