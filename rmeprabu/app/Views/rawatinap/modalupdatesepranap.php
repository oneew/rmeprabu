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
$attr_naikKelas = $apakahnaikkelas == 1 ? 'checked' : 0;
?>


<div id="modalupdatesepranap" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Update SEP Rawat Inap</h4>
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
                                        <h6 class="card-subtitle"><span class="badge badge-info"><?= $noSep; ?></span></h6>
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
                                <?= form_open('DPMRI/simpanUpdateSEP', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <from class="form-horizontal form-material" id="form-filter" method="post">
                                        <div class="form-body">
                                            <div id="slimtest4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Asal Rujukan</label>
                                                            <div class="mb-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio5" name="asalRujukan" type="radio" class="custom-control-input" value="1">
                                                                    <span class="custom-control-label">Faskes 1</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio6" name="asalRujukan" type="radio" class="custom-control-input" value="2" checked>
                                                                    <span class="custom-control-label">RS/ Faskes2</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="text" class="form-control" id="noKartu" name="noKartu" placeholder="No.Kartu Asuransi" value="<?= $pasien['cardnumber']; ?>" required>
                                                            <input type="hidden" id="journalnumberrajal" name="journalnumberrajal" class="form-control" value="<?= $journalnumber; ?>">
                                                            <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                                            <input type="hidden" id="noSep" name="noSep" class="form-control" value="<?= $noSep; ?>">

                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-cardrajalpasinsep" type="button">Cek!</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Norm</label>
                                                            <input type="text" id="noMR" name="noMR" class="form-control" value="<?= $pasien['code']; ?>">
                                                            <input type="hidden" id="registerdatesep" name="registerdatesep" class="form-control" readonly value="<?= date('Y-m-d'); ?>" readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis Pelayanan</label>
                                                            <div class="mb-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio7" name="jnsPelayanan" type="radio" class="custom-control-input" value="2">
                                                                    <span class="custom-control-label">Rawat Jalan</span>
                                                                </label>
                                                                <label class="custom-control custom-radio">
                                                                    <input id="radio8" name="jnsPelayanan" type="radio" class="custom-control-input" value="1" checked>
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
                                                            <input type="text" id="noRujukan" name="noRujukan" class="form-control" autocomplete="off" value="<?= $noRujukan; ?>">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Rujukan</label>
                                                            <input type="text" id="tglRujukan" name="tglRujukan" class="form-control" autocomplete="off" value="<?= $tglRujukan; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Faskep Perujuk</label>
                                                            <input type="text" id="ppkRujukan" name="ppkRujukan" class="form-control" autocomplete="off" value="0609R002">
                                                        </div>
                                                    </div>
                                                    <?php $diag = explode('-', $diagnosa);
                                                    $diagexplode = $diag[0];
                                                    $diagAwal = str_replace(' ', '', $diagexplode); ?>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <label class="control-label"></label>
                                                            <input type="text" id="diagAwal" name="diagAwal" class="form-control" autocomplete="off" value="<?= $diagAwal; ?>" readonly>
                                                            <input type="hidden" id="namadiagAwal" name="namadiagAwal" class="form-control" autocomplete="off" readonly value="<?= $diagnosa; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-info" id="btn-caridiagnosa" type="button"><i class="fas fa-search"></i> Diagnosa</button>
                                                            </div>
                                                        </div>
                                                        <small class="form-control-feedback text-danger">* Diisi Diagnosa</small>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Poli Rujukan</label>
                                                            <input type="text" id="tujuan" name="tujuan" class="form-control" required value="<?= $kode_poli; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Sep</label>
                                                            <input type="text" id="tglSep" name="tglSep" class="form-control" value="<?= $tglSep; ?>" required>
                                                            <input type="hidden" id="ppkPelayanan" name="ppkPelayanan" class="form-control" value="0609R002">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">NoTlp</label>
                                                            <input type="text" id="noTelp" name="noTelp" class="form-control" value="<?= $noTelp; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Catatan</label>
                                                            <input type="text" id="catatan" name="catatan" class="form-control" value="<?= $catatan; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="control-label">HakKelas</label>
                                                            <input type="text" id="klsRawat" name="klsRawat" class="form-control" value="<?= $kodeHakKelas; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Naik Kelas?</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_naikKelas; ?> value="1" name="apakahnaik" id="apakahnaik"><span class="lever"></span>Ya</label>
                                                            </div>
                                                            <input type="hidden" id="apakahnaik2" name="apakahnaik2" class="form-control" value="<?= $apakahnaikkelas; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Naik Kelas Ke</label>
                                                            <select name="klsRawatNaik" id="klsRawatNaik" class="select2" style="width: 100%" disabled>
                                                                <option value="">Pilih Naik Kelas Ke</option>
                                                                <?php foreach ($naikKelas as $nk) : ?>
                                                                    <option value="<?= $nk['code']; ?>" class="select-code" <?php if ($nk['code'] == $klsRawatNaik) { ?> selected="selected" <?php } ?>><?= $nk['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Pembiayaan</label>
                                                            <select name="pembiayaan" id="pembiayaan" class="select2" style="width: 100%" disabled>
                                                                <option value="">Pilih Pembiayaan</option>
                                                                <?php foreach ($pembiayaan as $pem) : ?>
                                                                    <option value="<?= $pem['code']; ?>" class="select-code" <?php if ($pem['code'] == $pembiayaanPasien) { ?> selected="selected" <?php } ?>><?= $pem['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">PenanggungJawab Pembiayaan</label>
                                                            <input type="text" id="penanggungJawab" name="penanggungJawab" class="form-control" value="<?= $penanggungJawab; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Poli Eksekutif</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_eksekutif; ?> value="1" name="eksekutif"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">COB</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_cob; ?> value="1" name="cob"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Katarak</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_katarak; ?> value="1" name="katarak"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">KLL</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_lakaLantas; ?> value="1" id="lakalantas" name="lakalantas"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis KLL</label>
                                                            <select name="ketLakalantas" id="ketLakalantas" class="select2" style="width: 100%">
                                                                <?php foreach ($jeniskll as $jeniskll) : ?>
                                                                    <option value="<?= $jeniskll['code']; ?>" class="select-code" <?php if ($jeniskll['code'] == $jenislakaLantas) { ?> selected="selected" <?php } ?>><?= $jeniskll['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <small class="form-control-feedback text-danger">* Diisi</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal KLL</label>
                                                            <input type="text" id="tglKejadian" name="tglKejadian" value="<?= date('Y-m-d'); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Keterangan</label>
                                                            <input type="text" id="keterangan" name="keterangan" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Suplesi</label>
                                                            <div class="switch">
                                                                <label>Tidak
                                                                    <input type="checkbox" <?= $attr_suplesi; ?> value="1" id="suplesi" name="suplesi"><span class="lever"></span>Ya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">No SEP Suplesi</label>
                                                            <input type="text" id="nosuplesi" name="nosuplesi" class="form-control" value="<?= $noSuplesi; ?>">
                                                            <input type="hidden" id="lakalantas2" name="lakalantas2" class="form-control" value="0">
                                                            <input type="hidden" id="suplesi2" name="suplesi2" class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Provinsi</label>
                                                            <select name="kdPropinsi" id="kdPropinsi" class="select2" style="width: 100%">
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
                                                            <select name="kdKabupaten" id="kdKabupaten" class="select2" style="width: 100%">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kecamatan</label>
                                                            <select name="kdKecamatan" id="kdKecamatan" class="select2" style="width: 100%">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">No Surat Kontrol</label>
                                                            <input type="text" id="noSurat" name="noSurat" class="form-control" readonly value="<?= $noSPRI; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Dokter</label>
                                                            <select name="kodeDPJP" id="kodeDPJP" class="select2" style="width: 100%">
                                                                <option>Pilih Dokter</option>
                                                                <?php foreach ($dokterBPJS as $dpjp) : ?>
                                                                    <option data-id="<?= $dpjp['kode']; ?>" data-name="<?= $dpjp['nama']; ?>" value="<?= $dpjp['kode']; ?>" class="select-classroom" <?php if ($dpjp['kode'] == $kodeDokter) { ?> selected="selected" <?php } ?>><?= $dpjp['nama']; ?>[<?= $dpjp['kode']; ?>]</option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="hidden" id="dokterpemeriksa" name="dokterpemeriksa" class="form-control" readonly value="<?= $dokterpemeriksa; ?>">
                                                            <small class="form-control-feedback text-danger">* Diisi</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Tujuan Kunjungan</label>
                                                            <select name="tujuanKunj" id="tujuanKunj" class="select2" style="width: 100%">
                                                                <?php foreach ($tujuanKunjungan as $tk) : ?>
                                                                    <option value="<?= $tk['code']; ?>" class="select-classroom" <?php if ($tk['code'] == $tujuanKunj) { ?> selected="selected" <?php } ?>><?= $tk['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="hidden" id="user" name="user" class="form-control" value="Coba Ws">
                                                            <input type="hidden" id="idrajal" name="idrajal" class="form-control" value="<?= $idrajal; ?>">
                                                            <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>">
                                                            <small class="form-control-feedback text-danger">* Diisi</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Flag Procedure</label>
                                                            <select name="flagProcedure" id="flagProcedure" class="select2" style="width: 100%">
                                                                <option>Pilih Flag Procedure</option>
                                                                <?php foreach ($flagprocedure as $fp) : ?>
                                                                    <option value="<?= $fp['code']; ?>" class="select-classroom" <?php if ($fp['code'] == $flagProcedure) { ?> selected="selected" <?php } ?>><?= $fp['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Tujuan Penunjang</label>
                                                            <select name="kdPenunjang" id="kdPenunjang" class="select2" style="width: 100%">
                                                                <option>Pilih Penunjang</option>
                                                                <?php foreach ($penunjangsep as $pnj) : ?>
                                                                    <option value="<?= $pnj['code']; ?>" class="select-classroom" <?php if ($pnj['code'] == $kdPenunjang) { ?> selected="selected" <?php } ?>><?= $pnj['name']; ?></option>
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
                                    <button type="submit" class="btn btn-success btnsimpan" id="btnsimpansep"><i class="fa fa-plus"></i> Update SEP</button>
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


<div class="viewmodalupdatesepranap" style="display:none;"></div>


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

                    if (response.gagal) {
                        Swal.fire({
                            html: 'Pesan: ' + response.pesan,
                            icon: 'error',
                            title: 'error',
                            title: '<strong>SEP Rawat Inap</strong>',
                            timer: 2000

                        });
                    } else {
                        if (response.success) {
                            Swal.fire({
                                html: response.response,
                                icon: 'success',
                                title: response.pesanberhasil,

                            });
                        } else {
                            Swal.fire({
                                html: 'Pesan: ' + response.pesan,
                                icon: 'error',
                                title: '<strong>SEP Rawat Inap</strong>',
                                timer: 2000

                            });
                        }
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
                        $('#klsRawat').val(parseResponse.response.peserta.hakKelas.kode);
                        $('#btnsimpansep').removeAttr('disabled');

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
<!-- 
<script type="text/javascript">
    $('#lakalantas').on('change', function() {
        if ($('#lakalantas').val() == 1) {
            $('#tglKejadian').removeAttr('disabled');
            $('#keterangan').removeAttr('disabled');
            $('#kdPropinsi').removeAttr('disabled');
            $('#penjamin').removeAttr('disabled');
            $('#lakalantas').val(0);
            $('#lakalantas2').val(1);
            $('#ketLakalantas').removeAttr('disabled');
        } else {
            $('#tglKejadian').attr('disabled', 'disabled');
            $('#keterangan').attr('disabled', 'disabled');
            $('#kdPropinsi').attr('disabled', 'disabled');
            $('#penjamin').attr('disabled', 'disabled');
            $('#lakalantas').val(1);
            $('#lakalantas2').val(0);
            $('#ketLakalantas').attr('disabled', 'disabled');
        }
        //alert($('#lakalantas').val());
    })
</script> -->

<!-- <script type="text/javascript">
    $('#suplesi').on('change', function() {
        if ($('#suplesi').val() == 1) {
            $('#nosuplesi').removeAttr('disabled');
            $('#suplesi').val(0);
            $('#suplesi2').val(1);
        } else {
            $('#nosuplesi').attr('disabled', 'disabled');
            $('#suplesi').val(1);
            $('#suplesi2').val(0);

        }
        //alert($('#suplesi').val());
    })
</script> -->

<script type="text/javascript">
    $('#apakahnaik').on('change', function() {
        if ($('#apakahnaik').val() == 1) {
            $('#klsRawatNaik').removeAttr('disabled');
            $('#pembiayaan').removeAttr('disabled');
            $('#penanggungJawab').removeAttr('disabled');
            $('#apakahnaik').val(0);
            $('#apakahnaik2').val(1);
        } else {
            $('#klsRawatNaik').attr('disabled', 'disabled');
            $('#pembiayaan').attr('disabled', 'disabled');
            $('#penanggungJawab').attr('disabled', 'disabled');
            $('#apakahnaik').val(1);
            $('#apakahnaik2').val(0);
        }
    })
</script>



<!-- <script type="text/javascript">
    $('#apakahnaik').on('change', function() {
        if ($('#apakahnaik').val() == 1) {
            $('#apakahnaik').val(0);
            $('#apakahnaik2').val(1);
        } else {
            $('#apakahnaik').val(1);
            $('#apakahnaik2').val(0);
        }
    })
</script> -->


<script>
    $('#btn-caridiagnosa').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/CariDiagnosa') ?>",
            dataType: "json",
            success: function(response) {
                if (response.suksescaridiagnosa) {
                    $('.viewmodalupdatesepranap').html(response.suksescaridiagnosa).show();
                    $('#modalcaridiagnosa').modal('show');
                }

            }
        });

    });
</script>