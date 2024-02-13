<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css') ?>">
<div id="modal_edit_cppt" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    Edit CPPT
                </h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('PelayananRawatJalanRME/updateCppt'); ?>" method="post" class="updateCppt">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $tampildata[0]['id']; ?>">
                    <div class="form-group">
                        <label for="subjektif">Subjektif</label>
                        <textarea type="text" class="form-control textedit_cppt" id="subjektif" name="subjektif"><?= $tampildata[0]['s']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="obyektif">Obyektif</label>
                        <textarea type="text" class="form-control textedit_cppt" id="obyektif" name="obyektif"><?= $tampildata[0]['o']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="asesmen">Asesmen</label>
                        <textarea type="text" class="form-control textedit_cppt" id="asesmen" name="asesmen"><?= $tampildata[0]['a']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="planning">Planning</label>
                        <textarea type="text" class="form-control textedit_cppt" id="planning" name="planning"><?= $tampildata[0]['p']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect btnupdatecppt">Simpan</button>
                        <button type="button" class="btn btn-default waves-effect" id="closeModal"> <i class="fa fa-home"></i> Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/plugins/html5-editor/wysihtml5-0.3.0.js') ?>"></script>
<script src="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.textedit_cppt').each(function() {
            $(this).wysihtml5();
        });
    });
    $('.updateCppt').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnupdatecppt').attr('disable', 'disabled');
                $('.btnupdatecppt').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnupdatecppt').removeAttr('disable');
                $('.btnupdatecppt').html('Simpan');
            },
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `${response.sukses}`,
                    }).then((result) => {
                        dataresumeCPPTAll();
                        $('#modal_edit_cppt').remove();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        html: `${response.gagal}`,
                    })
                }
            }
        });
        return false;
    });

    $('#closeModal').click(function() {
        $('#modal_edit_cppt').remove();
    });
</script>