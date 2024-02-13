<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

<div id="modalexpertisevisum" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Forensik Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?= form_open('PelayananFRS/simpan_expertise', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <?php
                foreach ($forensik as $row) :
                ?>
                    <?php
                    $lampiran_klinis = $row['lampiran_klinis'] == 1 ? 'checked' : '';
                    $lampiran_toksikologi = $row['lampiran_toksikologi'] == 1 ? 'checked' : '';
                    $lampiran_histopatologi = $row['lampiran_histopatologi'] == 1 ? 'checked' : '';
                    $lampiran_video = $row['lampiran_video'] == 1 ? 'checked' : '';
                    $lampiran_lain = $row['lampiran_lain'] == 1 ? 'checked' : '';
                    ?>
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
                        <div class="col-md-3 col-xs-6 border-right"> <strong>Pemohon</strong>
                            <br>
                            <p class="text-muted"><?= $row['request_from']; ?></p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>No Surat Permohonan</strong>
                            <br>
                            <p class="text-muted"><b><?= $row['request_number']; ?></b></p>
                        </div>
                    </div>
                    <hr>
                    <h6>Isi Expertise Pemeriksaan</h6>
                    <from id="form-filter" method="post">
                        <div class="form-body">
                            <div class="row pt-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Anamnesis</label>
                                        <textarea id="anamnesis" name="anamnesis" class="textarea_editor form-control" rows="2" placeholder="Enter text"><?= $row['anamnesis']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kesadaran</label>
                                        <input type="text" id="kesadaran" name="kesadaran" class="form-control" value="<?= $row['kesadaran']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Denyut Nadi</label>
                                        <input type="text" id="denyutnadi" name="denyutnadi" class="form-control" value="<?= $row['denyutnadi']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pernapasan</label>
                                        <input type="text" id="pernapasan" name="pernapasan" class="form-control" value="<?= $row['pernapasan']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tekanan Darah</label>
                                        <input type="text" id="tekanandarah" name="tekanandarah" class="form-control" value="<?= $row['tekanandarah']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Suhu Tubuh</label>
                                        <input type="text" id="suhutubuh" name="suhutubuh" class="form-control" value="<?= $row['suhutubuh']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tinggi Badan</label>
                                        <input type="text" id="tinggibadan" name="tinggibadan" class="form-control" value="<?= $row['tinggibadan']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Berat Badan</label>
                                        <input type="text" id="beratbadan" name="beratbadan" class="form-control" value="<?= $row['beratbadan']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kepala</label>
                                        <input type="text" id="kepala" name="kepala" class="form-control" value="<?= $row['kepala']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ciri Khusus</label>
                                        <textarea id="cirikhusus" name="cirikhusus" class="textarea_editor_cirikhusus form-control" rows="2" placeholder="Enter text"><?= $row['cirikhusus']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pakaian</label>
                                        <textarea id="pakaian" name="pakaian" class="textarea_editor_pakaian form-control" rows="2" placeholder="Enter text"><?= $row['pakaian']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Leher</label>
                                        <textarea id="leher" name="leher" class="textarea_editor_leher form-control" rows="2" placeholder="Enter text"><?= $row['leher']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Bahu</label>
                                        <textarea id="bahu" name="bahu" class="textarea_editor_bahu form-control" rows="2" placeholder="Enter text"><?= $row['bahu']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Dada</label>
                                        <textarea id="dada" name="dada" class="textarea_editor_dada form-control" rows="2" placeholder="Enter text"><?= $row['dada']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Punggung</label>
                                        <textarea id="punggung" name="punggung" class="textarea_editor_punggung form-control" rows="2" placeholder="Enter text"><?= $row['punggung']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Perut</label>
                                        <textarea id="perut" name="perut" class="textarea_editor_perut form-control" rows="2" placeholder="Enter text"><?= $row['perut']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pinggang</label>
                                        <textarea id="pinggang" name="pinggang" class="textarea_editor_pinggang form-control" rows="2" placeholder="Enter text"><?= $row['pinggang']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Bokong</label>
                                        <textarea id="bokong" name="bokong" class="textarea_editor_bokong form-control" rows="2" placeholder="Enter text"><?= $row['bokong']; ?></textarea>
                                        <input type="hidden" id="referencenumber" name="referencenumber" value="<?= $row['referencenumber']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Dubur</label>
                                        <textarea id="pinggangdubur" name="dubur" class="textarea_editor_dubur form-control" rows="2" placeholder="Enter text"><?= $row['dubur']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Alat Kelamin</label>
                                        <textarea id="alatkelamin" name="alatkelamin" class="textarea_editor_alatkelamin form-control" rows="2" placeholder="Enter text"><?= $row['alatkelamin']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Anggota Gerak Atas</label>
                                        <textarea id="anggota_gerak_atas" name="anggota_gerak_atas" class="textarea_editor_anggota_gerak_atas form-control" rows="1" placeholder="Enter text"><?= $row['anggota_gerak_atas']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Anggota Gerak Bawah</label>
                                        <textarea id="anggota_gerak_bawah" name="anggota_gerak_bawah" class="textarea_editor_anggota_gerak_bawah form-control" rows="1" placeholder="Enter text"><?= $row['anggota_gerak_bawah']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Laboratorium</label>
                                        <input type="text" id="penunjang_lab" name="penunjang_lab" class="form-control" value="<?= $row['penunjang_lab']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Radiologi</label>
                                        <input type="text" id="penunjang_radiologi" name="penunjang_radiologi" class="form-control" value="<?= $row['penunjang_radiologi']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Odontogram</label>
                                        <input type="text" id="penunjang_odontogram" name="penunjang_odontogram" class="form-control" value="<?= $row['penunjang_odontogram']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lain-lain</label>
                                        <input type="text" id="penunjang_lain" name="penunjang_lain" class="form-control" value="<?= $row['penunjang_lain']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Ringkasan Pemeriksaan</label>
                                        <textarea id="ringkasan_pemeriksaan" name="ringkasan_pemeriksaan" class="textarea_editor_ringkasan form-control" rows="2" placeholder="Enter text"><?= $row['anamnesis']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Diagnosa ICD</label>
                                        <input type="text" id="icd" name="icd" class="form-control" value="<?= $row['icd']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Penyebab Damage(A-1)</label>
                                        <input type="text" id="penyebab_a1" name="penyebab_a1" class="form-control" value="<?= $row['penyebab_A1']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Penyebab (A-2)</label>
                                        <input type="text" id="penyebab_a2" name="penyebab_a2" class="form-control" value="<?= $row['penyebab_A2']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Penyebab Mendasari</label>
                                        <input type="text" id="penyebab_mendasari" name="penyebab_mendasari" class="form-control" value="<?= $row['penyebab_mendasari']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Keadaan Morbid Lain(B-1)</label>
                                        <input type="text" id="b_1" name="b_1" class="form-control" value="<?= $row['b_1']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Keadaan Morbid Lain(B-2)</label>
                                        <input type="text" id="b_2" name="b_2" class="form-control" value="<?= $row['b_2']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Keadaan Morbid Lain(B-n)</label>
                                        <input type="text" id="b_n" name="b_n" class="form-control" value="<?= $row['b_n']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pengobatan & tindakan</label>
                                        <input type="text" id="pengobatan_tindakan" name="pengobatan_tindakan" class="form-control" value="<?= $row['pengobatan_tindakan']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Prognosis</label>
                                        <input type="text" id="prognosis" name="prognosis" class="form-control" value="<?= $row['prognosis']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Dokter Forensik</label>
                                        <select name="dokter_forensik" id="dokter_forensik" class="select2" style="width: 100%">
                                            <option>Pilih Dokter Forensik</option>
                                            <?php foreach ($dokterforensik as $dokter) { ?>
                                                <option data-id="<?= $dokter['id']; ?>" class="select-dokterpoli" <?php if ($dokter['name'] == $row['dokter_forensik']) { ?> selected="selected" <?php } ?>><?= $dokter['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">No Induk</label>
                                        <input type="text" id="nip_dokter_forensik" name="nip_dokter_forensik" class="form-control" value="<?= $row['nip_dokter_forensik']; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Kesimpulan</label>
                                        <textarea id="kesimpulan" name="kesimpulan" class="textarea_editor_kesimpulan form-control" rows="1" placeholder="Enter text"><?= $row['kesimpulan']; ?></textarea>
                                        <input type="hidden" id="updatedby" name="updatedby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">

                                        <label class="control-label">Sign Below: Dokter Forensik</label>
                                        <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                                        <input type="hidden" id="id" name="id" class="form-control" value="<?= $row['id']; ?>">
                                        <div class="js-signature" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                        <p><button id="clearBtn" class="btn btn-default">Clear Canvas</button></p>
                                        <div id="signature">
                                        </div>
                                    </div>
                                </div>
                                <?php if ($row['dokter_signature'] !== "") { ?>
                                    <div class="col-md-3">
                                        <label class="control-label">Sign</label>
                                        <div class="card">
                                            <div class="el-card-item">
                                                <div class="el-card-avatar el-overlay-1"> <img src="<?= $row['dokter_signature'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Klinis</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $lampiran_klinis; ?> value="1" name="lampiran_klinis" id="lampiran_klinis"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Toksikologi</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $lampiran_toksikologi; ?> value="1" name="lampiran_toksikologi" id="lampiran_toksikologi"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Histopatologi</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $lampiran_histopatologi; ?> value="1" name="lampiran_histopatologi" id="lampiran_histopatologi"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Foto</label>
                                        <input type="text" id="lampiran_foto" name="lampiran_foto" class="form-control" value="<?= $row['lampiran_foto']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Video</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $lampiran_video; ?> value="1" name="lampiran_video" id="lampiran_video"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Lampiran Lain-lain</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $lampiran_lain; ?> value="1" name="lampiran_lain" id="lampiran_lain"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </from>
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
        $('.textarea_editor_pakaian').wysihtml5();
        $('.textarea_editor_cirikhusus').wysihtml5();
        $('.textarea_editor_leher').wysihtml5();
        $('.textarea_editor_bahu').wysihtml5();
        $('.textarea_editor_dada').wysihtml5();
        $('.textarea_editor_punggung').wysihtml5();
        $('.textarea_editor_perut').wysihtml5();
        $('.textarea_editor_pinggang').wysihtml5();
        $('.textarea_editor_bokong').wysihtml5();
        $('.textarea_editor_dubur').wysihtml5();
        $('.textarea_editor_alatkelamin').wysihtml5();
        $('.textarea_editor_anggota_gerak_atas').wysihtml5();
        $('.textarea_editor_anggota_gerak_bawah').wysihtml5();
        $('.textarea_editor_kesimpulan').wysihtml5();
        $('.textarea_editor_ringkasan').wysihtml5();


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
                            $('#ibsdoktername').addClass('form-control-danger');
                            $('.erroribsdoktername').html(response.error.ibsdoktername);
                        } else {
                            $('#ibsdoktername').removeClass('form-control-danger');
                            $('.erroribsdoktername').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalexpertisevisum').modal('hide');
                                dataresume();
                                resumeexpertise();

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
            window.open("<?php echo base_url('PelayananFRS/printbuktiVisum') ?>?page=" + id, "_blank");

        })
    });
</script>