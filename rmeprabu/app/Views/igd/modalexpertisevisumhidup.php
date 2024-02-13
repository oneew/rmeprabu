<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

<div id="modalexpertisevisumhidup" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Expertise Visum Korban Hidup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?= form_open('PelayananIGD/simpan_expertise_visum', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <?php
                foreach ($forensik as $row) :
                ?>
                    <?php
                    // $lampiran_klinis = $row['lampiran_klinis'] == 1 ? 'checked' : '';
                    // $lampiran_toksikologi = $row['lampiran_toksikologi'] == 1 ? 'checked' : '';
                    // $lampiran_histopatologi = $row['lampiran_histopatologi'] == 1 ? 'checked' : '';
                    // $lampiran_video = $row['lampiran_video'] == 1 ? 'checked' : '';
                    // $lampiran_lain = $row['lampiran_lain'] == 1 ? 'checked' : '';
                    ?>
                    <h6>Data Pasien</h6>
                    <div class="row">
                        <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                            <br>
                            <p class="text-muted"><?= $row['pasienid']; ?> | <?= $row['documentdate']; ?> | <?= $row['paymentmethodname']; ?> </p>
                        </div>
                        <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                            <br>
                            <p class="text-muted"><?= $row['pasienname']; ?> | <?= $row['journalnumber']; ?> </p>
                        </div>
                        <div class="col-md-3 col-xs-6 border-right"> <strong>Pemohon</strong>
                            <br>
                            <p class="text-muted"><?= $permintaanDari; ?></p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>No Surat Permohonan</strong>
                            <br>
                            <p class="text-muted"><b><?= $noPermintaan; ?></b></p>
                        </div>
                    </div>
                    <hr>
                    <h6>Isi Expertise Pemeriksaan</h6>
                    <div class="row mt-0">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Permintaan Dari</label>
                                <input type="text" id="permintaanDari" name="permintaanDari" class="form-control" value="<?= $permintaanDari; ?>">
                                <input type="hidden" id="pasienid_expertise" name="pasienid_expertise" class="form-control" value="<?= $row['pasienid']; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">No. Surat Permintaan</label>
                                <input type="text" id="noPermintaan" name="noPermintaan" class="form-control" value="<?= $noPermintaan; ?>">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">TglSP</label>
                                <?php if ($tglPermintaan == "") {
                                    $tglPermintaan = date('Y-m-d');
                                } else {
                                    $tglPermintaan = $tglPermintaan;
                                } ?>
                                <input type="text" id="tglPermintaan" name="tglPermintaan" class="form-control" value="<?= $tglPermintaan; ?>">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">TglDiterima</label>
                                <?php if ($tglterimaPermintaan == "") {
                                    $tglterimaPermintaan = date('Y-m-d');
                                } else {
                                    $tglterimaPermintaan = $tglterimaPermintaan;
                                } ?>
                                <input type="text" id="tglterimaPermintaan" name="tglterimaPermintaan" class="form-control" value="<?= $tglterimaPermintaan; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">No Registrasi</label>
                                <input type="text" id="journalnumber" name="journalnumber" class="form-control" value="<?= $row['journalnumber']; ?>">
                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $row['journalnumber']; ?>">
                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Dokter Pemeriksa</label>
                                <select name="doktername1" id="doktername1" class="select2" style="width: 100%">
                                    <option value>Pilih Dokter Pemeriksa</option>
                                    <?php foreach ($list as $dpjp) { ?>
                                        <option value="<?= $dpjp['name']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername1) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Dokter Forensik</label>
                                <select name="doktername2" id="doktername2" class="select2" style="width: 100%">
                                    <option value>Pilih Dokter Pemeriksa</option>
                                    <?php foreach ($list as $df) { ?>
                                        <option value="<?= $df['name']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername2) { ?> selected="selected" <?php } ?>><?= $df['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Korban Datang Dalam Keadaan</label>
                                <textarea id="keadaanDatang" name="keadaanDatang" class="textarea_editor form-control" rows="2" placeholder="Enter text"><?= $keadaanDatang; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Keadaan Umum</label>
                                <textarea id="keadaanUmum" name="keadaanUmum" class="textarea_editor_umum form-control" rows="2" placeholder="Enter text"><?= $keadaanUmum; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Korban Mengaku</label>
                                <textarea id="pengakuanKorban" name="pengakuanKorban" class="textarea_editor_pengakuan form-control" rows="2" placeholder="Enter text"><?= $pengakuanKorban; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tekanan Darah</label>
                                        <input type="text" id="tekananDarah" name="tekananDarah" class="form-control" value="<?= $tekananDarah; ?>">
                                        <small class="form-control-feedback text-danger"> /mm</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Frekuensi Nadi</label>
                                        <input type="text" id="frekuensiNadi" name="frekuensiNadi" class="form-control" value="<?= $frekuensiNadi; ?>">
                                        <small class="form-control-feedback text-danger"> /menit</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Frekuensi Napas</label>
                                        <input type="text" id="frekuensiNafas" name="frekuensiNafas" class="form-control" value="<?= $frekuensiNafas; ?>">
                                        <small class="form-control-feedback text-danger"> /menit</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Suhu</label>
                                        <input type="text" id="suhu" name="suhu" class="form-control" value="<?= $suhu; ?>">
                                        <small class="form-control-feedback text-danger"> celcius</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Pada Korban Ditemukan</label>
                                <textarea id="korbanDitemukan" name="korbanDitemukan" class="textarea_editor_ditemukan form-control" rows="2" placeholder="Enter text"><?= $korbanDitemukan; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Pada Korban Dilakukan</label>
                                <textarea id="korbanDilakukan" name="korbanDilakukan" class="textarea_editor_dilakukan form-control" rows="2" placeholder="Enter text"><?= $korbanDilakukan; ?></textarea>
                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Status Korban</label>
                                <select name="statusKorban" id="statusKorban" class="select2" style="width: 100%">
                                    <option value>Pilih Tindak Lanjut</option>
                                    <?php foreach ($pasienstatus as $ps) { ?>
                                        <option value="<?= $ps['name']; ?>" class="select-dokter" <?php if ($ps['name'] == $statusKorban) { ?> selected="selected" <?php } ?>><?= $ps['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kesimpulan</label>
                                <textarea id="kesimpulan" name="kesimpulan" class="textarea_editor_kesimpulan form-control" rows="2" placeholder="Enter text"><?= $kesimpulan; ?></textarea>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan</button>
                <button id="print" class="btn btn-success btnprintExpertise" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>

            </div>
            <?= form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();
        $('.textarea_editor_umum').wysihtml5();
        $('.textarea_editor_pengakuan').wysihtml5();
        $('.textarea_editor_ditemukan').wysihtml5();
        $('.textarea_editor_dilakukan').wysihtml5();
        $('.textarea_editor_kesimpulan').wysihtml5();
    });
</script>

<script>
    $(document).ready(function() {
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }

        $('#clearBtn').on('click', function(e) {
            e.preventDefault();
            $('.js-signature').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
            //alert($('.js-signature').html());
        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signature').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });
            // alert(save);
        });

        $('.js-signature').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));
            //$('#saveBtn').attr('disabled', false);
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/dff/dff.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script>
    $(function() {
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
    $('#dokter_forensik').on('change', function() {
        $.ajax({
            'type': "POST",

            'url': "<?php echo base_url('autocomplete/fill_dokter_forensik') ?>",
            'data': {
                key: $('#dokter_forensik option:selected').data('id')
            },
            'success': function(response) {
                //mengisi value input nama dan lainnya
                let data = JSON.parse(response);
                $('#dokter_forensik').val(data.name);
                $('#nip_dokter_forensik').val(data.nip);

                $('#autocomplete-dokter').html('');
            }
        })
    })
</script>

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
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.ibsdoktername) {
                            $('#doktername1').addClass('form-control-danger');
                            $('.errordoktername1').html(response.error.doktername1);
                        } else {
                            $('#doktername1').removeClass('form-control-danger');
                            $('.errordoktername1').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //$('#modalexpertisevisum').modal('hide');
                                //dataresume();
                                //resumeexpertise();

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintExpertise').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('PelayananFRS/printbuktiVisumIgd') ?>?page=" + id, "_blank");

        })
    });
</script>