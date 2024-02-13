<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css') ?>">

<div id="modalcreate_cppt_rajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                <h4 class="mb-0 text-white">Form Catatan Perkembangan Pasien Terintegrasi (CPPT)</h4>
                            </div>
                            <div class="card-body">
                                <?php helper('form') ?>
                                <?= form_open('PelayananRawatJalanRME/simpanCPPTRad', ['class' => 'formdatarme']); ?>
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
                                                <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= session()->get('firstname'); ?>">
                                                <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $referencenumber; ?>">
                                                <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                                                <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                                                <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                                                <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                                                <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                                                <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                                <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                                <input type="hidden" class="form-control" id="asalPasien" name="asalPasien" required value="<?= $asalPasien; ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Profesi</label>
                                                <select name="kelompokCPPT" id="kelompokCPPT" class="select2" style="width: 100%" required>
                                                    <option value="">Pilih</option>
                                                    <option value="Dokter">Dokter</option>
                                                    <option value="Dokter Radiologi">Dokter Radiologi</option>
                                                    <option value="Dokter Laboratorium">Dokter Laboratorium</option>
                                                    <option value="PERAWAT">Perawat</option>
                                                    <option value="Apoteker">Apoteker</option>
                                                    <option value="Ahli Gizi">Ahli Gizi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="button-mic"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Subjective</label>
                                                    <textarea class="textarea_editor form-control" id="subjective" name="subjective" rows="6" placeholder="subjective ..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Objective</label>
                                                    <textarea class="textarea_editor form-control" id="objective" name="objective" rows="6" placeholder="objective ..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Assesment</label>
                                                    <textarea class="textarea_editor form-control" id="asesmen" name="asesmen" rows="6" placeholder="asesmen ..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Planning</label>
                                                    <textarea class="textarea_editor form-control" id="planning" name="planning" rows="6" placeholder="asesmen ..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
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
                                $('#modalcreate_cppt_rajal').modal('hide');
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