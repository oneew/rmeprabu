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
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatIGDUpdate', ['class' => 'formasesmenhasil']); ?>
                <?= csrf_field(); ?>
                <?php $no = 0;
                foreach ($tampilasesmen as $row) :
                    $no++;
                    $caraBerjalan = $row['caraBerjalan'] == 1 ? 'checked' : 0;
                    $alatBantu = $row['fungsionalAlatBantu'] == 1 ? 'checked' : 0;
                    $dudukMenopang = $row['dudukMenopang'] == 1 ? 'checked' : 0;
                    $alergi = $row['Alergi'] == 1 ? 'checked' : 0;
                    $rujukAhliGizi = $row['rujukAhliGizi'] == 1 ? 'checked' : '';


                ?>
                    <form>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Tanggal Jam Kedatangan</label>
                                <input type="text" class="form-control" id="hasil_admissionDateTime" name="hasil_admissionDateTime" required value="<?= $row['admissionDateTime']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kondisi Pasien</label>
                                <input type="text" class="form-control" id="hasil_kondisiPasien" name="hasil_kondisiPasien" required value="<?= $kondisiPasien; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Anamnesis</label>
                                <select name="hasil_anamnesis" id="hasil_anamnesis" class="select2" style="width: 100%">
                                    <option value="Auto Anamnesa" <?php if ($row['anamnesis'] == 'Auto Anamnesa') echo "selected"; ?>>Auto Anamnesa</option>
                                    <option value="Allo Anamnesa" <?php if ($row['anamnesis'] == 'Allo Anamnesa') echo "selected"; ?>>Allo Anamnesa</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Nama Pemberi Informasi</label>
                                <input type="text" class="form-control" id="hasil_uraianAllo" name="hasil_uraianAllo" disabled value="<?= $row['uraianAllo']; ?>">
                                <input type="hidden" class="form-control" id="hasil_alloanamnesa" name="hasil_alloanamnesa">
                                <small class="form-control-feedback">Ditulis Jika Allo Anamnesa</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>BB</label>
                                <input type="number" class="form-control" id="hasil_bb" name="hasil_bb" required value="<?= $row['bb']; ?>">
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TB</label>
                                <input type="number" class="form-control" id="hasil_tb" name="hasil_tb" required value="<?= $row['tb']; ?>">
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nadi</label>
                                <input type="number" class="form-control" id="hasil_frekuensiNadi" name="hasil_frekuensiNadi" required value="<?= $row['frekuensiNadi']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Sistolik</label>
                                <input type="number" class="form-control" id="hasil_tdSistolik" name="hasil_tdSistolik" required value="<?= $row['tdSistolik']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Diastolik</label>
                                <input type="number" class="form-control" id="hasil_tdDiastolik" name="hasil_tdDiastolik" required value="<?= $row['tdDiastolik']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suhu</label>
                                <input type="text" class="form-control" id="hasil_suhu" name="hasil_suhu" required value="<?= $row['suhu']; ?>">
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nafas</label>
                                <input type="number" class="form-control" id="hasil_frekuensiNafas" name="hasil_frekuensiNafas" required value="<?= $row['frekuensiNafas']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>SpO2</label>
                                <input type="number" class="form-control" id="hasil_spo2" name="hasil_spo2" required value="<?= $row['spo2']; ?>">
                                <small class="form-control-feedback">%</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Airway</label>
                                <select name="hasil_airway" id="hasil_airway" class="select2" style="width: 100%" required>
                                    <?php foreach ($airway as $air) : ?>
                                        <option value="<?php echo $air['name']; ?>" <?php if ($air['name'] == $row['airway']) { ?> selected="selected" <?php } ?>><?php echo $air['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suara Nafas</label>
                                <select name="hasil_suaraNafas" id="hasil_suaraNafas" class="select2" style="width: 100%" required>
                                    <?php foreach ($suaraNafas as $suara) : ?>
                                        <option value="<?php echo $suara['name']; ?>" <?php if ($suara['name'] == $row['suaraNafas']) { ?> selected="selected" <?php } ?>><?php echo $suara['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Pola Nafas</label>
                                <select name="hasil_polaNafas" id="hasil_polaNafas" class="select2" style="width: 100%" required>
                                    <?php foreach ($polaNafas as $pola) : ?>
                                        <option value="<?php echo $pola['name']; ?>" <?php if ($pola['name'] == $row['polaNafas']) { ?> selected=" selected" <?php } ?>><?php echo $pola['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Bunyi Nafas</label>
                                <select name="hasil_bunyiNafas" id="hasil_bunyiNafas" class="select2" style="width: 100%" required>

                                    <?php foreach ($bunyiNafas as $bunyi) : ?>
                                        <option value="<?php echo $bunyi['name']; ?>" <?php if ($bunyi['name'] == $row['bunyiNafas']) { ?> selected=" selected" <?php } ?>><?php echo $bunyi['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Irama Nafas</label>
                                <select name="hasil_iramaNafas" id="hasil_iramaNafas" class="select2" style="width: 100%" required>

                                    <?php foreach ($iramaNafas as $irama) : ?>
                                        <option value="<?php echo $irama['name']; ?>" <?php if ($irama['name'] == $row['iramaNafas']) { ?> selected=" selected" <?php } ?>><?php echo $irama['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Tanda Distress Pernafasan</label>
                                <select name="hasil_tandaDistressNafas" id="hasil_tandaDistressNafas" class="select2" style="width: 100%" required>
                                    <?php foreach ($tandaDistressNafas as $tandaDistress) : ?>
                                        <option value="<?php echo $tandaDistress['name']; ?>" <?php if ($tandaDistress['name'] == $row['distressPernafasan']) { ?> selected=" selected" <?php } ?>><?php echo $tandaDistress['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Akral</label>
                                <select name="hasil_akral" id="hasil_akral" class="select2" style="width: 100%" required>
                                    <?php foreach ($akral as $akral) : ?>
                                        <option value="<?php echo $akral['name']; ?>" <?php if ($akral['name'] == $row['akral']) { ?> selected=" selected" <?php } ?>><?php echo $akral['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Sianosis</label>
                                <select name="hasil_sianosis" id="hasil_sianosis" class="select2" style="width: 100%" required>
                                    <?php foreach ($sianosis as $sianosis) : ?>
                                        <option value="<?php echo $sianosis['name']; ?>" <?php if ($sianosis['name'] == $row['sianosis']) { ?> selected=" selected" <?php } ?>><?php echo $sianosis['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Pengisian Kapiler</label>
                                <select name="hasil_pengisianKapiler" id="hasil_pengisianKapiler" class="select2" style="width: 100%" required>
                                    <?php foreach ($kapiler as $kapiler) : ?>
                                        <option value="<?php echo $kapiler['name']; ?>" <?php if ($kapiler['name'] == $row['pengisianKapiler']) { ?> selected=" selected" <?php } ?>><?php echo $kapiler['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kelembaban Kulit</label>
                                <select name="hasil_kelembapanKulit" id="hasil_kelembapanKulit" class="select2" style="width: 100%" required>
                                    <?php foreach ($kelembapan as $kelembapan) : ?>
                                        <option value="<?php echo $kelembapan['name']; ?>" <?php if ($kelembapan['name'] == $row['kelembabanKulit']) { ?> selected=" selected" <?php } ?>><?php echo $kelembapan['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Turgor</label>
                                <select name="hasil_turgor" id="hasil_turgor" class="select2" style="width: 100%" required>
                                    <?php foreach ($turgor as $turgor) : ?>
                                        <option value="<?php echo $turgor['name']; ?>" <?php if ($turgor['name'] == $row['turgor']) { ?> selected=" selected" <?php } ?>><?php echo $turgor['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Eye</label>
                                <select name="hasil_eye" id="hasil_eye" class="select2" style="width: 100%" required onchange="hasiltotal2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($eye as $eye) : ?>
                                        <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $row['eye']) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Verbal</label>
                                <select name="hasil_verbal" id="hasil_verbal" class="select2" style="width: 100%" required onchange="hasiltotal2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($verbal as $verbal) : ?>
                                        <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $row['verbal']) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Motorik</label>
                                <select name="hasil_motorik" id="hasil_motorik" class="select2" style="width: 100%" required onchange="hasiltotal2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($motorik as $motorik) : ?>
                                        <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $row['motorik']) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Total GCS</b></label>
                                <input type="number" class="form-control" id="hasil_gcs" name="hasil_gcs" required readonly value="<?= $row['totalGcs']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Keadaan Umum</label>
                                <select name="hasil_keadaanUmum" id="hasil_keadaanUmum" class="select2" style="width: 100%">
                                    <option value="Baik" <?php if ($row['keadaanUmum'] == 'Baik') echo "selected"; ?>>Baik</option>
                                    <option value="Sedang <?php if ($row['keadaanUmum'] == 'Sedang') echo "selected"; ?>">Sedang</option>
                                    <option value="Buruk <?php if ($row['keadaanUmum'] == 'Buruk') echo "selected"; ?>">Buruk</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Pupil</label>
                                <select name="hasil_pupil" id="hasil_pupil" class="select2" style="width: 100%" required>
                                    <?php foreach ($pupil as $pupil) : ?>
                                        <option value="<?php echo $pupil['name']; ?>" <?php if ($pupil['name'] == $row['pupil']) { ?> selected="selected" <?php } ?>><?php echo $pupil['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kesadaran</label>
                                <select name="hasil_kesadaran" id="hasil_kesadaran" class="select2" style="width: 100%">
                                    <?php foreach ($kesadaran as $kes) : ?>
                                        <option value="<?php echo $kes['name']; ?>" <?php if ($kes['name'] == $row['kesadaran']) { ?> selected="selected" <?php } ?>><?php echo $kes['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Asesmen Fungsional</label>
                                <select name="hasil_asesmenFungsional" id="hasil_asesmenFungsional" class="select2" style="width: 100%">
                                    <?php foreach ($asesmen as $as) : ?>
                                        <option value="<?php echo $as['name']; ?>" <?php if ($as['name'] == $row['asesmenFungsional']) { ?> selected="selected" <?php } ?>><?php echo $as['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" id="hasil_paramedicName" name="hasil_paramedicName" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="hasil_createdBy" name="hasil_createdBy" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="hasil_createddate" name="hasil_createddate" required value="<?= date('Y-m-d G:i:s'); ?>">

                            <input type="hidden" class="form-control" id="hasil_nomorreferensi" name="hasil_nomorreferensi" required value="<?= $nomorreferensi; ?>">
                            <input type="hidden" class="form-control" id="hasil_poliklinikname" name="hasil_poliklinikname" required value="<?= $poliklinikname; ?>">
                            <input type="hidden" class="form-control" id="hasil_pasienid" name="hasil_pasienid" required value="<?= $pasienid; ?>">
                            <input type="hidden" class="form-control" id="hasil_pasienname" name="hasil_pasienname" required value="<?= $pasienname; ?>">
                            <input type="hidden" class="form-control" id="hasil_paymentmethodname" name="hasil_paymentmethodname" required value="<?= $paymentmethodname; ?>">
                            <input type="hidden" class="form-control" id="hasil_dmissionDate" name="hasil_admissionDate" required value="<?= $admissionDate; ?>">
                            <input type="hidden" class="form-control" id="hasil_doktername" name="hasil_doktername" required value="<?= $doktername; ?>">


                            <div class="col-md-2 mb-3">
                                <label>Cara Berjalan</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        Sempoyongan ?<input name="hasil_caraBerjalan" id="hasil_caraBerjalan" value="1" type="checkbox" <?= $caraBerjalan; ?>><span class="lever switch-col-red"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Jalan Menggunakan</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        Alat Bantu ?<input name="hasil_alatBantu" id="hasil_alatBantu" value="1" type="checkbox" <?= $alatBantu; ?>><span class="lever switch-col-red"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Posisi Duduk</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        Menopang Saat Duduk ?<input name="hasil_dudukMenopang" id="hasil_dudukMenopang" value="1" type="checkbox" <?= $dudukMenopang; ?>><span class="lever switch-col-red"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Skoring Jatuh</label>
                                <div class="input-group">
                                    <select name="hasil_skoringJatuh" id="hasil_skoringJatuh" class="select2" style="width: 100%">
                                        <option value="Tidak Beresiko" <?php if ($row['skoringJatuh'] == "Tidak Beresiko") echo "selected"; ?>>Tidak Beresiko</option>
                                        <option value="Resiko Rendah" <?php if ($row['skoringJatuh'] == "Resiko Rendah") echo "selected"; ?>>Resiko Rendah</option>
                                        <option value="Resiko Tinggi" <?php if ($row['skoringJatuh'] == "Resiko Tinggi") echo "selected"; ?>>Resiko Tinggi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Edema</label>
                                <select name="hasil_edema" id="hasil_edema" class="select2" style="width: 100%">
                                    <option value="Tidak" <?php if ($row['edema'] == "Tidak") echo "selected"; ?>>Tidak</option>
                                    <option value="Ada" <?php if ($row['edema'] == "Ada") echo "selected"; ?>>Ada</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Daerah Edema</label>
                                <input type="text" class="form-control" id="hasil_uraianEdema" name="hasil_uraianEdema" disabled value="<?= $row['daerahEdema']; ?>">
                                <small class="form-control-feedback">Ditulis Jika Edema</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Laserasi</label>
                                <select name="hasil_laserasi" id="hasil_laserasi" class="select2" style="width: 100%">
                                    <option value="Tidak" <?php if ($row['laserasi'] == "Tidak") echo "selected"; ?>>Tidak</option>
                                    <option value="Ada" <?php if ($row['laserasi'] == "Tidak") echo "selected"; ?>>Ada</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Daerah Laserasi</label>
                                <input type="text" class="form-control" id="hasil_uraianLaserasi" name="hasil_huraianLaserasi" disabled value="<?= $row['daerahLaserasi']; ?>">
                                <small class="form-control-feedback">Ditulis Jika Edema</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Kondisi Lain</label>
                                <input type="text" class="form-control" id="hasil_kondisiLain" name="hasil_kondisiLain" value="<?= $row['kondisiLain']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Skala Nyeri</label>
                                <select name="hasil_skalaNyeri" id="hasil_skalaNyeri" class="select2" style="width: 100%">
                                    <?php foreach ($skala_nyeri as $skala) : ?>
                                        <option value="<?php echo $skala['code']; ?>" <?php if ($skala['code'] == $row['skalaNyeri']) { ?> selected="selected" <?php } ?>><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Provokes</label>
                                <select name="hasil_provokes" id="hasil_provokes" class="select2" style="width: 100%">
                                    <option value="Tidak Ada">Tidak Ada</option>
                                    <?php foreach ($provokes as $provokes) : ?>
                                        <option value="<?php echo $provokes['name']; ?>" <?php if ($provokes['name'] == $row['provokes']) { ?> selected="selected" <?php } ?>><?php echo $provokes['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Quality</label>
                                <select name="hasil_quality" id="hasil_quality" class="select2" style="width: 100%">
                                    <option value="">Tidak Ada</option>
                                    <?php foreach ($quality as $quality) : ?>
                                        <option value="<?php echo $quality['name']; ?>" <?php if ($quality['name'] == $row['quality']) { ?> selected="selected" <?php } ?>><?php echo $quality['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Regio</label>
                                <input type="text" class="form-control" id="hasil_regio" name="hasil_regio" value="<?= $row['regio']; ?>">
                                <small class="form-control-feedback">lokasi</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Severity</label>
                                <select name="hasil_severity" id="hasil_severity" class="select2" style="width: 100%">
                                    <option value="">Tidak Ada</option>
                                    <?php foreach ($severity as $severity) : ?>
                                        <option value="<?php echo $severity['name']; ?>" <?php if ($severity['name'] == $row['severity']) { ?> selected="selected" <?php } ?>><?php echo $severity['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Durasi Nyeri</label>
                                <input type="text" class="form-control" id="hasil_durasiNyeri" name="hasil_durasiNyeri" value="<?= $row['durasiNyeri']; ?>">
                            </div>
                        </div>
                        <hr class="hr2">
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Spiritual</label>
                                <select name="hasil_spiritual" id="hasil_spiritual" class="select2" style="width: 100%">
                                    <?php foreach ($spiritual as $spiritual) : ?>
                                        <option value="<?php echo $spiritual['name']; ?>" <?php if ($spiritual['name'] == $row['spiritual']) { ?> selected="selected" <?php } ?>><?php echo $spiritual['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Psikologis</label>
                                <select name="hasil_psikologis" id="hasil_psikologis" class="select2" style="width: 100%">
                                    <?php foreach ($psikologis as $psikologis) : ?>
                                        <option value="<?php echo $psikologis['name']; ?>" <?php if ($psikologis['name'] == $row['psikologis']) { ?> selected="selected" <?php } ?>><?php echo $psikologis['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Sosiologis</label>
                                <select name="hasil_sosiologis" id="hasil_sosiologis" class="select2" style="width: 100%">
                                    <?php foreach ($sosiologis as $sosiologis) : ?>
                                        <option value="<?php echo $sosiologis['name']; ?>" <?php if ($sosiologis['name'] == $row['sosiologis']) { ?> selected="selected" <?php } ?>><?php echo $sosiologis['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label><b>Keluhan Utama</b></label>
                                <input type="text" class="form-control" id="hasil_keluhanUtama" name="hasil_keluhanUtama" required value="<?= $row['keluhanUtama']; ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><b>Riwayat Penyakit Sekarang</b></label>
                                <input type="text" class="form-control" id="hasil_riwayatPenyakitSekarang" name="hasil_riwayatPenyakitSekarang" required value="<?= $row['riwayatPenyakitSekarang']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Riwayat Penyakit Dahulu</b></label>
                                <input type="text" class="form-control" id="hasil_riwayatPenyakitDahulu" name="hasil_riwayatPenyakitDahulu" value="<?= $row['riwayatPenyakitDahulu'] ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Riwayat Penyakit Keluarga</b></label>
                                <input type="text" class="form-control" id="hasil_riwayatPenyakitKeluarga" name="hasil_riwayatPenyakitKeluarga" value="<?= $row['riwayatPenyakitKeluarga']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Alergi ?</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_isialergi" id="hasil_isialergi" value="1" type="checkbox" <?= $alergi; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Uraian Alergi</label>
                                <input type="text" class="form-control" id="hasil_uraianAlergi" name="hasil_uraianAlergi" disabled value="<?= $row['uraianAlergi']; ?>">
                                <input type="hidden" class="form-control" id="alergi" name="alergi" value="<?= $alergi; ?>">
                                <small class="form-control-feedback">Ditulis Jika Ada Alergi</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Riwayat Penggunaan Obat Sebelum Masuk RS</label>
                                <input type="text" class="form-control" id="hasil_riwayatpenggunaanObat" name="hasil_riwayatpenggunaanObat" value="<?= $row['riwayatPenggunaanObat']; ?>">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Penurunan Berat Badan</label>
                                <select name="hasil_penurunanBb" id="hasil_penurunanBb" class="select2" style="width: 100%" required onchange="hasiltotalnutrisi()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($turunbb as $turunbb) : ?>
                                        <option value="<?php echo $turunbb['nilai']; ?>" <?php if ($turunbb['nilai'] == $row['nutrisiturunBbDewasa']) { ?> selected="selected" <?php } ?>><?php echo $turunbb['name']; ?>[<b><?= $turunbb['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Asupan Makan Berkurang ?</label>
                                <select name="hasil_asupanMakanan" id="hasil_asupanMakanan" class="select2" style="width: 100%" required onchange="hasiltotalnutrisi()">
                                    <option value="">Pilih</option>
                                    <option value="0" <?php if ($row['asupanMakanDewasa'] == "0") echo "selected"; ?>>Tidak</option>
                                    <option value="1" <?php if ($row['asupanMakanDewasa'] == "1") echo "selected"; ?>>Ya</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Skor</b></label>
                                <input type="number" class="form-control" id="hasil_skorNutrisi" name="hasil_skorNutrisi" readonly value="<?= $row['totalSkorNutrisiDewasa']; ?>">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Anak Tampak Kurus ?</label>
                                <select name="hasil_nutrisiKurus" id="hasil_nutrisiKurus" class="select2" style="width: 100%" required onchange="hasiltotalnutrisiAnak()">
                                    <option value="">Pilih</option>
                                    <option value="0" <?php if ($row['nutrisiKurus'] == "0") echo "selected"; ?>>Tidak</option>
                                    <option value="1" <?php if ($row['nutrisiKurus'] == "1") echo "selected"; ?>>Ya</option>
                                </select>
                                <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Penurunan BB 1 Bulan Terkahir ?</label>
                                <select name="hasil_turunBbAnak" id="hasil_turunBbAnak" class="select2" style="width: 100%" required onchange="hasiltotalnutrisiAnak()">
                                    <option value="">Pilih</option>
                                    <option value="0" <?php if ($row['nutrisiTurunBb'] == "0") echo "selected"; ?>>Tidak</option>
                                    <option value="1" <?php if ($row['nutrisiTurunBb'] == "1") echo "selected"; ?>>Ya</option>
                                </select>
                                <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Penyakit mengakibatkan resiko malnutrisi ?</label>
                                <select name="hasil_penyakitMalnutrisi" id="hasil_penyakitMalnutrisi" class="select2" style="width: 100%" required onchange="hasiltotalnutrisiAnak()">
                                    <option value="">Pilih</option>
                                    <option value="0" <?php if ($row['nutrisiKondisiKhusus'] == "0") echo "selected"; ?>>Tidak</option>
                                    <option value="2" <?php if ($row['nutrisiKondisiKhusus'] == "2") echo "selected"; ?>>Ya</option>
                                </select>
                                <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Nafsu makan berkurang/</br>muntah > 3 kali/</br>diare > 5 kali ?</label>
                                <select name="hasil_nutrisiMuntahDiare" id="hasil_nutrisiMuntahDiare" class="select2" style="width: 100%" required onchange="hasiltotalnutrisiAnak()">
                                    <option value="">Pilih</option>
                                    <option value="0" <?php if ($row['nutrisiMuntahDiare'] == "0") echo "selected"; ?>>Tidak</option>
                                    <option value="1" <?php if ($row['nutrisiMuntahDiare'] == "1") echo "selected"; ?>>Ya</option>

                                </select>
                                <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Skor Nutrisi Anak</b></label>
                                <input type="number" class="form-control" id="hasil_skorNutrisiAnak" name="hasil_skorNutrisiAnak" readonly value="<?= $row['totalSkorNutrisiAnak']; ?>">
                            </div>


                            <div class="col-md-2 mb-3">
                                <label>Uraian Kondisi Khusus</label>
                                <input type="text" class="form-control" id="hasil_uraianKondisiKhusus" name="hasil_uraianKondisiKhusus" disabled value="<?= $row['uraianKondisiKhusus']; ?>">
                                <input type="hidden" class="form-control" id="hasil_nutrisiKondisiKhusus" name="hasil_nutrisiKondisiKhusus" value="<?= $row['nutrisiKondisiKhusus']; ?>">
                                <small class="form-control-feedback">Ditulis Jika Kondisi Khusus</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Nutrisi</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        Dirujuk Ke Ahli Gizi<input name="hasil_rujukAhliGizi" id="hasil_rujukAhliGizi" value="1" type="checkbox" <?= $rujukAhliGizi; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                        </div>
                        <hr class="hr3">
                        <div class="form-row">

                            <div class="col-md-2 mb-3">
                                <label>Diagnosis Keperawatan IGD</label>
                                <div class="input-group">
                                    <select name="hasil_DiagnosaAskep" id="hasil_DiagnosaAskep" class="select2" style="width: 100%">
                                        <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                                            <option value="<?php echo $diagnosa['diagnosa']; ?>" <?php if ($diagnosa['diagnosa'] == $row['DiagnosaAskep']) { ?> selected="selected" <?php } ?>><?php echo $diagnosa['diagnosa']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-2 mb-3">
                                <label></label>
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariaskephasil" type="button"><i class="fas fa-search"></i> Lihat Rencana Keperawatan</button>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label></label>
                                <div class="input-group-append">
                                    <button class="btn btn-warning" id="cariimplementasihasil" type="button"><i class="fas fa-search"></i> Pilih Implemntasi</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Rencana Keperawatan</label>
                                <textarea id="mymce2" name="hasil_uraianAskep" class="form-control" rows="8"><?php $dataUraianAskep = '';
                                                                                                                $cleanedText = strip_tags($row['uraianAskep']);
                                                                                                                $dataUraianAskep .= $cleanedText . "\n";
                                                                                                                echo $dataUraianAskep; ?></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Sasaran Rencana Asuhan</label>
                                <textarea id="mymce4" name="hasil_sasaranRencana" class="form-control" rows="8"> <?= $row['sasaranRencana']; ?></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tindakan & Evaluasi Keperawatan</label>
                                <textarea id="mymce3" name="hasil_tindakanEvaluasi" class="form-control" rows="8"><?php $dataEvaluasiAskep = '';
                                                                                                                    $cleanedText2 = strip_tags($row['implementasiAskep']);
                                                                                                                    $dataEvaluasiAskep .= $cleanedText2 . "\n";
                                                                                                                    echo $dataEvaluasiAskep; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-success btnsimpanhasil"><i class="fas fa-plus"></i> Ubah</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
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
        $("#hasil_paramedicName").autocomplete({

            source: "<?php echo base_url('PelayananRawatJalanRME/ajax_paramedicName'); ?>?poliklinikname=" + poliklinikname,
            select: function(event, ui) {
                $('#hasil_paramedicName').val(ui.item.value);

            }
        });
    });
</script>


<script type="text/javascript">
    $('#hasil_isialergi').on('change', function() {
        if ($('#hasil_isialergi').val() == 1) {
            $('#hasil_uraianAlergi').removeAttr('disabled');
            $('#hasil_isialergi').val(0);
            $('#hasil_alergi').val(1);
        } else {
            $('#hasil_uraianAlergi').attr('disabled', 'disabled');
            $('#hasil_uraianAlergi').val('');
            $('#hasil_isialergi').val(1);
            $('#hasil_alergi').val(0);

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

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskephasil').click(function(e) {
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
    $('#hasil_anamnesis').on('change', function() {
        if ($('#hasil_anamnesis').val() == "Allo Anamnesa") {
            $('#hasil_uraianAllo').removeAttr('disabled');
            $('#hasil_uraianAllo').val('');

        } else {
            $('#hasil_uraianAllo').attr('disabled', 'disabled');
            $('#hasil_uraianAllo').val('');



        }

    })
</script>



<script type="text/javascript">
    function hasiltotal2() {
        var hasileye2 = document.getElementById('hasil_eye').value;
        var hasilverbal2 = document.getElementById('hasil_verbal').value;
        var hasilmotorik2 = document.getElementById('hasil_motorik').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var hasilnilai_eye2 = parseInt(hasileye2);
        var hasilnilai_verbal2 = parseInt(hasilverbal2);
        var hasilnilai_motorik2 = parseInt(hasilmotorik2);
        var hasiltotalGCS2 = hasilnilai_eye2 + hasilnilai_verbal2 + hasilnilai_motorik2;
        document.getElementById('hasil_gcs').value = hasiltotalGCS2;
    }
</script>





<script type="text/javascript">
    $('#hasil_edema').on('change', function() {
        if ($('#hasil_edema').val() == "Ada") {
            $('#hasil_uraianEdema').removeAttr('disabled');
            $('#hasil_uraianEdema').val('');

        } else {
            $('#hasil_uraianEdema').attr('disabled', 'disabled');
            $('#hasil_uraianEdema').val('');
        }

    })
</script>


<script type="text/javascript">
    $('#hasil_laserasi').on('change', function() {
        if ($('#hasil_laserasi').val() == "Ada") {
            $('#hasil_uraianLaserasi').removeAttr('disabled');
            $('#hasil_uraianLaserasi').val('');

        } else {
            $('#hasil_uraianLaserasi').attr('disabled', 'disabled');
            $('#hasil_uraianLaserasi').val('');
        }

    })
</script>

<script type="text/javascript">
    function hasiltotalnutrisi() {
        var hasilpenurunanBb = document.getElementById('hasil_penurunanBb').value;
        var hasilasupanMakanan = document.getElementById('hasil_asupanMakanan').value;

        var hasilnilai_penurunan = parseInt(hasilpenurunanBb);
        var hasilnilai_asupanmakanan = parseInt(hasilasupanMakanan);

        var hasiltotalNutrisi = hasilnilai_penurunan + hasilnilai_asupanmakanan;
        document.getElementById('hasil_skorNutrisi').value = hasiltotalNutrisi;
    }
</script>



<script type="text/javascript">
    function hasiltotalnutrisiAnak() {
        var hasilnutrisiKurus = document.getElementById('hasil_nutrisiKurus').value;
        var hasilturunBbAnak = document.getElementById('hasil_turunBbAnak').value;
        var hasil_nutrisiMuntahDiare = document.getElementById('hasil_nutrisiMuntahDiare').value;
        var hasilpenyakitMalnutrisi = document.getElementById('hasil_penyakitMalnutrisi').value;

        var hasilnilai_nutrisiKurus = parseInt(hasilnutrisiKurus);
        var hasilnilai_turunBbAnak = parseInt(hasilturunBbAnak);
        var hasilnilai_nutrisiMuntahDiare = parseInt(hasilnutrisiMuntahDiare);
        var hasilnilai_malnutrisi = parseInt(hasilpenyakitMalnutrisi);

        var hasiltotalNutrisiAnak = hasilnilai_nutrisiKurus + hasilnilai_turunBbAnak + hasilnilai_nutrisiMuntahDiare + hasilnilai_malnutrisi;
        document.getElementById('hasil_skorNutrisiAnak').value = hasiltotalNutrisiAnak;
    }
</script>



<script>
    $('#cariimplementasihasil').click(function(e) {
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