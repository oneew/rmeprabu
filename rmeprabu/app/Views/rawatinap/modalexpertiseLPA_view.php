<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />


<div id="modalexpertiseLPA_view" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Patologi Anantomi Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <div class="row">
                    <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                        <br>
                        <p class="text-muted"><?= $relation; ?> | <?= $documentdate; ?> | <?= $paymentmethod; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $relationname; ?> | <?= $roomname; ?> | <?= $journalnumber; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $doktername; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-dark"><b><?= $name; ?></b> (No.Expertise :<?= $expertiseid; ?>)</p>
                    </div>
                </div>
                <hr>

                <h6>Isi Expertise Pemeriksaan</h6>

                <?= form_open('PelayananLPA/simpanExpertise', ['class' => 'formexpertise']); ?>
                <?= csrf_field(); ?>
                <form method="post" id="form-filter">
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Lokasi Organ</b></label>
                            <textarea id="lokasiorgan" name="lokasiorgan" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $expertise; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertise">
                            </div>
                            <input type="hidden" id="expertiseid" name="expertiseid" class="form-control" value="<?= $expertiseid; ?>">
                            <input type="hidden" id="pacsnumber" name="pacsnumber" class="form-control" value="<?= $pacsnumber; ?>">
                            <input type="hidden" id="groups" name="groups" class="form-control" value="NONE">
                            <input type="hidden" id="cekexpertise" name="cekexpertise" class="form-control" value="<?= $expertiseidhasil; ?>">
                            <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                            <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label><b>Makroskopis</b></label>
                            <textarea id="makroskopis" name="makroskopis" class="textarea_editor2 form-control" rows="15" placeholder="Enter text ..."><?= $makroskopis; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisemakroskopis">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Mikroskopis</b></label>
                            <textarea id="mikroskopis" name="mikroskopis" class="textarea_editor3 form-control" rows="15" placeholder="Enter text ..."><?= $mikroskopis; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisemikroskopis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><b>Kesimpulan</b></label>
                            <textarea id="expertise" name="expertise" class="textarea_editor4 form-control" rows="15" placeholder="Enter text ..."><?= $expertise; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisekesimpulan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Catatan</b></label>
                            <textarea id="catatan" name="catatan" class="textarea_editor5 form-control" rows="15" placeholder="Enter text ..."><?= $catatan; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisecatatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><b>Saran</b></label>
                            <textarea id="saran" name="saran" class="textarea_editor6 form-control" rows="15" placeholder="Enter text ..."><?= $saran; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisesaran">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="ti-link"></i> Attachment</h4>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-3 text-center">
                                        <?php
                                        $foto = !is_null($fotoradiologi) ? $fotoradiologi : 'default.jpeg'; ?>
                                        <a data-foto="<?= $fotoradiologi; ?>" data-id="<?= $expertiseidhasil; ?>" class="btn-form-upload"><img id="foto-<?= $expertiseidhasil; ?>" src="<?= base_url(); ?>/assets/images/fotopatologianatomi/<?= $foto; ?>" alt="dokter" height="100" width="100" class="rounded-circle img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                </form>
            </div>

            <div class="modal-footer">

                <div id="form-filter-bawah" style="display: block;">
                    <div class="text-right">
                        <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                        <button id="print" class="btn btn-success btnprintexpertise" type="button"> <span><i class="fa fa-print"></i></span> </button>
                    </div>
                </div>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal-upload">

</div>

<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();
        $('.textarea_editor2').wysihtml5();
        $('.textarea_editor3').wysihtml5();
        $('.textarea_editor4').wysihtml5();
        $('.textarea_editor5').wysihtml5();
        $('.textarea_editor6').wysihtml5();

    });
</script>

<script>
    $(document).ready(function() {
        $('.formexpertise').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanExpertise').attr('disable', 'disabled');
                    $('.btnsimpanExpertise').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanExpertise').removeAttr('disable');
                    $('.btnsimpanExpertise').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.expertise) {
                            $('#expertise').addClass('form-control-danger');
                            $('.errorexpertise').html(response.error.expertise);
                        } else {
                            $('#expertise').removeClass('form-control-danger');
                            $('.errorexpertise').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                    }
                }
            });
            return false;
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-form-upload').on('click', function() {
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('FotoLPA/upload_view_lpa') ?>",
                data: {
                    code: $(this).data('id'),
                    foto: $(this).data('foto')
                },
                success: function(response) {
                    $('.modal-upload').html(response);
                }
            })
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintexpertise').on('click', function() {

            let id = $('#expertiseid').val();
            window.open("<?php echo base_url('PelayananLPA/printexpertise') ?>?page=" + id, "_blank");

        })
    });
</script>