<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Penelaah Resep (Apoteker)</h4>
                <button type="button" class="btn btn-info btn-sm tomboltambahbanyak"><i class="fa fa-plus-circle"></i> Tambah Data</button>

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

            url: "<?php echo base_url('PenelaahResep/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('PenelaahResep/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal('show');

                }
            });

        });

        $('.tomboltambahbanyak').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('PenelaahResep/formtambahbanyak') ?>",
                dataType: "json",
                beforeSend: function() {
                    $('.viewdata').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    $('.viewdata').html(response.data).show();

                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>