<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Templet Laporan Operasi</h4>
            </div>

            <button type="button" class="btn btn-primary add-lap-ok">
                <i class="fas fa-plus"></i> Templet Lap OK General
            </button>

            <button type="button" class="btn btn-primary add-lap-ok-katarak">
                <i class="fas fa-plus"></i> Templet Lap OK Katarak
            </button>

            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>
</div>

<div class="viewmodal"></div>

<script>
    $('.add-lap-ok').click(() => {
        $.ajax({
            method: "GET",
            url: "<?= base_url('TempletLapOk/create') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalcreate_lo_general').modal('show');
            }
        });
    });

    $('.add-lap-ok-katarak').click(() => {
        $.ajax({
            method: "GET",
            url: "<?= base_url('TempletLapOk/createKatarak') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalcreate_lo_katarak').modal('show');
            }
        });
    });

    function dataLap() {
        $.ajax({

            url: "<?php echo base_url('TempletLapOk/index') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
                $('#datatable').dataTable();
            }
        });
    }
    $(document).ready(function() {
        dataLap();
    });
</script>


<?= $this->endSection(); ?>