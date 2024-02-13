<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->

<div id="modalviewexpertiseLPK" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Patologi Klinik Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <?php $no = 0;
                foreach ($tampildata as $row) :
                    $relation = $row['relation'];
                    $tanggal = $row['documentdate'];
                    $carabayar = $row['paymentmethod'];
                    $namapasien = $row['relationname'];
                    $namaruangan = $row['roomname'];
                    $journalnumber = $row['journalnumber'];
                    $namadokter = $row['doktername'];
                    $name = $row['name'];


                ?>


                <?php endforeach; ?>
                <div class="row">
                    <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                        <br>
                        <p class="text-muted"><?= $relation; ?> | <?= $tanggal; ?> | <?= $carabayar; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $namapasien; ?> | <?= $namaruangan; ?> | <?= $journalnumber; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $namadokter; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-muted"><b>Patologi Klinik</b></p>
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <div class="col-md-12">
                        <table id="dataranap" class="table display table-bordered table-striped no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 2%;">No</th>
                                    <th class="text-center">Pemeriksaan</th>
                                    <th class="text-center" style="width: 8%;">Flag</th>
                                    <th class="text-center">Satuan</th>
                                    <th class="text-center">Hasil</th>
                                    <th class="text-center">Nilai Normal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($tampildata as $row) :
                                    $no++; ?>
                                    <tr>
                                        <td style="width: 2%;"><?= $no ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td class="text-center" style="width: 8%;"> </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?= form_open('PelayananLPK/simpanExpertise', ['class' => 'formexpertise']); ?>
                    <?= csrf_field(); ?>
                    <div class="col-md-12">
                        <label><b>Kesimpulan</b></label>
                        <textarea id="expertise" name="expertise" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $expertise; ?></textarea>
                        <div class="form-control-feedback text-danger errorexpertise">
                        </div>
                        <input type="hidden" id="cekexpertise" name="cekexpertise" class="form-control" value="<?= $expertiseid; ?>">
                        <input type="hidden" id="expertiseid" name="expertiseid" class="form-control" value="<?= $journalnumber ?>">
                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                        <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Analis</label>
                            <select name="paramedis" id="paramedis" class="select2" style="width: 100%;">

                                <?php foreach ($analis as $hub) : ?>
                                    <option value="<?php echo $hub['name']; ?>" <?php if ($hub['name'] == $nama_analis) { ?> selected="selected" <?php } ?>><?php echo $hub['name']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btnsimpanExpertise"> <i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                        </div>
                    </div>

                    <?= form_close() ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

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

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
        // Switchery

        $(".select2").select2();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>