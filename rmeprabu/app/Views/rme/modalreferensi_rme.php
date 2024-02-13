<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css') ?>">


<div id="modal_diagnosa_rme" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="mb-0 text-white">Form Perubahan Diagnosa RME</h4>
                            </div>
                            <div class="card-body">
                                <?php helper('form') ?>
                                <?= form_open('PelayananRawatJalanRME/updateDataDiagnosaRME', ['class' => 'formviewrme']); ?>
                                <?= csrf_field(); ?>
                                <from action="#">
                                    <div class="form-body">
                                        <input type="hidden" name="id" id="id" value="<?= $id; ?>" readonly>
                                        <input type="hidden"class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('email'); ?>">
                                        <div class="row pt-3">
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">SMF</label>
                                                    <input type="text" id="smf" name="smf" class="form-control form-control-danger" required value="<?= $smf; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Keterangan</label>
                                                    <input type="text" id="keterangan" name="keterangan" class="form-control form-control-danger" required value="<?= $keterangan; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Subjective</label>
                                                    <textarea class="textarea_editor form-control" id="subjective" name="subjective" rows="15" placeholder="subjective ..."><?= $subjective; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Objective</label>
                                                    <textarea class="textarea_editor form-control" id="objective" name="objective" rows="15" placeholder="objective ..."><?= $objective; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Asesmen</label>
                                                    <textarea class="textarea_editor form-control" id="asesmen" name="asesmen" rows="15" placeholder="asesment ..."><?= $asesmen; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Planning</label>
                                                    <textarea class="textarea_editor form-control" id="planning" name="planning" rows="15" placeholder="planning ..."><?= $planning; ?></textarea>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-warning btnsimpan"> <i class="fa fa-check"></i>
                                            Update</button>
                                        <button type="button" class="btn btn-danger btnhapus" data-id="<?= $id; ?>"> <i class="fa fa-trash"></i>
                                            Hapus</button>
                                        <button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Cancel</button>
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

        $('.formviewrme').submit(function(e) {
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
                                $('#modal_diagnosa_rme').modal('hide');
                                dataReferensiCP();
                            }
                        });

                    }
                }


            });
            return false;
        });

        $('.btnhapus').click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Apakah anda yakin untuk menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        $.ajax({
                            type: "post",
                            url: '<?= base_url('PelayananRawatJalanRME/deleteDataDiagnosaRME'); ?>',
                            data: {
                                id: id,
                            },
                            beforeSend: function() {
                                $('.btnhapus').attr('disable', 'disabled');
                                $('.btnhapus').html('<i class="fa fa-spin fa-spinner "></i>');
                            },
                            complete: function() {
                                $('.btnhapus').removeAttr('disable');
                                $('.btnhapus').html('Hapus');
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
                                            $('#modal_diagnosa_rme').modal('hide');
                                            dataReferensiCP();
                                        }
                                    });

                                }
                            }
                        })
                    )
                }
            })
        })
    });
</script>