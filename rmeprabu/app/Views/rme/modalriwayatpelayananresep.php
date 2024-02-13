<div id="modalriwayatpelayananresep" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Riwayat Pelayanan Resep</h4>
            </div>

            <div class="modal-body">

                <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                <div class="mt-4 viewdatariwayatresep"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
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

            url: "<?php echo base_url('PelayananRawatJalanRME/resumeRiwayatResep') ?>",
            data: {
                pasienid: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatariwayatresep').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumePenunjang();


    });
</script>