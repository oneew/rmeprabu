<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pencatatan Kegiatan Harian Pelayanan Rawat Inap (Clinical Pathway)</h4>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {
        $.ajax({
            url: "<?php echo base_url('ClinicalPathway/ambildataDact') ?>",
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