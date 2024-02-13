<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

            </div>
            <h4 class="card-title">Data Spesialistik Lembar Pengajuan Klaim</h4>
            <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            <div class="table-responsive mt-4 viewdata"></div>
        </div>
    </div>
</div>


<script>
    function datadiagnosaPRB() {
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/referensiSpesialistikLPK') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datadiagnosaPRB();

    });
</script>

<?= $this->endSection(); ?>