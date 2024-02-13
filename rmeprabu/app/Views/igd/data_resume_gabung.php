<div class="table-responsive">
    <table id="pemeriksaan" class="table color-table success-table">
        <thead>
            <tr>
                <th>No Jurnal</th>
                <th>Poliklinik</th>
                <th>Dokter</th>
                <th>Tarif Pemeriksaan</th>
                <th>Total Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($PEMERIKSAAN as $pem) :
            ?>
                <tr>
                    <td><?= $pem['journalnumber'] ?></td>
                    <td><?= $pem['poliklinikname'] ?></td>
                    <td><?= $pem['doktername'] ?></td>
                    <td><?php echo number_format($pem['price'], 2, ",", "."); ?></td>
                    <td><?php echo number_format($pem['price'], 2, ",", "."); ?></td>
                    <?php $TotPem[] = $pem['price'];  ?>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">Biaya Administrasi:</h6>
                </td>
                <td><b><?php
                        $check_TotPem = isset($TotPem) ? array_sum($TotPem) : 0;
                        $TotalPem = $check_TotPem;
                        echo number_format($TotalPem, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="dataGabung" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nomor Jurnal</th>
                <th>Pelayanan</th>
                <th>Jml</th>
                <th>Dokter</th>
                <th>Tarif</th>

            </tr>
        </thead>
        <tbody>


            <?php
            foreach ($TNO as $row) :
            ?>
                <tr>
                    <td> <?php if (($row['name'] == "Visum Et Repertum Hidup") or ($row['name'] == "Visum Perkosaan") or ($row['name'] == "Visum Repertum Psikiatrikum")) { ?>
                            <button class="btn btn-outline-danger" type="button" onclick="expertiseVisum('<?= $row['referencenumber'] ?>')"><span class="mr-1"></span>Exp</button>
                        <?php } ?>
                    </td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= round($row['qty'])  ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotTNO[] = $row['subtotal'];  ?>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">Total Tindakan :</h6>
                </td>
                <td><b><?php
                        $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                        $TotalTNO = $check_TotTNO;
                        echo number_format($TotalTNO, 2, ",", "."); ?></b>
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
            <?php
            $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
            $TotalOPERASI = $check_TotOPERASI;
            if ($TotalOPERASI > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">Total Operasi :</h6>
                    </td>
                    <td><b><?php
                            echo number_format($TotalOPERASI, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($PENUNJANG as $P) :
            ?>
                <tr>
                    <td><?= $P['types'] ?></td>
                    <td><?= $P['documentdate'] ?></td>
                    <td><?= $P['journalnumber'] ?></td>
                    <td><?= $P['name']  ?></td>
                    <td><?= round($P['qty'])  ?></td>
                    <td><?= $P['employeename'] ?></td>
                    <td><?php $totPnj = $P['price'] * $P['qty'];
                        echo number_format($totPnj, 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $totPnj;  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
            $TotalPENUNJANG = $check_TotPENUNJANG;
            if ($TotalPENUNJANG > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">Total Penunjang :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalPENUNJANG, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <hr>
            <?php
            foreach ($FARMASI as $F) :
            ?>
                <tr>
                    <td>FAR</td>
                    <td><?= $F['documentdate'] ?></td>
                    <td><?= $F['journalnumber'] ?></td>
                    <td>-</td>
                    <td>1</td>
                    <td><?= $F['doktername']  ?></td>
                    <td><?php $awal = abs($F['price']);
                        $far = $awal + $F['embalase'];
                        $deni = ceil($far);
                        echo number_format($deni, 2, ",", ".") ?></td>
                    <?php $TotFAR[] = $deni;  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
            $TotalFAR = $check_TotFAR;
            if ($TotalFAR > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">Total Farmasi :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalFAR, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($BHP as $behape) :
            ?>
                <?php
                if ($behape['totalbhp'] > 0) { ?>
                    <tr>
                        <td><?= $behape['types'] ?></td>
                        <td><?= $behape['documentdate'] ?></td>
                        <td><?= $behape['journalnumber'] ?></td>
                        <td>BHP Penunjang : <?= $behape['types']  ?></td>
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
                        <h6 class="card-title">Total BHP :</h6>
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
                    <h6 class="card-title"><b>Total Biaya IGD :</b></h6>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title"><b>Total Biaya Seluruh :</b></h6>
                </td>
                <td><b><?php

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI  +  $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function expertiseVisum(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananIGD/expertiseVisum'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertisevisumhidup').modal('show');

                }
            }

        });
    }
</script>