<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>

<meta http-equiv="refresh" content="<?php echo $sec ?>">
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

            </div>
            <h4 class="card-title">Update Ketersediaan Kamar Aplicares</h4>
            <div class="table-responsive mt-4 viewdata"></div>
        </div>
    </div>
</div>


<script>
    function updateketersediaankamar() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('aplicares/update_kamar_aplicares') ?>",
            updateType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        updateketersediaankamar();

    });
</script>

<?= $this->endSection(); ?>