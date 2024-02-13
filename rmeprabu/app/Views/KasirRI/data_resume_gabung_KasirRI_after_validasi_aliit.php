<!-- <div class="container">
    <div class="row">
        <div class="col-md-12"> -->
        <div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <div class="col">
        <div class="row">

            <table class="table color-table success-table" id="dataGabung" style="color: black; color:black" cellspacing="0" cellpadding="0">
                <thead>
                    <!-- <tr>
                        <td colspan="6">
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                        </td>
                    </tr> -->
                    <tr>

                        <th style="text-align: left;">Type</th>
                        <th style="text-align: left;">Periode</th>
                        <!-- <th style=" text-align: center;"><th>HariRawat</th></th> -->
                        <th style="text-align: left;">Ruangan</th>
                        <th style=" text-align: center;">LamaRawat</th>
                        <th style="text-align: right;">Tarif</th>
                        <th style="text-align: right;">TotalTarif</th>
                    </tr>
                    <!-- <tr>
                        <td colspan="6">
                            <hr style="margin-top: 0px; margin-bottom: 0px">
                        </td>
                    </tr> -->
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $i = 0;

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

                        <!-- ?php if ($selisiha > 0) { ?> -->
                        <tr>
                            <td><?= $K['types'] ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($K['datetimein'])) ?> - <?= date('d-m-Y H:i:s', strtotime($K['datetimeout'])); ?></td>
                            <!-- <td style=" text-align: center;">?php echo $selisiha . " Hari"; ?></td> -->
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
                                } else if (($jam <= $waktu) and ($menit > 1)) {
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
                        <?php endforeach ?>
                        <!-- menhitung jumlah Biaya kamar -->
                        <?php
                        $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                        $TotalBK = $check_TotBK;
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Ruangan) . </td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalBK, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <?php //} 
                        ?>
                </tbody>
            </table>

            <!-- looping Tindakan Ruangan -->
            <?php foreach ($KAMAR_GROUP as $KG) :
                $ruangan = $KG['roomname']; ?>
                <br>

                <table class="table color-table success-table" id="dataGabung" style="color: black; color:black" cellspacing="0" cellpadding="0">
                    <thead>
                        <!-- <tr>
                                <td colspan="6">
                                    <hr style="margin-top: 2px; margin-bottom: 2px">
                                </td>
                            </tr> -->
                        <tr>
                            <th style="text-align: left; width: 4%">No</th>
                            <th style="text-align: left; width: 10%">Tanggal</th>
                            <th style="text-align: left; width: 30%;">Keterangan</th>
                            <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                            <th style="text-align: left; width: 24%">dokter</th>
                            <th style="text-align: right;width: 15%">Harga</th>
                            <th style="text-align: right; width: 17%">Total</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $kelasruangan = "IRJ / IGD";
                        foreach ($PEMIGD as $PIGD) :
                            if ($PIGD['groups'] == "IRJ") {
                                $kelasruangan = "Rawat Jalan";
                                $room_op = $PIGD['poliklinik'];
                            } elseif ($PIGD['groups'] == "IGD") {
                                $kelasruangan = "IGD";
                                $room_op = $PIGD['poliklinik'];
                            }
                        endforeach; ?>
                        <?php $no = 1;
                        $i = 0; ?>

                        <!-- Visit Ranap -->
                        <?php
                        foreach ($VISITE as $row) :
                            if ($row['roomname'] == $ruangan) {
                                $TotVISIT[] = $row['totaltarif'];
                                $TotVst[] = $row['subtotal'];
                            };
                        endforeach ?>
                        <?php
                        $check_TotVISIT = isset($TotVISIT) ? array_sum($TotVISIT) : 0;
                        $TotalVISIT = $check_TotVISIT;

                        $sub_TotVst = isset($TotVst) ? array_sum($TotVst) : 0;

                        if ($sub_TotVst > 0) { ?>
                            <tr>
                                <td colspan="6"><u>Visit/Askep</u></td>
                            </tr>
                        <?php } ?>

                        <?php
                        foreach ($VISITE as $row) :
                            if ($row['roomname'] == $ruangan) { ?>
                                <?php
                                unset($TotVst[$i]);
                                $i++; ?>
                                <?php if ($row['totaltarif'] > 0) { ?>
                                    <tr>
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= date('d-m-Y', strtotime($row['documentdate'])) ?></td>
                                        <td> <?= $row['name'] ?> [<?= number_format($row['qty'], 2); ?>]</td>
                                        <?php
                                        $caridokter = explode(" ", $row['doktername']);
                                        if ($caridokter[0] == "dr" or $caridokter[0] == "dr.") {
                                            $dokter = $row['doktername'];
                                        } else {
                                            $dokter = $row['doktername'];
                                        } ?>
                                        <td> <?php echo $dokter ?></td>
                                        <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                        <td style="text-align: right;"><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                        <?php
                                        $no++; ?>


                                    </tr>
                        <?php
                                };
                            };
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
                                <td style="text-align: right" colspan="5">Sub Total (Visit/Askep) . <?= $ruangan ?></td>
                                <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotVst, 2, ",", ".") ?></b></td>
                            </tr>
                            <tr style="font-size: 4px; line-height:1">
                                <td colspan="5">&nbsp;</td>
                            </tr>

                        <?php } ?>

                        <!-- Tindakan Ranap -->
                        <?php
                        $i = 0;
                        foreach ($TNO as $rowTNO) :
                            if ($rowTNO['roomname'] == $ruangan) {
                                $TotTNO[] = $rowTNO['subtotal'];
                                $TotTn[] = $rowTNO['subtotal'];
                            };
                        endforeach ?>
                        <?php
                        $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                        $TotalTNO = $check_TotTNO;
                        $sub_TotTn = isset($TotTn) ? array_sum($TotTn) : 0;
                        if ($sub_TotTn > 0) { ?>
                            <tr>
                                <td colspan="6"><u>Tindakan Non Operatip</u></td>
                            </tr>
                        <?php } ?>
                        <?php
                        foreach ($TNO as $rowTNO) :
                            if ($rowTNO['roomname'] == $ruangan) { ?>
                                <?php
                                unset($TotTn[$i]);
                                $i++; ?>
                                <tr>
                                    <?php if ($rowTNO['subtotal'] > 0) { ?>
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= date('d-m-Y', strtotime($rowTNO['documentdate'])) ?></td>
                                        <td> <?= $rowTNO['name'] ?> [<?= number_format($rowTNO['qty'], 2) ?>]</td>
                                        <?php
                                        $caridokter = explode(" ", $rowTNO['doktername']);
                                        if ($caridokter[0] == "dr" or $caridokter[0] == "dr.") {
                                            $dokter = $rowTNO['doktername'];
                                        } else {
                                            $dokter = "";
                                        } ?>
                                        <td> <?php echo $dokter ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                        <!-- ?php $TotTNO[] = $rowTNO['subtotal'];  ?> //Untuk Perhitungan -->
                                        <?php $no++; ?>
                                </tr>
                    <?php
                                    };
                                };
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
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan Non Operatif) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotTn, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Penunjang Rawat Inap -->
                    <?php
                    $i = 0;
                    foreach ($PENUNJANG as $P) :
                        if ($P['roomname'] == $ruangan) {
                            $TotPENUNJANG[] = $P['subtotal'];
                            $totPnj[] = $P['subtotal'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                    $TotalPENUNJANG = $check_TotPENUNJANG;

                    $sub_TotPnj = isset($totPnj) ? array_sum($totPnj) : 0;
                    if ($sub_TotPnj > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Penunjang</u></td>
                        </tr>
                    <?php } ?>
                    <?php foreach ($PENUNJANG as $P) :
                        if ($P['roomname'] == $ruangan) { ?>
                            <?php
                            unset($totPnj[$i]);
                            $i++; ?>
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
                                    <td><?= date('d-m-Y', strtotime($P['documentdate'])) ?></td>
                                    <td><?= $P['name']; ?> [<?= number_format($P['qty'], 2) ?>]</td>
                                    <td><?= $P['doktername']; ?></td>
                                    <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                            <?php } ?>
                    <?php };
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
                            <td style="text-align: right" colspan="5">Sub Total (Penunjang) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotPnj, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>


                    <!-- Operasi -->
                    <?php
                    $i = 0;
                    foreach ($OPERASI as $OP) :
                        if ($OP['roomname'] == $ruangan) {
                            $TotOPERASI[] = $OP['totaltarif'];
                            $TotOp[] = $OP['totaltarif'];
                        };
                    endforeach
                    ?>
                    <?php
                    $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                    $TotalOPERASI = $check_TotOPERASI;
                    $sub_TotOp = isset($TotOp) ? array_sum($TotOp) : 0;
                    if ($sub_TotOp > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Tindakan Operasi</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($OPERASI as $OP) :
                        if ($OP['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotOp[$i]);
                            $i++; ?>
                            <?php if ($OP['totaltarif'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td> <?= date('d-m-Y', strtotime($OP['documentdate'])) ?></td>
                                    <td><?= $OP['name']  ?> [<?= number_format($OP['qty'], 2) ?>]</td>
                                    <td><?= $OP['doktername']  ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
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
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan Operasi) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotOp, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- bhp -->
                    <?php
                    $i = 0;
                    foreach ($BHP as $behape) :
                        if ($behape['roomname'] == $ruangan) {
                            $TotBHP[] = $behape['totalbhp'];
                            $totBh[] = $behape['totalbhp'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                    $TotalBHP = $check_TotBHP;

                    $sub_TotBh = isset($totBh) ? array_sum($totBh) : 0;
                    if ($sub_TotBh > 0) { ?>
                        <tr>
                            <td colspan="6"><u>BHP</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($BHP as $behape) :
                        if ($behape['roomname'] == $ruangan) { ?>
                            <?php
                            unset($totBh[$i]);
                            $i++; ?>
                            <?php if ($behape['totalbhp'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?= $behape['types'] ?></td>
                                    <td><?= $behape['name']  ?> [<?= number_format($behape['qty'], 2) ?>]</td>
                                    <td><?= $behape['doktername']  ?></td>
                                    <td style="text-align: right"><?= number_format($behape['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right"><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                    <?php $no++ ?>
                                </tr>
                    <?php };
                        };
                    endforeach;  ?>

                    <?Php
                    // if ($i > 0) { 
                    ?>
                    <?php if ($sub_TotBh > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (BHP) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotBh, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Gzi -->
                    <?php
                    $i = 0;
                    foreach ($GIZI as $GZ) :
                        if ($GZ['roomname'] == $ruangan) {
                            $TotGIZI[] = $GZ['totaltarif'];
                            $totGz[] = $GZ['totaltarif'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                    $TotalGIZI = $check_TotGIZI;

                    $sub_TotGz = isset($totGz) ? array_sum($totGz) : 0;
                    if ($sub_TotGz > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Gizi</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($GIZI as $GZ) :
                        if ($GZ['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotGz[$i]);
                            $i++; ?>
                            <?php if ($GZ['totaltarif'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td> <?= date('d-m-Y', strtotime($GZ['documentdate'])) ?></td>
                                    <td> <?= $GZ['name']  ?> [<?= number_format($GZ['qty'], 2) ?>]</td>
                                    <td> <?= $GZ['doktername'] ?> </td>
                                    <td style="text-align: right;"><?= number_format($GZ['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
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
                            <td style="text-align: right" colspan="5">Sub Total (Gizi) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotGz, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Farmasi ranap -->
                    <?php
                    $i = 0;
                    foreach ($FARMASI as $F) :
                        if ($F['roomname'] == $ruangan) {
                            $TotFAR[] = abs($F['subtotal']);
                            $TotFr[] = abs($F['subtotal']);
                        };
                    endforeach ?>
                    <?php
                    $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                    $TotalFAR = $check_TotFAR;

                    $sub_TotFr = isset($TotFr) ? array_sum($TotFr) : 0;
                    if ($sub_TotFr > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Farmasi Rawat Inap</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($FARMASI as $F) :
                        if ($F['roomname'] == $ruangan) { ?>
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

                                    <td style="text-align: right;"><?php $awal = (-1 * ($F['subtotal']));
                                                                    $far = $awal + $F['embalase'];
                                                                    $deni = ceil($far);
                                                                    echo number_format($awal, 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
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
                            <td style="text-align: right" colspan="5">Sub Total (Farmasi RI) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotFr, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Farmasi ranap IBS /////////////////////////// --> 
                    <?php
                    $i = 0;
                    foreach ($FARMASI_IBS as $F_IBS) :
                        if ($F_IBS['roomname'] == $ruangan) {
                            $TotFAR_IBS[] = abs($F_IBS['subtotal']);
                            $TotFr_IBS[] = abs($F_IBS['subtotal']);
                        };
                    endforeach ?>
                    <?php
                    $check_TotFAR_IBS = isset($TotFAR_IBS) ? array_sum($TotFAR_IBS) : 0;
                    $TotalFAR_IBS = $check_TotFAR_IBS;

                    $sub_TotFr_IBS = isset($TotFr_IBS) ? array_sum($TotFr_IBS) : 0;
                    if ($sub_TotFr_IBS > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Farmasi OK</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($FARMASI_IBS as $F_IBS) :
                        if ($F_IBS['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotFr_IBS[$i]);
                            $i++; ?>
                            <?php if (abs($F_IBS['subtotal']) > 0) { ?>
                                <tr>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                        </div>
                                    </td>
                                    <!-- <td>?php echo $no ?></td> -->
                                    <td> <?= date('d-m-Y', strtotime($F_IBS['documentdate'])) ?></td>
                                    <td><?= $F_IBS['name']  ?> [<?= number_format(abs($F_IBS['qty']), 2, ",", ".") ?>]</td>
                                    <td><?= $F_IBS['doktername']  ?></td>
                                    <td style="text-align: right;"><?= number_format($F_IBS['price'], 2, ",", ".") ?></td>

                                    <td style="text-align: right;"><?php $awal_IBS = (-1 * ($F_IBS['subtotal']));
                                                                    $far_IBS = $awal_IBS + $F_IBS['embalase'];
                                                                    $deni_IBS = ceil($far_IBS);
                                                                    echo number_format($awal_IBS, 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
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
                            <td style="text-align: right" colspan="5">Sub Total (Farmasi OK) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotFr_IBS, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    </tbody>
                </table>
            <?php endforeach; ?>
            <?php
            $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
            $TotalBK = $check_TotBK; ?>
            <hr style="margin-bottom: 2px; margin-top: 2px">
            <!-- akhir looping kamar -->

            <!-- =================================================================== -->

            <!-- Cetak IGD -->
            <table class="table color-table success-table" id="dataGabung" style="color: black; color:black" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="text-align: left; width: 4%">No</th>
                        <th style="text-align: left; width: 10%">Tanggal</th>
                        <th style="text-align: left; width: 30%;">Keterangan</th>
                        <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                        <th style="text-align: left; width: 24%">dokter</th>
                        <th style="text-align: right;width: 15%">Harga</th>
                        <th style="text-align: right; width: 17%">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="6"><u><?= $kelasruangan ?></u></td>
                    </tr>
                    <!-- Pemeriksaan -->
                    <?php
                    $no = 1;
                    foreach ($PEMIGD as $PIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($PIGD['documentdate'])) ?></td>
                            <td><?= $PIGD['description'] ?> [<?= number_format(1, 2, ",", ".") ?>]</td>
                            <td><?= $PIGD['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                            <?php $TotPEMIGD[] = $PIGD['price']; ?>
                            <?php $no++; ?>
                        </tr>
                    <?php endforeach;
                    $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                    $TotalPemIGD = $check_TotPEMIGD;
                    ?>

                    <!-- Tindakan IGD -->
                    <?php
                    foreach ($TINIGD as $TGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($PIGD['documentdate'])) ?></td>
                            <td><?= $TGD['name'] ?> [<?= number_format($TGD['qty'], 2) ?>]</td>
                            <td><?= $TGD['doktername']  ?></td>
                            <td style="text-align: right;"><?= number_format($TGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($TGD['subtotal'], 2, ",", ".") ?></td>
                            <?php $TotTINDIGD[] = $TGD['subtotal']; ?>
                            <?php $no++; ?>
                        </tr>

                    <?php endforeach;
                    $check_TotTINDIGD = isset($TotTINDIGD) ? array_sum($TotTINDIGD) : 0;
                    $TotalTindIGD = $check_TotTINDIGD;
                    ?>

                    <!-- Jumlah gabungan tindakan dan pemeriksaan igd -->
                    <?php if (($TotalPemIGD + $TotalTindIGD) > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalPemIGD + $TotalTindIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- OPERASI IGD?RJ -->
                    <?php
                    foreach ($OPERASIIGD as $OPIGD) :
                    ?>
                        <?php if (($OPIGD['room'] == $room_op) or (substr($OPIGD['room'], 0, 3) == $room_op)) { ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td> <?= date('d-m-Y', strtotime($OPIGD['documentdate'])) ?></td>
                                <td><?= $OPIGD['name'] ?> [<?= number_format($OPIGD['qty'], 2) ?>]</td>
                                <td><?= $OPIGD['doktername']  ?></td>
                                <td style="text-align: right;"><?= number_format($OPIGD['price'], 2, ",", ".") ?></td>
                                <td style="text-align: right;"><?= number_format($OPIGD['totaltarif'], 2, ",", ".") ?></td>
                                <?php $TotOPIGD[] = $OPIGD['totaltarif']; ?>
                                <?php $no++; ?>
                            </tr>
                        <?php } ?>
                    <?php endforeach;
                    $check_TotOPIGD = isset($TotOPIGD) ? array_sum($TotOPIGD) : 0;
                    $TotalOPIGD = $check_TotOPIGD;
                    ?>

                    <!-- OPERASI IGD/RJ igd -->
                    <?php if (($TotalOPIGD) > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <!-- <td style="text-align: right" colspan="5">Sub Total (OPERASI) . ?= $kelasruangan ?></td> -->
                            <td style="text-align: right" colspan="5">Sub Total (OPERASI) . </td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalOPIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- Farmasi Igd -->
                    <?php
                    foreach ($FARMASIIGD as $FIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($FIGD['documentdate'])) ?></td>
                            <td><?= $FIGD['name']  ?> [<?= number_format(abs($FIGD['qty']), 2) ?>]</td>
                            <td><?= $FIGD['doktername']  ?></td>
                            <td style="text-align: right;"><?= number_format($FIGD['price'], 2, ",", ".") ?></td>

                            <td style="text-align: right;"><?php $awaligd = abs($FIGD['subtotal']);
                                                            $farigd = $awaligd + $FIGD['embalase'];
                                                            $deniigd = ceil($farigd);
                                                            echo number_format($awaligd, 2, ",", ".") ?></td>
                            <?php $TotFARIGD[] = $awaligd;  ?>
                            <?php $no++; ?>
                        </tr>
                    <?php endforeach ?>
                    <?php
                    $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                    $TotalFARIGD = $check_TotFARIGD;
                    ?>
                    <?php if ($TotalFARIGD > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Farmasi) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalFARIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- penunjang -->
                    <?php
                    foreach ($PENUNJANGIGD as $PNJIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($PNJIGD['documentdate'])) ?></td>
                            <td><?= $PNJIGD['types']; ?> | <?= $PNJIGD['name']; ?> [<?= number_format($PNJIGD['qty'], 2) ?>]</td>
                            <td><?= $PNJIGD['doktername']; ?></td>
                            <td style="text-align: right;"><?= number_format($PNJIGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><b><?= number_format($PNJIGD['subtotal'], 2, ",", ".") ?></b></td>
                            <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                            <?php $no++ ?>
                        </tr>
                    <?php endforeach ?>
                    <?php
                    $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                    $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                    ?>
                    <?php if ($TotalPENUNJANGIGD > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Penunjang) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalPENUNJANGIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- BHP -->
                    <?php
                    foreach ($BHPIGD as $behapeIGD) :
                    ?>
                        <?php if ($behapeIGD['totalbhp'] > 0) { ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td> <?= date('d-m-Y', strtotime($behapeIGD['documentdate'])) ?></td>
                                <td><?= $behapeIGD['types']; ?> | <?= $behapeIGD['name']; ?> [<?= number_format($behapeIGD['qty'], 2) ?>]</td>
                                <td><?= $behapeIGD['doktername']; ?></td>
                                <td style="text-align: right;"><?= number_format($behapeIGD['totalbhp'], 2, ",", ".") ?></td>
                                <td style="text-align: right;"><b><?= number_format($behapeIGD['totalbhp'], 2, ",", ".") ?></b></td>
                                <?php $TotBHPIGD[] = $behapeIGD['totalbhp'];  ?>
                                <?php $no++ ?>
                            </tr>
                    <?php };
                    endforeach ?>
                    <?php
                    $check_TotBHPIGD = isset($TotBHPIGD) ? array_sum($TotBHPIGD) : 0;
                    $TotalBHPIGD = $check_TotBHPIGD;
                    ?>
                    <?php if ($TotalBHPIGD > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (BHP) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalBHPIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="6">&nbsp;</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <hr style="margin-bottom: 0px; margin-top: 2px">
            <br>
            <!-- akhir hitungan IGD -->

            <!-- Menghitung Total Biaya Rawat Inap -->
            <?php
            $totalRanap = $TotalBK + $TotalVISIT +
                $TotalTNO + $TotalPENUNJANG +
                $TotalOPERASI + $TotalBHP +
                $TotalGIZI + $TotalFAR + $TotalOPIGD + $TotalFAR_IBS;
            ?>

            <!-- menghitung jumlah OPERASI RI atau RJ-->
            <?php
            $TotalOPERASI = $TotalOPERASI + $TotalOPIGD;
            ?>

            <!-- menghitung jumlah Total Rawat Jalan ? IGD -->
            <?php
            $totalRajal = $TotalPemIGD + $TotalTindIGD +
                $TotalFARIGD + $TotalPENUNJANGIGD  +
                $TotalOPIGD + $TotalBHPIGD;
            ?>

            <!-- menghitung jumlah deposit / pembayaran -->
            <?php
            $depositbayar = abs($TotalKasirApotek_RI) + abs($TotalKasirApotek_RJ) +
                abs($TotalKasirPnj_RI) + abs($TotalKasirPnj_RJ) +
                abs($TotalKasir_RJ) + abs($TotalKasir_Tindakan);
            ?>

            <!-- total tagihan -->
            <?php
            $totalbiaya = (abs($totalRajal) + abs($totalRanap)) - abs($depositbayar)
            ?>

            <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                <tfoot>
                    <tr>
                        <th style="text-align: left; width: 5%"></th>
                        <th style="text-align: left; width: 13%"></th>
                        <th style="text-align: left; width: 36%;"></th>
                        <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                        <th style="text-align: left; width: 34%"></th>
                        <th style="text-align: right;width: 15%"></th>
                        <th style="text-align: right; width: 17%"></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 0px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">Biaya Rawat Inap (RI)</td>
                        <td colspan="1" style="text-align: right">
                            <?php echo number_format($totalRanap, 2, ",", "."); ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="4">Biaya (<?= $kelasruangan . ")"; ?></td>
                        <td style="text-align: right" colspan="1">
                            <?php echo number_format($totalRajal, 2, ",", "."); ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 2px">
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="4"><b>Total Biaya</b></td>
                        <td style="text-align: right" colspan="2">
                            <b> <?php echo number_format(($totalRajal + $totalRanap), 2, ",", "."); ?></b>
                        </td>
                        <!-- <td></td> -->
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="4">Deposit</td>
                        <td style="text-align: right" colspan="2">
                            <?php echo number_format($depositbayar, 2, ",", "."); ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 2px">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="4"><b>Total Tagihan Biaya</b></td>
                        <td style="text-align: right" colspan="2">
                            <b> <?php echo number_format($totalbiaya, 2, ",", "."); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 2px">
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="4"><b>Jumlah Pembayaran</b></td>
                        <td style="text-align: right" colspan="2">
                            <b> <?php echo number_format($paymentamount, 2, ",", "."); ?></b>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 2px">
                        </td>
                    </tr>


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
                    <?php //endforeach; 
                    ?>
                </tfoot>
            </table>
            <!-- <hr> -->
            <?php //endforeach; 
            ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm" id="dataGabung" cellspacing="0" cellpadding="0">
                <tfoot>

                    <?php
                    foreach ($TagihanAsal as $tagihan_asal) :
                        $totaldaftarklinik = $tagihan_asal['totaldaftar'];
                        $totaltindakanklinik = $tagihan_asal['totaltindakan'];
                        $totalbhptindakanklinik = $tagihan_asal['totalbhp'];
                        $totalfarmasiklinik = $tagihan_asal['totalfarmasi'];
                        $totalpenunjangklinik = $tagihan_asal['totalpenunjang'];
                        $totalkasirklinik = $tagihan_asal['grandtotal'];
                        $asalpelayanan = $tagihan_asal['groups'];
                    ?>

                    <?php endforeach; ?>

                    <?php
                    $sisatagihanasalIGD = $totalRajal - ($TotalKasirApotek_RJ + $TotalKasirPnj_RJ +
                        $TotalKasir_RJ + $TotalKasir_Tindakan) ?>
                    <?php
                    foreach ($UangMuka as $um) :
                        $uangdeposit = $um['paymentamount'];
                    ?>
                        <tr>
                            <td colspan="4" style="text-align: right; line-height: 2;">
                                <b>Uang Muka</b>
                            </td>
                            <td style="text-align: right;" colspan="1">
                            <td><b>
                                    <span class="badge badge-danger">
                                        <?php
                                        echo number_format($uangdeposit, 2, ",", "."); ?></span></b>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ($paymentmethod == 'JAMKESDA') { ?>
                        <tr>
                            <td colspan="4" style="text-align: right; line-height: 2;">
                                <b>Plafon Biaya</b>
                            </td>
                            <td style="text-align: right;" colspan="1">
                                <b><?php
                                    $cara = $paymentmethod;
                                    if (strpos($cara, 'JAMKESDA') !== false) {
                                        $plafon = 5000000;
                                    } else if (strpos($cara, 'JKN JASARAHRJA') !== false) {
                                        $plafon = 20000000;
                                    } else {
                                        $plafon = 0;
                                    }
                                    // echo number_format($plafon, 2, ",", "."); 
                                    ?></b>
                            </td>
                        </tr>
                    <?php } else {
                        $plafon = 0;
                    } ?>


                    <b><?php

                        // $check_uangdeposit = isset($uangdeposit) ? ($uangdeposit) : 0;
                        // $Totaldeposit = $check_uangdeposit;

                        // $check_bayar_asal = isset($tagihanasalIGD) ? ($tagihanasalIGD) : 0;
                        // $TotalBayarAsal = $check_bayar_asal;

                        // $check_bayar_asal = isset($tagihanasalIGD) ? ($tagihanasalIGD) : 0;
                        // $TotalBayarAsal = $check_bayar_asal;


                        // $SisaTagihan = ($totalbiaya) - ($Totaldeposit + $plafon + $TotalKasirAwal);

                        // $SisaTagihan = ($totalbiaya) - ($totalKasirRajal + $totalKasirRanap + $Totaldeposit);
                        // $cara = $paymentmethod;
                        // if ((strpos($cara, 'JAMKESDA') !== false) and ($plafon > $totalbiaya)) {
                        //     $SisaTagihan = 0;
                        // } else {
                        //     $SisaTagihan = abs($totalbiaya) - ($Totaldeposit + $plafon + $totalKasirRajal + $totalKasirRanap);
                        // }

                        // echo number_format($SisaTagihan, 2, ",", "."); 
                        ?></b>


            </table>
        </div>
        <!-- </font> -->
    </div>


    <div class="row mt-4">
        <div class="col-md-2 col-lg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-info text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalBK, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Kamar</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-warning text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalVISIT, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Visite&Askep</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-success text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalTNO, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Tindakan Non Operatif</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-danger text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalOPERASI, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Tindakan Operatif</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-info text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalPENUNJANG, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Penunjang RI</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-warning text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalGIZI, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Gizi</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-success text-center">
                    <h4 class="font-light text-white"><?php echo number_format($TotalFAR + $TotalFAR_IBS, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Biaya Farmasi RI</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="rounded bg-danger text-center">
                    <h4 class="font-light text-white"><?php echo number_format($totalRajal - $TotalOPIGD, 2, ",", ".") ?></h4>
                    <h6 class="text-white">Tagihan <?= $kelasruangan; ?></h6>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="form-body">
        <div class="row" style="display: none;">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Dokter</label>
                    <select name="doktername" id="doktername" class="select2" style="width: 100%">
                        <option></option>
                        <?php foreach ($list as $dpjp) { ?>
                            <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?php echo $dpjp['name']; ?></option>

                        <?php } ?>
                    </select>
                    <input type="hidden" name="dokter" id="dokter" value="<?= $dokter; ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cara Pulang</label>
                    <select name="statuspasien" id="statuspasien" class="select2" style="width: 100%;">
                        <?php foreach ($pasienstatus as $pjb) : ?>
                            <option value="<?php echo $pjb['name']; ?>" <?php if ($pjb['name'] == $statuspasienpulang) { ?> selected="selected" <?php } ?>><?php echo $pjb['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Jenis Transaksi</label>
                    <select name="paymentstatusname" id="paymentstatusname" class="select2" style="width: 100%">
                        <option>Pilih Jenis Transaksi</option>
                        <?php foreach ($jpkasir as $jpk) : ?>
                            <option data-id="<?= $jpk['id']; ?>" class="select-jpk" <?php if ($jpk['keteranganpembayaran'] == $memo) { ?> selected="selected" <?php } ?>><?= $jpk['keteranganpembayaran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" id="paymentstatus" name="paymentstatus" class="form-control" value="<?= $paymentstatus; ?>" readonly>
                    <input type="hidden" id="memo" name="memo" class="form-control" value="<?= $memo; ?>" readonly>
                    <input type="hidden" id="types" name="types" class="form-control" value="<?= $types; ?>">
                    <input type="hidden" id="idbayar" name="idbayar" class="form-control" value="<?= $id; ?>">
                    <div class="form-control-feedback errortypes">
                    </div>
                </div>
            </div>

        </div>

        <div class="row" style="display: none;">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kode INACBG</label>
                    <input type="text" id="inacbg" name="inacbg" class="form-control" autocomplete="off" value="<?= $inacbgs; ?>">
                    <input type="hidden" id="inacbgsclass" name="inacbgsclass" class="form-control" value="<?= $inacbgsclass; ?>">
                    <input type="hidden" id="inacbgs" name="inacbgs" class="form-control" value="<?= $inacbgs; ?>">
                    <input type="hidden" id="inacbgsname" name="inacbgsname" class="form-control" value="<?= $inacbgsname; ?>">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kelas1</label>
                    <input type="text" id="tarifkelas1" name="tarifkelas1" class="form-control" value="<?= $tarifkelas1; ?>" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kelas2</label>
                    <input type="text" id="tarifkelas2" name="tarifkelas2" class="form-control" value="<?= $tarifkelas2; ?>" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kelas3</label>
                    <input type="text" id="tarifkelas3" name="tarifkelas3" class="form-control" value="<?= $tarifkelas3; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row" style="display: none;">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select name="metodepembayaran" id="metodepembayaran" class="select2" style="width: 100%;">
                        <?php foreach ($metodebayar as $mb) : ?>
                            <option data-id="<?= $mb['id']; ?>" data-name="<?= $mb['metodepembayaran']; ?>" class="select-metodepembayaran" <?php if ($mb['metodepembayaran'] == $metodepembayaran) { ?> selected="selected" <?php } ?>><?= $mb['metodepembayaran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Refrensi Bank</label>
                    <select name="daftarbank" id="daftarbank" class="select2" style="width: 100%" disabled>
                        <option>-</option>
                        <?php foreach ($daftarbank as $bank) : ?>
                            <option data-id="<?= $bank['id']; ?>" data-room="<?= $bank['namabank']; ?>" class="select-daftarbank" <?php if ($bank['namabank'] == $referensibank) { ?> selected="selected" <?php } ?>><?= $bank['namabank']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="text-danger">Jumlah Selisih Biaya</label>
                    <input type="text" id="selisih" name="selisih" class="form-control danger" onkeyup="myFunctionDisc()" value="<?php
                                                                                                                                    $cara = $paymentmethod;
                                                                                                                                    if (strpos($cara, 'JAMKESDA') !== false) {
                                                                                                                                        $selisih = $SisaTagihan;
                                                                                                                                    } else {
                                                                                                                                        $selisih = 0;
                                                                                                                                    }
                                                                                                                                    echo $selisih; ?>">
                    <div class="form-control-feedback errorpaymentamount">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Disc %</label>
                    <input type="text" id="disc" name="disc" class="form-control" value="<?= $disc; ?>">

                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Disc Rp.</label>
                    <input type="text" id="jumlahdiskon" name="jumlahdiskon" class="form-control" value="0">
                    <input type="hidden" id="tagihan" name="tagihan" class="form-control" value=<?= $totalbiaya ?>>
                    <div class="form-control-feedback errorpaymentamount">
                    </div>
                </div>
            </div>

        </div>

        <div class="row" style="display: none;">

            <div class="col-md-3">
                <div class="form-group">
                    <label>No.Referensi Bank</label>
                    <input type="text" id="referensibank" name="referensibank" class="form-control" disabled>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nominal Debit</label>
                    <input type="text" id="nominaldebet" name="nominaldebet" class="form-control" value="0" disabled>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Jumlah Pembayaran</label>
                    <input type="text" id="paymentamount" name="paymentamount" class="form-control" value="<?= $paymentamount; ?>">
                    <?php
                    $TOTAL = abs($totalRajal) + abs($totalRanap)
                    ?>
                    <input type="hidden" id="grandtotal" name="grandtotal" class="form-control" value="<?= $TOTAL; ?>">
                    <input type="hidden" id="paymentamount_awal" name="paymentamount_awal" class="form-control" value="<?= $paymentamount; ?>">
                    <input type="hidden" id="daftarbank_awal" name="daftarbank_awal" class="form-control" value="<?= $referensibank; ?>">
                    <div class="form-control-feedback errorpaymentamount">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nama Penyetor</label>
                    <input type="text" id="payersname" name="payersname" class="form-control form-rupiah" onkeyup="this.value = this.value.toUpperCase()">
                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>">
                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                    <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="<?= $parentjournalnumber; ?>">
                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>">
                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                    <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep_poli; ?>">
                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="<?= $bpjs_sep; ?>">
                    <input type="hidden" id="noantrian" name="noantrian" class="form-control">
                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>">
                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>">
                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>">
                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>">
                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>">
                    <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>">
                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>">
                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>">
                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>">
                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>">
                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>">
                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>">
                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>">
                    <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $paymentmethodori; ?>">
                    <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $paymentmethodnameori; ?>">
                    <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control" value="<?= $paymentcardnumberori; ?>">
                    <input type="hidden" id="paymentmethodnew" name="paymentmethodnew" class="form-control" value="<?= $paymentmethod; ?>">
                    <input type="hidden" id="paymentmethodnamenew" name="paymentmethodnamenew" class="form-control" value="<?= $paymentmethodname; ?>">
                    <input type="hidden" id="paymentcardnumbernew" name="paymentcardnumbernew" class="form-control">
                    <input type="hidden" id="paymentchange" name="paymentchange" class="form-control">
                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>">
                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>">
                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>">
                    <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>">
                    <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokterpoli; ?>">
                    <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $dokterpoliname; ?>">

                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>">
                    <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                    <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>">
                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="<?= $statuspasienpulang; ?>">
                    <input type="hidden" id="lakalantas" name="lakalantas" class="form-control" value="<?= $lakalantas; ?>">
                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>">
                    <input type="hidden" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>">
                    <input type="hidden" id="hubunganpjb" name="hubunganpjb" class="form-control" value="<?= $hubunganpjb; ?>">
                    <input type="hidden" id="telppjb" name="telppjb" class="form-control" value="<?= $telppjb; ?>">
                    <input type="hidden" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>">
                    <input type="hidden" id="pasienclassroom" name="pasienclassroom" class="form-control" value="<?= $pasienclassroom; ?>">
                    <input type="hidden" id="pasienclassroomnew" name="pasienclassroomnew" class="form-control">
                    <input type="hidden" id="pasienclassroomchange" name="pasienclassroomchange" class="form-control" value="<?= $pasienclassroomchange; ?>">
                    <input type="hidden" id="bumil" name="bumil" class="form-control" value="<?= $bumil; ?>">
                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>">
                    <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>">
                    <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>">
                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>">
                    <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>">
                    <input type="hidden" id="roomname" name="roomname" class="form-control" value="<?= $roomname; ?>">
                    <input type="hidden" id="bednumber" name="bednumber" class="form-control" value="<?= $bednumber; ?>">
                    <input type="hidden" id="bedname" name="bedname" class="form-control" value="<?= $bedname; ?>">
                    <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>">
                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="<?= $parentid; ?>">
                    <input type="hidden" id="parentname" name="parentname" class="form-control" value="<?= $parentname; ?>">
                    <input type="hidden" id="datein" name="datein" class="form-control" value="<?= $datein; ?>">
                    <input type="hidden" id="timein" name="timein" class="form-control" value="<?= $timein; ?>">
                    <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>">
                    <input type="hidden" id="dateout" name="dateout" class="form-control" value="<?= $dateout; ?>">
                    <input type="hidden" id="timeout" name="timeout" class="form-control" value="<?= $timeout; ?>">
                    <input type="hidden" id="datetimeout" name="datetimeout" class="form-control" value="<?= $datetimeout; ?>">
                    <input type="hidden" id="dateout" name="dateout" class="form-control" value="<?= $dateout; ?>">

                    <?php
                    $totaldaftarklinik = $TotalPemIGD;
                    $totaltindakanklinik = $TotalTindIGD;
                    $totalbhptindakanklinik = $TotalBHPIGD;
                    $totalfarmasiklinik = $TotalFARIGD;
                    $totalpenunjangklinik = $TotalPENUNJANGIGD;
                    $totalkasirklinik = $depositbayar;
                    $sisatagihanasalIGD = ($TotalPemIGD + $TotalTindIGD + $TotalBHPIGD + $TotalFARIGD + $TotalPENUNJANGIGD) - $depositbayar
                    ?>

                    <!-- untuk rawat jalan/igd -->
                    <input type="hidden" id="totaldaftarklinik" name="totaldaftarklinik" class="form-control" value="<?= $totaldaftarklinik; ?>">
                    <input type="hidden" id="totaltindakanklinik" name="totaltindakanklinik" class="form-control" value="<?= $totaltindakanklinik; ?>">
                    <input type="hidden" id="totalbhptindakanklinik" name="totalbhptindakanklinik" class="form-control" value="<?= $totalbhptindakanklinik; ?>">
                    <input type="hidden" id="totalfarmasiklinik" name="totalfarmasiklinik" class="form-control" value="<?= $totalfarmasiklinik; ?>">
                    <input type="hidden" id="totalpenunjangklinik" name="totalpenunjangklinik" class="form-control" value="<?= $totalpenunjangklinik; ?>">
                    <input type="hidden" id="totalbhppenunjangklinik" name="totalbhppenunjangklinik" class="form-control" value="0">
                    <input type="hidden" id="totalkasirklinik" name="totalkasirklinik" class="form-control" value="<?= $totalkasirklinik; ?>">

                    <!-- rawat inap -->
                    <input type="hidden" id="totalkamar" name="totalkamar" class="form-control" value="<?= $TotalBK; ?>">
                    <input type="hidden" id="totalvisite" name="totalvisite" class="form-control" value="<?= $TotalVISIT; ?>">
                    <input type="hidden" id="totaltindakanruang" name="totaltindakanruang" class="form-control" value="<?= $TotalTNO; ?>">
                    <input type="hidden" id="totalmakan" name="totalmakan" class="form-control" value="<?= $TotalGIZI; ?>">
                    <input type="hidden" id="totalbhptindakanruang" name="totalbhptindakanruang" class="form-control" value="0">
                    <input type="hidden" id="totaltindakanoperasi" name="totaltindakanoperasi" class="form-control" value="<?= $TotalOPERASI; ?>">
                    <input type="hidden" id="totalbhptindakanoperasi" name="totalbhptindakanoperasi" class="form-control">
                    <input type="hidden" id="totalfarmasi" name="totalfarmasi" class="form-control" value="<?= $TotalFAR + $TotalFAR_IBS; ?>">
                    <input type="hidden" id="totalpenunjang" name="totalpenunjang" class="form-control" value="<?= $TotalPENUNJANG; ?>">
                    <input type="hidden" id="totalbhppenunjang" name="totalbhppenunjang" class="form-control" value="<?= $TotalBHP; ?>">

                    <input type="hidden" id="totallainnya" name="totallainnya" class="form-control">
                    <input type="hidden" id="totalbhplainnya" name="totalbhplainnya" class="form-control">
                    <input type="hidden" id="totalkasirranap" name="totalkasirranap" class="form-control">
                    <input type="hidden" id="totalkasirpenunjang" name="totalkasirpenunjang" class="form-control">
                    <input type="hidden" id="discount" name="discount" class="form-control">
                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="KASIRRI">
                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="KASIR RAWAT INAP">
                    <input type="hidden" id="penunjang" name="penunjang" class="form-control">
                    <input type="hidden" id="cancel" name="cancel" class="form-control">
                    <input type="hidden" id="cancelreason" name="cancelreason" class="form-control">
                    <input type="hidden" id="cancelmemo" name="cancelmemo" class="form-control">
                    <input type="hidden" id="cancelby" name="cancelby" class="form-control">
                    <input type="hidden" id="numberseq" name="numberseq" class="form-control">
                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                    <input type="hidden" id="totalTagihanAsal" name="totalTagihanAsal" class="form-control" value="<?= $sisatagihanasalIGD; ?>">

                </div>
            </div>

        </div>
        <div class="text-right">
            <?php if ($payment == 0) { ?>
                <!-- <button id="button" class="btn btn-danger btnvalidasi" type="submit"> <i class="fas fa-credit-card"></i></span> Validasi Pembayaran </button> -->
            <?php } ?>
            <?php if ($payment == 1) { ?>
                <!-- <button id="button" class="btn btn-danger btnvalidasiupdate" type="submit"><i class="fas fa-credit-card"></i></span> Update Validasi Pembayaran </button> -->
                <!-- <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="signaturekasirranap('<?= $referencenumber ?>')"><span><i class="fas fa-quidditch"></i></span> Signature</button> -->

                <!-- <button class="btn btn-warning btn-outline" type="button" onclick="emailkwitansikasirranap('<?= $referencenumber ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button> -->
                <!-- <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail</button> -->
                <button id="print" class="btn btn-info btnprintBP" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print BP</button>
                <button id="print" class="btn btn-success btnprintdetailseluruh" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Seluruh</button>
                <button id="print" class="btn btn-danger btnprintdetailkoinsiden" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span>Koinsiden</button>
                <button id="print" class="btn btn-info btnprintdetailnonkoinsiden" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span>Non Koinsiden</button>
            <?php } ?>
        </div>

    </div>
</div>


<script>
    var rupiah = document.getElementById('paymentamount__');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);

    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#paymentstatusname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_jpkasir') ?>",
                'data': {
                    key: $('#paymentstatusname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#paymentstatusname').val(data.jenispembayaran);
                    $('#paymentstatus').val(data.deskripsi);
                    $('#memo').val(data.keteranganpembayaran);
                    $('#types').val(data.jenispembayaran);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
    $('#paymentstatusname').on('change', function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('KasirRanap/ajax_selisih_inacbg') ?>",
            data: {
                keterangan: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);
                if (data[0] == null) {
                    $('#inacbg').attr('disabled', 'disabled');
                    $('#selisih').attr('disabled', 'disabled');
                    $('#tarifkelas1').val('');
                    $('#tarifkelas2').val('');
                    $('#tarifkelas3').val('');
                    $('#inacbg').val('');
                    $('#selisih').val('0');


                } else {
                    $('#inacbg').removeAttr('disabled');
                    $('#selisih').removeAttr('disabled');
                }
                //$('#statuspulang').val($('#statuspulang option:selected').data('name'));
            }
        })
    });
</script>


<script>
    $(document).ready(function() {
        $('.formvalidasibayar').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnvalidasi').attr('disable', 'disabled');
                    $('.btnvalidasi').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnvalidasi').removeAttr('disable');
                    $('.btnvalidasi').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.errordoktername').html('');
                        }

                        if (response.error.paymentamount) {
                            $('#paymentamount').addClass('form-control-danger');
                            $('.errorpaymentamount').html(response.error.paymentamount);
                        } else {
                            $('#paymentamount').removeClass('form-control-danger');
                            $('.errorpaymentamount').html('');
                        }

                        if (response.error.statuspasien) {
                            $('#statuspasien').addClass('form-control-danger');
                            $('.errorstatuspasien').html(response.error.statuspasien);
                        } else {
                            $('#statuspasien').removeClass('form-control-danger');
                            $('.errorstatuspasien').html('');
                        }

                        if (response.error.types) {
                            $('#types').addClass('text-danger');
                            $('.errortypes').html(response.error.types);
                        } else {
                            $('#types').removeClass('text-danger');
                            $('.errortypes').html('');
                        }
                    } else
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.gagal,

                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                dataresume();
                                $('#paymentamount').val(response.jumlahbayar);
                                $('#payersname').val(response.pembayar);
                            }
                        });
                    }
                }
            });
            return false;
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#rujuk").autocomplete({
            source: "<?php echo base_url('PelayananRanap/ajax_rujuk'); ?>",
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#code_rujuk').val(ui.item.code);
                $('#address_rujuk').val(ui.item.address);

            }
        });
    });

    $('#metodepembayaran').on('change', function() {


        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('PendaftaranRanap/metode_pembayaran_kasir') ?>",
            data: {
                metodepembayaran: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);


                $('#daftarbank').empty();

                if (data[0] == null) {

                    $('#daftarbank').append("<option>-</option>");
                    $('#daftarbank').attr('disabled', 'disabled');
                    $('#referensibank').attr('disabled', 'disabled');
                    $('#nominaldebet').attr('disabled', 'disabled');



                } else {

                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#daftarbank').append("<option value='" + item.namabank + "' data-room='" + item.namabank + "'>" + item.namabank + "</option>");
                    }
                    $('#referensibank').removeAttr('disabled');
                    $('#daftarbank').removeAttr('disabled');
                    $('#nominaldebet').removeAttr('disabled');

                }

                $('#metodepembayaran').val($('#metodepembayaran option:selected').data('name'));

            }
        })
    });
</script>


<script>
    function signaturekasirranap(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/SignatureKasir'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsignaturekasirranap').modal('show');

                }
            }

        });


    }
</script>

<script>
    function cetakkwitansikasirranap(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/cetakkwitansikasir'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintkwitansikasirranap').modal('show');

                }
            }

        });
    }
</script>

<script>
    function emailkwitansikasirranap(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/emailkwitansikasir'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Berhasil Dikirim',


                    })

                }
            }

        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintdetail').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRanap/printdetailkwitansi') ?>?page=" + id, "_blank");

        })
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRanap/printbuktipembayaran') ?>?page=" + id, "_blank");

        })
        $('.btnprintdetailseluruh').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            // window.open("?php echo base_url('KlaimRanap/printdetailkwitansiKlaim') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");
            window.open("<?php echo base_url('KlaimRanap/printdetailkwitansiKlaim') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank");

        })
        $('.btnprintdetailkoinsiden').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printdetailkwitansiKlaimKoinsiden') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
        $('.btnprintdetailnonkoinsiden').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printdetailkwitansiKlaimNonKoinsiden') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;
        var separator = '-';
        var hakKelas = document.getElementById("pasienclassroom").value;
        var grandtotal = document.getElementById("grandtotal").value;
        var disc = document.getElementById("disc").value;
        $("#inacbg").autocomplete({
            source: "<?php echo base_url('KasirRanap/ajax_inacbg'); ?>?kelas=" + kelas + +'separator' + hakKelas + +'separator' + grandtotal + +'separator' + disc,

            select: function(event, ui) {
                $('#inacbg').val(ui.item.value);
                $('#inacbgs').val(ui.item.inacbg);
                $('#inacbgsname').val(ui.item.deskripsi);
                $('#tarifkelas1').val(ui.item.kls1);
                $('#tarifkelas2').val(ui.item.kls2);
                $('#tarifkelas3').val(ui.item.kls3);
                $('#selisih').val(ui.item.tarif_selisih);
            }
        });
    });
</script>

<script>
    function myFunctionDisc() {
        let x = document.getElementById("jumlahdiskon");
        let y = document.getElementById("paymentamount");
        t = document.getElementById("tagihan");
        s = document.getElementById("selisih");
        d = document.getElementById("disc");

        if (s.value > 10000) {
            x.value = (s.value * d.value / 100).toFixed(2);
            y.value = (s.value - x.value);
        } else {
            x.value = (t.value * d.value / 100).toFixed(2);
            y.value = (t.value - x.value);
        }
    }
</script>