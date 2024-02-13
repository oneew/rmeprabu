<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr16 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr16:after {
        background: #fff;
        content: 'Riwayat Ringkas Pasien';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr17 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr17:after {
        background: #fff;
        content: 'Tanda-tanda Vital';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr18 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr18:after {
        background: #fff;
        content: 'Hasil Pemeriksaan Penunjang & Prosedur Yang Dilakukan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr19 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr19:after {
        background: #fff;
        content: 'Terapi Obat Yang Diberikan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr20 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr20:after {
        background: #fff;
        content: 'Kondisi Pasien Saat Pindah';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr21 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr21:after {
        background: #fff;
        content: 'Asesmen Resiko';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr22 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr22:after {
        background: #fff;
        content: 'Penggunaan Alat';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr23 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr23:after {
        background: #fff;
        content: '$$';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr24 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr24:after {
        background: #fff;
        content: 'Kondisi Pasien Saat Tiba Di Ruangan Tujuan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr25 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr25:after {
        background: #fff;
        content: 'Petugas';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>


<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanTerimaTransferPasien', ['class' => 'formterimatransfer']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <?php $no = 0;
                foreach ($cek_Hasil_transfer as $row) :
                    $no++;
                    $dekubitus = $row['dekubitus'] == 1 ? 'checked' : 0;
                    $nyeri = $row['nyeri'] == 1 ? 'checked' : 0;
                    $jatuh = $row['jatuh'] == 1 ? 'checked' : 0;
                    $alergi = $row['alergi'] == 1 ? 'checked' : 0;
                    $phlebitis = $row['phlebitis'] == 1 ? 'checked' : '';
                    $lain_lainPindah = $row['lain_lainPindah'] == 1 ? 'checked' : '';

                    $ngt = $row['ngt'] == 1 ? 'checked' : 0;
                    $folley = $row['folley'] == 1 ? 'checked' : 0;
                    $chest = $row['chest'] == 1 ? 'checked' : 0;
                    $ett = $row['ett'] == 1 ? 'checked' : 0;
                ?>
                    <form>

                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Tanggal Jam Kedatangan IGD</label>
                                <input type="text" class="form-control" id="hasil_transfer_admissionDateTime" name="hasil_transfer_admissionDateTime" required value="<?= $row['admissionDateTime']; ?>" disabled>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Pindah Ke Ruangan</label>
                                <input type="text" class="form-control" id="hasil_transfer_pindahDateTime" name="hasil_transfer_pindahDateTime" required value="<?= $row['pindahDateTime'] ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_paramedicName" name="hasil_transfer_paramedicName" required value="<?= $row['paramedicName'] ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_createdBy" name="hasil_transfer_createdBy" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_createddate" name="hasil_transfer_createddate" required value="<?= date('Y-m-d G:i:s'); ?>">

                                <input type="hidden" class="form-control" id="hasil_transfer_nomorreferensi" name="hasil_transfer_nomorreferensi" required value="<?= $row['referencenumber']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_poliklinikname" name="hasil_transfer_poliklinikname" required value="<?= $row['poliklinikname']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_pasienid" name="hasil_transfer_pasienid" required value="<?= $row['pasienid']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_pasienname" name="hasil_transfer_pasienname" required value="<?= $row['pasienname']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_paymentmethodname" name="hasil_transfer_paymentmethodname" required value="<?= $row['paymentmethodname']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_admissionDate" name="hasil_transfer_admissionDate" required value="<?= $row['admissionDate']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_doktername" name="hasil_transfer_doktername" required value="<?= $row['doktername']; ?>">
                                <input type="hidden" class="form-control" id="hasil_transfer_admissionDate" name="hasil_transfer_admissionDate" required value="<?= $row['admissionDate']; ?>">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Dari Ruang</label>
                                <input type="text" class="form-control" id="hasil_transfer_dariRuang" name="hasil_transfer_dariRuang" required value="<?= $row['dariRuang']; ?>" disabled>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Ke Ruang</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="hasil_transfer_ruangTujuan" name="hasil_transfer_ruangTujuan" value="<?= $row['ruangTujuan']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Diagnosa Masuk</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="hasil_transfer_diagnosa" name="hasil_transfer_diagnosa" value="<?= $row['diagnosa']; ?>" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-info" id="btn-caridiagnosa" type="button">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Indikasi Rawat</label>
                                <input type="text" class="form-control" id="hasil_transfer_indikasiRawat" name="hasil_transfer_indikasiRawat" required value="<?= $row['indikasiRawat']; ?>" disabled>
                            </div>
                        </div>
                        <hr class="hr16">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Keluhan Utama</label>
                                <input type="text" class="form-control" id="hasil_transfer_keluhanUtama" name="hasil_transfer_keluhanUtama" value="<?= $row['keluhanUtama']; ?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Riwayat Penyakit Sekarang</label>
                                <input type="text" class="form-control" id="hasil_transfer_riwayatPenyakitSekarang" name="hasil_transfer_riwayatPenyakitSekarang" value="<?= $row['riwayatPenyakitSekarang']; ?>" disabled>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Riwayat Alergi</label>
                                <input type="text" class="form-control" id="hasil_transfer_riwayatAlergi" name="hasil_transfer_riwayatAlergi" value="<?= $row['riwayatAlergi']; ?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Keterangan Alergi</label>
                                <input type="text" class="form-control" id="hasil_transfer_uraianAlergi" name="hasil_transfer_uraianAlergi" value="<?= $row['uraianAlergi']; ?>" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Pemeriksaan Fisik</label>
                                <input type="text" class="form-control" id="hasil_transfer_pemeriksaanFisik" name="hasil_transfer_pemeriksaanFisik" value="<?= $row['pemeriksaanFisik']; ?>" disabled>
                            </div>
                        </div>
                        <hr class="hr17">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Kesadaran</label>
                                <select name="hasil_transfer_kesadaran" id="hasil_transfer_kesadaran" class="select2" style="width: 100%" disabled>
                                    <?php foreach ($kesadaran as $kes) : ?>
                                        <option value="<?php echo $kes['name']; ?>" <?php if ($kes['name'] == $row['kesadaran']) { ?> selected="selected" <?php } ?>><?php echo $kes['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>BB</label>
                                <input type="number" class="form-control" id="hasil_transfer_bb" name="hasil_transfer_bb" required value="<?= $row['bb']; ?>" disabled>
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TB</label>
                                <input type="number" class="form-control" id="hasil_transfer_tb" name="hasil_transfer_tb" required value="<?= $row['tb']; ?>" disabled>
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nadi</label>
                                <input type="number" class="form-control" id="hasil_transfer_frekuensiNadi" name="hasil_transfer_frekuensiNadi" required value="<?= $row['frekuensiNadi']; ?>" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Sistolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_tdSistolik" name="hasil_transfer_tdSistolik" required value="<?= $row['tdSistolik']; ?>" disabled>
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Diastolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_tdDiastolik" name="hasil_transfer_tdDiastolik" required value="<?= $row['tdDiastolik']; ?>" disabled>
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suhu</label>
                                <input type="text" class="form-control" id="hasil_transfer_suhu" name="hasil_transfer_suhu" required value="<?= $row['suhu']; ?>" disabled>
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nafas</label>
                                <input type="number" class="form-control" id="hasil_transfer_frekuensiNafas" name="hasil_transfer_frekuensiNafas" required value="<?= $row['frekuensiNafas']; ?>" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>SpO2</label>
                                <input type="number" class="form-control" id="hasil_transfer_spo2" name="hasil_transfer_spo2" required value="<?= $row['spo2']; ?>" disabled>
                                <small class="form-control-feedback">%</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Keadaan Umum</label>
                                <select name="hasil_transfer_keadaanUmum" id="hasil_transfer_keadaanUmum" class="select2" style="width: 100%" disabled>
                                    <option value="Baik" <?php if ($row['keadaanUmum'] == 'Baik') echo "selected"; ?>>Baik</option>
                                    <option value="Sedang <?php if ($row['keadaanUmum'] == 'Sedang') echo "selected"; ?>">Sedang</option>
                                    <option value="Buruk <?php if ($row['keadaanUmum'] == 'Buruk') echo "selected"; ?>">Buruk</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Alasan Transfer</label>
                                <input type="text" class="form-control" id="hasil_transfer_alasan" name="hasil_transfer_alasan" required value="<?= $row['alasanTransfer']; ?>" disabled>

                            </div>
                        </div>
                        <hr class="hr18">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Hasil Pemeriksaan Penunjang</label>
                                <textarea id="mymce20" name="hasil_transfer_hasilpenunjang" class="form-control" rows="3" disabled><?= $row['hasilPenunjang']; ?></textarea>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tindakan / Prosedur Yang Dilakukan</label>
                                <textarea id="mymce20" name="hasil_transfer_prosedur" class="form-control" rows="3" disabled><?= $row['prosedur']; ?></textarea>

                            </div>
                        </div>
                        <hr class="hr19">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Obat</label>
                                <textarea id="mymce20" name="hasil_transfer_obat" class="form-control" rows="3" disabled><?= $row['obat']; ?></textarea>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Lain-lain</label>
                                <textarea id="mymce20" name="hasil_transfer_lain_lain" class="form-control" rows="2" disabled><?= $row['lain_lain']; ?></textarea>

                            </div>

                        </div>
                        <hr class="hr20">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Keadaan Umum</label>
                                <select name="hasil_transfer_keadaanUmumPindah" id="hasil_transfer_keadaanUmumPindah" class="select2" style="width: 100%" disabled>
                                    <option value="Baik" <?php if ($row['keadaanUmumPindah'] == 'Baik') echo "selected"; ?>>Baik</option>
                                    <option value="Sedang <?php if ($row['keadaanUmumPindah'] == 'Sedang') echo "selected"; ?>">Sedang</option>
                                    <option value="Buruk <?php if ($row['keadaanUmumPindah'] == 'Buruk') echo "selected"; ?>">Buruk</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Eye</label>
                                <select name="hasil_transfer_eye" id="hasil_transfer_eye" class="select2" style="width: 100%" required onchange="totalGCSTransferHasil()" disabled>
                                    <option value="">Pilih</option>
                                    <?php foreach ($eye as $eye) : ?>
                                        <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $row['eye']) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Verbal</label>
                                <select name="hasil_transfer_verbal" id="hasil_transfer_verbal" class="select2" style="width: 100%" required onchange="totalGCSTransferHasil()" disabled>
                                    <option value="">Pilih</option>
                                    <?php foreach ($verbal as $verbal) : ?>
                                        <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $row['verbal']) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Motorik</label>
                                <select name="hasil_transfer_motorik" id="hasil_transfer_motorik" class="select2" style="width: 100%" required onchange="totalGCSTransferHasil()" disabled>
                                    <option value="">Pilih</option>
                                    <?php foreach ($motorik as $motorik) : ?>
                                        <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $row['motorik']) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Total GCS</b></label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_gcs" name="hasil_transfer_pindah_gcs" required readonly value="<?= $row['totalGcs']; ?>" disabled>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>BB</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_bb" name="hasil_transfer_pindah_bb" required value="<?= $row['bbPindah']; ?>" disabled>
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TB</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_tb" name="hasil_transfer_pindah_tb" required value="<?= $row['tbPindah']; ?>" disabled>
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nadi</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_frekuensiNadi" name="hasil_transfer_pindah_frekuensiNadi" required value="<?= $row['frekuensiNadiPindah']; ?>" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Sistolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_tdSistolik" name="hasil_transfer_pindah_tdSistolik" required value="<?= $row['tdSistolikPindah']; ?>" disabled>
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Diastolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_tdDiastolik" name="hasil_transfer_pindah_tdDiastolik" required value="<?= $row['tdDiastolikPindah']; ?>" disabled>
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suhu</label>
                                <input type="text" class="form-control" id="hasil_transfer_pindah_suhu" name="hasil_transfer_pindah_suhu" required value="<?= $row['suhuPindah']; ?>" disabled>
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nafas</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_frekuensiNafas" name="hasil_transfer_pindah_frekuensiNafas" required value="<?= $row['frekuensiNafasPindah']; ?>" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>SpO2</label>
                                <input type="number" class="form-control" id="hasil_transfer_pindah_spo2" name="hasil_transfer_pindah_spo2" required value="<?= $row['spo2Pindah']; ?>" disabled>
                                <small class="form-control-feedback">%</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Tinggi Fundus Uteri</label>
                                <input type="text" class="form-control" id="hasil_transfer_tinggiFundusUteri" name="hasil_transfer_tinggiFundusUteri" value="<?= $row['tinggiFundusUteriPindah']; ?>" disabled>

                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kontraksi Uterus</label>
                                <input type="text" class="form-control" id="hasil_transfer_kontraksi_kontraksiUterus" name="hasil_transfer_kontraksi_kontraksiUterus" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Denyut Jantung Janin</label>
                                <input type="text" class="form-control" id="hasil_transfer_janin" name="hasil_transfer_janin" value="<?= $row['janin']; ?>" disabled>
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Perdarahan</label>
                                <input type="text" class="form-control" id="hasil_transfer_perdarahan" name="hasil_transfer_perdarahan" value="<?= $row['perdarahan']; ?>" disabled>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Diet</label>
                                <input type="text" class="form-control" id="hasil_transfer_diet" name="hasil_transfer_diet" value="<?= $row['diet']; ?>" disabled>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Mobilisasi</label>
                                <input type="text" class="form-control" id="hasil_transfer_mobilisasi" name="hasil_transfer_mobilisasi" value="<?= $row['mobilisasi']; ?>" disabled>

                            </div>
                        </div>
                        <hr class="hr21">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Dekubitus</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_dekubitus" id="hasil_transfer_dekubitus" value="1" type="checkbox" <?= $dekubitus; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Nyeri</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_nyeri" id="hasil_transfer_nyeri" value="1" type="checkbox" <?= $nyeri; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Jatuh</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_jatuh" id="hasil_transfer_jatuh" value="1" type="checkbox" <?= $jatuh; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Alergi</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_alergi" id="hasil_transfer_alergi" value="1" type="checkbox" <?= $alergi; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Phlebitis</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_phlebitis" id="hasil_transfer_phlebitis" value="1" type="checkbox" <?= $phlebitis; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Lain-lain</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_lain_asesmen" id="hasil_transfer_lain_asesmen" value="1" type="checkbox" <?= $lain_lainPindah; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Uraian Lain-lain</label>
                                <input type="text" class="form-control" id="uraianLain" name="uraianLain" value="<?= $row['uraianLain']; ?>" disabled>
                                <input type="hidden" class="form-control" id="lain" name="lain">
                                <small class="form-control-feedback">Ditulis Jika Ada Lain-lain</small>
                            </div>
                        </div>
                        <hr class="hr22">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>NGT</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_ngt" id="hasil_transfer_ngt" value="1" type="checkbox" <?= $ngt; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Folley Catheter</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_folley" id="hasil_transfer_folley" value="1" type="checkbox" <?= $folley; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Chest Tube + WSD</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_chest" id="hasil_transfer_chest" value="1" type="checkbox" <?= $chest; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>ETT</label>
                                <div class="switch">
                                    <label class="d-flex flex-column flex-sm-row">
                                        <input name="hasil_transfer_ett" id="hasil_transfer_ett" value="1" type="checkbox" <?= $ett; ?>><span class="lever switch-col-blue"></span></label>
                                </div>
                            </div>
                        </div>
                        <hr class="hr23">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Alat Transport</label>
                                <select name="hasil_transfer_alat_transport" id="hasil_transfer_alat_transport" class="select2" style="width: 100%" required disabled>
                                    <?php foreach ($transport_transfer as $trans) : ?>
                                        <option value="<?php echo $trans['name']; ?>" <?php if ($trans['name'] == $row['alat_transport']) { ?> selected="selected" <?php } ?>><?php echo $trans['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Derajat Pasien</label>
                                <select name="hasil_transfer_derajat" id="hasil_transfer_derajat" class="select2" style="width: 100%" required disabled>
                                    <?php foreach ($derajat_transfer as $trans) : ?>
                                        <option value="<?php echo $trans['nilai']; ?>" <?php if ($trans['nilai'] == $row['derajatPasien']) { ?> selected="selected" <?php } ?><?php echo $trans['name']; ?> |><?php echo $trans['nilai']; ?> | ><?php echo $trans['pendamping']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Petugas Pendamping</label>
                                <input type="text" class="form-control" id="hasil_transfer_petugasPendamping" name="hasil_transfer_petugasPendamping" value="<?= $row['petugasPendamping']; ?>">
                            </div>
                        </div>
                        <hr class="hr24">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Keadaan Umum</label>
                                <select name="hasil_transfer_keadaanUmumtiba" id="hasil_transfer_keadaanUmumtiba" class="select2" style="width: 100%">
                                    <option value="Baik" <?php if ($row['keadaanUmumTiba'] == 'Baik') echo "selected"; ?>>Baik</option>
                                    <option value="Sedang <?php if ($row['keadaanUmumTiba'] == 'Sedang') echo "selected"; ?>">Sedang</option>
                                    <option value="Buruk <?php if ($row['keadaanUmumTiba'] == 'Buruk') echo "selected"; ?>">Buruk</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label><b>Total GCS</b></label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_gcs" name="hasil_transfer_tiba_gcs" value="<?= $row['totalGcsTiba']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>BB</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_bb" name="hasil_transfer_tiba_bb" value="<?= $row['bbTiba']; ?>">
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TB</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_tb" name="hasil_transfer_tiba_tb" value="<?= $row['tb']; ?>">
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nadi</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_frekuensiNadi" name="hasil_transfer_tiba_frekuensiNadi" value="<?= $row['frekuensiNadiTiba']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Sistolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_tdSistolik" name="hasil_transfer_tiba_tdSistolik" value="<?= $row['tdSistolikTiba']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Diastolik</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_tdDiastolik" name="hasil_transfer_tiba_tdDiastolik" value="<?= $row['tdDiastolikTiba']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suhu</label>
                                <input type="text" class="form-control" id="hasil_transfer_tiba_suhu" name="hasil_transfer_tiba_suhu" value="<?= $row['suhuTiba']; ?>">
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nafas</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_frekuensiNafas" name="hasil_transfer_tiba_frekuensiNafas" value="<?= $row['frekuensiNafasTiba']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>SpO2</label>
                                <input type="number" class="form-control" id="hasil_transfer_tiba_spo2" name="hasil_transfer_tiba_spo2" value="<?= $row['spo2Tiba']; ?>">
                                <small class="form-control-feedback">%</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Tinggi Fundus Uteri</label>
                                <input type="text" class="form-control" id="hasil_transfer_tinggiFundusUteri_tiba" name="hasil_transfer_tinggiFundusUteri_tiba" value="<?= $row['tinggiFundusUteriTiba']; ?>">

                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Kontraksi Uterus</label>
                                <input type="text" class="form-control" id="hasil_transfer_kontraksi_kontraksiUterus_tiba" name="hasil_transfer_kontraksi_kontraksiUterus_tiba" value="<?= $row['kontraksiUterusTiba']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Denyut Jantung Janin</label>
                                <input type="text" class="form-control" id="hasil_transfer_janin_tiba" name="hasil_transfer_janin_tiba" value="<?= $row['janinTiba']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Perdarahan</label>
                                <input type="text" class="form-control" id="hasil_transfer_perdarahan_tiba" name="hasil_transfer_perdarahan_tiba" value="<?= $row['perdarahanTiba']; ?>">
                            </div>
                        </div>
                        <hr class="hr25">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Dokter IGD/DPJP Pemberi Keputusan</label>
                                <input type="text" class="form-control" id="hasil_transfer_dpjp" name="hasil_transfer_dpjp" required value="<?= $row['doktername']; ?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Perawat Yang Memindahkan</label>
                                <input type="text" class="form-control" id="hasil_transfer_perawat_pemindah" name="hasil_transfer_perawat_pemindah" required value="<?= $row['paramedicNamePemindah']; ?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Perawat Yang Menerma</label>
                                <input type="text" class="form-control" id="hasil_transfer_perawat_penerima" name="hasil_transfer_perawat_penerima" value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="no_id_transfer" name="no_id_transfer" value="<?= $row['id']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Ubah</button>
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
        $('.formterimatransfer').submit(function(e) {
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
                        dataterimatransfer();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskep').click(function(e) {
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
    function total3() {
        var eye3 = document.getElementById('monitoring_eye').value;
        var verbal3 = document.getElementById('monitoring_verbal').value;
        var motorik3 = document.getElementById('monitoring_motorik').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var nilai_eye3 = parseInt(eye3);
        var nilai_verbal3 = parseInt(verbal3);
        var nilai_motorik3 = parseInt(motorik3);
        var totalGCS3 = nilai_eye3 + nilai_verbal3 + nilai_motorik3;
        document.getElementById('monitoring_gcs').value = totalGCS3;
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
    $('#cariimplementasi').click(function(e) {
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


<script type="text/javascript">
    function totalGCSTransferHasil() {
        var eye7 = document.getElementById('hasil_transfer_eye').value;
        var verbal7 = document.getElementById('hasil_transfer_verbal').value;
        var motorik7 = document.getElementById('hasil_transfer_motorik').value;

        var nilai_eye7 = parseInt(eye7);
        var nilai_verbal7 = parseInt(verbal7);
        var nilai_motorik7 = parseInt(motorik7);
        var totalGCS7 = nilai_eye7 + nilai_verbal7 + nilai_motorik7;
        document.getElementById('thasil_ransfer_pindah_gcs').value = totalGCS7;
    }
</script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#transfer_diagnosa").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>",
            select: function(event, ui) {
                $('#transfer_diagnosa').val(ui.item.value);
            }
        });
    });
</script>