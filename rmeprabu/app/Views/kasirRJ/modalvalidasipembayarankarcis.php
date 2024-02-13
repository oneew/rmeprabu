<div class="modal fade" id="modalvalidasipembayarankarcis" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Validasi Pembayaran Karcis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="validation-wizard wizard-circle updatebayar" id="form-update-nik" method="post" action="<?= base_url(); ?>/KasirRJ/SimpanValidasiBayarKarcis">
                    <div class="form-body">
                        <?php
                        foreach ($tindakan as $row) :
                        ?>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">NoTransaksi</label>
                                        <input type="text" id="journalnumber" name="journalnumber" class="form-control" value="<?= $row['journalnumber']; ?>" readonly>
                                        <input type="hidden" id="idtindakan" name="idtindakan" class="form-control" value="<?= $row['id']; ?>">
                                        <input type="hidden" id="validasipembayaran" name="validasipembayaran" class="form-control" value="1">
                                        <input type="hidden" id="kodevalidasipembayaran" name="kodevalidasipembayaran" class="form-control" value="<?= $row['validasipembayaran']; ?>">
                                        <input type="hidden" id="kasirvalidasi" name="kasirvalidasi" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                        <input type="hidden" id="tanggalvalidasipembayaran" name="tanggalvalidasipembayaran" class="form-control" value="<?= date('Y-m-d G:i:s'); ?>">

                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Tindakan</label>
                                        <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $row['description']; ?>" readonly>

                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Poli</label>
                                        <input type="text" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $row['poliklinikname']; ?>">
                                        <input type="hidden" id="qty" name="qty" class="form-control" value="1" required>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Dokter</label>
                                        <input type="text" id="doktername" name="doktername" class="form-control form-control-danger" value="<?= $row['doktername']; ?>" required onkeypress="return hanyaAngka(event)" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Tarif</label>
                                        <input type="text" id="subtotal" name="subtotal" class="form-control" value="<?= $row['price']; ?>" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Pembayaran</label>
                                        <input type="text" id="nominalpembayaran" name="nominalpembayaran" class="form-control form-control-danger" required onkeypress="return hanyaAngka(event)" value="<?= round($row['price']) ?>">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php
                    if ($row['validasipembayaran'] == 1) {
                        $kata = 'Batalkan Pembayaran';
                    } else {
                        $kata = 'Simpan Pembayaran';
                    }
                    ?>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btnupdatepembayaran"> <i class="fa fa-check"></i>
                            <?= $kata; ?></button>
                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        $('.updatebayar').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnupdatepembayaran').attr('disable', 'disabled');
                    $('.btnupdatepembayaran').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnupdatepembayaran').removeAttr('disable');
                    $('.btnupdatepembayaran').html('Simpan');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.pesan,

                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //$('#modalupdatenik').modal('hide');
                                dataresume();

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>