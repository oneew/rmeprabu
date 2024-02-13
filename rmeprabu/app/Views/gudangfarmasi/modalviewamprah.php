<div id="modalviewamprah" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Amprah : No Surat Amprah #[<?= $noamprah; ?>]</h4>
                <input type="hidden" class="form-control" id="journalnumber_permintaan_kegudang" name="journalnumber_permintaan_kegudang" value="<?= $noamprah; ?>" readonly required>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdataamparahkegudang"></div>
                            </div>
                        </div </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


<script>
    function detailpermintaankegidang() {
        $.ajax({
            url: "<?php echo base_url('DistribusiAmprahFarmasi/resumeDetailPermintaan') ?>",
            data: {
                journalnumber: $('#journalnumber_permintaan_kegudang').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataamparahkegudang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        detailpermintaankegidang();
    });
</script>