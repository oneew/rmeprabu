<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>
            <div class="card-title">
                <button type="button" class="btn btn-info btn-rounded daftarpasienlama"><i class="fa fa-plus-circle"></i> Pendaftaran Pasien Lama</button>
                <button type="button" class="btn btn-danger btn-rounded daftarpasienbaru"><i class="fa fa-plus-circle"></i> Pendaftaran Pasien Baru</button>
                <button type="button" class="btn btn-dark btn-rounded histori"><i class="fas fa-search"></i> Histori Pelayanan (Vclaim)</button>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Register Pasien Instalasi Gawat Darurat</h4>
            </div>

            <form action="#">
                <div class="form-body">

                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Metode Pembayaran</label>
                                <select name="metodepembayaran" id="metodepembayaran" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($list as $b) : ?>
                                        <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tgl Pelayanan</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive viewdata">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('IGD/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        dataRegisterPoli();
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('IGD/register') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldaftarigd').modal('show');

                }
            });

        });

        $('.daftarpasienlama').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('IGD/registerpasienlama') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldaftarigdpasienlama').modal('show');

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
        $('.histori').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('IGD/historipelayananSep') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalhistoripelayananSep').modal('show');

                }
            });

        });

    });
</script>


<?= $this->endSection(); ?>