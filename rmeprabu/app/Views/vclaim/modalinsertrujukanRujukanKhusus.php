<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }
</style>

<?php
$attr_eksekutif = $poliEksekutif == "Ya" ? 'checked' : '';
$attr_cob = $cob == "Ya" ? 'checked' : '';
$attr_katarak = $katarak == "Ya" ? 'checked' : '';
$attr_lakaLantas = $lakaLantas == 1 ? 'checked' : '';
$attr_suplesi = $suplesi == 1 ? 'checked' : '';
?>

<div id="modalinsertrujukanRujukanKhusus" class="modal fade" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Insert Rencana Rujukan Antar Rumah Sakit</h4>
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
                                        $gambar = '../assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years <= 5)) {
                                        $gambar = '../assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = '../assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = '../assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = '../assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = '../assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 60)) {

                                        $gambar = '../assets/images/users/priatua.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 60)) {

                                        $gambar = '../assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['name']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['code']; ?></h6>
                                        <h6 class="card-subtitle"><?= $cabarpasien; ?></h6>
                                        <h6 class="card-subtitle text-dark">NoSep : <?= $noSep; ?></h6>
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
                                <?= form_open('RawatJalan/simpanRencanaRujukan', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <from class="form-horizontal form-material" id="form-filter" method="post">
                                        <div class="form-body">
                                            <div id="slimtest4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="text" class="form-control" id="noKartu" name="noKartu" placeholder="No.Kartu Asuransi" value="<?= $pasien['cardnumber']; ?>" required>
                                                            <input type="hidden" class="form-control" id="nama" name="nama" placeholder="No.Kartu Asuransi" value="<?= $pasien['name']; ?>" required>
                                                            <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                                            <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-cardrajalpasinsep" type="button">Cek!</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Norm</label>
                                                            <input type="text" id="noMR" name="noMR" class="form-control" readonly value="<?= $pasien['code']; ?>" readonly>
                                                            <input type="hidden" id="registerdatesep" name="registerdatesep" class="form-control" readonly value="<?= date('Y-m-d'); ?>" readonly>
                                                            <input type="hidden" id="hakKelas" name="hakKelas" class="form-control" readonly>
                                                            <input type="hidden" id="jnsPeserta" name="jnsPeserta" class="form-control" readonly>
                                                            <input type="hidden" id="kelamin" name="kelamin" class="form-control" readonly>
                                                            <input type="hidden" id="tglLahir" name="tglLahir" class="form-control" readonly>
                                                            <input type="hidden" id="noRujukan" name="noRujukan" class="form-control" autocomplete="off" value="<?= $noRujukan; ?>">
                                                            <input type="hidden" id="tglRujukan" name="tglRujukan" class="form-control" autocomplete="off" value="<?= $tglRujukan; ?>">
                                                            <input type="hidden" id="ppkRujukan" name="ppkRujukan" class="form-control" autocomplete="off" value="<?= $ppkRujukan; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <?php $diag = explode('-', $diagnosa);
                                                            $diagexplode = $diag[0];
                                                            $diagAwal = str_replace(' ', '', $diagexplode); ?>
                                                            <label class="control-label"></label>
                                                            <input type="hidden" id="diagAwal" name="diagAwal" class="form-control" autocomplete="off" value="<?= $diagAwal; ?>">
                                                            <input type="text" id="namadiagAwal" name="namadiagAwal" class="form-control" autocomplete="off" readonly>
                                                            <input type="hidden" id="tujuan" name="tujuan" class="form-control" required value="<?= $kode_poli; ?>">
                                                            <input type="hidden" id="noTelp" name="noTelp" class="form-control" value="<?= $noTelp; ?>">
                                                            <input type="hidden" id="catatan" name="catatan" class="form-control" value="<?= $catatan; ?>">
                                                            <input type="hidden" id="noSurat" name="noSurat" class="form-control">
                                                            <input type="hidden" id="dokterpemeriksa" name="dokterpemeriksa" class="form-control" readonly value="<?= $dokterpemeriksa; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-caridiagnosa" type="button"><i class="fas fa-search"></i> Cari Diagnosa</button>
                                                            </div>

                                                        </div>
                                                        <small class="form-control-feedback text-danger"> Disi Diagnosa Rujukan</small>
                                                    </div>
                                                </div>
                                                <div class="row">


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Sep</label>
                                                            <input type="text" id="tglSep" name="tglSep" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                                            <input type="hidden" id="ppkPelayanan" name="ppkPelayanan" class="form-control" value="1020R001">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">NoSep</label>
                                                            <input type="text" id="noSep" name="noSep" class="form-control" value="<?= $noSep; ?>" readonly>
                                                            <input type="hidden" id="klsRawat" name="klsRawat" class="form-control">
                                                            <input type="hidden" id="user" name="user" class="form-control" value="Coba Ws">
                                                            <input type="hidden" id="idrajal" name="idrajal" class="form-control" value="<?= $idrajal; ?>">
                                                            <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                            <input type="hidden" id="statuspasienpulang" name="statuspasienpulang" class="form-control" readonly>
                                                            <input type="hidden" id="noSEP" name="noSEP" class="form-control" value="<?= $noSep; ?>" readonly>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Dokter Penanggung Jawab</label>
                                                            <select name="kodeDokter" id="kodeDokter" class="select2" style="width: 100%">
                                                                <option>Pilih Dokter</option>
                                                                <?php foreach ($dokterBPJS as $dpjp) : ?>
                                                                    <option data-id="<?= $dpjp['kode']; ?>" data-name="<?= $dpjp['nama']; ?>" value="<?= $dpjp['kode']; ?>" class="select-classroom" <?php if ($dpjp['kode'] == $kodeDPJP) { ?> selected="selected" <?php } ?>><?= $dpjp['nama']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Surat Rujukan</label>
                                                            <input type="text" id="tglRujukan" name="tglRujukan" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                            <small class="form-control-feedback text-danger"> Disi Tanggal Surat Rujukan</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Rencana Kunjungan</label>
                                                            <input type="text" id="tglRencanaKunjungan" name="tglRencanaKunjungan" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                            <small class="form-control-feedback text-danger"> Disi Tanggal Tanggal Rencana Kunjungan</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group has-success">
                                                            <label class="control-label">Tipe Rujukan</label>
                                                            <select name="tipeRujukan" id="tipeRujukan" class="select2" style="width: 100%">
                                                                <option value="0">Penuh</option>
                                                                <option value="1">Partial</option>
                                                                <option value="2">Balik PRB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group has-success">
                                                            <label class="control-label">Jenis Pelayanan</label>
                                                            <select name="jnsPelayanan" id="jnsPelayanan" class="select2" style="width: 100%">
                                                                <option value="1">Rawat Inap</option>
                                                                <option value="2">Rawat Jalan</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="hidden" id="ppkDirujuk" name="ppkDirujuk" class="form-control">
                                                            <input type="text" id="namappkDirujuk" name="namappkDirujuk" class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-carifaskes" type="button"><i class="fas fa-search"></i> Cari</button>
                                                            </div>
                                                        </div>
                                                        <small class="form-control-feedback text-danger"> Disi Tujuan Rujukan</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="hidden" id="poliRujukan" name="poliRujukan" class="form-control">
                                                            <input type="text" id="namapoliRujukan" name="namapoliRujukan" class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger" id="btn-carispesialistik" type="button"><i class="fas fa-search"></i> Spesialistik</button>
                                                                <button class="btn btn-info" id="btn-caripoli" type="button"><i class="fas fa-search"></i> Non</button>
                                                            </div>
                                                        </div>
                                                        <small class="form-control-feedback text-danger"> Disi Tujuan Pelayanan</small>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group has-success">
                                                            <label class="control-label">Catatan</label>
                                                            <input type="text" id="catatan" name="catatan" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </from>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan Rencana Rujukan</button>
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

<div class="viewmodalcarifaskes" style="display:none;"></div>

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
                    $('.btnsimpan').html('Simpan Surat Kontrol');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            html: 'Pesan: ' + response.pesan,
                            icon: 'warning',
                            title: 'Perhatian'

                        });
                    } else
                    if (response.success) {
                        Swal.fire({
                            html: 'Nama: ' + response.response.rujukan.peserta.nama + '<br>No.Kartu: ' + response.response.rujukan.peserta.noKartu + '<br>No.SuratRujukan: ' + response.response.rujukan.noRujukan +
                                '<br>Tanggal Rencana Kunjungan: ' + response.response.rujukan.tglRencanaKunjungan + '<br>Kode PPK Tujuan: ' + response.response.rujukan.tujuanRujukan.kode + '<br>Nama PPK Tujuan: ' + response.response.rujukan.tujuanRujukan.nama +
                                '<br>Nama Pelayanan Tujuan: ' + response.response.rujukan.poliTujuan.nama + '<br>Diagnosa: ' + response.response.rujukan.diagnosa.nama,
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
                        });
                        $('#hakKelas').val(parseResponse.response.peserta.hakKelas.kode);
                        $('#jnsPeserta').val(parseResponse.response.peserta.jenisPeserta.keterangan);
                        $('#kelamin').val(parseResponse.response.peserta.sex);
                        $('#tglLahir').val(parseResponse.response.peserta.tglLahir);

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

    $('#btn-no-rujukan').on('click', function() {

        if ($('#noRujukan').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No Rujukan Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_rujukan_kartu_noRujukan') ?>",
                data: {
                    noRujukan: $('#noRujukan').val(),
                    date: $('#documentdate').val()
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.rujukan.nama + '<br>No.Kartu: ' + parseResponse.response.rujukan.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.rujukan.sex + '<br>Tanggal Lahir: ' + parseResponse.response.rujukan.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.rujukan.pisa + '<br>Status: ' + parseResponse.response.rujukan.statusPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.rujukan.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.rujukan.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.rujukan.tglTMT + '<br>Keluhan: ' + parseResponse.response.rujukan.keluhan +
                                '<br>No rujukan: ' + parseResponse.response.rujukan.noKunjungan + '<br>Kode kecamatanDiagnosa: ' + parseResponse.response.rujukan.kecamatandiagnosa.kode + '<br>kecamatanDiagnosa: ' + parseResponse.response.rujukan.kecamatandiagnosa.nama + '<br>Rujukan Ke: ' + parseResponse.response.rujukan.poliRujukan.nama,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#referencedate').val(parseResponse.response.rujukan.tglkunjungan);
                        $('#noRujukan').val(parseResponse.response.rujukan.noKunjungan);

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


<script>
    $('#btn-carifaskes').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/CariFaskes') ?>",
            dataType: "json",
            success: function(response) {
                if (response.suksescarifaskes) {
                    $('.viewmodalcarifaskes').html(response.suksescarifaskes).show();
                    $('#modalcarifaskes').modal('show');
                }

            }
        });

    });
</script>

<script>
    $('#btn-carispesialistik').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/CariSpesialistikRujukan') ?>",
            data: {
                kodeFaskes: $('#ppkDirujuk').val(),
                TglRujukan: $('#tglRencanaKunjungan').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesspesialistik) {
                    $('.viewmodalcarifaskes').html(response.suksesspesialistik).show();
                    $('#modallistSpesialistik').modal('show');
                }

            }
        });

    });
</script>

<script>
    $('#btn-caridiagnosa').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/CariDiagnosa') ?>",
            dataType: "json",
            success: function(response) {
                if (response.suksescaridiagnosa) {
                    $('.viewmodalcarifaskes').html(response.suksescaridiagnosa).show();
                    $('#modalcaridiagnosa').modal('show');
                }

            }
        });

    });
</script>