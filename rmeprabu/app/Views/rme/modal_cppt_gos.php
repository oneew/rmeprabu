<div id="modal_cppt_gos" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Riwayat CPPT GOS</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="nomorPasien" name="nomorPasien" class="form-control" value="<?= $pasienid; ?>" readonly>
                <form action="#">
                    <div class="form-body">
                        <div class="col-md-3">
                            <label class="control-label">Nomor Rekam Medis</label>
                            <div class="input-group">
                                <input type="text" name="nomor" id="nomor" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="icon-calender"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="caricppt" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 viewdatacpptGos"></div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#caricppt').click(function(e) {
        e.preventDefault();
        let norm = $('#nomor').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/caridataCPPTGOS') ?>",
            dataType: "json",
            data: {
                norm: norm
            },
            success: function(response) {
                $('.viewdatacpptGos').html(response.data);
            }
        });
    });
    $(document).ready(function() {
        dataresumeCPPTGOS();
        $("#nomor").attr("readonly", false);

    });
</script>