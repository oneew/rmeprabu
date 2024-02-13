<!-- Primary Header Modal -->
<div id="EmailKwitansi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-center text-center">
                                        <address>
                                            <h3> &nbsp;<b class="text-info"><?= $header1; ?></b></h3>
                                            <p class="text-muted ml-1"><?= $header2; ?>
                                                <br /> <?= $status; ?>
                                                <br /> <?= $alamat; ?>
                                                <br />
                                            <h5> <?= $deskripsi; ?></h5>
                                            </p>
                                        </address>
                                    </div>
                                    <hr>
                                    <div class="pull-text text-left">
                                        <table class="table full-color-table full-info-table hover-table">
                                            <tbody>
                                                <tr>
                                                    <td> No Kwitansi </td>
                                                    <td>:</td>
                                                    <td><?= $journalnumber; ?></td>
                                                    <td>Tanggal</td>
                                                    <td>:</td>
                                                    <td><?php echo date('d M Y') ?></td>
                                                </tr>
                                                <tr>
                                                    <td> Nomor Rekam Medis </td>
                                                    <td>:</td>
                                                    <td><?= $pasienid; ?></td>
                                                    <td>Nama Pasien</td>
                                                    <td>:</td>
                                                    <td><?= $pasienname; ?></td>
                                                </tr>
                                                <tr>
                                                    <td> Cara Bayar </td>
                                                    <td>:</td>
                                                    <td><?= $paymentmethodname; ?></td>
                                                    <td>Poliklinik</td>
                                                    <td>:</td>
                                                    <td><?= $poliklinikname; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive mt-1" style="clear: both;">
                                        <table class="table table-hover no-wrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Uraian</th>
                                                    <th class="text-right">Tarif</th>
                                                    <th class="text-right">Disc</th>
                                                    <th class="text-right">Total Tarif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Pemeriksaan</td>
                                                    <td class="text-right"><?= number_format($pemeriksaan, 2, ",", ".") ?></td>
                                                    <td class="text-right"> 0</td>
                                                    <td class="text-right"> <?= number_format($pemeriksaan, 2, ",", ".") ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>Tindakan</td>
                                                    <td class="text-right"> <?= number_format($tindakan, 2, ",", ".") ?></td>
                                                    <td class="text-right"> 0 </td>
                                                    <td class="text-right"> <?= number_format($tindakan, 2, ",", ".") ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>Penunjang</td>
                                                    <td class="text-right"> <?= number_format($penunjang, 2, ",", ".") ?> </td>
                                                    <td class="text-right"> 0 </td>
                                                    <td class="text-right"> <?= number_format($penunjang, 2, ",", ".") ?> </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td>BHP</td>
                                                    <td class="text-right"> <?= number_format($bhp, 2, ",", ".") ?> </td>
                                                    <td class="text-right">0 </td>
                                                    <td class="text-right"> <?= number_format($bhp, 2, ",", ".") ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>Farmasi</td>
                                                    <td class="text-right"> <?= number_format($farmasi, 2, ",", ".") ?> </td>
                                                    <td class="text-right">0 </td>
                                                    <td class="text-right"> <?= number_format($farmasi, 2, ",", ".") ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right mt-1 text-right">
                                        <?php $totalbiaya = $pemeriksaan + $tindakan + $penunjang + $bhp + $farmasi; ?>
                                        <p>Sub - Total : <?= number_format($totalbiaya, 2, ",", ".") ?></p>
                                        <?php $disc = 0;
                                        $totaldisc = $totalbiaya * $disc; ?>
                                        <p>Disc (0%) : <?= number_format($totaldisc, 2, ",", ".") ?> </p>
                                        <?php $totaltagihan = $totalbiaya - $totaldisc; ?>
                                        <p>Total Tagihan : <?= number_format($totaltagihan, 2, ",", ".") ?> </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Metode Pembayaran </td>
                                                <td>:</td>
                                                <td><span class="badge badge-success"><?= $metodepembayaran; ?></span></td>
                                                <td>Referensi Bank</td>
                                                <td>:</td>
                                                <td><span class="badge badge-danger"><?= $referensibank ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Pembayaran Cash </td>
                                                <td>:</td>
                                                <td><?= number_format($paymentamount, 2, ",", ".") ?></td>
                                                <td>Nominal Debet</td>
                                                <td>:</td>
                                                <td><?= number_format($nominaldebet, 2, ",", ".") ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Bayar </td>
                                                <td>:</td>
                                                <td><span class="badge badge-success"><?= $waktu; ?></span></td>
                                                <td>Nama Penyetor</td>
                                                <td>:</td>
                                                <td><span class="badge badge-danger"><?= $payersname ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Status Pembayaran </td>
                                                <td>:</td>
                                                <td><span class="badge badge-success"><?= $paymentstatus; ?></span></td>
                                                <td>Sisa pembayaran</td>
                                                <td>:</td>
                                                <?php $sisabayar = $totaltagihan - ($paymentamount + $nominaldebet); ?>
                                                <td><span class="badge badge-danger"><?= number_format($sisabayar, 2, ",", ".") ?></span></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- <script>
    window.print();
</script> -->