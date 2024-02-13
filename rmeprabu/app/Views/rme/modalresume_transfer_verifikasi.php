<div id="modalresume_transfer_verifikasi" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Dokumen Transfer Pasien</h4>
            </div>

            <div class="modal-body">

                <input type="text" id="noKunjungan" name="noKunjungan" class="form-control" value="<?= $noKunjungan; ?>" readonly>
                <div class="mt-4 viewdataresumetransfer"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>
    function dataresumeTransfer() {
        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatIGDTransferHasilVerifikasi') ?>",
            data: {
                referencenumber: $('#noKunjungan').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresumetransfer').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeTransfer();


    });
</script>