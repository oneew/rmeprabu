<div class="table-responsive">
    <table id="datakamar" class="table color-table white-table">
        <thead>
            <tr>
                <th></th>
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
                    <td></td>
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
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">TotalBiaya Kamar :</h6>
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
                    <?php $TotBhpTNO[] = $row['totalbhp'];  ?>

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

                            echo number_format($TotalTNO, 2, ",", ".");
                            $check_TotBhpTNO = isset($TotBhpTNO) ? array_sum($TotBhpTNO) : 0;
                            $TotalBhpTNO = $check_TotBhpTNO;
                            ?></b>
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
                    <td><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotGIZI[] = $GZ['totaltarif'];  ?>
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
            <?php
            $check_TotVISITE = isset($TotVISITE) ? array_sum($TotVISITE) : 0;
            $TotalVISITE = $check_TotVISITE;
            if ($TotalVISITE > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Visite & Asuhan :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalVISITE, 2, ",", "."); ?></b>
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
                <td>
                    <h6 class="card-title"><b>TotalBiaya Rawat Inap :</b></h6>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR + $TotalBHP;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right"></td>
                <td>
                    <?php
                    foreach ($TagihanAsal as $tagihan_asal) :
                        $totaldaftarklinik = $tagihan_asal['totaldaftar'];
                        $totaltindakanklinik = $tagihan_asal['totaltindakan'];
                        $totalbhptindakanklinik = $tagihan_asal['totalbhp'];
                        $totalfarmasiklinik = $tagihan_asal['totalfarmasi'];
                        $totalpenunjangklinik = $tagihan_asal['totalpenunjang'];
                        $totalkasirklinik = $tagihan_asal['grandtotal']
                    ?>
                        <h6 class="card-title"><b>TotalBiaya <?= $tagihan_asal['groups']; ?> :</b></h6>

                    <?php endforeach; ?>
                </td>
                <td><b><?php
                        echo number_format($tagihan_asal['grandtotal'], 2, ",", "."); ?></b>
                    <br>-<span class="badge badge-danger"><?php echo number_format($tagihan_asal['paymentamount'], 2, ",", "."); ?></span>
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

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalVISITE + $TotalTNO + $TotalBK + $TotalFAR +  $TotalBHP + ($tagihan_asal['grandtotal'] - $tagihan_asal['paymentamount']);
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="pull-right text-right">
    <div class="col-md-2">

    </div>
</div>
<div class="clearfix"></div>
<hr>

<div class="form-body">
    <div class="row">
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
                <label>Jenis Transaksi</label>
                <select name="paymentstatusname" id="paymentstatusname" class="select2" style="width: 100%">
                    <?php foreach ($jpkasir as $jpk) : ?>
                        <option data-id="<?= $jpk['id']; ?>" class="select-jpk"><?= $jpk['keteranganpembayaran']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" id="paymentstatus" name="paymentstatus" class="form-control" value="UANG MUKA" readonly>

                <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" readonly>
                <input type="hidden" id="types" name="types" class="form-control" value="UM">
                <div class="form-control-feedback errortypes">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>catatan</label>
                <input type="text" id="memo" name="memo" class="form-control" required autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
                <input type="hidden" id="inacbg" name="inacbg" class="form-control" autocomplete="off">
                <input type="hidden" id="inacbgsclass" name="inacbgsclass" class="form-control">
                <input type="hidden" id="inacbgs" name="inacbgs" class="form-control">
                <input type="hidden" id="inacbgsname" name="inacbgsname" class="form-control">
                <input type="hidden" id="tarifkelas3" name="tarifkelas3" class="form-control" readonly>
                <input type="hidden" id="tarifkelas2" name="tarifkelas2" class="form-control" readonly>
                <input type="hidden" id="tarifkelas1" name="tarifkelas1" class="form-control" readonly>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="metodepembayaran" id="metodepembayaran" class="select2" style="width: 100%;">
                    <?php foreach ($metodebayar as $mb) : ?>
                        <option data-id="<?= $mb['id']; ?>" data-name="<?= $mb['metodepembayaran']; ?>" class="select-metodepembayaran"><?= $mb['metodepembayaran']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <input type="text" id="paymentamount" name="paymentamount" class="form-control">
                <input type="hidden" id="grandtotal" name="grandtotal" class="form-control" value="<?= $TOTAL; ?>">
                <input type="hidden" id="disc" name="disc" class="form-control" value="0">
                <div class="form-control-feedback errorpaymentamount">
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label>No.Referensi Bank</label>
                <input type="text" id="referensibank" name="referensibank" class="form-control" disabled>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nominal Debit</label>
                <input type="text" id="nominaldebet" name="nominaldebet" class="form-control" value="0" disabled>

            </div>
        </div>
        <div class="col-md-4">
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
                <input type="hidden" id="paymentchange" name="paymentchange" class="form-control" value="0">
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

                <input type="hidden" id="totaldaftarklinik" name="totaldaftarklinik" class="form-control">
                <input type="hidden" id="totaltindakanklinik" name="totaltindakanklinik" class="form-control">
                <input type="hidden" id="totalbhptindakanklinik" name="totalbhptindakanklinik" class="form-control">
                <input type="hidden" id="totalfarmasiklinik" name="totalfarmasiklinik" class="form-control">
                <input type="hidden" id="totalpenunjangklinik" name="totalpenunjangklinik" class="form-control">
                <input type="hidden" id="totalbhppenunjangklinik" name="totalbhppenunjangklinik" class="form-control">
                <input type="hidden" id="totalkasirklinik" name="totalkasirklinik" class="form-control">

                <input type="hidden" id="totalkamar" name="totalkamar" class="form-control">
                <input type="hidden" id="totalvisite" name="totalvisite" class="form-control">
                <input type="hidden" id="totaltindakanruang" name="totaltindakanruang" class="form-control">
                <input type="hidden" id="totalmakan" name="totalmakan" class="form-control">
                <input type="hidden" id="totalbhptindakanruang" name="totalbhptindakanruang" class="form-control">
                <input type="hidden" id="totaltindakanoperasi" name="totaltindakanoperasi" class="form-control">
                <input type="hidden" id="totalbhptindakanoperasi" name="totalbhptindakanoperasi" class="form-control">
                <input type="hidden" id="totalfarmasi" name="totalfarmasi" class="form-control">
                <input type="hidden" id="totalpenunjang" name="totalpenunjang" class="form-control">
                <input type="hidden" id="totalbhppenunjang" name="totalbhppenunjang" class="form-control">
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

            </div>
        </div>

    </div>
    <div class="text-right">
        <div id="form-filter-atas">
            <button id="button" class="btn btn-danger btnvalidasi" type="submit"> <span class="mr-1"><i class="fas fa-archive"></i></span>Validasi Uang Muka </button>
        </div>
        <br>
        <div id="form-filter-bawah" style="display: none;">
            <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="signaturekasirranap('<?= $referencenumber ?>')"><span><i class="fas fa-quidditch"></i></span> Signature</button>
            <button class="btn btn-warning btn-outline" type="button" onclick="emailkwitansikasirranap_uangmuka('<?= $referencenumber ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>
            <button id="print" class="btn btn-info btnprintBPuangmuka" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print BP</button>
        </div>
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


<script src="<? =base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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


                //$('#alasanaps').empty();

                if (data[0] == null) {
                    $('#inacbg').attr('disabled', 'disabled');
                    $('#tarifkelas1').val('');
                    $('#tarifkelas2').val('');
                    $('#tarifkelas3').val('');
                    $('#inacbg').val('');


                } else {
                    $('#inacbg').removeAttr('disabled');
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
                       
                        if (response.error.paymentamount) {
                            $('#paymentamount').addClass('form-control-danger');
                            $('.errorpaymentamount').html(response.error.paymentamount);
                        } else {
                            $('#paymentamount').removeClass('form-control-danger');
                            $('.errorpaymentamount').html('');
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
                                //dataresume();
                                $('#paymentamount').val(response.jumlahbayar);
                                $('#payersname').val(response.pembayar);
                                $('#form-filter-bawah').css('display', 'block');
                                $('#form-filter-atas').css('display', 'none');
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
    function emailkwitansikasirranap_uangmuka(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/emailkwitansikasir_uangmuka'); ?>",
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
        $('.btnprintBPuangmuka').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRanap/printbuktipembayaran_uangmuka') ?>?page=" + id, "_blank");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#inacbg").autocomplete({
            source: "<?php echo base_url('KasirRanap/ajax_inacbg'); ?>",
            select: function(event, ui) {
                $('#inacbg').val(ui.item.value);
                $('#inacbgs').val(ui.item.inacbg);
                $('#inacbgsname').val(ui.item.deskripsi);
                $('#tarifkelas1').val(ui.item.kls1);
                $('#tarifkelas2').val(ui.item.kls2);
                $('#tarifkelas3').val(ui.item.kls3);
            }
        });
    });
</script>