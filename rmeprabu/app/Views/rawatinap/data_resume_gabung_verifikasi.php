<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div id="slimtest4">
    <div class="table-responsive">
        <table id="datakamar" class="table color-table white-table">
            <thead>
                <tr>

                    <th>Ketrangan</th>
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
                            if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                $tarif = 156815;
                            } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                $tarif = 256815;
                            } else {
                                $tarif = $K['price'];
                            }
                            echo  number_format($tarif, 0, ",", "."); ?></td>
                        <td>
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
        <table id="dataGabung" class="table color-table success-table">
            <thead>
                <tr>
                    <th>Verifikasi</th>
                    <th>Type</th>
                    <th>Tanggal</th>
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
                        <td>
                            <?php
                            $attr_tno = $row['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_tno ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><?= $row['types'] ?></td>
                        <td><?= $row['documentdate'] ?></td>
                        <td><?= $row['name']  ?> [<b><?= $row['qty']; ?></b>]<small class="text-muted mt-2 d-block"><?= $row['paymentmethodname']; ?></small>
                            <small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($row['koinsiden'] == 1) {
                                                                                                            echo "Koinsiden";
                                                                                                        } ?></span></small>
                        </td>
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
                    <td>
                        <h6 class="card-title">TotalBiaya Tindakan :</h6>
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
                        <td>
                            <?php
                            $attr_gizi = $GZ['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_gizi ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><?= $GZ['types'] ?></td>
                        <td><?= $GZ['documentdate'] ?></td>
                        <td><?= $GZ['name']  ?> [<b><?= $GZ['qty']; ?></b>]<small class="text-muted mt-2 d-block"><?= $GZ['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($GZ['koinsiden'] == 1) {
                                                                                                                                                                                                                                        echo "Koinsiden";
                                                                                                                                                                                                                                    } ?></span></small></td>
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
                        <td>
                            <?php
                            $attr_visite = $V['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_visite ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td>VISITE</td>
                        <td><?= $V['documentdate'] ?></td>
                        <td><?= $V['name']  ?> [<b><?= $V['qty']; ?></b>]<small class="text-muted mt-2 d-block"><?= $V['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($V['koinsiden'] == 1) {
                                                                                                                                                                                                                                    echo "Koinsiden";
                                                                                                                                                                                                                                } ?></span></small></td>
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
                        <td>
                            <?php
                            $attr_operasi = $OP['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_operasi ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><?= $OP['types'] ?></td>
                        <td><?= $OP['documentdate'] ?></td>
                        <td><?= $OP['name']  ?> <small class="text-muted mt-2 d-block"><?= $OP['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($OP['koinsiden'] == 1) {
                                                                                                                                                                                                            echo "Koinsiden";
                                                                                                                                                                                                        } ?></span></small></td>
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
                        <td>
                            <?php
                            $attr_penunjang = $P['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_penunjang ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><?= $P['types'] ?></td>
                        <td><?= $P['documentdate'] ?></td>
                        <td><?= $P['name']  ?> [<b><?= $P['qty']; ?></b>] <small class="text-muted mt-2 d-block"><?= $P['paymentmethod']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($P['koinsiden'] == 1) {
                                                                                                                                                                                                                                    echo "Koinsiden";
                                                                                                                                                                                                                                } ?></span></small></td>
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
                    <?php
                    if (abs($F['price']) > 0) { ?>
                        <tr>
                            <td>
                                <div class="switch">
                                    <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td>FAR</td>
                            <td><?= $F['documentdate'] ?></td>
                            <td><?= $F['journalnumber']  ?><small class="text-muted mt-2 d-block"><?= $F['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($F['koinsiden'] == 1) {
                                                                                                                                                                                                                        echo "Koinsiden";
                                                                                                                                                                                                                    } ?></span></small></td>
                            <td><?= $F['doktername']  ?></td>
                            <td><?php $awal = abs($F['price']);
                                $far = $awal + $F['embalase'];
                                $deni = ceil($far);
                                echo number_format($deni, 2, ",", ".") ?></td>
                            <?php $TotFAR[] = $deni;  ?>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Farmasi :</h6>
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
                            <td>
                                <div class="switch">
                                    <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><?= $behape['types'] ?></td>
                            <td><?= $behape['documentdate'] ?></td>

                            <td>BHP Penunjang : <?= $behape['name']  ?></td>
                            <td>Opt : <?= $behape['createdby'] ?></td>
                            <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                            <?php $TotBHP[] = $behape['totalbhp'];  ?>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya BHP :</h6>
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
                        <td>
                            <div class="switch">
                                <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><b><?= $PEM_IGD['groups'] ?></b></td>
                        <td><?= $PEM_IGD['documentdate'] ?></td>
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
                        <td>
                            <?php
                            $attr_tind_igd = $TIN_IGD['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_tind_igd ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><b><?= $TIN_IGD['types'] ?></b></td>
                        <td><?= $TIN_IGD['documentdate'] ?></td>
                        <td><?= $TIN_IGD['name']  ?> [<b><?= $TIN_IGD['qty']; ?></b>]</td>
                        <td><?= $TIN_IGD['doktername'] ?></td>
                        <td><?= number_format($TIN_IGD['price'], 2, ",", ".") ?></td>
                        <?php $TotTINIGD[] = $TIN_IGD['price'];  ?>
                    </tr>
                <?php endforeach; ?>
                <?php
                foreach ($PENUNJANGIGD as $PNJIGD) :
                ?>
                    <tr>
                        <td>
                            <?php
                            $attr_penunjang_igd = $PNJIGD['verifikasi'] == 1 ? 'checked' : '';
                            ?>
                            <div class="switch">
                                <input type="checkbox" <?= $attr_penunjang_igd ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                            </div>
                        </td>
                        <td><b><?= $PNJIGD['groups'] ?></b></td>
                        <td><?= $PNJIGD['documentdate'] ?></td>
                        <td>Penunjang <?= $PNJIGD['groups']; ?></td>
                        <td><?= $PNJIGD['employeename'] ?></td>
                        <td><?= number_format($PNJIGD['totalamount'], 2, ",", ".") ?></td>
                        <?php $TotPENUNJANGIGD[] = $PNJIGD['totalamount'];  ?>
                    </tr>
                <?php endforeach; ?>

                <?php
                foreach ($FARMASIIGD as $FIGD) :
                ?>
                    <?php
                    if (abs($FIGD['price']) > 0) { ?>
                        <tr>
                            <td>
                                <div class="switch">
                                    <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td>FAR</td>
                            <td><?= $FIGD['documentdate'] ?></td>
                            <td><?= $FIGD['journalnumber']  ?><small class="text-muted mt-2 d-block"><?= $FIGD['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($FIGD['koinsiden'] == 1) {
                                                                                                                                                                                                                            echo "Koinsiden";
                                                                                                                                                                                                                        } ?></span></small></td>
                            <td><?= $FIGD['doktername']  ?></td>
                            <td><?php $awal = abs($FIGD['price']);
                                $far = $awal + $FIGD['embalase'];
                                $deniIGD = ceil($far);
                                echo number_format($deniIGD, 2, ",", ".") ?></td>
                            <?php $TotFARIGD[] = $deniIGD;  ?>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>

                <?php
                foreach ($BHPIGD as $behapeIGD) :
                ?>
                    <?php
                    if ($behapeIGD['totalbhp'] > 0) { ?>
                        <tr>
                            <td>
                                <div class="switch">
                                    <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><b><?= $behapeIGD['types'] ?></b></td>
                            <td><?= $behapeIGD['documentdate'] ?></td>
                            <td>Penunjang <?= $behapeIGD['types']; ?></td>
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

                            $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                            $TotalFARIGD = $check_TotFARIGD;



                            $biayaIGD = $TotalPEMIGD + $TotalTINIGD + $TotalPENUNJANGIGD + $TotalBHPIGD + $TotalFARIGD;
                            echo number_format($biayaIGD, 2, ",", "."); ?></b>
                    </td>
                </tr>

                <tr>
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
<br>
<div class="text-right">
    <input type="hidden" id="idfverifikasi" name="idfverifikasi" class="form-control" value="<?= $idverifikasi; ?>">
    <input type="hidden" id="verifikasi" name="verifikasi" class="form-control" value="<?= $verifikasi; ?>">
    <input type="hidden" id="batalverifikasi" name="batalverifikasi" class="form-control" value="<?= $verifikasi; ?>">
    <input type="hidden" id="tanggalverifikasi" name="tanggalverifikasi" class="form-control" value="<?= date('Y-m-d G:i:s'); ?>" readonly>
    <input type="hidden" id="petugasverifikasi" name="petugasverifikasi" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
    <?php if ($verifikasi == 0) { ?>
        <button id="button" class="btn btn-danger btnverifikasi" type="submit" onclick="VerifikasiSelesai('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-on"></i></span> Selesai Verifikasi ?</button>
    <?php } ?>
    <?php if ($verifikasi == 1) { ?>
        <button id="button" class="btn btn-warning btnbatalverifikasi" type="submit" onclick="VerifikasiBatal('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-off"></i></span> Batal Verifikasi </button>
    <?php } ?>
    <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail</button>
</div>

<script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>/js/custom.min.js"></script>
<script type="text/javascript">
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '1000px',
        railVisible: true,
        alwaysVisible: true
    });
</script>


<script>
    function VerifikasiSelesai(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Rincian Pasien Ini Sudah Selesai Anda verifikasi ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRanap/VerifikasiSelesai'); ?>",
                    data: {
                        id: id,
                        petugasverifikasi: $('#petugasverifikasi').val(),
                        tanggalverifikasi: $('#tanggalverifikasi').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            }).then((result) => {
                                if (result.value) {
                                    dataresume();
                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function VerifikasiBatal(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Akan Membatalkan Status Verifikasi Rincian Ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRanap/VerifikasiBatal'); ?>",
                    data: {
                        id: id,
                        petugasverifikasi: $('#petugasverifikasi').val(),
                        tanggalverifikasi: $('#tanggalverifikasi').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            }).then((result) => {
                                if (result.value) {
                                    dataresume();
                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script src="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.js"></script>

<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/dff/dff.js" type="text/javascript"></script>

<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2


    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintdetail').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRanap/printdetailkwitansiVerifikasi') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRJ/printbuktipembayaran') ?>?page=" + id, "_blank");

        })
    });
</script>