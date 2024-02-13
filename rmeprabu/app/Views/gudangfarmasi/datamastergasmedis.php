<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">

            <button type="button" class="btn btn-info btn-rounded tomboltambah"><i class="fa fa-plus-circle"></i> Tambah Data Gas Medis</button>
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

            url: "<?php echo base_url('GASMEDIS/ambildata') ?>",
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

<script>
    $(document).ready(function() {
        dataobat();
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('GASMEDIS/tambahGASMEDIS') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaladdgasmedis').modal('show');

                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>