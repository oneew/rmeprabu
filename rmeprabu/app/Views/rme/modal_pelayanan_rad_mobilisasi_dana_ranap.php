<div id="modal_pelayanan_rad_mobilisasi_dana_ranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Pelayanan Pemeriksaan Radiologi</h4>
            </div>

            <div class="modal-body">

                <input type="hidden" id="nomorreferensi" name="nomorreferensi" class="form-control" value="<?= $referencenumber; ?>" readonly>
                <div id="form-filter-tno" style="display: block;">
                    <div class="form-body">
                        <div class="row pt-3">
                            <div class="col-md-12 vieweRad"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="viewmodalexpertise" style="display:none;"></div>


<script>
    function detailRad() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ExpertiseRadRanap') ?>",
            data: {
                journalnumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.vieweRad').html(response.data);
            }
        });
    }
    //$(document).ready(function() {
    detailRad();

    //});
</script>