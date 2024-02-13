<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Informasi Tagihan Rawat Inap</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
            font-size: 60%;

        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
            font-size: 60%;
            font-style: italic;
        }
    </style>
    </style>
</head>

<body>
    <header>
        Sistem Informasi RSUD R Syamsudin, SH Kota Sukabumi
    </header>

    <footer>
        Copyright &copy; <?php echo date("Y"); ?>#Informasi Tagihan Rawat Inap
    </footer>

    <div class="container-fluid">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; border=" 0">
                    <tbody>
                        <tr>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkot.jpeg" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text-info"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/bunut.jpeg" width="40" class="dark-logo" />

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
                                    <hr />
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right text-right">
                    <?php
                    foreach ($pasien as $row) :
                    ?>
                        <address>
                            <h6>Kepada,</h6>
                            <?= $row['namapjb']; ?>
                            <p class="text-muted ml-4">Keluarga Atas nama Pasien No.RM : <?= $row['pasienid']; ?> [ <?= $row['pasienname']; ?>],
                                <br /> Metode Pembayaran : <?= $row['paymentmethodname']; ?>,
                                <br /> Kelas Perawatan : <?= $row['classroomname']; ?> [<?= $row['roomname']; ?>]
                                <br /><b>Tanggal Masuk Perawatan :</b> <i class="fa fa-calendar"></i> <?= $row['datetimein']; ?>
                            </p>
                        </address>
                    <?php endforeach; ?>
                </div>

                <div class="pull-text text-left">
                    <table class="table table-hover no-wrap">
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
                                <td></td>
                                <td></td>
                                <td></td>

                                <td colspan="2" style="text-align: right;">
                                    TotalBiaya Kamar
                                </td>
                                <td><b><?php
                                        $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                                        $TotalBK = $check_TotBK;
                                        echo number_format($TotalBK, 2, ",", "."); ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-responsive mt-4" style="clear: both;">
                        <table id="dataGabung" class="table table-hover no-wrap">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Tanggal</th>
                                    <th>JournalNumber</th>
                                    <th>Pelayanan</th>
                                    <th>Dokter</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                foreach ($TNO as $row) :
                                ?>
                                    <tr>
                                        <td><?= $row['types'] ?></td>
                                        <td><?= $row['documentdate'] ?></td>
                                        <td><?= $row['journalnumber'] ?></td>
                                        <td><?= $row['name']  ?></td>
                                        <td><?= $row['doktername'] ?></td>
                                        <td><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotTNO[] = $row['totaltarif'];  ?>

                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Tindakan
                                    </td>
                                    <td><b><?php
                                            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                                            $TotalTNO = $check_TotTNO;
                                            echo number_format($TotalTNO, 2, ",", "."); ?></b>
                                    </td>

                                </tr>
                                <?php
                                foreach ($GIZI as $GZ) :
                                ?>
                                    <tr>
                                        <td><?= $GZ['types'] ?></td>
                                        <td><?= $GZ['documentdate'] ?></td>
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
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Gizi
                                    </td>
                                    <td><b><?php
                                            $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                                            $TotalGIZI = $check_TotGIZI;
                                            echo number_format($TotalGIZI, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                                <?php
                                foreach ($VISITE as $V) :
                                ?>
                                    <tr>
                                        <td>VISITE</td>
                                        <td><?= $V['documentdate'] ?></td>
                                        <td><?= $V['journalnumber'] ?></td>
                                        <td><?= $V['name']  ?></td>
                                        <td><?= $V['doktername'] ?></td>
                                        <td><?= number_format($V['totaltarif'], 2, ",", ".") ?></td>
                                    </tr>
                                    <?php $TotVISITE[] = $V['totaltarif'];  ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Visite & Asuhan
                                    </td>
                                    <td><b><?php
                                            $check_TotVISITE = isset($TotVISITE) ? array_sum($TotVISITE) : 0;
                                            $TotalVISITE = $check_TotVISITE;
                                            echo number_format($TotalVISITE, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                                <?php
                                foreach ($OPERASI as $OP) :
                                ?>
                                    <tr>
                                        <td><?= $OP['types'] ?></td>
                                        <td><?= $OP['documentdate'] ?></td>
                                        <td><?= $OP['journalnumber'] ?></td>
                                        <td><?= $OP['name']  ?></td>
                                        <td><?= $OP['doktername'] ?></td>
                                        <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Operasi
                                    </td>
                                    <td><b><?php
                                            $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                                            $TotalOPERASI = $check_TotOPERASI;
                                            echo number_format($TotalOPERASI, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                                <?php
                                foreach ($PENUNJANG as $P) :
                                ?>
                                    <tr>
                                        <td><?= $P['types'] ?></td>
                                        <td><?= $P['documentdate'] ?></td>
                                        <td><?= $P['journalnumber'] ?></td>
                                        <td><?= $P['name']  ?></td>
                                        <td><?= $P['employeename'] ?></td>
                                        <td><?= number_format($P['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $TotPENUNJANG[] = $P['totaltarif'];  ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        TotalBiaya Penunjang
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
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Farmasi :
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
                                    <tr>
                                        <td><?= $behape['types'] ?></td>
                                        <td><?= $behape['documentdate'] ?></td>
                                        <td><?= $behape['journalnumber'] ?></td>
                                        <td>BHP Penunjang : <?= $behape['name']  ?></td>
                                        <td>Opt : <?= $behape['createdby'] ?></td>
                                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya BHP
                                    </td>
                                    <td><b><?php
                                            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                                            $TotalBHP = $check_TotBHP;
                                            echo number_format($TotalBHP, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Rawat Inap
                                    </td>
                                    <td><b><?php

                                            $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $TotalBHP;
                                            echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                                <?php
                                foreach ($PEMIGD as $PEM_IGD) :
                                ?>
                                    <tr>
                                        <td><b><?= $PEM_IGD['groups'] ?></b></td>
                                        <td><?= $PEM_IGD['documentdate'] ?></td>
                                        <td><?= $PEM_IGD['journalnumber'] ?></td>
                                        <td><?= $PEM_IGD['description']  ?></td>
                                        <td><?= $PEM_IGD['doktername'] ?></td>
                                        <td><?= number_format($PEM_IGD['price'], 2, ",", ".") ?></td>
                                        <?php $TotPEMIGD[] = $PEM_IGD['price'];  ?>
                                    </tr>
                                <?php endforeach; ?>
                                <?php
                                foreach ($TINIGD as $TIN_IGD) :
                                ?>
                                    <tr>
                                        <td><b><?= $TIN_IGD['types'] ?></b></td>
                                        <td><?= $TIN_IGD['documentdate'] ?></td>
                                        <td><?= $TIN_IGD['journalnumber'] ?></td>
                                        <td><?= $TIN_IGD['name']  ?></td>
                                        <td><?= $TIN_IGD['doktername'] ?></td>
                                        <td><?= number_format($TIN_IGD['price'], 2, ",", ".") ?></td>
                                        <?php $TotTINIGD[] = $TIN_IGD['price'];  ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        <?php
                                        foreach ($PEMIGD as $D) :
                                        ?>
                                            TotalBiaya <?= $D['groups']; ?> :
                                        <?php endforeach; ?>
                                    </td>
                                    <td><b><?php
                                            $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                                            $TotalPEMIGD = $check_TotPEMIGD;

                                            $check_TotTINIGD = isset($TotTINIGD) ? array_sum($TotTINIGD) : 0;
                                            $TotalTINIGD = $check_TotTINIGD;

                                            $biayaIGD = $TotalPEMIGD + $TotalTINIGD;
                                            echo number_format($biayaIGD, 2, ",", "."); ?></b>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" style="text-align: right;">
                                        TotalBiaya Seluruh :
                                    </td>
                                    <td><b><?php

                                            $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $biayaIGD;
                                            echo number_format($TOTAL, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <b>#Catatan :</b>
                        Silahkan untuk menyelesaikan administrasi keuangan dibagian loket pembayaran kasir rawat inap.
                        <br />Abaikan jika pasien ditanggung asuransi pembayaran kecuali ada biaya selisih dari perawatan yang disebabkan naik kelas perawatan
                        <br /><u>Terimaksih,</u>

                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>


</body>

</html>