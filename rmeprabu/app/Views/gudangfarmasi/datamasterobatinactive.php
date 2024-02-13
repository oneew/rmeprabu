<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">

            <div class="table-responsive mt-4">
                <h4 class="card-title"></h4>
                <p class="card-text viewdata">
                </p>
            </div>
        </div>
    </div>
</div>


<div class="viewmodal" style="display:none;"></div>

<script>
    function dataobat() {
        $.ajax({

            url: "<?php echo base_url('MasterObat/ambildataInactive') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataobat();


    });
</script>


<?= $this->endSection(); ?>