<div id="modalrincianpelayananranap" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title text-white" id="warning-header-modalLabel">Rincian Gabung Pelayanan Obat Rawat Inap (No Referensi : <?= $referensi; ?>)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table id="dataradiologi" class="table color-table white-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Cara Pakai</th>
                            <th>Jumlah</th>
                            <th>Batch</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($DetailObat as $row) :
                            $no++; ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['documentdate'] ?><small class="text-muted mt-2 d-block"><?= $row['createdby']; ?></small>
                                    <small class="text-muted mt-2 d-block"><span class="badge badge-warning"></small>
                                </td>
                                <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                                    <br><?= $row['uom']  ?> [Exp:<?= $row['expireddate']; ?>]
                                </td>
                                <td><?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", "."); ?><small class="text-muted mt-2 d-block"><?= $row['eticket_carapakai']; ?></small>
                                    <small class="text-muted mt-2 d-block"><?= $row['eticket_petunjuk']; ?></small>
                                </td>
                                <td><?= abs($row['qty']) ?></td>
                                <td><?= $row['batchnumber']  ?></td>
                                <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                                <td><?= abs($row['subtotal']) ?></td>
                                <?php $Total[] = $row['subtotal']; ?>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
                        $grandtotal = $check_Total;
                        $totalbiaya = abs($grandtotal);
                        ?>
                        <tr>
                            <td colspan="15" class="text-center">
                                <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
                            </td>
                        </tr>

                        <td colspan="15" class="text-center">
                            <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                        </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->