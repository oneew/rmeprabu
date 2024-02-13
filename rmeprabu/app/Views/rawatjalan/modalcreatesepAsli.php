<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }
</style>

<div id="modalcreatesepAsli" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pembuatan SEP</h4>
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
                                <?= form_open('RawatJalan/simpanSEP', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <from class="form-horizontal form-material" id="form-filter" method="post">
                                        <div class="form-body">
                                            <div id="slimtest4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Asal Rujukan</label>
                                                            <div class="switch">
                                                                <label>Faskes1
                                                                    <input type="checkbox" value="1" name="asalRujukan" id="asalRujukan"><span class="lever"></span>RS/Faskes2</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="text" class="form-control" id="noKartu" name="noKartu" placeholder="No.Kartu Asuransi" value="<?= $pasien['cardnumber']; ?>" required>


                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-cardrajalpasinsep" type="button">Cek!</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Norm</label>
                                                            <input type="text" id="noMR" name="noMR" class="form-control" readonly value="<?= $pasien['code']; ?>" readonly>
                                                            <input type="hidden" id="registerdatesep" name="registerdatesep" class="form-control" readonly value="<?= date('Y-m-d'); ?>" readonly>
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
                                                            <label class="control-label">No Rujukan</label>
                                                            <input type="text" id="noRujukan" name="noRujukan" class="form-control" autocomplete="off" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Rujukan</label>
                                                            <input type="text" id="tglRujukan" name="tglRujukan" class="form-control" autocomplete="off" value="<?= date('Y-m-d'); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Faskep Perujuk</label>
                                                            <input type="text" id="ppkRujukan" name="ppkRujukan" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">DiagnosaMasuk</label>
                                                            <input type="text" id="diagAwal" name="diagAwal" class="form-control" autocomplete="off" required value="<?= $icdx; ?>">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Poli Rujukan</label>
                                                            <input type="text" id="tujuan" name="tujuan" class="form-control" required value="<?= $kode_poli; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Sep</label>
                                                            <input type="text" id="tglSep" name="tglSep" class="form-control" value="<?= date('Y-m-d'); ?>" readonly required>
                                                            <input type="hidden" id="ppkPelayanan" name="ppkPelayanan" class="form-control" value="1020R001">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">NoTlp</label>
                                                            <input type="text" id="noTelp" name="noTelp" class="form-control" value="<?= $pasien['telephone']; ?>">
                                                            <input type="hidden" id="journalnumberrajal" name="journalnumberrajal" class="form-control" value="<?= $journalnumber; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Catatan</label>
                                                            <input type="text" id="catatan" name="catatan" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Poli Eksekutif</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" value="1" name="eksekutif"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">COB</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" value="1" name="cob"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Katarak</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" value="1" name="katarak"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">KLL</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" value="1" id="lakalantas" name="lakalantas"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis KLL</label>
                                                            <select name="ketLakalantas" id="ketLakalantas" class="select2" style="width: 100%" disabled>
                                                                <option>Pilih Jenis KLL</option>
                                                                <?php foreach ($jeniskll as $jeniskll) : ?>
                                                                    <option value="<?= $jeniskll['code']; ?>" class="select-code"><?= $jeniskll['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Penjamin KLL</label>
                                                            <select name="penjamin" id="penjamin" class="select2" style="width: 100%" disabled>
                                                                <option>Pilih Penjamin KLL</option>
                                                                <?php foreach ($penjaminKLL as $PK) : ?>
                                                                    <option value="<?= $PK['code']; ?>" class="select-code"><?= $PK['penjamin']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal KLL</label>
                                                            <input type="text" id="tglKejadian" name="tglKejadian" value="<?= date('Y-m-d'); ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Keterangan</label>
                                                            <input type="text" id="keterangan" name="keterangan" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Suplesi</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" value="1" id="suplesi" name="suplesi"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">No SEP Suplesi</label>
                                                            <input type="text" id="nosuplesi" name="nosuplesi" class="form-control" disabled>
                                                            <input type="hidden" id="lakalantas2" name="lakalantas2" class="form-control" value="0">
                                                            <input type="hidden" id="suplesi2" name="suplesi2" class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Provinsi</label>
                                                            <select name="kdPropinsi" id="kdPropinsi" class="select2" style="width: 100%" disabled>
                                                                <option>Pilih Propinsi</option>
                                                                <?php foreach ($Propinsi as $prop) : ?>
                                                                    <option data-id="<?= $prop['kode']; ?>" data-name="<?= $prop['nama']; ?>" value="<?= $prop['kode']; ?>" class="select-classroom"><?= $prop['nama']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kabupaten</label>
                                                            <select name="kdKabupaten" id="kdKabupaten" class="select2" style="width: 100%" disabled>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kecamatan</label>
                                                            <select name="kdKecamatan" id="kdKecamatan" class="select2" style="width: 100%" disabled>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">No Surat Kontrol</label>
                                                            <input type="text" id="noSurat" name="noSurat" class="form-control">
                                                            <input type="hidden" class="form-control" id="searchBy" name="searchBy" value="RSS" required>
                                                            <input type="hidden" class="form-control" id="asalRujukanSep" name="asalRujukanSep" value="1" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">DPJP</label>
                                                            <select name="kodeDPJP" id="kodeDPJP" class="select2" style="width: 100%">
                                                                <option>Pilih Dokter</option>
                                                                <?php foreach ($dokterBPJS as $dpjp) : ?>
                                                                    <option data-id="<?= $dpjp['kode']; ?>" data-name="<?= $dpjp['nama']; ?>" value="<?= $dpjp['kode']; ?>" class="select-classroom" <?php if ($dpjp['kode'] == $kodeDPJP) { ?> selected="selected" <?php } ?>><?= $dpjp['nama']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">DPJP Layan</label>
                                                            <select name="dpjpLayan" id="dpjpLayan" class="select2" style="width: 100%">
                                                                <option>Pilih Dpjp Layan</option>
                                                                <?php foreach ($list as $dok) : ?>
                                                                    <option data-id="<?= $dok['kode_bpjs']; ?>" data-name="<?= $dok['name']; ?>" value="<?= $dok['kode_bpjs']; ?>" class="select-classroom"><?= $dok['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="hidden" id="dokterpemeriksa" name="dokterpemeriksa" class="form-control" readonly value="<?= $dokterpemeriksa; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tujuan Kunjungan</label>
                                                            <select name="tujuanKunj" id="tujuanKunj" class="select2" style="width: 100%">
                                                                <option value="">Pilih Tujuan Kunjungan</option>
                                                                <?php foreach ($tujuanKunjungan as $tk) : ?>
                                                                    <option value="<?= $tk['code']; ?>" class="select-classroom"><?= $tk['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="hidden" id="klsRawat" name="klsRawat" class="form-control">
                                                            <input type="hidden" id="user" name="user" class="form-control" value="Coba Ws">
                                                            <input type="hidden" id="idrajal" name="idrajal" class="form-control" value="<?= $idrajal; ?>">
                                                            <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Flag Procedure</label>
                                                            <select name="flagProcedure" id="flagProcedure" class="select2" style="width: 100%">
                                                                <option value="">Pilih Flag Procedure</option>
                                                                <?php foreach ($flagprocedure as $fp) : ?>
                                                                    <option value="<?= $fp['code']; ?>" class="select-classroom"><?= $fp['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Tujuan Penunjang</label>
                                                            <select name="kdPenunjang" id="kdPenunjang" class="select2" style="width: 100%">
                                                                <option value="">Pilih Penunjang</option>
                                                                <?php foreach ($penunjangsep as $pnj) : ?>
                                                                    <option value="<?= $pnj['code']; ?>" class="select-classroom"><?= $pnj['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Assesment Pelayanan</label>
                                                            <select name="assesmentPel" id="assesmentPel" class="select2" style="width: 100%">
                                                                <option value="">Pilih Assesmen</option>
                                                                <?php foreach ($assesmentpelayanansep as $ass) : ?>
                                                                    <option value="<?= $ass['code']; ?>" class="select-classroom"><?= $ass['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </from>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btnsimpan"><i class="fa fa-plus"></i> Create SEP</button>
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
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#kecamatan").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_wilayah'); ?>",
            select: function(event, ui) {
                $('#namakecamatan').val(ui.item.kecamatan);
                $('#kelurahan').val(ui.item.kelurahan);
                $('#kabupaten').val(ui.item.kabupaten);
                $('#propinsi').val(ui.item.propinsi);
                $('#kodewilayah').val(ui.item.kodewilayah);
                $('#area').val(ui.item.kabupaten);
                $('#namasubarea').val(ui.item.namasubarea);
            }
        });
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
                    $('.btnsimpan').html('Simpan Sep');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            html: 'No Sep: ' + response.response.sep.noSep + '<br>No.Kartu: ' + response.response.sep.peserta.noKartu + '<br>Nama: ' + response.response.sep.peserta.nama + '<br>Tanggal Lahir: ' + response.response.sep.peserta.tglLahir +
                                '<br>Jenis Kelamin: ' + response.response.sep.peserta.kelamin + '<br>Jenis Peserta: ' + response.response.sep.peserta.jnsPeserta + '<br>Hak kelas: ' + response.response.sep.peserta.hakKelas + '<br>Tanggal Sep: ' + response.response.sep.tglSep +
                                '<br>Diagnosa: ' + response.response.sep.diagnosa,

                            icon: 'success',
                            title: 'succes'

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


<script type="text/javascript">
    $(document).ready(function() {});
    $('#btn-cardrajalpasinsep').on('click', function() {
        if ($('#noKartu').val() == '' || $('#registerdatesep').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $('#noKartu').val(),
                    date: $('#registerdatesep').val()
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.hakKelas.kode + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,
                            icon: 'success',
                            text: parseResponse.metaData.message,
                        }).then((result) => {
                            if (result.value) {
                                $('#klsRawat').val(parseResponse.response.peserta.hakKelas.kode);
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('Bpjs/check_rujukan_kartu') ?>",
                                    data: {
                                        card: $('#noKartu').val(),
                                        searchBy: $('#searchBy').val(),
                                        asalRujukan: $('#asalRujukan').val()

                                    },
                                    success: function(response) {
                                        let parseResponse = JSON.parse(response);
                                        if (parseResponse.metaData.code == 200) {

                                            Swal.fire({
                                                html: 'Asal Faskes: ' + parseResponse.response.asalFaskes + '<br> Nama: ' + parseResponse.response.rujukan.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.rujukan.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.rujukan.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.rujukan.peserta.tglLahir +
                                                    '<br>Hak Kelas: ' + parseResponse.response.rujukan.peserta.hakKelas.kode +
                                                    '<br>Kode Faskes Perujuk: ' + parseResponse.response.rujukan.provPerujuk.kode + '<br>Nama Faskes 1: ' + parseResponse.response.rujukan.provPerujuk.nama +
                                                    '<br>Keluhan: ' + parseResponse.response.rujukan.keluhan +
                                                    '<br>No rujukan: ' + parseResponse.response.rujukan.noKunjungan + '<br>Kode Diagnosa: ' + parseResponse.response.rujukan.diagnosa.kode + '<br>Nama Diagnosa: ' + parseResponse.response.rujukan.diagnosa.nama + '<br>Rujukan Ke: ' + parseResponse.response.rujukan.poliRujukan.nama,
                                                icon: 'success',
                                                text: parseResponse.metaData.message,
                                            });
                                            $('#diagAwal').val(parseResponse.response.rujukan.diagnosa.kode);
                                            $('#tujuan').val(parseResponse.response.rujukan.poliRujukan.kode);
                                            $('#noRujukan').val(parseResponse.response.rujukan.noKunjungan);
                                            $('#ppkRujukan').val(parseResponse.response.rujukan.provPerujuk.kode);
                                            $('#tglRujukan').val(parseResponse.response.rujukan.tglKunjungan);
                                            $('#noTelp').val(parseResponse.response.rujukan.mr.noTelepon);

                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                //title: 'Error',
                                                text: parseResponse.metaData.message

                                            });
                                        }
                                    }
                                })
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
</script>

<script type="text/javascript">
    $('#kdPropinsi').on('change', function() {


        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('RawatJalan/ajax_propinsiBPJS') ?>",
            data: {
                kelas: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);
                $('#kdKabupaten').empty();

                if (data[0] == null) {

                    $('#kdKabupaten').append("<option>Pilihan kosong</option>");
                    $('#kdKabupaten').attr('disabled', 'disabled');
                } else {

                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#kdKabupaten').append("<option value='" + item.kode + "' data-room='" + item.nama + "'>" + item.nama + "</option>");
                    }

                    $('#kdKabupaten').removeAttr('disabled');
                }


                $('#kdPropinsi').val($('#classroom option:selected').data('name'));
                $('#kdKecamatan').empty();
                $('#kdKecamatan').attr('disabled', 'disabled');

            }
        })
    });

    $('#kdKabupaten').on('change', function() {
        // url disesuaikan
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('RawatJalan/ajax_kabupatenBPJS') ?>",
            data: {
                room: $(this).val(),
                kelas: $('#kdPropinsi').val()
            },
            success: function(response) {
                let data = JSON.parse(response);

                $('#kdKecamatan').empty();

                if (data[0] == null) {
                    $('#kdKecamatan').append("<option>Pilihan kosong</option>");
                    $('#kdKecamatan').attr('disabled', 'disabled');
                } else {
                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#kdKecamatan').append("<option value='" + item.kode + "'>" + item.nama + "</option>");
                    }

                    $('#kdKecamatan').removeAttr('disabled');
                }


            }
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#diagAwal2").autocomplete({
            source: "<?php echo base_url('RawatJalan/diagnosaBPJS'); ?>",
            data: {
                diagnosa: $('#diagAwal').val()
            },
            select: function(event, ui) {
                //alert(ui);
                $('#diagAwal').val(ui.response.response.diagnosa.nama);
                //$('#namaicdx').val(ui.item.name);
                //$('#kodeicdx').val(ui.item.code);

            }
        });
    });
</script>


<script type="text/javascript">
    $('#asalRujukan').on('change', function() {
        if ($('#asalRujukan').val() == 1) {
            $('#asalRujukan').val(0);
            $('#searchBy').val('RS');
            $('#asalRujukanSep').val(2);
        } else {
            $('#asalRujukan').val(1);
            $('#searchBy').val('RSS');
            $('#asalRujukanSep').val(1);
        }
        //alert($('#asalRujukan').val());
    })
</script>


<script type="text/javascript">
    $('#lakalantas').on('change', function() {
        if ($('#lakalantas').val() == 1) {
            $('#tglKejadian').removeAttr('disabled');
            $('#keterangan').removeAttr('disabled');
            $('#kdPropinsi').removeAttr('disabled');
            $('#penjamin').removeAttr('disabled');
            $('#lakalantas').val(0);
            $('#lakalantas2').val(1);
        } else {
            $('#tglKejadian').attr('disabled', 'disabled');
            $('#keterangan').attr('disabled', 'disabled');
            $('#kdPropinsi').attr('disabled', 'disabled');
            $('#penjamin').attr('disabled', 'disabled');
            $('#keterangan').val('');
            $('#lakalantas').val(1);
            $('#lakalantas2').val(0);
        }
        //alert($('#lakalantas').val());
    })
</script>

<script type="text/javascript">
    $('#suplesi').on('change', function() {
        if ($('#suplesi').val() == 1) {
            $('#nosuplesi').removeAttr('disabled');
            $('#suplesi').val(0);
            $('#suplesi2').val(1);
        } else {
            $('#nosuplesi').attr('disabled', 'disabled');
            $('#suplesi').val(1);
            $('#suplesi2').val(0);
            $('#nosuplesi').val('');

        }
        //alert($('#suplesi').val());
    })
</script>