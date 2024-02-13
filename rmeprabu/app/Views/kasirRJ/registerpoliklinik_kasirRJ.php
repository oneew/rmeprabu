<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="validasipembayaran-tab" data-toggle="tab" href="#validasipembayaran" role="tab" aria-controls="validasipembayaran" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-money"></i></span> <span class="hidden-xs-down">Validasi Pembayaran</span></a> </li>
                <li class="nav-item"> <a class="nav-link" id="DVP-tab" data-toggle="tab" href="#DVP" role="tab" aria-controls="DVP"><span class="hidden-sm-up"><i class="ti-credit-card"></i></span> <span class="hidden-xs-down">Data Validasi</span></a></li>
                <li class="nav-item"> <a class="nav-link" id="beritaacara-tab" data-toggle="tab" href="#beritaacara" role="tab" aria-controls="beritaacara"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">Berita Acara Setoran</span></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-sm-up"><i class="ti-control-shuffle"></i></span> <span class=" hidden-xs-down">Laporan</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" role="tab" data-toggle="tab" aria-controls="dropdown1">Rekap pendapatan</a>
                        <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" role="tab" data-toggle="tab" aria-controls="dropdown2">Berita Acara</a>
                    </div>
                </li>
            </ul>

            <div class="tab-content tabcontent-border p-3" id="myTabContent">
                <div role="tabpanel" class="tab-pane fade show active" id="validasipembayaran" aria-labelledby="validasipembayaran-tab">
                    <form action="#">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Poliklinik</label>
                                        <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Poliklinik</option>
                                            <?php foreach ($poli as $p) : ?>
                                                <option value="<?php echo $p['name']; ?>"><?php echo $p['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">NoRekamMedis</label>
                                        <input type="text" name="norm" id="norm" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Tgl Pelayanan</label>
                                        <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive viewdata"></div>
                </div>
                <div class="tab-pane fade" id="DVP" role="tabpanel" aria-labelledby="DVP-tab">
                    <form action="#">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Poliklinik</label>
                                        <select name="polivalidasi" id="polivalidasi" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Poliklinik</option>
                                            <?php foreach ($poli as $p) : ?>
                                                <option value="<?php echo $p['name']; ?>"><?php echo $p['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">NoRekamMedis</label>
                                        <input type="text" name="normvalidasi" id="normvalidasi" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pasien</label>
                                        <input type="text" name="patientnamevalidasi" id="patientnamevalidasi" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Metode Pembayaran</label>
                                        <select name="metodepembayaranvalidasi" id="metodepembayaranvalidasi" class="select2 filter-input" style="width: 100%">
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
                                        <input type="text" name="DateOutvalidasi" id="DateOutvalidasi" class="form-control daterange filter-input" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive viewvalidasi"></div>
                </div>
                <div class="tab-pane fade" id="beritaacara" role="tabpanel" aria-labelledby="beritaacara-tab">
                    <form action="#">
                        <div class="form-body">

                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Poliklinik</label>
                                        <select name="poliberitaacara" id="poliberitaacara" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Poliklinik</option>
                                            <?php foreach ($poli as $p) : ?>
                                                <option value="<?php echo $p['name']; ?>"><?php echo $p['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">NoRekamMedis</label>
                                        <input type="text" name="normberitaacara" id="normberitaacara" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pasien</label>
                                        <input type="text" name="patientnameberitaacara" id="patientnameberitaacara" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Metode Pembayaran</label>
                                        <select name="metodepembayaranberitaacara" id="metodepembayaranberitaacara" class="select2 filter-input" style="width: 100%">
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
                                        <input type="text" name="DateOutberitaacara" id="DateOutberitaacara" class="form-control daterange filter-input" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive viewberitaacara"></div>
                </div>
            </div>
            <div class="viewmodalbayar" style="display:none;"></div>
        </div>
    </div>
</div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('KasirRJ/ambildata') ?>",
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
        let poli = $('#poli').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<script>
    function dataRegisterPolivalidasi() {
        $.ajax({

            url: "<?php echo base_url('KasirRJ/ambildatavalidasi') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewvalidasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPolivalidasi();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let patientname = $('#patientnamevalidasi').val();
        let norm = $('#normvalidasi').val();
        let metodepembayaran = $('#metodepembayaranvalidasi').val();
        let DateOut = $('#DateOutvalidasi').val();
        let poli = $('#polivalidasi').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/caridataregisterpolivalidasi') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
            },
            success: function(response) {
                $('.viewvalidasi').html(response.data);

            }
        });
    });
</script>



<script>
    function dataRegisterPoliberitaacara() {
        $.ajax({

            url: "<?php echo base_url('KasirRJ/ambildataberitaacara') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewberitaacara').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoliberitaacara();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let patientname = $('#patientnameberitaacara').val();
        let norm = $('#normberitaacara').val();
        let metodepembayaran = $('#metodepembayaranberitaacara').val();
        let DateOut = $('#DateOutberitaacara').val();
        let poli = $('#poliberitaacara').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/caridataregisterpoliberitaacara') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
            },
            success: function(response) {
                $('.viewberitaacara').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>