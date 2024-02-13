<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Propinsi</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                    </div>
                </div>
            </form>
            <div class="table-responsive viewpropinsi"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodalpropinsi" style="display:none;"></div>

<script>
    function dataPropinsi() {
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/referensiPropinsi') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewpropinsi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataPropinsi();

    });
</script>
<?= $this->endSection(); ?>