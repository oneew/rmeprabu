<div id="slimtest4">
    <div class="table-responsive">
        <div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
            <div class="col">
                <div class="row">

                    <table id="datakamar" class="table color-table white-table" style="color: black; color:black" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Periode</th>
                                <th>Ruangan</th>
                                <th>Lama Rawat</th>
                                <th>Tarif</th>
                                <th>Total Tarif</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($KAMAR as $K) :
                            ?>
                                <tr>

                                    <td><?= $K['types'] ?></td>
                                    <td><?= $K['datetimein'] ?> - <?= $K['datetimeout']; ?></td>
                                    <td><b><?= $K['roomname']  ?></b> |<?= $K['bednumber'] ?></td>
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
                                    <td><?php
                                        $ruangan = $K['roomname'];

                                        if ($cek_titipan == "YA") {
                                            $tarif = $cek_tarif_kelas;
                                        }

                                        if ($cek_titipan == "TIDAK") {
                                            $tarif = $K['price'];
                                        }

                                        echo  number_format($tarif, 0, ",", "."); ?></td>
                                    <td>
                                        <?php
                                        $waktu = 6;
                                        $waktu2 = 6;
                                        $ruangan = $K['roomname'];

                                        if ($cek_titipan == "YA") {
                                            $tarif = $cek_tarif_kelas;
                                        } else {
                                            $tarif = $K['price'];
                                        }


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
                                    <h6 class="card-title text-right">Biaya Kamar :</h6>
                                </td>
                                <td><b><?php
                                        $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                                        $TotalBK = $check_TotBK;
                                        echo number_format($TotalBK, 2, ",", "."); ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="dataGabung" class="table color-table primary-table" style="color: black; color:black" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Tanggal</th>
                                <th>Nomor Jurnal</th>
                                <th>Pelayanan</th>
                                <th>Qty</th>
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
                                    <td><?= $row['name']  ?> <small class="text-muted mt-2 d-block"><?= $row['paymentmethodname']; ?></small>
                                        <small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($row['koinsiden'] == 1) {
                                                                                                                        echo "Koinsiden";
                                                                                                                    } ?></span></small>
                                    </td>
                                    <td><?= $row['qty']  ?></td>
                                    <td><?= $row['doktername'] ?></td>
                                    <td><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotTNO[] = $row['totaltarif'];  ?>

                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td colspan="2" style="text-align: right;">
                                    <h6 class="card-title">Total Biaya Tindakan :</h6>
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
                                    <td>
                                        <?= $GZ['documentdate'] ?>
                                        <small><?= $GZ['waktu'] ?></small>
                                    </td>
                                    <td><?= $GZ['journalnumber'] ?></td>
                                    <td><?= $GZ['name']  ?><small class="text-muted mt-2 d-block"><?= $GZ['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($GZ['koinsiden'] == 1) {
                                                                                                                                                                                                                        echo "Koinsiden";
                                                                                                                                                                                                                    } ?></span></small></td>
                                    <td><?= $GZ['qty']  ?></td>
                                    <td><?= $GZ['doktername'] ?></td>
                                    <td><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title">TotalBiaya Gizi :</h6>
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
                                    <td><?= $V['name']  ?><small class="text-muted mt-2 d-block"><?= $V['paymentmethodname']; ?></small></td>
                                    <td><?= $V['qty']  ?></td>
                                    <td><?= $V['doktername'] ?></td>
                                    <td><?= number_format($V['totaltarif'], 2, ",", ".") ?></td>
                                </tr>
                                <?php $TotVISITE[] = $V['totaltarif'];  ?>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title">TotalBiaya Visite & Asuhan :</h6>
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
                                    <td><?= $OP['name']  ?> <small class="text-muted mt-2 d-block"><?= $OP['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($OP['koinsiden'] == 1) {
                                                                                                                                                                                                                        echo "Koinsiden";
                                                                                                                                                                                                                    } ?></span></small></td>
                                    <td><?= $OP['qty']  ?></td>
                                    <td><?= $OP['doktername'] ?></td>
                                    <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title">TotalBiaya Operasi :</h6>
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
                                    <td><?= $P['name']  ?> <small class="text-muted mt-2 d-block"><?= $P['paymentmethod']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($P['koinsiden'] == 1) {
                                                                                                                                                                                                                    echo "Koinsiden";
                                                                                                                                                                                                                } ?></span></small></td>
                                    <td><?= $P['qty']  ?></td>
                                    <td><?= $P['employeename'] ?></td>
                                    <td><?= number_format($P['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANG[] = $P['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title">TotalBiaya Penunjang :</h6>
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
                                    <td></td>
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
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title">TotalBiaya Farmasi:</h6>
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
                                        <td><?= $behape['types'] ?></td>
                                        <td><?= $behape['documentdate'] ?></td>
                                        <td><?= $behape['journalnumber'] ?></td>
                                        <td>BHP Penunjang : <?= $behape['name']  ?></td>
                                        <td>Opt : <?= $behape['createdby'] ?></td>
                                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                            <?php
                            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                            $TotalBHP = $check_TotBHP;
                            if ($TotalBHP > 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h6 class="card-title">TotalBiaya BHP :</h6>
                                    </td>
                                    <td><b><?php

                                            echo number_format($TotalBHP, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title"><b>TotalBiaya Rawat Inap :</b></h6>
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
                                    <td>1</td>
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
                                    <td><?= $TIN_IGD['qty']  ?></td>
                                    <td><?= $TIN_IGD['doktername'] ?></td>
                                    <td><?= number_format($TIN_IGD['price'], 2, ",", ".") ?></td>
                                    <?php $TotTINIGD[] = $TIN_IGD['price'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                            foreach ($PENUNJANGIGD as $PNJIGD) :
                            ?>
                                <tr>
                                    <td><b><?= $PNJIGD['groups'] ?></b></td>
                                    <td><?= $PNJIGD['documentdate'] ?></td>
                                    <td><?= $PNJIGD['journalnumber'] ?></td>
                                    <td>Penunjang <?= $PNJIGD['groups']; ?></td>
                                    <td><?= $PNJIGD['employeename'] ?></td>
                                    <td><?= number_format($PNJIGD['totalamount'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANGIGD[] = $PNJIGD['totalamount'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                            foreach ($BHPIGD as $behapeIGD) :
                            ?>
                                <tr>
                                    <td><b><?= $behapeIGD['types'] ?></b></td>
                                    <td><?= $behapeIGD['documentdate'] ?></td>
                                    <td><?= $behapeIGD['journalnumber'] ?></td>
                                    <td>Penunjang <?= $behapeIGD['types']; ?></td>
                                    <td></td>
                                    <td><?= number_format($behapeIGD['totalbhp'], 2, ",", ".") ?></td>
                                    <?php $TotBHPIGD[] = $behapeIGD['totalbhp'];  ?>
                                </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php
                                    foreach ($PEMIGD as $D) :
                                    ?>
                                        <h6 class="card-title"><b>TotalBiaya <?= $D['groups']; ?> :</b></h6>
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
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title"><b>TotalBiaya Seluruh :</b></h6>
                                </td>
                                <td><b><?php

                                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $biayaIGD;
                                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                                </td>
                            </tr>
                            <?php
                            foreach ($UangMuka as $um) :
                                $uangdeposit = $um['paymentamount'];
                            ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h6 class="card-title"><b>Uang Muka:</b></h6>
                                    </td>
                                    <td><b><?php
                                            echo number_format($uangdeposit, 2, ",", "."); ?></b>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h6 class="card-title"><b>TotalBiaya Tagihan :</b></h6>
                                </td>
                                <td><b><?php

                                        $check_uangdeposit = isset($uangdeposit) ? ($uangdeposit) : 0;
                                        $Totaldeposit = $check_uangdeposit;

                                        $SisaTagihan = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $biayaIGD - ($Totaldeposit);
                                        echo number_format($SisaTagihan, 2, ",", "."); ?></b>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
        height: '67vh',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '67vh',
        alwaysVisible: true
    });
</script>