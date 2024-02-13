<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
            </div>
            <div class="card-title">
                <button type="button" class="btn btn-info btn-rounded daftarkontrol"><i class="fas fa-search"></i> Pasien Rencana Rawat (Vclaim)</button>
                <button type="button" class="btn btn-danger btn-rounded daftarpasienbaru"><i class="fa fa-plus-circle"></i> Pendaftaran Pasien Bayi</button>
                <button type="button" class="btn btn-success btn-rounded histori"><i class="fas fa-search"></i> Histori Pelayanan (Vclaim)</button>

            </div>
            <div class="table-responsive mt-4">
                <h4 class="card-title">Data Pasien Rawat Jalan & IGD Akan Dirawat</h4>
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

            url: "<?php echo base_url('PendaftaranRanap/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();


    });

    $('.daftarkontrol').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/registerkontrol') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaldaftarkontrol').modal('show');

            }
        });

    });
    $('.histori').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/historipelayananSep') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalhistoripelayananSep').modal('show');

            }
        });

    });
    $('.daftarpasienbaru').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('IGD/registerpasienbaru') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaldaftarigdpasienbaru').modal('show');

            }
        });

    });
</script>

<?= $this->endSection(); ?>