<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>
            <div class="card-title">
                <button type="button" class="btn btn-info btn-rounded daftarpasienlama"><i class="fa fa-plus-circle"></i> Pasien Lama</button>
                <button type="button" class="btn btn-danger btn-rounded daftarpasienbaru"><i class="fa fa-plus-circle"></i> Pasien Baru</button>
                <button type="button" class="btn btn-success btn-rounded daftarkontrol"><i class="fas fa-search"></i> Pasien Kontrol (Vclaim)</button>
                <button type="button" class="btn btn-warning btn-rounded daftarrujukan"><i class="fas fa-search"></i> Pasien Rujukan (Vclaim)</button>
                <button type="button" class="btn btn-dark btn-rounded histori"><i class="fas fa-search"></i> Histori Pelayanan (Vclaim)</button>
                <button type="button" class="btn btn-info btn-rounded dapelFP"><i class="fas fa-search"></i> DaPel FingerPrint (Vclaim)</button>
                <button type="button" class="btn btn-success btn-rounded dataFP"><i class="fas fa-search"></i> Data FingerPrint (Vclaim)</button>

            </div>
            <div class="card-title">
                <button id="print" class="btn btn-info btn-rounded jadwalhfis" type="button"> <span><i class="fas fa-search"></i></span> Dokter HFIS </button>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Register Pasien Rawat Jalan</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Poli</label>
                                <select name="pilihanpoli" id="pilihanpoli" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Poli</option>
                                    <?php foreach ($pilihanpoli as $poli) : ?>
                                        <option value="<?php echo $poli['name']; ?>"><?php echo $poli['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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

            url: "<?php echo base_url('RawatJalan/ambildata') ?>",
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
        let pilihanpoli = $('#pilihanpoli').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                pilihanpoli: pilihanpoli
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

    $('.jadwalhfis').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/JadwalDokter') ?>",
            dataType: "json",
            success: function(response) {
                if (response.suksesjadwal) {
                    $('.viewmodal').html(response.suksesjadwal).show();
                    $('#modaldaftarjadwaldokterkontrol').modal();
                }

            }
        });

    });
</script>





<?= $this->endSection(); ?>