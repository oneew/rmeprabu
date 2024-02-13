<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div id="modalupdateHFIS" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">

                <h4 class="modal-title text-white" id="warning-header-modalLabel">Update Jadwal HFIS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php helper('form'); ?>
            <?= form_open('WsAntrean/SimpanUpdateHFIS', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <from class="validation-wizard wizard-circle updatedatanik" id="form-update-nik" method="post">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Dokter</label>
                                    <input type="text" id="namadokter" autocomplete="off" name="namadokter" class="form-control" value="<?= $namadokter; ?>">
                                    <input type="hidden" id="kodedokter" autocomplete="off" name="kodedokter" class="form-control" value="<?= $kodedokter; ?>">
                                </div>
                            </div>
                        </div>

                        <!--/span-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kode Poli</label>
                                    <input type="text" id="kodepoli" autocomplete="off" name="kodepoli" class="form-control" value="<?= $kodepoli; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kode Sub Spesialis</label>
                                    <input type="text" id="kodesubspesialis" autocomplete="off" name="kodesubspesialis" class="form-control" value="<?= $kodesubspesialis; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Hari</label>
                                    <select class="select2" style="width: 100%;" id="hari" name="hari">
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                        <option value="6">Sabtu</option>
                                        <option value="7">Minggu</option>
                                        <option value="8">Hari Libur Nasional</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Mulai</label>
                                    <input type="text" id="buka" autocomplete="off" name="buka" class="form-control" value="08:00">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jam Selesai</label>
                                    <input type="text" id="tutup" autocomplete="off" name="tutup" class="form-control" value="14:00">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>

            </div>
            </from>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan</button>

                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>

        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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

                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan Update HFIS');
                },
                success: function(response) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'success',
                        timer: 5000
                    });

                }
            });
            return false;
        });
    });
</script>