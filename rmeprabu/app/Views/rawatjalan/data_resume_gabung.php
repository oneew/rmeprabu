<div class="table-responsive">
    <table id="pemeriksaan" class="table color-table success-table">
        <thead>
            <tr>
                <th>JournalNumber</th>
                <th>Poliklinik</th>
                <th>Dokter</th>
                <th>Tarif Pemeriksaan</th>
                <th>TotalTarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($PEMERIKSAAN as $pem) :
            ?>
                <tr>
                    <td><?= $pem['journalnumber'] ?>
                        <br><span class="<?php if (($pem['paymentmethodname'] == 'TUNAI') and ($pem['validasipembayaran'] == 0)) {
                                                echo "badge badge-danger";
                                                $statusbayar = "Belum Validasi karcis";
                                            } else {
                                                echo "badge badge-success";
                                                $statusbayar = "Sudah Validasi Karcis";
                                            }  ?>"><?= $statusbayar; ?></span>

                    </td>
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
                    <h6 class="card-title">Biaya Periksa:</h6>
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
                <th>JournalNumber</th>
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
                    <td>
                        <?php if ($row['validasipembayaran'] == 1) { ?>
                            <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprinttindakan" type="button" data-id="<?= $row['id']; ?>"> <span><i class="fas fa-print"></i></span></button>
                        <?php } ?>
                        <?php if ($row['validasipembayaran'] <> 1) { ?>
                            <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" type="button" data-id="<?= $row['id']; ?>"> <span><i class="fas fa-crosshairs"></i></span></button>
                        <?php } ?>
                    </td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?>
                        <br><span class="<?php if (($row['paymentmethodname'] == 'TUNAI') and ($row['validasipembayaran'] == 0)) {
                                                echo "badge badge-danger";
                                                $statusbayartindakan = "Belum Bayar Tindakan";
                                            } else {
                                                echo "badge badge-success";
                                                $statusbayartindakan = "Sudah Bayar Tindakan";
                                            }  ?>"><?= $statusbayartindakan; ?></span>
                    </td>
                    <td>[<?php $code = explode("_", $row['code']);
                            $kode = $code[1];
                            echo $kode; ?>] <?= $row['name']  ?></td>
                    <td><?= $row['qty'] ?></td>
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
                    <h6 class="card-title">TotalBiaya Tindakan :</h6>
                </td>
                <td><b><?php
                        $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                        $TotalTNO = $check_TotTNO;
                        echo number_format($TotalTNO, 2, ",", "."); ?></b>
                </td>

            </tr>
            <?php
            $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
            $TotalGIZI = $check_TotGIZI;
            if ($TotalGIZI > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Gizi :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalGIZI, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
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
                        <h6 class="card-title">TotalBiaya Operasi :</h6>
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
                    <td><?= $P['qty']  ?></td>
                    <td><?= $P['employeename'] ?></td>
                    <td><?= number_format($P['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $P['totaltarif'];  ?>
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
                        <h6 class="card-title">TotalBiaya Penunjang :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalPENUNJANG, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
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
            <?php
            $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
            $TotalFAR = $check_TotFAR;
            if ($TotalFAR > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Farmasi :</h6>
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
                    <h6 class="card-title"><b>TotalBiaya Rawat Jalan :</b></h6>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>

            <hr>


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

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI +  $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinttindakan').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('KasirRJ/printkarcisTindakan') ?>?page=" + id, "_blank");
        })
    });
</script>