<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modaldaftarjadwaldokterkontrol" class="modal fade" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Jadwal Praktek Dokter (Sumber Data : Vclaim)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">
                                <div class="row pt-3">
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="control-label">Jenis Kontrol</label>
                                            <select name="filter" id="filter" class="form-control custom-select filter-input">
                                                <option value>Pilih</option>
                                                <option value="1">SPRI</option>
                                                <option value="2">Rencana Kontrol</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Pelayanan</label>
                                            <select name="pelayanan" id="pelayanan" class="select2 filter-input" style="width: 100%">
                                                <option>Pilih</option>
                                                <?php foreach ($pelayanan as $PL) : ?>
                                                    <option value="<?= $PL['bpjscode']; ?>" class="select-pelayanan"><?= $PL['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Pelayanan</label>
                                            <input type="text" name="rencanakontrol" id="rencanakontrol" class="form-control filter-input" autocomplete="off" value="<?= date('Y-m-d'); ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-info carijadwal" id="btn-carijadwal" type="button"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatahistoriSep"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="viewmodalbaru" style="display:none;"></div>
<!-- <script>
    $('.filter-input').on('input apply.daterangepicker', function() {
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#filter').val();
        let pelayanan = $('#pelayanan').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/JadwalDokterKontrolVclaim') ?>",
            dataType: "json",
            data: {
                rencanakontrol: rencanakontrol,
                pelayanan: pelayanan,
                filter: filter
            },
            success: function(response) {
                $('.viewdatahistoriSep').html(response.data);

            }
        });
    });
</script> -->

<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
</script>


<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $('.selectpicker').selectpicker();



        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
                        page: params.page
                    };
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            minimumInputLength: 1,

        });
    });
</script>

<script>
    $('.carijadwal').click(function(e) {
        e.preventDefault();
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#filter').val();
        let pelayanan = $('#pelayanan').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/JadwalDokterKontrolVclaim') ?>",
            type: 'POST',
            data: {
                rencanakontrol: rencanakontrol,
                pelayanan: pelayanan,
                filter: filter
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahistoriSep').html(response.data);

            }
        });
    });
</script>