<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    hr {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    hr:after {
        background: #fff;
        content: 'Asesmen Primary';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr2 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr2:after {
        background: #fff;
        content: 'Asesmen Secondary';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>


<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr3 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr3:after {
        background: #fff;
        content: 'Masalah Keperawatan Dan Rencana Keperawatan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>
<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatIGD', ['class' => 'formasesmen']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Tanggal Jam Kedatangan</label>
                            <input type="text" class="form-control" id="admissionDateTime" name="admissionDateTime" required value="<?= $admissionDateTime; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kondisi Pasien</label>
                            <input type="text" class="form-control" id="kondisiPasien" name="kondisiPasien" required value="<?= $kondisiPasien; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Anamnesis</label>
                            <select name="anamnesis" id="anamnesis" class="select2" style="width: 100%">
                                <option value="Auto Anamnesa">Auto Anamnesa</option>
                                <option value="Allo Anamnesa">Allo Anamnesa</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hubungan</label>
                            <input type="text" class="form-control" id="uraianAllo" name="uraianAllo" disabled>
                            <input type="hidden" class="form-control" id="alloanamnesa" name="alloanamnesa">
                            <small class="form-control-feedback">Ditulis Jika Allo Anamnesa</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="bb" name="bb" required value="<?= $bb; ?>">
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="tb" name="tb" required value="<?= $tb; ?>">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required value="<?= $frekuensiNadi; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required value="<?= $tdSistolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required value="<?= $tdDiastolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="suhu" name="suhu" required value="<?= $suhu; ?>">
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required value="<?= $frekuensiNafas; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="spo2" name="spo2" required value="<?= $spo2; ?>">
                            <small class="form-control-feedback">%</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Airway</label>
                            <select name="airway" id="airway" class="select2" style="width: 100%" required>

                                <?php foreach ($airway as $air) : ?>
                                    <option value="<?php echo $air['name']; ?>"><?php echo $air['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suara Nafas</label>
                            <select name="suaraNafas" id="suaraNafas" class="select2" style="width: 100%" required>

                                <?php foreach ($suaraNafas as $suara) : ?>
                                    <option value="<?php echo $suara['name']; ?>"><?php echo $suara['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pola Nafas</label>
                            <select name="polaNafas" id="polaNafas" class="select2" style="width: 100%" required>

                                <?php foreach ($polaNafas as $pola) : ?>
                                    <option value="<?php echo $pola['name']; ?>"><?php echo $pola['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Bunyi Nafas</label>
                            <select name="bunyiNafas" id="bunyiNafas" class="select2" style="width: 100%" required>

                                <?php foreach ($bunyiNafas as $bunyi) : ?>
                                    <option value="<?php echo $bunyi['name']; ?>"><?php echo $bunyi['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Irama Nafas</label>
                            <select name="iramaNafas" id="iramaNafas" class="select2" style="width: 100%" required>

                                <?php foreach ($iramaNafas as $irama) : ?>
                                    <option value="<?php echo $irama['name']; ?>"><?php echo $irama['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tanda Distress Pernafasan</label>
                            <select name="tandaDistressNafas" id="tandaDistressNafas" class="select2" style="width: 100%" required>

                                <?php foreach ($tandaDistressNafas as $tandaDistress) : ?>
                                    <option value="<?php echo $tandaDistress['name']; ?>"><?php echo $tandaDistress['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Akral</label>
                            <select name="akral" id="akral" class="select2" style="width: 100%" required>

                                <?php foreach ($akral as $akral) : ?>
                                    <option value="<?php echo $akral['name']; ?>"><?php echo $akral['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sianosis</label>
                            <select name="sianosis" id="sianosis" class="select2" style="width: 100%" required>

                                <?php foreach ($sianosis as $sianosis) : ?>
                                    <option value="<?php echo $sianosis['name']; ?>"><?php echo $sianosis['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pengisian Kapiler</label>
                            <select name="pengisianKapiler" id="pengisianKapiler" class="select2" style="width: 100%" required>

                                <?php foreach ($kapiler as $kapiler) : ?>
                                    <option value="<?php echo $kapiler['name']; ?>"><?php echo $kapiler['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kelembaban Kulit</label>
                            <select name="kelembapanKulit" id="kelembapanKulit" class="select2" style="width: 100%" required>

                                <?php foreach ($kelembapan as $kelembapan) : ?>
                                    <option value="<?php echo $kelembapan['name']; ?>"><?php echo $kelembapan['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Turgor</label>
                            <select name="turgor" id="turgor" class="select2" style="width: 100%" required>

                                <?php foreach ($turgor as $turgor) : ?>
                                    <option value="<?php echo $turgor['name']; ?>"><?php echo $turgor['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Eye</label>
                            <select name="eye" id="eye" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($eye as $eye) : ?>
                                    <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $eye_triase) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Verbal</label>
                            <select name="verbal" id="verbal" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($verbal as $verbal) : ?>
                                    <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $verbal_triase) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Motorik</label>
                            <select name="motorik" id="motorik" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($motorik as $motorik) : ?>
                                    <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $motorik_triase) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Total GCS</b></label>
                            <input type="number" class="form-control" id="gcs" name="gcs" required readonly value="<?= $totalGcs; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Keadaan Umum</label>
                            <select name="keadaanUmum" id="keadaanUmum" class="select2" style="width: 100%">
                                <option value="Baik">Baik</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Buruk">Buruk</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pupil</label>
                            <select name="pupil" id="pupil" class="select2" style="width: 100%" required>
                                <?php foreach ($pupil as $pupil) : ?>
                                    <option value="<?php echo $pupil['name']; ?>"><?php echo $pupil['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kesadaran</label>
                            <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Asesmen Fungsional</label>
                            <select name="asesmenFungsional" id="asesmenFungsional" class="select2" style="width: 100%">
                                <?php foreach ($asesmen as $as) : ?>
                                    <option value="<?php echo $as['name']; ?>"><?php echo $as['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">

                        <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                        <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                        <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                        <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                        <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                        <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                        <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">


                        <div class="col-md-2 mb-3">
                            <label>Cara Berjalan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Sempoyongan ?<input name="caraBerjalan" id="caraBerjalan" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jalan Menggunakan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Alat Bantu ?<input name="alatBantu" id="alatBantu" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Posisi Duduk</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Menopang Saat Duduk ?<input name="dudukMenopang" id="dudukMenopang" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skoring Jatuh</label>
                            <div class="input-group">
                                <select name="skoringJatuh" id="skoringJatuh" class="select2" style="width: 100%">
                                    <option value="Tidak Beresiko">Tidak Beresiko</option>
                                    <option value="Resiko Rendah">Resiko Rendah</option>
                                    <option value="Resiko Tinggi">Resiko Tinggi</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Edema</label>
                            <select name="edema" id="edema" class="select2" style="width: 100%">
                                <option value="Tidak">Tidak</option>
                                <option value="Ada">Ada</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Daerah Edema</label>
                            <input type="text" class="form-control" id="uraianEdema" name="uraianEdema" disabled>
                            <small class="form-control-feedback">Ditulis Jika Edema</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Laserasi</label>
                            <select name="laserasi" id="laserasi" class="select2" style="width: 100%">
                                <option value="Tidak">Tidak</option>
                                <option value="Ada">Ada</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Daerah Laserasi</label>
                            <input type="text" class="form-control" id="uraianLaserasi" name="uraianLaserasi" disabled>
                            <small class="form-control-feedback">Ditulis Jika Edema</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kondisi Lain</label>
                            <input type="text" class="form-control" id="kondisiLain" name="kondisiLain">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skala Nyeri</label>
                            <select name="skalaNyeri" id="skalaNyeri" class="select2" style="width: 100%">
                                <?php foreach ($skala_nyeri as $skala) : ?>
                                    <option value="<?php echo $skala['code']; ?>"><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Provokes</label>
                            <select name="provokes" id="provokes" class="select2" style="width: 100%">
                                <option value="Tidak Ada">Tidak Ada</option>
                                <?php foreach ($provokes as $provokes) : ?>
                                    <option value="<?php echo $provokes['name']; ?>"><?php echo $provokes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Quality</label>
                            <select name="quality" id="quality" class="select2" style="width: 100%">
                                <option value="">Tidak Ada</option>
                                <?php foreach ($quality as $quality) : ?>
                                    <option value="<?php echo $quality['name']; ?>"><?php echo $quality['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Regio</label>
                            <input type="text" class="form-control" id="regio" name="regio">
                            <small class="form-control-feedback">lokasi</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Severity</label>
                            <select name="severity" id="severity" class="select2" style="width: 100%">
                                <option value="">Tidak Ada</option>
                                <?php foreach ($severity as $severity) : ?>
                                    <option value="<?php echo $severity['name']; ?>"><?php echo $severity['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Durasi Nyeri</label>
                            <input type="text" class="form-control" id="durasiNyeri" name="durasiNyeri">
                        </div>
                        <div class="col-md-2 mb-3">
                            <img src="https://kliniknyeritulangbelakang.com/wp-content/uploads/2020/07/Skala-nyeri-wajah.png" alt="" width="100%">
                        </div>
                    </div>
                    <hr class="hr2">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Spiritual</label>
                            <select name="spiritual" id="spiritual" class="select2" style="width: 100%">
                                <?php foreach ($spiritual as $spiritual) : ?>
                                    <option value="<?php echo $spiritual['name']; ?>"><?php echo $spiritual['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <select name="psikologis" id="psikologis" class="select2" style="width: 100%">
                                <?php foreach ($psikologis as $psikologis) : ?>
                                    <option value="<?php echo $psikologis['name']; ?>"><?php echo $psikologis['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sosiologis</label>
                            <select name="sosiologis" id="sosiologis" class="select2" style="width: 100%">
                                <?php foreach ($sosiologis as $sosiologis) : ?>
                                    <option value="<?php echo $sosiologis['name']; ?>"><?php echo $sosiologis['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label><b>Keluhan Utama</b></label>
                            <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><b>Riwayat Penyakit Sekarang</b></label>
                            <input type="text" class="form-control" id="riwayatPenyakitSekarang" name="riwayatPenyakitSekarang" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Riwayat Penyakit Dahulu</b></label>
                            <input type="text" class="form-control" id="riwayatPenyakitDahulu" name="riwayatPenyakitDahulu" value="-">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Riwayat Penyakit Keluarga</b></label>
                            <input type="text" class="form-control" id="riwayatPenyakitKeluarga" name="riwayatPenyakitKeluarga" value="-">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Alergi ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isialergi" id="isialergi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian Alergi</label>
                            <input type="text" class="form-control" id="uraianAlergi" name="uraianAlergi" disabled>
                            <input type="hidden" class="form-control" id="alergi" name="alergi">
                            <small class="form-control-feedback">Ditulis Jika Ada Alergi</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Riwayat Penggunaan Obat Sebelum Masuk RS</label>
                            <input type="text" class="form-control" id="riwayatpenggunaanObat" name="riwayatpenggunaanObat" value="Tidak ada">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Penurunan Berat Badan</label>
                            <select name="penurunanBb" id="penurunanBb" class="select2" style="width: 100%" required onchange="totalnutrisi()">
                                <option value="">Pilih</option>
                                <?php foreach ($turunbb as $turunbb) : ?>
                                    <option value="<?php echo $turunbb['nilai']; ?>"><?php echo $turunbb['name']; ?>[<b><?= $turunbb['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Asupan Makan Berkurang ?</label>
                            <select name="asupanMakanan" id="asupanMakanan" class="select2" style="width: 100%" required onchange="totalnutrisi()">
                                <option value="">Pilih</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Skor</b></label>
                            <input type="number" class="form-control" id="skorNutrisi" name="skorNutrisi" readonly>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Anak Tampak Kurus ?</label>
                            <select name="nutrisiKurus" id="nutrisiKurus" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="">Pilih</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Penurunan BB 1 Bulan Terkahir ?</label>
                            <select name="turunBbAnak" id="turunBbAnak" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="">Pilih</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Penyakit mengakibatkan resiko malnutrisi ?</label>
                            <select name="penyakitMalnutrisi" id="penyakitMalnutrisi" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="">Pilih</option>
                                <option value="0">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Nafsu makan berkurang/</br>muntah > 3 kali/</br>diare > 5 kali ?</label>
                            <select name="nutrisiMuntahDiare" id="nutrisiMuntahDiare" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="">Pilih</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Skor Nutrisi Anak</b></label>
                            <input type="number" class="form-control" id="skorNutrisiAnak" name="skorNutrisiAnak" readonly>
                        </div>


                        <div class="col-md-2 mb-3">
                            <label>Uraian Kondisi Khusus</label>
                            <input type="text" class="form-control" id="uraianKondisiKhusus" name="uraianKondisiKhusus" disabled>
                            <input type="hidden" class="form-control" id="nutrisiKondisiKhusus" name="nutrisiKondisiKhusus">
                            <small class="form-control-feedback">Ditulis Jika Kondisi Khusus</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Dirujuk Ke Ahli Gizi<input name="rujukAhliGizi" id="rujukAhliGizi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr3">
                    <div class="form-row">

                        <div class="col-md-2 mb-3">
                            <label>Diagnosis Keperawatan IGD</label>
                            <div class="input-group">
                                <select name="DiagnosaAskep" id="DiagnosaAskep" class="select2" style="width: 100%">
                                    <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                                        <option value="<?php echo $diagnosa['diagnosa']; ?>"><?php echo $diagnosa['diagnosa']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-2 mb-3">
                            <label></label>
                            <div class="input-group-append">
                                <button class="btn btn-info" id="cariaskepigd" type="button"><i class="fas fa-search"></i> Lihat Rencana Keperawatan</button>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label></label>
                            <div class="input-group-append">
                                <button class="btn btn-warning" id="cariimplementasiigd" type="button"><i class="fas fa-search"></i> Pilih Implemntasi</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Rencana Keperawatan</label>
                            <textarea id="mymce2" name="uraianAskep" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Sasaran Rencana Asuhan</label>
                            <textarea id="mymce4" name="sasaranRencana" class="form-control" rows="8"></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Tindakan & Evaluasi Keperawatan</label>
                            <textarea id="mymce3" name="tindakanEvaluasi" class="form-control" rows="8"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
                        </div>
                    </div>
            </div>

            </form>
    </div>
    </from>
</div>
<div class="modal-footer">

</div>
<?= form_close() ?>
</div>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
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
            }, // let our custom formatter work
            minimumInputLength: 1,

        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 100,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var poliklinikname = document.getElementById("poliklinikname").value;
        $("#paramedicName").autocomplete({

            source: "<?php echo base_url('PelayananRawatJalanRME/ajax_paramedicName'); ?>?poliklinikname=" + poliklinikname,
            select: function(event, ui) {
                $('#paramedicName').val(ui.item.value);

            }
        });
    });
</script>


<script type="text/javascript">
    $('#isialergi').on('change', function() {
        if ($('#isialergi').val() == 1) {
            $('#uraianAlergi').removeAttr('disabled');
            $('#isialergi').val(0);
            $('#alergi').val(1);
        } else {
            $('#uraianAlergi').attr('disabled', 'disabled');
            $('#uraianAlergi').val('');
            $('#isialergi').val(1);
            $('#alergi').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isinutrisiKondisiKhusus').on('change', function() {
        if ($('#isinutrisiKondisiKhusus').val() == 1) {
            $('#uraianKondisiKhusus').removeAttr('disabled');
            $('#isinutrisiKondisiKhusus').val(0);
            $('#nutrisiKondisiKhusus').val(1);
        } else {
            $('#uraianKondisiKhusus').attr('disabled', 'disabled');
            $('#uraianKondisiKhusus').val('');
            $('#isinutrisiKondisiKhusus').val(1);
            $('#nutrisiKondisiKhusus').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isifungsionalAlatBantu').on('change', function() {
        if ($('#isifungsionalAlatBantu').val() == 1) {
            $('#fungsionalNamaAlatBantu').removeAttr('disabled');
            $('#isifungsionalAlatBantu').val(0);
            $('#fungsionalAlatBantu').val(1);
        } else {
            $('#fungsionalNamaAlatBantu').attr('disabled', 'disabled');
            $('#fungsionalNamaAlatBantu').val('');
            $('#isifungsionalAlatBantu').val(1);
            $('#fungsionalAlatBantu').val(0);

        }

    })
</script>


<script>
    $(document).ready(function() {
        $('.formasesmen').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.pesan,
                        })

                    } else if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        $('#kode').val(response.JN);
                        $('#dokter').val(response.dokter);
                        $('#doktername').val(response.doktername);
                        $('#documentdate').val(response.tanggalpelayanan);
                        dataCPPT();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskepigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariAskep'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep').modal('show');

                }
            }
        })
    })
</script>



<script type="text/javascript">
    $('#anamnesis').on('change', function() {
        if ($('#anamnesis').val() == "Allo Anamnesa") {
            $('#uraianAllo').removeAttr('disabled');
            $('#uraianAllo').val('');

        } else {
            $('#uraianAllo').attr('disabled', 'disabled');
            $('#uraianAllo').val('');
        }

    })
</script>



<script type="text/javascript">
    function total2() {
        var eye2 = document.getElementById('eye').value;
        var verbal2 = document.getElementById('verbal').value;
        var motorik2 = document.getElementById('motorik').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var nilai_eye2 = parseInt(eye2);
        var nilai_verbal2 = parseInt(verbal2);
        var nilai_motorik2 = parseInt(motorik2);
        var totalGCS2 = nilai_eye2 + nilai_verbal2 + nilai_motorik2;
        document.getElementById('gcs').value = totalGCS2;
    }
</script>





<script type="text/javascript">
    $('#edema').on('change', function() {
        if ($('#edema').val() == "Ada") {
            $('#uraianEdema').removeAttr('disabled');
            $('#uraianEdema').val('');

        } else {
            $('#uraianEdema').attr('disabled', 'disabled');
            $('#uraianEdema').val('');
        }

    })
</script>


<script type="text/javascript">
    $('#laserasi').on('change', function() {
        if ($('#laserasi').val() == "Ada") {
            $('#uraianLaserasi').removeAttr('disabled');
            $('#uraianLaserasi').val('');

        } else {
            $('#uraianLaserasi').attr('disabled', 'disabled');
            $('#uraianLaserasi').val('');
        }

    })
</script>

<script type="text/javascript">
    function totalnutrisi() {
        var penurunanBb = document.getElementById('penurunanBb').value;
        var asupanMakanan = document.getElementById('asupanMakanan').value;

        var nilai_penurunan = parseInt(penurunanBb);
        var nilai_asupanmakanan = parseInt(asupanMakanan);

        var totalNutrisi = nilai_penurunan + nilai_asupanmakanan;
        document.getElementById('skorNutrisi').value = totalNutrisi;
    }
</script>



<script type="text/javascript">
    function totalnutrisiAnak() {
        var nutrisiKurus = document.getElementById('nutrisiKurus').value;
        var turunBbAnak = document.getElementById('turunBbAnak').value;
        var nutrisiMuntahDiare = document.getElementById('nutrisiMuntahDiare').value;
        var penyakitMalnutrisi = document.getElementById('penyakitMalnutrisi').value;

        var nilai_nutrisiKurus = parseInt(nutrisiKurus);
        var nilai_turunBbAnak = parseInt(turunBbAnak);
        var nilai_nutrisiMuntahDiare = parseInt(nutrisiMuntahDiare);
        var nilai_malnutrisi = parseInt(penyakitMalnutrisi);

        var totalNutrisiAnak = nilai_nutrisiKurus + nilai_turunBbAnak + nilai_nutrisiMuntahDiare + nilai_malnutrisi;
        document.getElementById('skorNutrisiAnak').value = totalNutrisiAnak;
    }
</script>



<script>
    $('#cariimplementasiigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariImplementasi'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_implementasi').modal('show');

                }
            }
        })
    })
</script>