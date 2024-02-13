<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Informasi Pasien Rawat Inap</h4>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {
        $.ajax({
            url: "<?php echo base_url('PasienRanap/ambildataJendela') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();
    });
</script>

<?= $this->endSection(); ?>