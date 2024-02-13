<div id="modal_farmakologis" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Planing Non Farmakologis</h4>
            </div>

            <div class="modal-body">

                <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                <input type="hidden" id="nomorKunjungan" name="nomorKunjungan" class="form-control" value="<?= $nomorKunjungan; ?>" readonly>
                <div class="mt-4 viewdatariwayattno"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Pakai Planning</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="viewmodalambilresep" style="display:none;"></div>

<script>
    function dataresumePenunjang() {
        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalanRME/resumePlaningNonFarmakologis') ?>",
            data: {
                pasienid: $('#pasienid').val(),
                nomorKunjungan: $('#nomorKunjungan').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatariwayattno').html(response);
            }
        });
    }
    $(document).ready(function() {
        dataresumePenunjang();


    });
</script>