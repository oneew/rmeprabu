<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pasien Rawat Inap</h4>
            </div>
            <div class="card-title text-right">
                <button type="button" class="btn btn-success btn-rounded daftarpindahcabar"><i class="fas fa-search"></i> Data Pindah Cara Bayar</button>
            </div>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('KasirRanap/ambildatapasienranapPaymentChange') ?>",
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

<script>
    $('.daftarpindahcabar').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('KasirRanap/dataPindahCabar') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaldatapindahcabar').modal('show');

            }
        });

    });
</script>

<?= $this->endSection(); ?>