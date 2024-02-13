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

<div id="modalcreate_lo_katarak" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                <h4 class="mb-0 text-white"><?= is_null($data_katarak) ? 'Tambah Templet Laporan Operasi Katarak' : 'Update Templet Laporan Operasi Katarak' ;?> </h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('TempletLapOk/storeKatarak') ;?>" method="POST" class="form-katarak">
                                    <?= csrf_field() ;?>
                                    <input type="hidden" name="id_katarak" value="<?= is_null($data_katarak) ? null : $data_katarak['id'] ;?>">
                                    <div class="form-group">
                                        <label class="control-label">Nama Tindakan</label>
                                        <input type="text" id="nama" name="nama" class="form-control form-control-danger" value="<?= is_null($data_katarak) ? null : $data_katarak['nama'] ;?>">
                                    </div>
                                    <div class="form-body">
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="od" id="od" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['od'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> OD</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label></label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        <input name="os" id="os" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['os'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> OS</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Cataract Grade</label>
                                                    <input type="text" id="cataractGrade" name="cataractGrade" class="form-control form-control-danger" value="<?= is_null($data_katarak) ? '-' : $data_katarak['cataractGrade'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Note</label>
                                                    <input type="text" id="noteOp" name="noteOp" class="form-control form-control-danger" value="<?= is_null($data_katarak) ? '-' : $data_katarak['noteOp'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">UCVA</label>
                                                    <input type="text" id="ucva" name="ucva" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['ucva'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">BCVA</label>
                                                    <input type="text" id="bcva" name="bcva" class="form-control form-control-danger" required value="<?= is_null($data_katarak) ? '-' : $data_katarak['bcva'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Retinometry</label>
                                                    <input type="text" id="retinometry" name="retinometry" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['retinometry'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">K1</label>
                                                    <input type="text" id="k1" name="k1" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['k1'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">K2</label>
                                                    <input type="text" id="k2" name="k2" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['k2'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">AXL</label>
                                                    <input type="text" id="axl" name="axl" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['axl'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">ACD</label>
                                                    <input type="text" id="acd" name="acd" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['acd'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">LT</label>
                                                    <input type="text" id="lt" name="lt" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['lt'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Formula</label>
                                                    <input type="text" id="formula" name="formula" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['formula'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Target Emmetropia With IOL Power</label>
                                                    <input type="text" id="emetropia" name="emetropia" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['emetropia'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Visus</label>
                                                    <input type="text" id="visus" name="visus" class="form-control form-control" value="<?= is_null($data_katarak) ? '-' : $data_katarak['visus'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Type Operasi</label>
                                                    <input type="text" class="form-control" id="typeOperasi" name="typeOperasi" value="<?= is_null($data_katarak) ? '-' : $data_katarak['typeOperasi'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Scrub</label>
                                                    <input type="text" class="form-control" id="scrub" name="scrub" value="<?= is_null($data_katarak) ? '-' : $data_katarak['scrub'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Cukator</label>
                                                    <input type="text" class="form-control" id="cukator" name="cukator" value="<?= is_null($data_katarak) ? '-' : $data_katarak['cukator'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr10">
                                        <div class="row pt-1">
                                            <div class="col-md-2 mb-3">
                                                <label>Anesthesia</label>
                                                <select name="anestehesia" id="anestehesia" class="select2" style="width: 100%">
                                                    <?php foreach ($anesthesia as $anes) : ?>
                                                        <option value="<?= $anes['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['anestehesia'] == $anes['name'] ? 'selected' : null) ;?>><?= $anes['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Approach</label>
                                                <select name="approach" id="approach" class="select2" style="width: 100%">
                                                    <?php foreach ($approach as $approach) : ?>
                                                        <option value="<?= $approach['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['approach'] == $approach['name'] ? 'selected' : null) ;?>><?= $approach['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Capsulotomy (CCC)</label>
                                                <select name="capsulotomy" id="capsulotomy" class="select2" style="width: 100%">
                                                    <?php foreach ($capsulotomy as $capsul) : ?>
                                                        <option value="<?= $capsul['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['capsulotomy'] == $capsul['name'] ? 'selected' : null) ;?>><?= $capsul['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Hydrodissection</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="hydrodissection" id="hydrodissection" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['hydrodissection'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Nucleus Management</label>
                                                <select name="nucleus" id="nucleus" class="select2" style="width: 100%">
                                                    <?php foreach ($nucleus as $nucleus) : ?>
                                                        <option value="<?= $nucleus['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['nucleus'] == $nucleus['name'] ? 'selected' : null) ;?>><?= $nucleus['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Phaco Technique</label>
                                                <select name="phaco" id="phaco" class="select2" style="width: 100%">
                                                    <?php foreach ($phaco as $phaco) : ?>
                                                        <option value="<?= $phaco['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['phaco'] == $phaco['name'] ? 'selected' : null) ;?>><?= $phaco['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>IOL Placement</label>
                                                <select name="iol" id="iol" class="select2" style="width: 100%">
                                                    <?php foreach ($iol as $iol) : ?>
                                                        <option value="<?= $iol['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['iol'] == $iol['name'] ? 'selected' : null) ;?>><?= $iol['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Stitch</label>
                                                <select name="stitch" id="stitch" class="select2" style="width: 100%">
                                                    <?php foreach ($stitch as $stitch) : ?>
                                                        <option value="<?= $stitch['name']; ?>" <?= is_null($data_katarak) ? null : ($data_katarak['stitch'] == $stitch['name'] ? 'selected' : null) ;?>><?= $stitch['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Phaco Macchine</label>
                                                    <input type="text" class="form-control" id="phacoMachine" name="phacoMachine" value="<?= is_null($data_katarak) ? '-' : $data_katarak['phacoMachine'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Phaco Time</label>
                                                    <input type="text" class="form-control" id="phacoTime" name="phacoTime" value="<?= is_null($data_katarak) ? '-' : $data_katarak['phacoTime'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Irigating Solution</label>
                                                    <input type="text" class="form-control" id="irigatingSolution" name="irigatingSolution" value="<?= is_null($data_katarak) ? null : $data_katarak['irigatingSolution'] ;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Komplikasi</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak<input name="komplikasi" id="komplikasi" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['komplikasi'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Posterior Capsul Ruptur</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="posterior" id="posterior" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['posterior'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Vitreus Prolapse</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="vitreus" id="vitreus" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['vitreus'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Vitrectomy</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="vitrectomy" id="vitrectomy" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['vitrectomy'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Retained Lens Material</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="retained" id="retained" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['retained'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Cortex Left</label>
                                                <div class="switch">
                                                    <label class="d-flex flex-column flex-sm-row">
                                                        Tidak <input name="cortex" id="cortex" value="1" type="checkbox" <?= is_null($data_katarak) ? null : ($data_katarak['cortex'] == '1' ? 'checked' : null) ;?>><span class="lever switch-col-blue"></span> Ya</label>
                                                </div>
                                            </div>

                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
                                    </div>
                                </from>
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
        $('.select2').select2();

        $('.textarea_editor').each(function() {
            $(this).wysihtml5();
        });
        $('.form-katarak').submit(function(e) {
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
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        })
                        dataLap()
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.error,
                        })
                    }
                }
            });
            return false;
        });
    });
</script>