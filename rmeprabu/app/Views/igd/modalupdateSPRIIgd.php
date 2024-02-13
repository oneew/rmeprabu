<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }
</style>

<div id="modalupdateSPRIIgd" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Update SPRI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $tanggallahir = $pasien['dateofbirth'];
                                    $dob = strtotime($tanggallahir);
                                    $current_time = time();
                                    $age_years = date('Y', $current_time) - date('Y', $dob);
                                    $age_months = date('m', $current_time) - date('m', $dob);
                                    $age_days = date('d', $current_time) - date('d', $dob);

                                    if ($age_days < 0) {
                                        $days_in_month = date('t', $current_time);
                                        $age_months--;
                                        $age_days = $days_in_month + $age_days;
                                    }

                                    if ($age_months < 0) {
                                        $age_years--;
                                        $age_months = 12 + $age_months;
                                    }

                                    $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                                    if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['name']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['code']; ?></h6>
                                        <h6 class="card-subtitle"><?= $cabarpasien; ?></h6>
                                        <h6 class="card-subtitle text-dark"><span class="badge badge-info">NoSep : <?= $noSep; ?></span></h6>
                                        <h6 class="card-subtitle text-dark"><span class="badge badge-danger">NoSPRI : <?= $noSPRI; ?></span></h6>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['address']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['ssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['cardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['dateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <?= form_open('IGD/SimpanUpdateSpri', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <from class="form-horizontal form-material" id="form-filter" method="post">
                                        <div class="form-body">
                                            <div id="slimtest4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"><span class="badge badge-info">Nomor SPRI</span></label>

                                                            <input type="text" id="noSPRI" name="noSPRI" class="form-control" value="<?= $noSPRI; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Nomor Kartu</label>
                                                            <input type="text" class="form-control" id="noKartu" name="noKartu" placeholder="No.Kartu Asuransi" value="<?= $pasien['cardnumber']; ?>" required>
                                                            <input type="hidden" id="journalnumberrajal" name="journalnumberrajal" class="form-control" value="<?= $journalnumber; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Norm</label>
                                                            <input type="text" id="noMR" name="noMR" class="form-control" value="<?= $pasien['code']; ?>" readonly>
                                                            <input type="hidden" id="namaPasien" name="namaPasien" class="form-control" value="<?= $pasien['name']; ?>" readonly>
                                                            <input type="hidden" id="registerdatesep" name="registerdatesep" class="form-control" readonly value="<?= date('Y-m-d'); ?>" readonly>
                                                            <input type="hidden" id="noSep" name="noSep" class="form-control" value="<?= $noSep; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis Pelayanan</label>
                                                            <div class="mb-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio7" name="jnsPelayanan" type="radio" class="custom-control-input" value="2" checked>
                                                                    <span class="custom-control-label">Rawat Jalan</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio8" name="jnsPelayanan" type="radio" class="custom-control-input" value="1">
                                                                    <span class="custom-control-label">Rawat Inap</span>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <?php $diag = explode('-', $diagnosa);
                                                            $diagexplode = $diag[0];
                                                            $diagAwal = str_replace(' ', '', $diagexplode); ?>
                                                            <label class="control-label">DiagnosaMasuk</label>
                                                            <input type="text" id="diagAwal" name="diagAwal" class="form-control" autocomplete="off" value="<?= $diagAwal; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Poli Rujukan</label>
                                                            <input type="text" id="tujuan" name="tujuan" class="form-control" required value="<?= $kode_poli; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal SPRI</label>
                                                            <input type="hidden" id="tglSep" name="tglSep" class="form-control" value="<?= date('Y-m-d'); ?>" readonly required>
                                                            <input type="text" id="tglterbit name=" tglterbit class="form-control" value="<?= $tglTerbit; ?>" readonly required>
                                                            <input type="hidden" id="ppkPelayanan" name="ppkPelayanan" class="form-control" value="0609R002">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">No Sep IGD</label>
                                                            <input type="text" id="noSep" name="noSep" class="form-control" value="<?= $noSep; ?>" readonly>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Dokter</label>
                                                            <select name="kodeDokter" id="kodeDokter" class="select2" style="width: 100%">
                                                                <option>Pilih Dokter</option>
                                                                <?php foreach ($dokterBPJS as $dpjp) : ?>
                                                                    <option data-id="<?= $dpjp['kode']; ?>" data-name="<?= $dpjp['nama']; ?>" value="<?= $dpjp['kode']; ?>" class="select-classroom" <?php if ($dpjp['kode'] == $kodeDokter) { ?> selected="selected" <?php } ?>><?= $dpjp['nama']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">SMF</label>
                                                            <input type="hidden" id="poliKontrol2" name="poliKontrol2" class="form-control" value="<?= $kode_poliBpjs; ?>">
                                                            <select name="poliKontrol3" id="poliKontrol3" class="select2" style="width: 100%" required>
                                                                <option value="">Pilih SMF</option>
                                                                <?php foreach ($namasmf as $NSMF) : ?>
                                                                    <option data-id="<?= $NSMF['id']; ?>" class="select-poliKontrol3" <?php if ($NSMF['bpjscode'] == $poliKontrol) { ?> selected="selected" <?php } ?>><?= $NSMF['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Poli/SMF BPJS</label>
                                                            <input type="hidden" id="poliKontrolRs" name="poliKontrolRs" class="form-control" value="<?= $namapoli; ?>">
                                                            <input type="text" id="poliKontrol" name="poliKontrol" class="form-control" value="<?= $poliKontrol; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if ($tglRencanaKontrol == "") {
                                                        $tglrencana = date('Y-m-d');
                                                    } else {
                                                        $tglrencana = $tglRencanaKontrol;
                                                    }
                                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Rencana Rawat</label>
                                                            <input type="text" id="tglRencanaKontrol" name="tglRencanaKontrol" class="form-control" value="<?= $tglrencana ?>">
                                                            <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </from>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btnsimpan"><i class="fa fa-pencil"></i> Update SPRI</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Column -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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



<script type="text/javascript">
    $(document).ready(function() {

        $("#diagnosa").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>",
            select: function(event, ui) {
                $('#diagnosa').val(ui.item.value);
                $('#icdxname').val(ui.item.name);
                $('#icdx').val(ui.item.code);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#faskesname").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_faskes'); ?>",
            select: function(event, ui) {
                $('#faskesname').val(ui.item.value);
                $('#faskes').val(ui.item.code);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#namafaskes").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_faskes'); ?>",
            select: function(event, ui) {
                $('#namafaskes').val(ui.item.value);
                $('#kodefaskes').val(ui.item.code);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#diagnosamasuk").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>",
            select: function(event, ui) {
                $('#diagnosamasuk').val(ui.item.value);
                $('#namaicdx').val(ui.item.name);
                $('#kodeicdx').val(ui.item.code);
            }
        });

        $('#poliKontrol3').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_poli') ?>",
                'data': {
                    key: $('#poliKontrol3 option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#poliKontrol').val(data.bpjscode);
                    $('#poliKontrolRs').val(data.name);


                    $('#autocomplete-dokter').html('');
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",

                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan SPRI');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'succes',

                            html: 'Pesan: ' + response.pesan + '<br>No.SPRI: ' + response.response.noSPRI + '<br>Nama: ' + response.response.nama + '<br>Tanggal Lahir: ' + response.response.tglLahir +
                                '<br>Jenis Kelamin: ' + response.response.kelamin + '<br>Tanggal Recncana Rawat: ' + response.response.tglRencanaKontrol +
                                '<br>Dokter: ' + response.response.namaDokter,

                        });
                    } else {
                        Swal.fire({
                            html: 'Pesan: ' + response.pesan,
                            icon: 'error',
                            title: 'error'

                        });
                    }
                }
            });
            return false;
        });
    });
</script>