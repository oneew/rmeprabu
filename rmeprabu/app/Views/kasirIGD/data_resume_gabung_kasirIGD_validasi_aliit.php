<font size="3">
    <table id="pemeriksaan" class="table color-table success-table text-dark">
        <thead>
            <!-- <tr>
                <th colspan="6">
                    <hr style="margin-bottom: 2; margin-top: 2">
                </th>
            </tr> -->
            <tr>
                <th style="text-align: left; width: 10%">#</th>
                <th style="text-align: left; width: 10%">Tanggal</th>
                <th style="text-align: left; width: 25%">Keterangan</th>
                <th style="text-align: left; width: 27%">Dokter</th>
                <th style="text-align: right; width: 13%">Harga</th>
                <!-- <th style="text-align: right; width: 5%">Qty</th> -->
                <th style="text-align: right; width: 15%">Total</th>
            </tr>
            <!-- <tr>
                <th colspan="6">
                    <hr style="margin-bottom: 2; margin-top: 2">
                </th>
            </tr> -->
        </thead>

        <tbody>

            <!-- menghitung jumlah pemeriksaan -->
            <?php
            $no = 1;
            foreach ($PEMERIKSAAN as $row) :
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td style="text-align: left;"><?= date('d-m-Y', strtotime($row['documentdate'])) ?></td>
                    <td style="text-align: left;"><?= $row['description'] ?> [<?= number_format(1, 2, ",", ".") ?>]</td>
                    <td style="text-align: left;"><?= $row['doktername'] ?></td>
                    <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                    <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".") ?></td>
                    <?php $TotPemeriksaan[] = $row['price'];  ?>

                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
            $TotalPemeriksaan = $check_TotPem; ?>

            <?php
            $no = 1;
            if ($TotalPemeriksaan > 0) { ?>
                <!-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="3">
                        <hr style="margin-bottom: 2; margin-top: 2">
                    </td>
                </tr> -->

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Pemeriksaan</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalPemeriksaan, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>

            <!-- menghitung tindakan non operatif -->
            <?php
            foreach ($TNO as $rowTNO) :
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($rowTNO['documentdate'])) ?></td>
                    <td>
                        <?= $rowTNO['name'] ?>[<?= $rowTNO['qty'] ?>]
                    </td>
                    <td><?= $rowTNO['doktername'] ?></td>
                    <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                    <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotTNO[] = $rowTNO['subtotal'];  ?>

                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
            $TotalTNO = $check_TotTNO;
            ?>

            <?php
            $no = 1;
            if ($TotalTNO > 0) { ?>
                <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Tindakan Non Operatig</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalTNO, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>

            <!-- menghitung penunjang -->
            <?php
            foreach ($PENUNJANG as $P) :


            ?>
                <tr>
                    <?php if ($P['groups'] == "RAD") {
                        $deskripsi = 'Radiologi';
                    }
                    if ($P['groups'] == "LPK") {
                        $deskripsi = 'Lab Patologi Klinik';
                    }
                    if ($P['groups'] == "LPA") {
                        $deskripsi = 'Lab Patologi Anatomi';
                    }
                    if ($P['groups'] == "BD") {
                        $deskripsi = 'Bank Darah';
                    }
                    ?>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($P['documentdate'])) ?></td>
                    <td><?= $P['types'] ?> | <?= $P['name']; ?> [<?= number_format($P['qty'], 2, ",", ".") ?>]</td>
                    <td><?= $P['doktername'] ?></td>
                    <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                    <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
            $TotalPenunjang = $check_TotPenunjang;
            ?>

            <?php
            $no = 1;
            if ($TotalPenunjang > 0) { ?>
                <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalPenunjang, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>

            <!-- Menghitung Farmasi -->
            <?php
            foreach ($FARMASI as $F) :
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($F['documentdate'])) ?></td>
                    <td><?= $F['name'] ?> [<?= number_format(abs($F['qty']), 2, ",", ".") ?>]</td>
                    <td><?= $F['doktername']  ?></td>
                    <td style="text-align: right;"><?= number_format(abs($F['price']), 2, ",", ".") ?></td>
                    <td style="text-align: right;"><?php $awal = abs($F['subtotal']);
                                                    $far = $awal + $F['embalase'];
                                                    $deni = ceil($far);
                                                    echo number_format($deni, 2, ",", ".") ?></td>
                    <?php $TotFAR[] = $deni;  ?>
                </tr>
            <?php endforeach; ?>

            <?php
            $check_TotFar = isset($TotFAR) ? array_sum($TotFAR) : 0;
            $TotalFarmasi = $check_TotFar;
            ?>
            <?php
            $no = 1;
            if ($TotalFarmasi > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Farmasi</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalFarmasi, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>

            <!-- menghitung BHP -->
            <?php
            foreach ($BHP as $behape) :
            ?>
                <?php
                if ($behape['totalbhp'] > 0) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $behape['documentdate'] ?></td>
                        <td>BHP <?= $behape['types'] ?> | <?= $behape['name'] ?> [<?= number_format($behape['qty'], 2, ",", ".") ?>]</td>
                        <td><?= $behape['doktername'] ?></td>
                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                        <td><?= number_format(($behape['totalbhp'] * $behape['qty']), 2, ",", ".")  ?></td>
                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>

            <?php
            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
            $TotalBHP = $check_TotBHP;
            ?>
            <?php
            $no = 1;
            if ($TotalBHP > 0) { ?>
                <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalBHP, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>

            <!-- menghitung operasi -->
            <?php
            foreach ($OPERASI as $OP) :
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($OP['documentdate'])) ?></td>
                    <td><?= $OP['name'] ?> [<?= number_format($OP['qty'], 2, ",", "."); ?></td>
                    <td><?= $OP['doktername'] ?></td>
                    <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".")  ?></td>
                    <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>

            <?php
            $check_TotOperasi = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
            $TotalOperasi = $check_TotOperasi;
            ?>
            <?php
            $no = 1;
            if ($TotalOperasi > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="2"><b>Sub Total Operasi</b></td>
                    <td style="text-align: right;">
                        <b>
                            <?= number_format($TotalOperasi, 2, ",", "."); ?>
                        </b>
                    </td>
                </tr>

            <?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3">
                    <br style="margin-bottom: 2; margin-top: 10">
                </td>
            </tr>
            <?php
                    $totalbiaya = abs($TotalPemeriksaan) + abs($TotalTNO) +
                        abs($TotalPenunjang) + abs($TotalFarmasi) + abs($TotalBHP) + abs($TotalOperasi);
                    $totalbayarawal = $TotalKasirApotek_RJ + $TotalKasirPnj_RJ  + $TotalKasir_Tindakan;
                    ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="text-align: right;"><b>TOTAL BIAYA</b></td>
                <td style="text-align: right;">
                    <b><?= number_format($subtotal+$totalbayarawal, 2, ",", ".") ?></b>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            
                <td colspan="2" style="text-align: right;">DEPOSIT</td>
                <td style="text-align: right;">
                    <?= number_format($totalbayarawal, 2, ",", ".") ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="text-align: right;"><b>TOTAL TAGIHAN BIAYA</b></td>
                <td style="text-align: right;">
                    <b><?= number_format($grandtotal, 2, ",", ".") ?></b>
                </td>
            </tr>

        </tfoot>
    </table>
</font>
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
                        <option data-id="<?= $mb['id']; ?>" data-name="<?= $mb['metodepembayaran']; ?>" class="select-metodepembayaran" <?php if ($mb['metodepembayaran'] == $metodepembayaran) { ?> selected="selected" <?php } ?>><?php echo $mb['metodepembayaran']; ?></option>
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
                        <option data-id="<?= $bank['id']; ?>" data-room="<?= $bank['namabank']; ?>" class="select-daftarbank" <?php if ($bank['namabank'] == $referensibank) { ?> selected="selected" <?php } ?>><?php echo $bank['namabank']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <input type="text" id="paymentamount" name="paymentamount" class="form-control" value="<?= $paymentamount; ?>" disabled>
                <input type="hidden" id="grandtotal" name="grandtotal" class="form-control" value="<?= $grandtotal; ?>">
                <input type="hidden" id="paymentamount_awal" name="paymentamount_awal" class="form-control" value="<?= $paymentamount; ?>">
                <input type="hidden" id="daftarbank_awal" name="daftarbank_awal" class="form-control" value="<?= $referensibank; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Disc %</label>
                <input type="text" id="disc" name="disc" class="form-control" value="<?= $disc; ?>" disabled>

            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>No.Referensi Bank</label>
                <input type="text" id="referensibank" name="referensibank" class="form-control" value="<?= $noreferensidebet; ?>">

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Nominal Debit</label>
                <input type="text" id="nominaldebet" name="nominaldebet" class="form-control" value="<?= $nominaldebet; ?>">
                <input type="hidden" id="nominaldebet_awal" name="nominaldebet_awal" class="form-control" value="<?= $nominaldebet; ?>">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" id="payersname" name="payersname" value="<?= $payersname; ?>" class="form-control form-rupiah" onkeyup="this.value = this.value.toUpperCase()">
                <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>">
                <input type="hidden" id="idbayar" name="idbayar" class="form-control" value="<?= $idbayar; ?>">
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

                <!-- narik data dari tabel kasir rajal -->
                <input type="hidden" id="totaldaftar" name="totaldaftar" class="form-control" value="<?= $TotalPemeriksaan; ?>">
                <input type="hidden" id="totaltindakan" name="totaltindakan" class="form-control" value="<?= $TotalTNO; ?>">
                <input type="hidden" id="totalbhp" name="totalbhp" class="form-control" value="<?= $TotalBHP; ?>">
                <input type="hidden" id="totalitembhp" name="totalitembhp" class="form-control">
                <input type="hidden" id="totalfarmasi" name="totalfarmasi" class="form-control" value="<?= $TotalFarmasi; ?>">
                <input type="hidden" id="totalpenunjang" name="totalpenunjang" class="form-control" value="<?= $TotalPenunjang; ?>">
                <input type="hidden" id="kasirpenunjang" name="kasirpenunjang" class="form-control">
                <input type="hidden" id="subtotal" name="subtotal" class="form-control" value="<?= $subtotal ?>">

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
                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>

            </div>
        </div>

    </div>

</div>
</div>
<div class="text-right">
    <button id="button" class="btn btn-danger btnvalidasi" type="submit"><i class="fas fa-credit-card"></i></span> Update Validasi Pembayaran </button>
    <button id="print" class="btn btn-default btn-outline" type="button" onclick="cetakkwitansi('<?= $idbayar ?>')"> <span><i class="fa fa-print"></i> Print</span> </button>
    <button class="btn btn-warning btn-outline" type="button" onclick="email('<?= $idbayar ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>
    <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail</button>
    <button id="print" class="btn btn-info btnprintBP" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print BP</button>
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

<script>
    var rupiah2 = document.getElementById('nominaldebet');
    rupiah2.addEventListener('keyup', function(e) {
        rupiah2.value = formatRupiah(this.value);

    });

    /* Fungsi formatRupiah */
    function formatRupiah2(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah2 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah2;
        return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
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
                                //$('#modaleditranap').modal('hide');
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
    function cetakkwitansi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirIGD/cetakkwitansi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintkwitansiigd').modal('show');

                }
            }

        });


    }
</script>

<script>
    function email(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/emailkwitansi'); ?>",
            data: {
                id: id
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