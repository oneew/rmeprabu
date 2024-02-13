<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pasien Bedah Sentral Pra Bedah</h4>
            </div>
            <div class="mt-5 table-responsive viewdata"> </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ambildataRMEPraBedah') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();
    });
</script>
<?= $this->endSection(); ?>