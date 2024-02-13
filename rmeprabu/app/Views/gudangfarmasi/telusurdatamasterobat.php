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
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataobat() {
        $.ajax({
            beforeSend: function() {
                $('.viewdata').empty();
                $('.viewdata').html(`<div class="text-center text-danger h5 font-weight-bold">...Sedang Mengambil Data....</div>`);
            },
            url: "<?php echo base_url('TelusurMasterObat/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        setTimeout(() => {
            dataobat();
        }, 1000);


    });
</script>


<?= $this->endSection(); ?>