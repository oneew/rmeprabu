<div id="modaledit" class="modal fade in" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Edit Data Paramedis Dan Nakes Lainnya</h4>
            </div>

            <?= form_open('perawat/updatedata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-group">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" class="form-control" placeholder="nama" id="id" name="id" value="<?= $id; ?>">
                            <input type="text" class="form-control" placeholder="nama" id="nama" name="nama" value="<?= $nama; ?>">

                        </div>
                        <div class="col-md-12 mb-3">
                            <select name="area" id="area" class="form-control">
                                <option value="">-Pilih Area-</option>
                                <option value="IRJ" <?php if ($area == 'IRJ') echo "selected"; ?>>Rawat Jalan</option>
                                <option value="IGD" <?php if ($area == 'IGD') echo "selected"; ?>>IGD</option>
                                <option value="IRI" <?php if ($area == 'IRI') echo "selected"; ?>>Rawat Inap</option>
                                <option value="PENUNJANG" <?php if ($area == 'PENUNJANG') echo "selected"; ?>>Penunjang</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <select name="locationname" id="locationname" class="form-control" style="width: 100%" required>
                                <option value>Pilih Lokasi Kerja</option>
                                <?php foreach ($lokasi as $tk) : ?>
                                    <option value="<?= $tk['locationname']; ?>" class="select-classroom" <?php if ($tk['locationname'] == $locationname) { ?> selected="selected" <?php } ?>><?= $tk['locationname']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                        </div>

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-plus"></i> Update</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.kelompok) {
                            $('#kelompok').addClass('is-invalid');
                            $('.errorKelompok').html(response.error.kelompok);
                        } else {
                            $('#kelompok').removeClass('is-invalid');
                            $('.errorKelompok').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#modaledit').modal('hide');
                        dataperawat();

                    }
                }


            });
            return false;
        });
    });
</script>