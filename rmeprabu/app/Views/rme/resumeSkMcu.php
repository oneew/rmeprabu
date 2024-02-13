<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css'); ?>" />

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">RESUME SK</h4>
                <form action="" method="post" class="form-save">
                    <?= csrf_field() ;?>   
                    <input type="hidden" name="id_sk" value="<?= $sk == null ? null : $sk['id'] ;?>">
                    <input type="hidden" name="pasienid" value="<?= $sk == null ? $pasienid : $sk['pasienid'] ;?>">
                    <input type="hidden" name="referencenumber" id="referencenumber" value="<?= $sk == null ? $referencenumber : $sk['referencenumber'] ;?>">

                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input class="form-control" id="nomor_surat" name="nomor_surat" value="<?= is_null($sk) ? null : $sk['nomor_surat'] ;?>">
                    </div>
                    <div class="form-group">
                        <label for="keperluan">Hasil Pemeriksaan</label>
                        <textarea class="form-control text-editor" id="hasil" name="hasil" rows="3"><?= is_null($sk) ? null : $sk['hasil'] ;?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <textarea class="form-control" id="keperluan" name="keperluan" rows="3"><?= is_null($sk) ? null : $sk['keperluan'] ;?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-save">Simpan</button>
                    <button type="button" class="btn btn-sm btn-success btn-print"><i class="fas fa-print"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/plugins/html5-editor/wysihtml5-0.3.0.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.js'); ?>"></script>

<script>
    $(document).ready(() => {
        $('.text-editor').wysihtml5()

        $('.form-save').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?= base_url('PelayananRawatJalanRME/simpanResumeSkMcu');?>',
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-save').attr('disable', 'disabled');
                    $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-save').removeAttr('disable');
                    $('.btn-save').html('Simpan');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: response.success,
                        })
                        resumeSk()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            html: response.error,
                        })
                    }
                }
            });
            return false;
        })

        $('.btn-print').click(()=>{
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeSkMcu') ?>?page=" + $('#referencenumber').val(), "_blank");
        });
    })
</script>