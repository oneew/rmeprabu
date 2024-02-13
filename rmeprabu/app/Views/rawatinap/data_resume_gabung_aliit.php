<!-- <div id="slimtest4">
    <div class="table-responsive">
        <div class="col-md-12"> -->
<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <!-- <div class="col"> -->
        <div class="row">
            <!-- <font style="color: black"> -->

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
                            <th style="text-align: left; width: 10%">Tgl Pelayanan</th>
                            <th style="text-align: left; width: 10%">Tgl Input</th>
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
                                        <td> <?= date('d-m-Y H:i:s', strtotime($row['createddate'])) ?></td>
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
                                        <td> <?= date('d-m-Y H:i:s', strtotime($rowTNO['createddate'])) ?></td>
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
                                    <td><?= date('d-m-Y H:i:s', strtotime($P['createddate'])) ?></td>
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
                                    <td> <?= date('d-m-Y H:i:s', strtotime($OP['createddate'])) ?></td>
                                    
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
                                    <td> <?= date('d-m-Y H:i:s', strtotime($GZ['documentdate'])) ?></td>
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
                                    <td> <?= date('d-m-Y H:i:s', strtotime($F['createddate'])) ?></td>
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
                                    <td> <?= date('d-m-Y H:i:s', strtotime($F_IBS['createddate'])) ?></td>
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
                        <th style="text-align: left; width: 10%">Tgl Pelayanan</th>
                        <th style="text-align: left; width: 10%">Tgl Input</th>
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
                            <td> <?= date('d-m-Y H:i:s', strtotime($PIGD['createddate'])) ?></td>
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
                            <td> <?= date('d-m-Y H:i:s', strtotime($PIGD['createddate'])) ?></td>
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
                    foreach ($OPERASI as $OPIGD) :
                    ?>
                        <?php if ($OPIGD['roomname'] == $room_op) { ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td> <?= date('d-m-Y', strtotime($OPIGD['documentdate'])) ?></td>
                                <td> <?= date('d-m-Y H:i:s', strtotime($OPIGD['createddate'])) ?></td>
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
                            <td> <?= date('d-m-Y H:i:s', strtotime($FIGD['createddate'])) ?></td>
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
                            <td> <?= date('d-m-Y H:i:s', strtotime($PNJIGD['createddate'])) ?></td>
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
                                <td> <?= date('d-m-Y H:i:s', strtotime($behapeIGD['createddate'])) ?></td>
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

            <table class="table color-table success-table" id="dataGabung" style="color: black; font-size: medium;" cellspacing="0" cellpadding="0">
                <tfoot>
                    <tr>
                        <th style="text-align: left; width: 4%">&nbsp;</th>
                        <th style="text-align: left; width: 10%">&nbsp;</th>
                        <th style="text-align: left; width: 30%;">&nbsp;</th>
                        <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                        <th style="text-align: left; width: 24%">&nbsp;</th>
                        <th style="text-align: right;width: 15%">&nbsp;</th>
                        <th style="text-align: right; width: 17%">&nbsp;</th>
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
                        <td style="text-align: right" colspan="5"><b>Total Biaya</b></td>
                        <td style="text-align: right" colspan="1">
                            <b> <?php echo number_format($totalRajal + $totalRanap, 2, ",", "."); ?></b>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="5">Deposit</td>
                        <td style="text-align: right" colspan="1">
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
                        <td style="text-align: right" colspan="5"><b>Total Tagihan Biaya</b></td>
                        <td style="text-align: right" colspan="1">
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

                </tfoot>
            </table>
            <!-- </font> -->
        </div>
    <!-- </div> -->
</div>

<script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>/js/custom.min.js"></script>
<script type="text/javascript">
    $('#slimtest1').slimScroll({
        height: '250px'
    });
    $('#slimtest2').slimScroll({
        height: '250px'
    });
    $('#slimtest3').slimScroll({
        position: 'left',
        height: '1000px',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '1000px',
        alwaysVisible: true
    });
</script>