<div id="modalpilihriwayatresep" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Input Resep Dari Riwayat Resep</h4>
            </div>
            <div class="modal-body">
                <?php $no = 0;
                foreach ($tampildatariwayat as $row) :
                    $no++; ?>
                    <div class="row pt-1">
                        <div class="col-md-1">
                            <label class="control-label">Keterangan</label>
                            <select name="racikan" id="racikan" class="select2" style="width: 100%">
                                <?php foreach ($racikan as $SP) : ?>
                                    <option value="<?= $SP['kode']; ?>" data-name="<?= $SP['name']; ?>" class="select-statuspulang"><?= $SP['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">Racikan Ke</label>
                            <select name="koderacikan" id="koderacikan" class="select2" style="width: 100%">
                                <option value="-">-</option>
                                <?php foreach ($itemracikan as $APS) : ?>
                                    <option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Nama Obat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="kode_obat" name="kode_obat" required value="<?= $row['name']; ?>">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Jumlah Obat</label>
                                <input type="text" id="qtyresep" autocomplete="off" name="qtyresep" class="form-control" value="<?= ABS($row['qty']); ?>">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Aturan Pakai (Dosis)</label>
                                <input type="text" id="signa1" autocomplete="off" name="signa1" class="form-control" value="1" onkeyup="this.value = this.value.toUpperCase()">
                                <input type="hidden" id="signa2" autocomplete="off" name="signa2" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Satuan</label>
                                <input type="text" id="uom" autocomplete="off" name="uom" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Cara Pakai</label>
                                <input type="text" id="aturanPakai" autocomplete="off" name="aturanPakai" class="form-control" value="<?= $row['eticket_carapakai']; ?>">
                            </div>
                        </div>


                    </div>
                <?php endforeach; ?>
                <button id="print" class="btn btn-info btnsimpanresep" type="button"> <span class="mr-1"><i class="fa fa-save"></i></span> Simpan</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>