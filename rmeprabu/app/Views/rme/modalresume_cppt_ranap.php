<div id="modalresume_cppt_ranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Catatan Perkembangan Pasien Terintegrasi (CPPT)</h4>
                <h6 class="modal-title" id="myModalLabel">Nama : <?= $pasienname; ?>[<?= $pasienid; ?>] DOB : <?= $dob; ?> Ruangan : <?= $ruangan; ?> [DPJP : <?= $dpjp; ?>]</h6>
            </div>

            <div class="modal-body">

                <input type="hidden" id="noKunjungan" name="noKunjungan" class="form-control" value="<?= $noKunjungan; ?>" readonly>
                <div id="loader">
                    <h3><i class="fa fa-spin fa-spinner "></i> Harap Tunggu !!!</h3>
                </div>
                <div class="mt-4 viewdataresumecppt">
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


<script>
    function dataresumeCPPTAll() {
        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTAllProfesi') ?>",
            data: {
                noKunjungan: $('#noKunjungan').val()
            },
            dataType: "json",
            beforeSend: function(){
                $('#loader').addClass('d-block')
                $('#loader').removeClass('d-none')
            },
            complete: function(){
                $('#loader').addClass('d-none')
                $('#loader').removeClass('d-block')
            },
            success: function(response) {
                $('.viewdataresumecppt').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeCPPTAll();


    });
</script>