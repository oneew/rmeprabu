<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
            </div>
            <div class="table-responsive mt-4">
                <h4 class="card-title">Data Pasien Rawat Inap => Order Pelayanan Bank Darah</h4>
                <p class="card-text viewdata">
                </p>

            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {
        $.ajax({

            url: "<?php echo base_url('OrderBD/ambildata') ?>",
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