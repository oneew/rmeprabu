<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div id="modalsetetiket" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <h4 class="modal-title text-white" id="warning-header-modalLabel"><?= $row['name']; ?> [<?= $row['code']; ?>] [<?= $row['uom']; ?>]</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?= form_open('FarmasiPelayananRanap/Update_cara_pakai', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <from class="validation-wizard wizard-circle updatedatanik" id="form-update-nik" method="post">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Aturan Pakai</label>
                                    <select name="aturanpakai" id="aturanpakai" class="select2" style="width: 100%">
                                        <option value="-">-</option>
                                        <?php foreach ($aturanpakai as $ap) : ?>
                                            <option value="<?= $ap['name']; ?>" <?php if ($ap['name'] == $row['eticket_aturan']) { ?> selected="selected" <?php } ?>><?= $ap['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="id" autocomplete="off" name="id" class="form-control" value="<?= $row['id'] ?>">
                        <!--/span-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Cara Pakai</label>
                                    <select name="carapakai" id="carapakai" class="select2" style="width: 100%">
                                        <option value="-">-</option>
                                        <?php foreach ($carapakai as $cara) : ?>
                                            <option value="<?= $cara['name']; ?>" <?php if ($cara['name'] == $row['eticket_carapakai']) { ?> selected="selected" <?php } ?>><?= $cara['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Petunjuk</label>
                                    <select name="carapetunjuk" id="carapetunjuk" class="select2" style="width: 100%">
                                        <option value="-">-</option>
                                        <?php foreach ($carapetunjuk as $capet) : ?>
                                            <option value="<?= $capet['name']; ?>" <?php if ($capet['name'] == $row['eticket_petunjuk']) { ?> selected="selected" <?php } ?>><?= $capet['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Pagi</label>
                                    <select class="select2" style="width: 100%;" id="pagi" name="pagi">
                                        <option value="1" <?php if ($row['pagi'] == 1) echo "selected"; ?>>Y</option>
                                        <option value="0" <?php if ($row['pagi'] == 0) echo "selected"; ?>>T</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Siang</label>
                                    <select class="select2" style="width: 100%;" id="siang" name="siang">
                                        <option value="1" <?php if ($row['siang'] == 1) echo "selected"; ?>>Y</option>
                                        <option value="0" <?php if ($row['siang'] == 0) echo "selected"; ?>>T</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Sore</label>
                                    <select class="select2" style="width: 100%;" id="sore" name="sore">
                                        <option value="1" <?php if ($row['sore'] == 1) echo "selected"; ?>>Y</option>
                                        <option value="0" <?php if ($row['sore'] == 0) echo "selected"; ?>>T</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Malam</label>
                                    <select class="select2" style="width: 100%;" id="malam" name="malam">
                                        <option value="1" <?php if ($row['malam'] == 1) echo "selected"; ?>>Y</option>
                                        <option value="0" <?php if ($row['malam'] == 0) echo "selected"; ?>>T</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Signa 1</label>
                                    <input type="text" id="signa1" autocomplete="off" name="signa1" class="form-control" value="<?php echo number_format($row['signa1'], 0, ",", "."); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Signa 2</label>
                                    <input type="text" id="signa2" autocomplete="off" name="signa2" class="form-control" value="<?php echo number_format($row['signa2'], 0, ",", "."); ?>">
                                </div>
                            </div>
                        </div>

                        <!--/span-->
                    </div>
                <?php endforeach; ?>
            </div>
            </from>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupdatenikbaru"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-info waves-effect btnprintetiket" data-id="<?= $row['id']; ?>"> <i class="ti-printer"></i></button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>

        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        $('.updatedatanik').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnupdatenikbaru').attr('disable', 'disabled');
                    $('.btnupdatenikbaru').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnupdatenikbaru').removeAttr('disable');
                    $('.btnupdatenikbaru').html('Simpan');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.gagal,

                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalupdatenik').modal('hide');

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
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
                                //$('#modalsetetiket').modal('hide');
                                detail();

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
        $('.btnprintetiket').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('FarmasiPelayananRajal/printetiket') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=400");
        })
    });
</script>