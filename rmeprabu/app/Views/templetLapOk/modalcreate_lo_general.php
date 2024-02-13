<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css') ?>">
<style type="text/css">
    hr {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    hr:after {
        background: #fff;
        content: 'Jaringan /  Spesimen Yang Di Eksisi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .hr10 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr10:after {
        background: #fff;
        content: 'Laporan Jalannya Operasi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
</style>


<div id="modalcreate_lo_general" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="mb-0 text-white"><?= is_null($data_lap) ? 'Tambah Templet Laporan Operasi' : 'Update Templet Laporan Operasi' ;?></h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('TempletLapOk/store') ;?>" class="form-store" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= is_null($data_lap) ? null : $data_lap['id'] ;?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label">Nama Tindakan</label>
                                            <input type="text" id="name" name="name" class="form-control form-control-danger" value="<?= is_null($data_lap) ? null : $data_lap['nama'] ;?>">
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="cito" id="cito" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['cito'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Cito</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="elektif" id="elektif" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['elektif'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Elektif</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">SMF/KSM</label>
                                                    <input type="text" id="smfName" name="smfName" class="form-control form-control-danger" value="<?= is_null($data_lap) ? null : $data_lap['smfName'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Dokter Anestesi</label>
                                                    <input type="text" id="dokterAnestesi" name="dokterAnestesi" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['dokterAnestesi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Perawat/Anestesi</label>
                                                    <textarea id="perawatAnestesi" name="perawatAnestesi" class="form-control" rows="3"><?= is_null($data_lap) ? null : $data_lap['perawatAnestesi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Scrub Nurse/ Instrumen</label>
                                                    <input type="text" id="scrubNurse" name="scrubNurse" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['scrubNurse'] ;?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asisten I</label>
                                                    <input type="text" id="asisten1" name="asisten1" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['asisten1'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asisten II</label>
                                                    <input type="text" id="asisten2" name="asisten2" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['asisten2'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Circulation Nurse</label>
                                                    <input type="text" id="circulationNurse" name="circulationNurse" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['circulationNurse'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Posisi Operasi Pasien</label>
                                                    <input type="text" id="posisiOperasi" name="posisiOperasi" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['posisiOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jenis Sayatan</label>
                                                    <input type="text" id="jenisSayatan" name="jenisSayatan" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jenisSayatan'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Skin Perparasi</label>
                                                <select name="skinPerparasi" id="skinPerparasi" class="select2" style="width: 100%">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($skin as $skin) : ?>
                                                        <option value="<?= $skin['name']; ?>" <?= is_null($data_lap) ? null : ($data_lap['skinPerparasi'] == $skin['name'] ? 'selected' : null) ;?> ><?= $skin['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Jenis Pembedahan</label>
                                                <select name="jenisPembedahan" id="jenisPembedahan" class="select2" style="width: 100%">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($jenisPembedahan as $jenisPembedahan) : ?>
                                                        <option value="<?= $jenisPembedahan['name']; ?>" <?= is_null($data_lap) ? null : ($data_lap['jenisPembedahan'] == $jenisPembedahan['name'] ? 'selected' : null) ;?> ><?= $jenisPembedahan['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Diagnosa Pra Bedah</label>
                                                    <input type="text" id="diagnosaPraBedah" name="diagnosaPraBedah" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['diagnosaPraBedah'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Indikasi Operasi</label>
                                                    <textarea id="indikasiOperasi" name="indikasiOperasi" class="form-control" rows="3"><?= is_null($data_lap) ? null : $data_lap['indikasiOperasi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jenis Operasi</label>
                                                    <input type="text" id="jenisOperasi" name="jenisOperasi" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jenisOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Diagnosa Pasca Bedah</label>
                                                    <input type="text" id="diagnosaPascaBedah" name="diagnosaPascaBedah" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['diagnosaPascaBedah'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label class="control-label">Prosedur/Tindakan Operasi</label>
                                            <textarea id="prosedurOp" name="prosedurOp" class="form-control" rows="3"><?= is_null($data_lap) ? null : $data_lap['prosedurOp'] ;?></textarea>
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-md-2 mb-3">
                                                <label>Operasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenOperasi" id="jaringanSpesimenOperasi" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['jaringanSpesimenOperasi'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Aspirasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenAspirasi" id="jaringanSpesimenAspirasi" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['jaringanSpesimenAspirasi'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Katerisasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenkaterisasi" id="jaringanSpesimenkaterisasi" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['jaringanSpesimenkaterisasi'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Lokalisasi</label>
                                                    <input type="text" id="lokalisasi" name="lokalisasi" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['lokalisasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Dikirim Ke PA</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="dikirimPA" id="dikirimPA" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['dikirimPA'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Profilaksis Antibiotik</label>
                                                    <input type="text" id="profilaksisAntibiotik" name="profilaksisAntibiotik" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['profilaksisAntibiotik'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jam Pemberian</label>
                                                    <input type="text" id="jamPemberian" name="jamPemberian" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jamPemberian'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr10">
                                        <div class="row pt-1">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jalannya Operasi/ Temuan</label>
                                                    <textarea id="laporanJalanOperasi" name="laporanJalanOperasi" class="textarea_editor form-control" rows="3"><?= is_null($data_lap) ? null : $data_lap['laporanJalanOperasi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Komplikasi Pasca Bedah</label>
                                                    <textarea id="komplikasiPascaBedah" name="komplikasiPascaBedah" class="textarea_editor form-control" rows="2"><?= is_null($data_lap) ? null : $data_lap['komplikasiPascaBedah'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah Perdarahan Hilang</label>
                                                    <input type="text" id="jumlahPerdarahan" name="jumlahPerdarahan" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jumlahPerdarahan'] ;?>">
                                                    <small class="form-control-feedback">cc</small>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Transfusi Darah Masuk</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="transfusiDarah" id="transfusiDarah" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['transfusiDarah'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>PCR</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="pcr" id="pcr" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['pcr'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>WB</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="wb" id="wb" value="1" type="checkbox" <?= is_null($data_lap) ? null : ($data_lap['wb'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah</label>
                                                    <input type="text" id="jumlahPcrWb" name="jumlahPcrWb" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jumlahPcrWb'] ;?>">
                                                    <small class="form-control-feedback">cc</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Inplan</label>
                                                    <input type="text" id="jenisInplan" name="jenisInplan" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['jenisInplan'] ;?>">
                                                    <small class="form-control-feedback">Bila Menggunakan Inplan</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">NoReg Inplan</label>
                                                    <input type="text" id="noRegInplan" name="noRegInplan" class="form-control form-control" value="<?= is_null($data_lap) ? null : $data_lap['noRegInplan'] ;?>">
                                                    <small class="form-control-feedback">Bila Menggunakan Inplan</small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= base_url('assets/plugins/html5-editor/wysihtml5-0.3.0.js') ?>"></script>
<script src="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.textarea_editor').each(function() {
            $(this).wysihtml5();
        });

        $('.select2').select2();

        $('.form-store').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
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
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.error
                        })
                    }

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success
                        })
                        dataLap()
                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    $("#dokterAnestesi").autocomplete({
        source: "<?php echo base_url('Utilities/ajax_get_dokter'); ?>",
        select: function(event, ui) {
            $('#dokterAnestesi').val(ui.item.nama_dokter);
        }
    });
</script>