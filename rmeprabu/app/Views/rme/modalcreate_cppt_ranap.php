<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css') ?>">

<div id="modalcreate_cppt_ranap" class="modal fade"  role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                <h4 class="mb-0 text-white">Form Catatan Perkembangan Pasien Terintegrasi (CPPT)</h4>
                            </div>
                            <div class="card-body">
                                <?php helper('form') ?>
                                <?= form_open('PelayananRawatJalanRME/simpanCPPTRanap', ['class' => 'formdatarme']); ?>
                                <?= csrf_field(); ?>
                                <from action="#">
                                    <div class="form-body">
                                        <div class="row pt-3">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Tanggal Jam</label>
                                                    <input type="text" id="admissionDateTime" name="admissionDateTime" class="form-control form-control-danger" required value="<?= date('d-m-Y G:i:s'); ?>">
                                                </div>
                                                <div class="form-group has-success">
                                                    <label class="control-label">DPJP/Dokter Pemeriksa</label>
                                                    <input type="text" class="form-control" id="doktername" name="doktername" readonly required value="<?= session()->get('firstname'); ?>">
                                                </div>
                                              
                                                <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $referencenumber; ?>">
                                                <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                                                <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                                                <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                                                <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                                                <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                                                <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                                <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <button class="mb-1 btn btn-info" id="caridiagnosa1" type="button"><i class="fas fa-search"></i>Add Template</button>

                                                <button class="mb-1 btn btn-warning" type="button" onclick="cek_histori1('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT</button>

                                                <button class="mb-1 btn btn-success" type="button" onclick="planingFarmakologis('<?= $pasienid ?>', '<?= $referencenumber; ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Planing Farmakologis</button>

                                                <button class="mb-1 btn btn-danger" type="button" onclick="planingNonFarmakologis('<?= $pasienid ?>', '<?= $referencenumber; ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Planing Non Farmakologis</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="button-mic" data-location="subjective1"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Subjective</label>
                                                    <textarea class="form-control textarea_editor" id="subjective1" name="subjective" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="button-mic" data-location="objective1"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Objective</label>
                                                    <textarea class="form-control textarea_editor" id="objective1" name="objective" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="button-mic" data-location="asesmen1"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <div class="form-group has-success">
                                                    <label class="control-label ">Assesment</label>
                                                    <textarea class="form-control textarea_editor" id="asesmen1" name="asesmen" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="button-mic" data-location="planning1"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Planning</label>
                                                    <textarea class="form-control textarea_editor" id="planning1" name="planning" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <label>Diagnosis Primer</label>
                                                <textarea class="form-control" id="diagnosisprimer" name="diagnosisprimer" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Diagnosis Sekunder</label>
                                                <textarea class="form-control" id="diagnosisSekunder" name="diagnosisSekunder" rows="3"></textarea>
                                            </div> -->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                                    </div>
                                </from>
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
<div class="viewmodalmediscppt" style="display:none;"></div>
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
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.error,
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

<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();

        $('.button-mic').on('click', function(e) {
            e.preventDefault();
            var location = $(this).attr('data-location')

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
                    $('#'+location).data("wysihtml5").editor.setValue(finalTranscripts);
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
    $('#caridiagnosa1').click(function(e) {
        e.preventDefault();
        let referencenumber = $('#nomorreferensi').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariTemplateRMERanap_tambah'); ?>",

            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmediscppt').html(response.sukses).show();
                    $('#modalpilihtemplaterme_tambah').modal('show');

                }
            }

        })


    })
</script>

<script>
    function dataCPPT() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTMedistambah') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatacppttambah').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataCPPT();

    });
</script>

<script>
    function cek_histori1(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPTtambah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmediscppt').html(response.sukses).show();
                    $('#modalresume_cppttambah').modal('show');
                }
            }
        });
    }

    function planingFarmakologis (pasienid, referencenumber){
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/planingFarmakologis') ?>",
            data: {
                pasienid: pasienid,
                nomorKunjungan: referencenumber
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalmediscppt').html(response.sukses).show();
                $('#modal_farmakologis').modal('show')
            }
        });
    }

    function planingNonFarmakologis (pasienid, referencenumber){
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/planingNonFarmakologis') ?>",
            data: {
                pasienid: pasienid,
                nomorKunjungan: referencenumber
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalmediscppt').html(response.sukses).show();
                $('#modal_farmakologis').modal('show')
            }
        });
    }
</script>