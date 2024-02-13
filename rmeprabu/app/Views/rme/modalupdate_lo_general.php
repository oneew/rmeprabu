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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="mb-0 text-white">UPDATE LAPORAN OPERASI</h4>
                            </div>
                            <div class="card-body">
                                <?php helper('form') ?>
                                <?= form_open('PelayananRawatJalanRME/updateLOGeneral', ['class' => 'formdatarme']); ?>
                                <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= $data['id'] ;?>" readonly>
                                    <div class="form-body">
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="cito" id="cito" value="1" type="checkbox" <?= $data['cito'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Cito</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="elektif" id="elektif" value="1" type="checkbox" <?= $data['elektif'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Elektif</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Tanggal Operasi</label>
                                                    <input type="text" id="datepicker-autoclose" name="admissionDate" class="form-control form-control-danger" value="<?= date("d/m/Y", strtotime($data['admissionDate'])) ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asal Ruangan</label>
                                                    <input type="text" id="asalRuangan" name="asalRuangan" class="form-control form-control-danger" value="<?= $data['asalRuangan']; ?>">
                                                    <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                                    <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label>Kamar Operasi</label>
                                                    <select name="kamarOperasi" id="kamarOperasi" class="select2" style="width: 100%">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($kamarOperasi as $kamar) : ?>
                                                            <option value="<?= $kamar['name'] ;?>" <?= $kamar['name'] == $data['kamarOperasi'] ? 'selected' : '' ;?>><?= $kamar['name'] ;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">SMF/KSM</label>
                                                    <input type="text" id="smfName" name="smfName" class="form-control form-control-danger" value="<?= $data['smfName'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">DPJP</label>
                                                    <input type="text" id="doktername" name="doktername" class="form-control form-control" value="<?= $data['doktername']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Dokter Anestesi</label>
                                                    <input type="text" id="dokterAnestesi" name="dokterAnestesi" class="form-control form-control" value="<?= $data['dokterAnestesi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Perawat/Anestesi</label>
                                                    <textarea id="perawatAnestesi" name="perawatAnestesi" class="form-control" rows="3"><?= $data['perawatAnestesi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Scrub Nurse/ Instrumen</label>
                                                    <input type="text" id="scrubNurse" name="scrubNurse" class="form-control form-control" <?= $data['scrubNurse'] ;?>>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asisten I</label>
                                                    <input type="text" id="asisten1" name="asisten1" class="form-control form-control" value="<?= $data['asisten1'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asisten II</label>
                                                    <input type="text" id="asisten2" name="asisten2" class="form-control form-control" value="<?= $data['asisten2'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Circulation Nurse</label>
                                                    <input type="text" id="circulationNurse" name="circulationNurse" class="form-control form-control" value="<?= $data['circulationNurse'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Posisi Operasi Pasien</label>
                                                    <input type="text" id="posisiOperasi" name="posisiOperasi" class="form-control form-control" value="<?= $data['posisiOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jenis Sayatan</label>
                                                    <input type="text" id="jenisSayatan" name="jenisSayatan" class="form-control form-control" value="<?= $data['jenisSayatan'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Skin Perparasi</label>
                                                <select name="skinPerparasi" id="skinPerparasi" class="select2" style="width: 100%">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($skin as $skin) : ?>
                                                        <option value="<?= $skin['name'] ;?>" <?= $skin['name'] == $data['skinPerparasi'] ? 'selected' : '' ;?>><?= $skin['name'] ;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Jenis Pembedahan</label>
                                                <select name="jenisPembedahan" id="jenisPembedahan" class="select2" style="width: 100%">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($jenisPembedahan as $jenisPembedahan) : ?>
                                                        <option value="<?= $jenisPembedahan['name']; ?>"  <?= $jenisPembedahan['name'] == $data['jenisPembedahan'] ? 'selected' : '' ; ?>><?= $jenisPembedahan['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Diagnosa Pra Bedah</label>
                                                    <input type="text" id="diagnosaPraBedah" name="diagnosaPraBedah" class="form-control form-control" value="<?= $data['diagnosaPraBedah'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Indikasi Operasi</label>
                                                    <textarea id="indikasiOperasi" name="indikasiOperasi" class="form-control" rows="3"><?= $data['indikasiOperasi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jenis Operasi</label>
                                                    <input type="text" id="jenisOperasi" name="jenisOperasi" class="form-control form-control" value="<?= $data['jenisOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Diagnosa Pasca Bedah</label>
                                                    <input type="text" id="diagnosaPascaBedah" name="diagnosaPascaBedah" class="form-control form-control" value="<?= $data['diagnosaPascaBedah'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Mulai Operasi Jam</label>
                                                    <input type="text" id="startDateTimeOp" name="startDateTimeOp" class="form-control form-control" value="<?= date('d-m-Y G:i:s', strtotime($data['startDateTimeOp'])); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Mulai Operasi Jam</label>
                                                    <input type="text" id="stopDateTimeOp" name="stopDateTimeOp" class="form-control form-control" value="<?= date('d-m-Y G:i:s', strtotime($data['stopDateTimeOp'])); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Lama Operasi</label>
                                                    <input type="text" id="lamaOperasi" name="lamaOperasi" class="form-control form-control" value="<?= $data['lamaOperasi'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label class="control-label">Prosedur OP</label>
                                            <textarea id="prosedurOp" name="prosedurOp" class="form-control" rows="3"><?= $data['prosedurOp'] ;?></textarea>
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-md-2 mb-3">
                                                <label>Operasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenOperasi" id="jaringanSpesimenOperasi" value="1" type="checkbox" <?= $data['jaringanSpesimenOperasi'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Aspirasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenAspirasi" id="jaringanSpesimenAspirasi" value="1" type="checkbox" <?= $data['jaringanSpesimenAspirasi'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Katerisasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="jaringanSpesimenkaterisasi" id="jaringanSpesimenkaterisasi" value="1" type="checkbox" <?= $data['jaringanSpesimenkaterisasi'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Lokalisasi</label>
                                                    <input type="text" id="lokalisasi" name="lokalisasi" class="form-control form-control" value="<?= $data['lokalisasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Dikirim Ke PA</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="dikirimPA" id="dikirimPA" value="1" type="checkbox" <?= $data['dikirimPA'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Profilaksis Antibiotik</label>
                                                    <input type="text" id="profilaksisAntibiotik" name="profilaksisAntibiotik" class="form-control form-control" value="<?= $data['profilaksisAntibiotik'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jam Pemberian</label>
                                                    <input type="text" id="jamPemberian" name="jamPemberian" class="form-control form-control" value="<?= $data['jamPemberian'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr10">
                                        <div class="row pt-1">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Jalannya Operasi/ Temuan</label>
                                                    <textarea id="laporanJalanOperasi" name="laporanJalanOperasi" class="textarea_editor form-control" rows="3"><?= $data['laporanJalanOperasi'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Komplikasi Pasca Bedah</label>
                                                    <textarea id="komplikasiPascaBedah" name="komplikasiPascaBedah" class="textarea_editor form-control" rows="2"><?= $data['komplikasiPascaBedah'] ;?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah Perdarahan Hilang</label>
                                                    <input type="text" id="jumlahPerdarahan" name="jumlahPerdarahan" class="form-control form-control" value="<?= $data['jumlahPerdarahan'] ;?>">
                                                    <small class="form-control-feedback">cc</small>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Transfusi Darah Masuk</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="transfusiDarah" id="transfusiDarah" value="1" type="checkbox" <?= $data['transfusiDarah'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>PCR</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="pcr" id="pcr" value="1" type="checkbox" <?= $data['pcr'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>WB</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="wb" id="wb" value="1" type="checkbox" <?= $data['wb'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah</label>
                                                    <input type="text" id="jumlahPcrWb" name="jumlahPcrWb" class="form-control form-control" value="<?= $data['jumlahPcrWb'] ;?>">
                                                    <small class="form-control-feedback">cc</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Inplan</label>
                                                    <input type="text" id="jenisInplan" name="jenisInplan" class="form-control form-control" value="<?= $data['jenisInplan'] ;?>">
                                                    <small class="form-control-feedback">Bila Menggunakan Inplan</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">NoReg Inplan</label>
                                                    <input type="text" id="noRegInplan" name="noRegInplan" class="form-control form-control" value="<?= $data['noRegInplan'] ;?>">
                                                    <small class="form-control-feedback">Bila Menggunakan Inplan</small>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                            Update</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-2 viewdataanak"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
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
        $('.formdatarme').submit(function(e) {
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
                            $('#diagnosa').addClass('form-control-danger');
                            $('.errordiagnosa').html(response.error.diagnosa);
                        } else {
                            $('#diagnosa').removeClass('form-control-danger');
                            $('.errordiagnosa').html('');
                        }

                    } else if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.gagal,

                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalcreate_cppt_ranap').modal('hide');
                                dataReferensiCP();
                            }
                        });

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

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
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

        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $('.button-mic').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#subjective').html(finalTranscripts);
                    $('#subjective').val(finalTranscripts);

                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#anamnesa').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
</script>



<script>
    jQuery('#datepicker-autoclose').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
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