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
                    <h6 class="card-title">TotalBiaya Pemeriksaan:</h6>
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
                <th>Type</th>
                <th>Tanggal</th>
                <th>Nomor Jurnal</th>
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
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotTNO[] = $row['subtotal'];  ?>

                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
            $TotalTNO = $check_TotTNO;
            if ($TotalTNO > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Tindakan :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalTNO, 2, ",", "."); ?></b>
                    </td>

                </tr>
            <?php } ?>
            <?php
            foreach ($GIZI as $GZ) :
            ?>
                <tr>
                    <td><?= $GZ['types'] ?></td>
                    <td><?= $GZ['documentdate'] ?></td>
                    <td><?= $GZ['journalnumber'] ?></td>
                    <td><?= $GZ['name']  ?></td>
                    <td><?= $GZ['doktername'] ?></td>
                    <td><?= number_format($GZ['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotGIZI[] = $GZ['subtotal'];  ?>
                </tr>

            <?php endforeach; ?>
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
                    <td><?= $F['name']  ?></td>
                    <td><?= $F['doktername']  ?></td>
                    <td><?php $awal = abs($F['subtotal']);
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
                <td>
                    <h6 class="card-title">TotalBiaya IGD :</h6>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">DEPOSIT :</h6>
                </td>
                <?php
                    $totalbiaya = abs($TotalPemeriksaan) + abs($TotalTNO) +
                        abs($TotalPenunjang) + abs($TotalFarmasi) + abs($TotalBHP) + abs($TotalOperasi);
                    $totalbayarawal = $TotalKasirApotek_RJ + $TotalKasirPnj_RJ + $TotalKasir_RJ + $TotalKasir_Tindakan;
                    ?>
                <td><b><?php

                       
                        echo number_format($totalbayarawal, 2, ",", "."); ?></b>
                </td>
            </tr>

            

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">TotalBiaya Seluruh :</h6>
                </td>
                <td><b><?php

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI +  $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>


</div>
<hr>

<div class="col-md-12">
    <div class="table-responsive mt-4" style="clear: both;">
        <table class="table table-hover no-wrap">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Deskripsi</th>

                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Pemeriksaan</td>

                    <td class="text-right"> <?php
                                            $check_TotPem = isset($TotPem) ? array_sum($TotPem) : 0;
                                            $TotalPem = $check_TotPem;
                                            echo number_format($TotalPem, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Total Tindakan</td>

                    <td class="text-right"> <?php
                                            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                                            $TotalTNO = $check_TotTNO;
                                            echo number_format($TotalTNO, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Total Penunjang</td>

                    <td class="text-right"> <?php
                                            $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                                            $TotalPENUNJANG = $check_TotPENUNJANG;
                                            echo number_format($TotalPENUNJANG, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Total Farmasi</td>

                    <td class="text-right"> <?php
                                            $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                                            $TotalFAR = $check_TotFAR;
                                            echo number_format($TotalFAR, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>Total BHP</td>

                    <td class="text-right"> <?php
                                            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                                            $TotalBHP = $check_TotBHP;
                                            echo number_format($TotalBHP, 2, ",", "."); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="pull-right mt-4 text-right">
        <b>Total Biaya/Tagihan</b>: <?php

                                    $TOTAL = ($TotalPENUNJANG + $TotalOPERASI + $TotalGIZI +  $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem)-$totalbayarawal;
                                    echo number_format($TOTAL, 2, ",", "."); ?>
    </div>
</div>

<div class="pull-right text-right">
    <div class="col-md-2">

    </div>
</div>
<div class="clearfix"></div>
<hr>



<div class="form-body">
    <div class="row">
        <div class="col-md-6">
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

        <div class="col-md-6">
            <div class="form-group">
                <label>Cara Pulang</label>
                <select name="statuspasien" id="statuspasien" class="select2" style="width: 100%;">
                    <?php foreach ($pasienstatus as $pjb) : ?>
                        <option value="<?php echo $pjb['name']; ?>" <?php if ($pjb['name'] == $advicedokter) { ?> selected="selected" <?php } ?>><?php echo $pjb['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="metodepembayaran" id="metodepembayaran" class="select2" style="width: 100%;">
                    <?php foreach ($metodebayar as $mb) : ?>
                        <option data-id="<?= $mb['id']; ?>" data-name="<?= $mb['metodepembayaran']; ?>" class="select-metodepembayaran"><?= $mb['metodepembayaran']; ?></option>
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
                        <option data-id="<?= $bank['id']; ?>" data-room="<?= $bank['namabank']; ?>" class="select-daftarbank"><?= $bank['namabank']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <?php if ($paymentmethod <> "TUNAI") {
                    $uang = 0;
                } else {
                    $uang = 0;
                } ?>
                <input type="text" id="paymentamount" name="paymentamount" class="form-control" value="<?= $uang; ?>">
                <input type="hidden" id="grandtotal" name="grandtotal" class="form-control" value="<?= $TOTAL; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Disc %</label>
                <input type="text" id="disc" name="disc" class="form-control" value="0">

            </div>
        </div>
    </div>
    <div class="row">

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
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" id="payersname" name="payersname" class="form-control form-rupiah" onkeyup="this.value = this.value.toUpperCase()">
                <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>">
                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control">
                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= $documentdate; ?>">
                <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= $documentyear; ?>">
                <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= $documentmonth; ?>">
                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>">
                <input type="hidden" id="registernumber" name="registernumber" value="NONE" class="form-control">
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
                <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>">
                <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>">
                <input type="hidden" id="code" name="code" class="form-control" value="<?= $code; ?>">
                <input type="hidden" id="description" name="description" class="form-control" value="<?= $description; ?>">
                <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>">
                <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>">
                <input type="hidden" id="employee" name="employee" value="NONE" class="form-control">
                <input type="hidden" id="employeename" name="employeename" class="form-control">
                <input type="hidden" id="classroom" name="classroom" class="form-control">
                <input type="hidden" id="classroomname" name="classroomname" class="form-control">
                <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>">
                <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>">
                <input type="hidden" id="totaldaftar" name="totaldaftar" class="form-control" value="<?= $TotalPem; ?>">
                <input type="hidden" id="totaltindakan" name="totaltindakan" class="form-control" value="<?= $TotalTNO; ?>">
                <input type="hidden" id="totalbhp" name="totalbhp" class="form-control" value="<?= $TotalBHP; ?>">
                <input type="hidden" id="totalitembhp" name="totalitembhp" class="form-control">
                <input type="hidden" id="totalfarmasi" name="totalfarmasi" class="form-control" value="<?= $TotalFAR; ?>">
                <input type="hidden" id="totalpenunjang" name="totalpenunjang" class="form-control" value="<?= $TotalPENUNJANG; ?>">
                <input type="hidden" id="kasirpenunjang" name="kasirpenunjang" class="form-control">
                <input type="hidden" id="subtotal" name="subtotal" class="form-control">

                <input type="hidden" id="totaldiscount" name="totaldiscount" class="form-control">


                <input type="hidden" id="memo" name="memo" value="BIAYA PERAWATAN DAN PELAYANAN RAWAT JALAN" class="form-control">
                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $locationcode; ?>">
                <input type="hidden" id="locationname" name="locationname" class="form-control" value="<?= $locationname; ?>">

                <input type="hidden" id="penunjang" name="penunjang" value="0" class="form-control">
                <input type="hidden" id="cancel" name="cancel" class="form-control">
                <input type="hidden" id="cancelreason" name="cancelreason" class="form-control">
                <input type="hidden" id="cancelmemo" name="cancelmemo" class="form-control">
                <input type="hidden" id="cancelby" name="cancelby" class="form-control">
                <input type="hidden" id="numberseq" name="numberseq" class="form-control">
                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>

            </div>
        </div>

    </div>

</div>
</div>
<div class="text-right">
    <?php if ($validation == "BELUM") { ?>
        <button id="button" class="btn btn-danger btnvalidasi" type="submit"><i class="fas fa-credit-card"></i></span> Validasi Pembayaran </button>
    <?php } ?>
    <?php if ($validation == "SUDAH") { ?>
        <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="signature('<?= $journalnumber ?>')"><span><i class="fas fa-quidditch"></i></span> Signature</button>
        <button id="print" class="btn btn-default btn-outline" type="button" onclick="cetakkwitansikasir('<?= $journalnumber ?>')"> <span><i class="fa fa-print"></i> Print</span> </button>
        <button class="btn btn-warning btn-outline" type="button" onclick="emailkwitansi('<?= $journalnumber ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>

        <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail</button>
        <button id="print" class="btn btn-info btnprintBP" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print BP</button>
    <?php } ?>


</div>


</div>



<script>
    var rupiah = document.getElementById('paymentamount');
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


<script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                dataresume();

                                //dataperawat();

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
    function signature(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/SignatureKasir'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsignature').modal('show');

                }
            }

        });


    }
</script>

<script>
    function cetakkwitansikasir(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirIGD/cetakkwitansikasir'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintkwitansi').modal('show');

                }
            }

        });


    }
</script>

<script>
    function emailkwitansi(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirIGD/emailkwitansikasir'); ?>",
            data: {
                journalnumber: journalnumber
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
            window.open("<?php echo base_url('KasirIGD/printdetailkwitansi') ?>?page=" + id, "_blank");

        })
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirIGD/printbuktipembayaran') ?>?page=" + id, "_blank");

        })
    });
</script>