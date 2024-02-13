<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

            </div>
            <h4 class="card-title">Ketersediaan Kamar Aplicares</h4>
            <div class="table-responsive mt-4 viewdata"></div>
        </div>
    </div>
</div>


<script>
    function dataketersediaanakamar() {
        $.ajax({

            url: "<?php echo base_url('aplicares/ketersediaan_kamar') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataketersediaanakamar();

    });
</script>

<?= $this->endSection(); ?>