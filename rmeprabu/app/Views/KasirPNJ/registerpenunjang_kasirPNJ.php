<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="../css/style.css" rel="stylesheet">
<link href="../css/colors/default-dark.css" id="theme" rel="stylesheet">

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

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
                    <p>
                    <div class="card-title">

                    </div>

                    <form action="#">
                        <div class="form-body">

                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pelayanan</label>
                                        <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Pelayanan</option>
                                            <?php foreach ($penunjang as $p) : ?>
                                                <option value="<?php echo $p['code']; ?>"><?php echo $p['name']; ?></option>
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

                    <div class="table-responsive viewdata">

                    </div>

                    </p>
                </div>
                <div class="tab-pane fade" id="DVP" role="tabpanel" aria-labelledby="DVP-tab">
                    <p>
                    <form action="#">
                        <div class="form-body">

                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pelayanan</label>
                                        <select name="polivalidasi" id="polivalidasi" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Pelayanan</option>
                                            <?php foreach ($poli as $p) : ?>
                                                <option value="<?php echo $p['code']; ?>"><?php echo $p['name']; ?></option>
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
                                        <label class="control-label">Tgl Validasi</label>
                                        <input type="text" name="DateOutvalidasi" id="DateOutvalidasi" class="form-control daterange filter-input" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive viewvalidasi">

                    </div>
                    </p>
                </div>
                <div class="tab-pane fade" id="beritaacara" role="tabpanel" aria-labelledby="beritaacara-tab">
                    <p>
                    <form action="#">
                        <div class="form-body">

                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pelayanan</label>
                                        <select name="poliberitaacara" id="poliberitaacara" class="select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Pelayanan</option>
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
                                        <label class="control-label">Tgl Validasi kasir</label>
                                        <input type="text" name="DateOutberitaacara" id="DateOutberitaacara" class="form-control daterange filter-input" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive viewberitaacara">

                    </div>
                    </p>
                </div>

            </div>








        </div>
    </div>
</div>
</div>




<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('KasirRAD/ambildata') ?>",
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
            url: "<?php echo base_url('KasirRAD/caridataregisterpoli') ?>",
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

            url: "<?php echo base_url('KasirRAD/ambildatavalidasiPNJ') ?>",
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
            url: "<?php echo base_url('KasirRAD/caridataregisterpolivalidasiPNJ') ?>",
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

            url: "<?php echo base_url('KasirRAD/ambildataberitaacara') ?>",
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
            url: "<?php echo base_url('KasirRAD/caridataregisterpoliberitaacara') ?>",
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








<script src="../assets/plugins/moment/moment.js"></script>
<script src="../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="../assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="../assets/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
<script src="../assets/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="../assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker();

    /*******************************************/
    // Date & Time
    /*******************************************/
    $('.datetime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });

    /*******************************************/
    //Calendars are not linked
    /*******************************************/
    $('.timeseconds').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        timePickerSeconds: true,
        locale: {
            format: 'MM-DD-YYYY h:mm:ss'
        }
    });

    /*******************************************/
    // Single Date Range Picker
    /*******************************************/
    $('.singledate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });

    /*******************************************/
    // Auto Apply Date Range
    /*******************************************/
    $('.autoapply').daterangepicker({
        autoApply: true,
    });

    /*******************************************/
    // Calendars are not linked
    /*******************************************/
    $('.linkedCalendars').daterangepicker({
        linkedCalendars: false,
    });

    /*******************************************/
    // Date Limit
    /*******************************************/
    $('.dateLimit').daterangepicker({
        dateLimit: {
            days: 7
        },
    });

    /*******************************************/
    // Show Dropdowns
    /*******************************************/
    $('.showdropdowns').daterangepicker({
        showDropdowns: true,
    });

    /*******************************************/
    // Show Week Numbers
    /*******************************************/
    $('.showweeknumbers').daterangepicker({
        showWeekNumbers: true,
    });

    /*******************************************/
    // Date Ranges
    /*******************************************/
    $('.dateranges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    /*******************************************/
    // Always Show Calendar on Ranges
    /*******************************************/
    $('.shawCalRanges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    });

    /*******************************************/
    // Top of the form-control open alignment
    /*******************************************/
    $('.drops').daterangepicker({
        drops: "up" // up/down
    });

    /*******************************************/
    // Custom button options
    /*******************************************/
    $('.buttonClass').daterangepicker({
        drops: "up",
        buttonClasses: "btn",
        applyClass: "btn-info",
        cancelClass: "btn-danger"
    });

    /*******************************************/
    // Language
    /*******************************************/
    $('.localeRange').daterangepicker({
        ranges: {
            "Aujourd'hui": [moment(), moment()],
            'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Les 7 derniers jours': [moment().subtract('days', 6), moment()],
            'Les 30 derniers jours': [moment().subtract('days', 29), moment()],
            'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
            'le mois dernier': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        locale: {
            applyLabel: "Vers l'avant",
            cancelLabel: 'Annulation',
            startLabel: 'Date initiale',
            endLabel: 'Date limite',
            customRangeLabel: 'SÃ©lectionner une date',
            // daysOfWeek: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi','Samedi'],
            daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
            monthNames: ['Janvier', 'fÃ©vrier', 'Mars', 'Avril', 'ÐœÐ°i', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            firstDay: 1
        }
    });
</script>
<?= $this->endSection(); ?>