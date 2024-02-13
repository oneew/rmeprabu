<div id="slimtest4">
    <div class="table-responsive">
        <table id="datakamar" class="table color-table white-table">
            <thead>
                <tr>

                    <th>Ketrangan</th>
                    <th>Periode</th>
                    <th>HariRawat</th>
                    <th>Ruangan</th>
                    <th>LamaRawat</th>

                    <th>Tarif</th>
                    <th>TotalTarif</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($KAMAR as $K) :
                ?>
                    <tr>
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

                        $tgl1 = new DateTime($K['datein']);
                        $tgl2 = new DateTime($K['dateout']);
                        $selisih = $tgl2->diff($tgl1)->days + 1;
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

                        <?php if ($selisiha > 0) { ?>
                            <td><?= $K['types'] ?></td>
                            <td><?= $K['datetimein'] ?> - <?= $K['datetimeout']; ?></td>
                            <td style=" text-align: center;"><?php echo $selisiha . " Hari" ?></td>
                            <td><b><?= $K['roomname']  ?></b> |<?= $K['bednumber'] ?></td>

                            <td><?php echo $hari . " Hr" . $jam . " Jm" . $menit . "Mn"; ?></td>

                            <td><?php
                                $ruangan = $K['roomname'];
                                if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                    $tarif = 156815;
                                } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                    $tarif = 256815;
                                } else if (strpos($ruangan, 'BUGENVILE ISOLASI') !== false) {
                                    $tarif = 150000;
                                } else if (strpos($ruangan, 'MAWAR, ISOLASI TB/ A') !== false) {
                                    $tarif = 150000;
                                } else if (strpos($ruangan, 'CEMPAKA ISOLASI') !== false) {
                                    $tarif = 150000;
                                } else {
                                    $tarif = $K['price'];
                                }
                                echo  number_format($tarif, 2, ",", "."); ?></td>
                            <td>
                                <?php
                                $waktu = 6;
                                $waktu2 = 6;
                                $ruangan = $K['roomname'];

                                if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                    $tarif = 156815;
                                } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                    $tarif = 256815;
                                } else if (strpos($ruangan, 'BUGENVILE ISOLASI') !== false) {
                                    $tarif = 150000;
                                } else if (strpos($ruangan, 'MAWAR, ISOLASI TB/ A') !== false) {
                                    $tarif = 150000;
                                } else if (strpos($ruangan, 'CEMPAKA ISOLASI') !== false) {
                                    $tarif = 150000;
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
                            </td>
                    </tr>
                <?php } ?>
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

                    <th></th>
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
                            <?php if ($row['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updatetindakanTNO('<?= $row['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($row['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="bataltindakanTNOkoinsiden('<?= $row['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>

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
                        <td><button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updatetindakan('<?= $GZ['id']; ?>')"> <i class="fas fa-seedling"></i></button></td>
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
                        <td> <?php if ($V['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updatetindakanVisite('<?= $V['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($V['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="bataltindakanVisitekoinsiden('<?= $V['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                        </td>
                        <td><?= $V['groups']; ?></td>
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
                            <?php if ($OP['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updateOPkoinsiden('<?= $OP['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($OP['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="batalOPkoinsiden('<?= $OP['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
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
                            <?php if ($P['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updatePenunjangkoinsiden('<?= $P['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($P['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="batalPenunjangkoinsiden('<?= $P['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
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
                                <?php if ($F['koinsiden'] == 0) { ?>
                                    <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updateFarmasikoinsiden('<?= $F['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                                <?php } ?>
                                <?php if ($F['koinsiden'] == 1) { ?>
                                    <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="batalFarmasikoinsiden('<?= $F['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                                <?php } ?>
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
                            <td></td>
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
                        <td></td>
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
                        <td><?php if ($TIN_IGD['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updateTinIGDkoinsiden('<?= $TIN_IGD['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($TIN_IGD['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="batalTinIGDkoinsiden('<?= $TIN_IGD['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                        </td>
                        <td><b><?= $TIN_IGD['types'] ?></b></td>
                        <td><?= $TIN_IGD['documentdate'] ?></td>
                        <td><?= $TIN_IGD['name']  ?> [<b><?= $TIN_IGD['qty']; ?></b>]</td>
                        <td><?= $TIN_IGD['doktername'] ?></td>
                        <td><?= number_format($TIN_IGD['subtotal'], 2, ",", ".") ?></td>
                        <?php $TotTINIGD[] = $TIN_IGD['subtotal'];  ?>
                    </tr>
                <?php endforeach; ?>
                <?php
                foreach ($PENUNJANGIGD as $PNJIGD) :
                ?>
                    <tr>
                        <td> <?php if ($PNJIGD['koinsiden'] == 0) { ?>
                                <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="updatePenunjangkoinsidenIGD('<?= $PNJIGD['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                            <?php if ($PNJIGD['koinsiden'] == 1) { ?>
                                <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="batalPenunjangkoinsidenIGD('<?= $PNJIGD['id']; ?>')"> <i class="fas fa-seedling"></i></button>
                            <?php } ?>
                        </td>
                        <td><b><?= $PNJIGD['types'] ?></b></td>
                        <td><?= $PNJIGD['documentdate'] ?></td>
                        <td><?= $PNJIGD['name']; ?></td>
                        <td><?= $PNJIGD['employeename'] ?></td>
                        <td><?= number_format($PNJIGD['subtotal'], 2, ",", ".") ?></td>
                        <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                    </tr>
                <?php endforeach; ?>
                <?php
                foreach ($BHPIGD as $behapeIGD) :
                ?>
                    <?php
                    if ($behapeIGD['totalbhp'] > 0) { ?>
                        <tr>
                            <td></td>
                            <td><b><?= $behapeIGD['types'] ?></b></td>
                            <td><?= $behapeIGD['documentdate'] ?></td>
                            <td>Penunjang <?= $behapeIGD['types']; ?></td>
                            <td></td>
                            <td><?= number_format($behapeIGD['totalbhp'], 2, ",", ".") ?></td>
                            <?php $TotBHPIGD[] = $behapeIGD['totalbhp'];  ?>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>


                <?php
                foreach ($FARMASIIGD as $FIGD) :
                ?>
                    <?php
                    if (abs($FIGD['totalharga']) > 0) { ?>
                        <tr>
                            <td>
                                <div class="switch">
                                    <input type="checkbox" class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td>FAR</td>
                            <td><?= $FIGD['documentdate'] ?></td>
                            <td>FAR <?= $FIGD['journalnumber']  ?><small class="text-muted mt-2 d-block"><?= $FIGD['paymentmethodname']; ?></small><small class="text-muted mt-2 d-block"><span class="badge badge-warning"><?php if ($FIGD['koinsiden'] == 1) {
                                                                                                                                                                                                                                echo "Koinsiden";
                                                                                                                                                                                                                            } ?></span></small></td>
                            <td><?= $FIGD['doktername']  ?></td>
                            <td><?php $awal = abs($FIGD['totalharga']);
                                $far = $awal + $FIGD['embalase'];
                                $deniIGD = ceil($far);
                                echo number_format($deniIGD, 2, ",", ".") ?></td>
                            <?php $TotFARIGD[] = $deniIGD;  ?>
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

                            $biayaIGD = $TotalPEMIGD + $TotalTINIGD + $TotalPENUNJANGIGD + $TotalBHPIGD;
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
    <?php if ($klaim == 0) { ?>
        <button id="button" class="btn btn-danger btnverifikasi" type="submit" onclick="KlaimSelesai('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-on"></i></span> Selesai Klaim ?</button>
    <?php } ?>
    <?php if ($klaim == 1) { ?>
        <button id="button" class="btn btn-warning btnbatalverifikasi" type="submit" onclick="KlaimBatal('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-off"></i></span> Batal Klaim </button>
    <?php } ?>
    <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Seluruh</button>
    <button id="print" class="btn btn-danger btnprintdetailkoinsiden" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Koinsiden</button>
    <button id="print" class="btn btn-info btnprintdetailnonkoinsiden" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Non Koinsiden</button>

</div>
<p>
<div class="text-right">
    <button id="print" class="btn btn-success btn-outline btn btnrincianobat" type="button"> <span><i class="fa fa-print"></i></span> Bukti Rincian Obat Rawat Inap</button>
    <button id="print" class="btn btn-danger btn-outline btn btnrincianobatkoinsiden" type="button"> <span><i class="fa fa-print"></i></span> Obat Koinsiden</button>
    <button id="print" class="btn btn-danger btn-outline btn btnrincianobatnonkoinsiden" type="button"> <span><i class="fa fa-print"></i></span> Obat Non Koinsiden</button>
</div>

<div class="viewmodalgabung" style="display:none;"></div>

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
    function KlaimSelesai(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Rincian Pasien Ini Sudah Siap Posting Klaim ?",
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
                    url: "<?php echo base_url('KlaimRanap/KlaimSelesai'); ?>",
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
    function KlaimBatal(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Akan Membatalkan Status Posting Klaim Rincian Ini ?",
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
                    url: "<?php echo base_url('KlaimRanap/KlaimBatal'); ?>",
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
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printdetailkwitansiKlaim') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

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
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRJ/printbuktipembayaran') ?>?page=" + id, "_blank");

        })
    });
</script>



<script>
    function lihatRincianGabung(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KlaimRanap/LihatRincianObatPelayanan'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalobat) {
                    $('.viewmodalkasir').html(response.suksesmodalobat).show();
                    $('#modalrincianobatranap').modal();
                }
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnrincianobat').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printpenjualanKonvesional') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnrincianobatkoinsiden').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printpenjualanKonvesionalKoinsiden') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnrincianobatnonkoinsiden').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printpenjualanKonvesionalNonKoinsiden') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>



<script>
    function updatetindakanTNO(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan/ Pemeriksaan ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateTNOKoinsiden'); ?>",
                    data: {
                        id: id
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
    function bataltindakanTNOkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan/ Pemeriksaan ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateTNOKoinsidenBatal'); ?>",
                    data: {
                        id: id
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
    function updatetindakanVisite(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateVisiteKoinsiden'); ?>",
                    data: {
                        id: id
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
    function bataltindakanVisitekoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateVisiteKoinsidenBatal'); ?>",
                    data: {
                        id: id
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
    function updateOPkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan Operasi ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateOperasiKoinsiden'); ?>",
                    data: {
                        id: id
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
    function batalOPkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan Operasi ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateOperasiKoinsidenBatal'); ?>",
                    data: {
                        id: id
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
    function updatePenunjangkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan Penunjang ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdatePenunjangKoinsiden'); ?>",
                    data: {
                        id: id
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
    function batalPenunjangkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan Penunjang ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdatePenunjangKoinsidenBatal'); ?>",
                    data: {
                        id: id
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
    function updateFarmasikoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Resep ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateFarmasiKoinsiden'); ?>",
                    data: {
                        id: id
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
    function batalFarmasikoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Resep ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateFarmasiKoinsidenBatal'); ?>",
                    data: {
                        id: id
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
    function updateTinIGDkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan/ Pemeriksaan IGD ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateTNOKoinsidenIGD'); ?>",
                    data: {
                        id: id
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
    function batalTinIGDkoinsiden(id) {
        Swal.fire({

            text: "Apakah Yakin Tindakan/ Pemeriksaan IGD ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdateTNOKoinsidenBatalIGD'); ?>",
                    data: {
                        id: id
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
    function updatePenunjangkoinsidenIGD(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan Penunjang ini masuk kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdatePenunjangKoinsiden'); ?>",
                    data: {
                        id: id
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
    function batalPenunjangkoinsidenIGD(id) {
        Swal.fire({

            text: "Apakah Yakin Pemeriksaan Penunjang ini dikeluarkan dari kategori Koinsiden?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRanap/UpdatePenunjangKoinsidenBatal'); ?>",
                    data: {
                        id: id
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