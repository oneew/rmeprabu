<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />


<div id="modalexpertiseLPA" class="modal fade" tabindex="-1"  role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                        <p class="text-muted"><?= $data_pasien['relation']; ?> | <?= $data_pasien['documentdate']; ?> | <?= $data_pasien['paymentmethod']; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $data_pasien['relationname']; ?> | <?= $data_pasien['roomname']; ?> | <?= $data_pasien['journalnumber']; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $data_pasien['doktername']; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-dark"><b><?= $data_pasien['name']; ?></b> (No.Expertise :<?= $data_pasien['expertiseid']; ?>)</p>
                    </div>
                </div>
                <hr>

                <h6>Isi Expertise Pemeriksaan</h6>

                <form method="post" action="<?= base_url('PelayananLPA/simpanExpertise') ;?>" class="formexpertise">
                    <?= csrf_field() ;?>
                    <input type="hidden" id="id_detail" name="id_detail" class="form-control" value="<?= $data_pasien['id'] ;?>">
                    <input type="hidden" id="groups" name="groups" class="form-control" value="NONE">
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Makroskopis</b></label>
                            <textarea id="makroskopis" name="makroskopis" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $data_expertise == null ? null : $data_expertise['makroskopis']; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisemakroskopis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><b>Mikroskopis</b></label>
                            <textarea id="mikroskopis" name="mikroskopis" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $data_expertise == null ? null : $data_expertise['mikroskopis']; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisemikroskopis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><b>Kesan</b></label>
                            <textarea id="kesan" name="kesan" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $data_expertise == null ? null : $data_expertise['kesan']; ?></textarea>
                            <div class="form-control-feedback text-danger errorexpertisekesimpulan">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 col-12 col-sm-6 px-0">
                        <label for="exampleFormControlSelect1">Dokter Pemeriksa</label>
                        <select class="form-control" name="employee" id="employee" required>
                            <option value="">Pilih dokter</option>
                            <?php foreach ($list as $item) : ?>
                                <option value="<?= $item['code'] . '|' . $item['name'] ;?>" <?= $data_expertise == null ? null : ($data_expertise['employee'] == $item['code'] ? 'selected' : null); ?>><?= $item['name'] ;?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btnsimpanExpertise"> <i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">

                <div id="form-filter-bawah" style="display: block;">
                    <div class="text-right">
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
        $('.textarea_editor').each(function() {
            $(this).wysihtml5();
        });
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal !!!',
                            text: response.error,
                        })

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
                url: "<?php echo base_url('FotoLPA/upload') ?>",
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

            let id = $('#pacsnumber').val();
            window.open("<?= base_url('PelayananLPA/printexpertise'); ?>?page=" + <?= $data_pasien['id'] ;?>, "_blank");

        })
    });
</script>