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
        content: 'Keterangan Operasi';
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
        content: '#';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>


<div id="modalupdate_lo_katarak" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                <h4 class="mb-0 text-white">UPDATE LAPORAN OPERASI KATARAK</h4>
                            </div>
                            <div class="card-body">
                                <?php helper('form') ?>
                                <?= form_open('PelayananRawatJalanRME/updateLOKatarak', ['class' => 'formdatarme']); ?>
                                <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= $data['id'] ;?>">
                                    <div class="form-body">
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="od" id="od" value="1" type="checkbox" <?= $data['od'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> OD</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="os" id="os" value="1" type="checkbox" <?= $data['os'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> OS</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Cataract Grade</label>
                                                    <input type="text" id="cataractGrade" name="cataractGrade" class="form-control form-control-danger" value="<?= $data['cataractGrade'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Note</label>
                                                    <input type="text" id="noteOp" name="noteOp" class="form-control form-control-danger" value="<?= $data['noteOp'] ;?>">

                                                    <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $data['poliklinikname']; ?>">
                                                    <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                                    <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">UCVA</label>
                                                    <input type="text" id="ucva" name="ucva" class="form-control form-control" value="<?= $data['ucva'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">BCVA</label>
                                                    <input type="text" id="bcva" name="bcva" class="form-control form-control-danger" required value="<?= $data['bcva'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Retinometry</label>
                                                    <input type="text" id="retinometry" name="retinometry" class="form-control form-control" value="<?= $data['retinometry'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">K1</label>
                                                    <input type="text" id="k1" name="k1" class="form-control form-control" value="<?= $data['k1'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">K2</label>
                                                    <input type="text" id="k2" name="k2" class="form-control form-control" value="<?= $data['k2'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">AXL</label>
                                                    <input type="text" id="axl" name="axl" class="form-control form-control" value="<?= $data['axl'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">ACD</label>
                                                    <input type="text" id="acd" name="acd" class="form-control form-control" value="<?= $data['acd'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">LT</label>
                                                    <input type="text" id="lt" name="lt" class="form-control form-control" value="<?= $data['lt'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Formula</label>
                                                    <input type="text" id="formula" name="formula" class="form-control form-control" value="<?= $data['formula'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Target Emmetropia With IOL Power</label>
                                                    <input type="text" id="emetropia" name="emetropia" class="form-control form-control" value="<?= $data['emetropia'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Visus</label>
                                                    <input type="text" id="visus" name="visus" class="form-control form-control" value="<?= $data['visus'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Nama Pasien</label>
                                                    <input type="text" class="form-control" id="pasienname" name="pasienname" required value="<?= $data['pasienname']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Nomor Rekam Medis</label>
                                                    <input type="text" class="form-control" id="pasienid" name="pasienid" required value="<?= $data['pasienid']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Intra Operative Date</label>
                                                    <input type="date" class="form-control" id="intraOperativeDate" name="intraOperativeDate" required value="<?= $data['intraOperativeDate'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Time</label>
                                                    <input type="text" class="form-control" id="intraOperativeTime" name="intraOperativeTime" value="<?= $data['intraOperativeTime'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Type Operasi</label>
                                                    <input type="text" class="form-control" id="typeOperasi" name="typeOperasi" value="<?= $data['typeOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Nama Dokter</label>
                                                    <input type="text" class="form-control" id="doktername" name="doktername" required value="<?= session()->get('firstname'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Perawat</label>
                                                <select name="anesthesilogist" id="anesthesilogist" class="select2" style="width: 100%" required>
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($perawat_katarak as $pk) : ?>
                                                        <option value="<?= $pk['name']; ?>" <?= $data['anesthesilogist'] == $pk['name'] ? 'selected' : null ;?>><?= $pk['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Scrub</label>
                                                    <input type="text" class="form-control" id="scrub" name="scrub" value="<?= $data['scrub'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Cukator</label>
                                                    <input type="text" class="form-control" id="cukator" name="cukator" value="<?= $data['cukator'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr10">
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label>Anesthesia</label>
                                                <select name="anestehesia" id="anestehesia" class="select2" style="width: 100%">
                                                    <?php foreach ($anesthesia as $anes) : ?>
                                                        <option value="<?= $anes['name']; ?>" <?= $data['anestehesia'] == $anes['name'] ? 'selected' : null ;?>><?= $anes['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Approach</label>
                                                <select name="approach" id="approach" class="select2" style="width: 100%">
                                                    <?php foreach ($approach as $approach) : ?>
                                                        <option value="<?= $approach['name']; ?>" <?= $approach['name'] == $data['approach'] ? 'selected' : null ;?>><?= $approach['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Capsulotomy (CCC)</label>
                                                <select name="capsulotomy" id="capsulotomy" class="select2" style="width: 100%">
                                                    <?php foreach ($capsulotomy as $capsul) : ?>
                                                        <option value="<?= $capsul['name']; ?>" <?= $capsul['name'] == $data['capsulotomy'] ? 'selected' : null; ?>><?= $capsul['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Hydrodissection</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="hydrodissection" id="hydrodissection" value="1" type="checkbox" <?= $data['hydrodissection'] == '1' ? 'checked' : null ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Nucleus Management</label>
                                                <select name="nucleus" id="nucleus" class="select2" style="width: 100%">
                                                    <?php foreach ($nucleus as $nucleus) : ?>
                                                        <option value="<?= $nucleus['name']; ?>" <?= $data['nucleus'] == $nucleus['name'] ? 'selected' : null ;?>><?= $nucleus['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Phaco Technique</label>
                                                <select name="phaco" id="phaco" class="select2" style="width: 100%">
                                                    <?php foreach ($phaco as $phaco) : ?>
                                                        <option value="<?= $phaco['name']; ?>" <?= $data['phaco'] == $phaco['name'] ? 'selected' : null;?>><?= $phaco['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>IOL Placement</label>
                                                <select name="iol" id="iol" class="select2" style="width: 100%">
                                                    <?php foreach ($iol as $iol) : ?>
                                                        <option value="<?= $iol['name']; ?>" <?= $data['iol'] == $iol['name'] ? 'selected' : null ;?>><?= $iol['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Stitch</label>
                                                <select name="stitch" id="stitch" class="select2" style="width: 100%">
                                                    <?php foreach ($stitch as $stitch) : ?>
                                                        <option value="<?= $stitch['name']; ?>" <?= $data['stitch'] == $stitch['name'] ? 'selected' : null ;?>><?= $stitch['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Phaco Macchine</label>
                                                    <input type="text" class="form-control" id="phacoMachine" name="phacoMachine" value="<?= $data['phacoMachine'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Phaco Time</label>
                                                    <input type="text" class="form-control" id="phacoTime" name="phacoTime" value="<?= $data['phacoTime'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Irigating Solution</label>
                                                    <input type="text" class="form-control" id="irigatingSolution" name="irigatingSolution" value="<?= $data['irigatingSolution'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Komplikasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="komplikasi" id="komplikasi" value="1" type="checkbox" <?= $data['komplikasi'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Posterior Capsul Ruptur</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="posterior" id="posterior" value="1" type="checkbox" <?= $data['posterior'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Vitreus Prolapse</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="vitreus" id="vitreus" value="1" type="checkbox" <?= $data['vitreus'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Vitrectomy</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="vitrectomy" id="vitrectomy" value="1" type="checkbox" <?= $data['vitrectomy'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Retained Lens Material</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="retained" id="retained" value="1" type="checkbox" <?= $data['retained'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Cortex Left</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="cortex" id="cortex" value="1" type="checkbox" <?= $data['cortex'] == '1' ? 'checked' : '' ;?>><span class="lever switch-col-blue"></span> Ya</label>
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