<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

            </div>
            <h4 class="card-title">Update Jadwal Dokter Ke HFIS</h4>
            <h6 class="card-subtitle"> <code>(Sumber Data Ws Antrean Online 2.0)</code></h6>
            <div class="table-responsive mt-4 viewdata"></div>
        </div>
    </div>
</div>


<script>
    function dataListPoli() {
        $.ajax({

            url: "<?php echo base_url('WsAntrean/datareferensiDokterHFIS') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataListPoli();

    });
</script>

<?= $this->endSection(); ?>