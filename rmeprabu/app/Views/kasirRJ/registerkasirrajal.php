<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pelayanan Pasien Rawat Jalan Belum Validasi</h4>
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
                                <select name="metodepembayarancari" id="metodepembayarancari" class="select2 filter-input" style="width: 100%">
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

            url: "<?php echo base_url('KasirRJ/ambildataBelumValidasi') ?>",
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
        let metodepembayaran = $('#metodepembayarancari').val();
        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/cariBelumValidasi') ?>",
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

                url: "<?php echo base_url('RawatJalan/register') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldaftarrawatjalan').modal('show');

                }
            });

        });

        $('.daftarpasienlama').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('RawatJalan/registerpasienlama') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldaftarrajalpasienlama').modal('show');

                }
            });

        });

        $('.daftarpasienbaru').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('RawatJalan/registerpasienbaru') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldaftarrajalpasienbaru').modal('show');

                }
            });

        });

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
    $('.daftarrujukan').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/registerrujukan') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaldaftarrujukan').modal('show');

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

    $('.dapelFP').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/DataPelayananFingerPrint') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalDaPelFingerPrint').modal('show');

            }
        });

    });

    $('.dataFP').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/DataPesertaFingerPrint') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalDataFingerPrint').modal('show');

            }
        });

    });
</script>





<?= $this->endSection(); ?>