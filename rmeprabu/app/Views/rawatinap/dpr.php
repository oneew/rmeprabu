<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h4 class="card-title">Data Pasien Rawat Inap</h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">

            </div>

            <div class="table-responsive mt-4">
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

            url: "<?php echo base_url('rawatinap/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();
        // $('.tomboltambah').click(function(e) {
        //     e.preventDefault();
        //     $.ajax({

        //         url: "<?php echo base_url('perawat/formtambah') ?>",
        //         dataType: "json",
        //         success: function(response) {
        //             $('.viewmodal').html(response.data).show();
        //             $('#modaltambah').modal('show');

        //         }
        //     });

        // });

    });
</script>

<?= $this->endSection(); ?>