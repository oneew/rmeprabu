<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />

<div class="m-1">
    <form action="<?= base_url('PelayananRawatJalanRME/storeObatRacikan'); ?>" class="form-racikan" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" id="id_obat_racikan" name="id_obat_racikan" value="<?= null; ?>">
        <div class="form-group">
            <label for="description">Uraian Obat Racikan</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= $data['description'] ?? null; ?></textarea>
        </div>
        <div class="text-right">
            <button class="btn btn-warning btn-store-racikan" type="submit">Simpan</button>
        </div>
    </form>
</div>

<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {
        $('#description').wysihtml5();

        $('.form-racikan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    id_obat_racikan: $('#id_obat_racikan').val(),
                    description: $('#description').val(),
                    journalnumber: $('#journalnumber').val(),
                    referencenumber: $('#referencenumber_detail').val(),
                    pasienid: $('#relation').val(),
                    pasienname: $('#relationname').val(),
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btn-store-racikan').attr('disabled', true);
                    $('.btn-store-racikan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-store-racikan').removeAttr('disabled');
                    $('.btn-store-racikan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops !!',
                            text: response.error,
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        })
                        $('#row').each(function() {
                            $(this).remove();
                        });
                        $('#nama_obat').val(null);
                        $('#kode_obat').val(null);
                        $('#code').val(null);
                        $('#uom').val(null);
                        $('#batchnumber').val(null);
                        $('#qty').val('1');
                        $('#qtyresep').val('1');
                        detaileResep();
                    }
                }
            });
            return false;
        });
    })
</script>