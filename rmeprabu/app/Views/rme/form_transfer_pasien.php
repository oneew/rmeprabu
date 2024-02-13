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
    <?= form_open('PelayananRawatJalanRME/simpanTransferPasienIGD', ['class' => 'formtransfer']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>

                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Tanggal Jam Kedatangan</label>
                            <input type="text" class="form-control" id="transfer_admissionDateTime" name="transfer_admissionDateTime" required value="<?= $admissionDateTime; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tanggal Jam Pindah</label>
                            <input type="text" class="form-control" id="transfer_pindahDateTime" name="transfer_pindahDateTime" required value="<?= date('d-m-Y G:i:s'); ?>">
                            <input type="hidden" class="form-control" id="transfer_paramedicName" name="transfer_paramedicName" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="transfer_createdBy" name="transfer_createdBy" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="transfer_createddate" name="transfer_createddate" required value="<?= date('Y-m-d G:i:s'); ?>">

                            <input type="hidden" class="form-control" id="transfer_nomorreferensi" name="transfer_nomorreferensi" required value="<?= $nomorreferensi; ?>">
                            <input type="hidden" class="form-control" id="transfer_poliklinikname" name="transfer_poliklinikname" required value="<?= $poliklinikname; ?>">
                            <input type="hidden" class="form-control" id="transfer_pasienid" name="transfer_pasienid" required value="<?= $pasienid; ?>">
                            <input type="hidden" class="form-control" id="transfer_pasienname" name="transfer_pasienname" required value="<?= $pasienname; ?>">
                            <input type="hidden" class="form-control" id="transfer_paymentmethodname" name="transfer_paymentmethodname" required value="<?= $paymentmethodname; ?>">
                            <input type="hidden" class="form-control" id="transfer_admissionDate" name="transfer_admissionDate" required value="<?= $admissionDate; ?>">
                            <input type="hidden" class="form-control" id="transfer_doktername" name="transfer_doktername" required value="<?= $doktername; ?>">
                            <input type="hidden" class="form-control" id="transfer_admissionDate" name="transfer_admissionDate" required value="<?= $admissionDate; ?>">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Dari Ruang</label>
                            <input type="text" class="form-control" id="transfer_dariRuang" name="transfer_dariRuang" required value="IGD">
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="nomorasuransi">Ke Ruang</label>
                                <div class="input-group">
                                    <input type="text" class="form-control required" id="transfer_ruangTujuan" name="transfer_ruangTujuan" value="<?= $ruangan; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="nomorasuransi">Diagnosa Masuk</label>
                                <div class="input-group">
                                    <input type="text" class="form-control required" id="transfer_diagnosa" name="transfer_diagnosa" value="<?= $diagnosis; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" id="btn-caridiagnosa" type="button">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Indikasi Rawat</label>
                            <input type="text" class="form-control" id="transfer_indikasiRawat" name="transfer_indikasiRawat" required>
                        </div>
                    </div>
                    <hr class="hr16">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Keluhan Utama</label>
                            <input type="text" class="form-control" id="transfer_keluhanUtama" name="transfer_keluhanUtama" value="<?= $keluhanUtama; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Riwayat Penyakit Sekarang</label>
                            <input type="text" class="form-control" id="transfer_riwayatPenyakitSekarang" name="transfer_riwayatPenyakitSekarang" value="<?= $rps; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Alergi</label>
                            <input type="text" class="form-control" id="transfer_riwayatAlergi" name="transfer_riwayatAlergi" value="<?= $alergi; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Keterangan Alergi</label>
                            <input type="text" class="form-control" id="transfer_uraianAlergi" name="transfer_uraianAlergi" value="<?= $uraianAlergi; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Pemeriksaan Fisik</label>
                            <input type="text" class="form-control" id="transfer_pemeriksaanFisik" name="transfer_pemeriksaanFisik">
                        </div>
                    </div>
                    <hr class="hr17">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Kesadaran</label>
                            <select name="transfer_kesadaran" id="transfer_kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="transfer_bb" name="transfer_bb" required value="<?= $bb; ?>">
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="transfer_tb" name="transfer_tb" required value="<?= $tb; ?>">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="transfer_frekuensiNadi" name="transfer_frekuensiNadi" required value="<?= $frekuensiNadi; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="transfer_tdSistolik" name="transfer_tdSistolik" required value="<?= $tdSistolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="transfer_tdDiastolik" name="transfer_tdDiastolik" required value="<?= $tdDiastolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="transfer_suhu" name="transfer_suhu" required value="<?= $suhu; ?>">
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="transfer_frekuensiNafas" name="transfer_frekuensiNafas" required value="<?= $frekuensiNafas; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="transfer_spo2" name="transfer_spo2" required value="<?= $spo2; ?>">
                            <small class="form-control-feedback">%</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Keadaan Umum</label>
                            <select name="transfer_keadaanUmum" id="transfer_keadaanUmum" class="select2" style="width: 100%">
                                <option value="Baik" <?php if ($keadaanUmum == 'Baik') echo "selected"; ?>>Baik</option>
                                <option value="Sedang <?php if ($keadaanUmum == 'Sedang') echo "selected"; ?>">Sedang</option>
                                <option value="Buruk <?php if ($keadaanUmum == 'Buruk') echo "selected"; ?>">Buruk</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Alasan Transfer</label>
                            <input type="text" class="form-control" id="transfer_alasan" name="transfer_alasan" required>

                        </div>
                    </div>
                    <hr class="hr18">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Hasil Pemeriksaan Penunjang</label>
                            <textarea id="mymce2" name="transfer_hasilpenunjang" class="form-control" rows="3"></textarea>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tindakan / Prosedur Yang Dilakukan</label>
                            <textarea id="mymce2" name="transfer_prosedur" class="form-control" rows="3"><?= $prosedur; ?></textarea>

                        </div>
                    </div>
                    <hr class="hr19">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Obat</label>
                            <textarea id="mymce2" name="transfer_obat" class="form-control" rows="3"><?= $dataObat; ?></textarea>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Lain-lain</label>
                            <textarea id="mymce2" name="transfer_lain_lain" class="form-control" rows="2">-</textarea>

                        </div>

                    </div>
                    <hr class="hr20">
                    <div class="row">

                        <div class="col-md-2 mb-3">
                            <label>Keadaan Umum</label>
                            <select name="transfer_keadaanUmumPindah" id="transfer_keadaanUmumPindah" class="select2" style="width: 100%">
                                <option value="Baik" <?php if ($keadaanUmum == 'Baik') echo "selected"; ?>>Baik</option>
                                <option value="Sedang <?php if ($keadaanUmum == 'Sedang') echo "selected"; ?>">Sedang</option>
                                <option value="Buruk <?php if ($keadaanUmum == 'Buruk') echo "selected"; ?>">Buruk</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Eye</label>
                            <select name="transfer_eye" id="transfer_eye" class="select2" style="width: 100%" required onchange="totalGCSTransfer()">
                                <option value="">Pilih</option>
                                <?php foreach ($eye as $eye) : ?>
                                    <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $eye_triase) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Verbal</label>
                            <select name="transfer_verbal" id="transfer_verbal" class="select2" style="width: 100%" required onchange="totalGCSTransfer()">
                                <option value="">Pilih</option>
                                <?php foreach ($verbal as $verbal) : ?>
                                    <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $verbal_triase) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Motorik</label>
                            <select name="transfer_motorik" id="transfer_motorik" class="select2" style="width: 100%" required onchange="totalGCSTransfer()">
                                <option value="">Pilih</option>
                                <?php foreach ($motorik as $motorik) : ?>
                                    <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $motorik_triase) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Total GCS</b></label>
                            <input type="number" class="form-control" id="transfer_pindah_gcs" name="transfer_pindah_gcs" required readonly value="<?= $totalGcs; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="transfer_pindah_bb" name="transfer_pindah_bb" required value="<?= $bb; ?>">
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="transfer_pindah_tb" name="transfer_pindah_tb" required value="<?= $tb; ?>">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="transfer_pindah_frekuensiNadi" name="transfer_pindah_frekuensiNadi" required value="<?= $frekuensiNadi; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="transfer_pindah_tdSistolik" name="transfer_pindah_tdSistolik" required value="<?= $tdSistolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="transfer_pindah_tdDiastolik" name="transfer_pindah_tdDiastolik" required value="<?= $tdDiastolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="transfer_pindah_suhu" name="transfer_pindah_suhu" required value="<?= $suhu; ?>">
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="transfer_pindah_frekuensiNafas" name="transfer_pindah_frekuensiNafas" required value="<?= $frekuensiNafas; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="transfer_pindah_spo2" name="transfer_pindah_spo2" required value="<?= $spo2; ?>">
                            <small class="form-control-feedback">%</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tinggi Fundus Uteri</label>
                            <input type="text" class="form-control" id="transfer_tinggiFundusUteri" name="transfer_tinggiFundusUteri">

                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kontraksi Uterus</label>
                            <input type="text" class="form-control" id="transfer_kontraksi_kontraksiUterus" name="transfer_kontraksi_kontraksiUterus">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Denyut Jantung Janin</label>
                            <input type="text" class="form-control" id="transfer_janin" name="transfer_janin">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perdarahan</label>
                            <input type="text" class="form-control" id="transfer_perdarahan" name="transfer_perdarahan">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Diet</label>
                            <input type="text" class="form-control" id="transfer_diet" name="transfer_diet">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Mobilisasi</label>
                            <input type="text" class="form-control" id="transfer_mobilisasi" name="transfer_mobilisasi">

                        </div>
                    </div>
                    <hr class="hr21">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Dekubitus</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_dekubitus" id="transfer_dekubitus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nyeri</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_nyeri" id="transfer_nyeri" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jatuh</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_jatuh" id="transfer_jatuh" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Alergi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_alergi" id="transfer_alergi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Phlebitis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_phlebitis" id="transfer_phlebitis" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Lain-lain</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_lain_asesmen" id="transfer_lain_asesmen" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian Lain-lain</label>
                            <input type="text" class="form-control" id="uraianLain" name="uraianLain">
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
                                    <input name="transfer_ngt" id="transfer_ngt" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Folley Catheter</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_folley" id="transfer_folley" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Chest Tube + WSD</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_chest" id="transfer_chest" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>ETT</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="transfer_ett" id="transfer_ett" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr23">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Alat Transport</label>
                            <select name="transfer_alat_transport" id="transfer_alat_transport" class="select2" style="width: 100%" required>
                                <?php foreach ($transport_transfer as $trans) : ?>
                                    <option value="<?php echo $trans['name']; ?>"><?php echo $trans['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Derajat Pasien</label>
                            <select name="transfer_derajat" id="transfer_derajat" class="select2" style="width: 100%" required>
                                <?php foreach ($derajat_transfer as $trans) : ?>
                                    <option value="<?php echo $trans['nilai']; ?>"><?php echo $trans['name']; ?> | ><?php echo $trans['nilai']; ?> | ><?php echo $trans['pendamping']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Petugas Pendamping</label>
                            <input type="text" class="form-control" id="transfer_petugasPendamping" name="transfer_petugasPendamping" value="<?= session()->get('firstname'); ?>">
                        </div>
                    </div>
                    <hr class="hr24">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Keadaan Umum</label>
                            <select name="transfer_keadaanUmumtiba" id="transfer_keadaanUmumtiba" class="select2" style="width: 100%" disabled>
                                <option value=""></option>
                                <option value="Baik">Baik</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Buruk">Buruk</option>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label><b>Total GCS</b></label>
                            <input type="number" class="form-control" id="transfer_tiba_gcs" name="transfer_tiba_gcs" disabled>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="transfer_tiba_bb" name="transfer_tiba_bb" disabled>
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="transfer_tiba_tb" name="transfer_tiba_tb" disabled>
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="transfer_tiba_frekuensiNadi" name="transfer_tiba_frekuensiNadi" disabled>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="transfer_tiba_tdSistolik" name="transfer_tiba_tdSistolik" disabled>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="transfer_tiba_tdDiastolik" name="transfer_tiba_tdDiastolik" disabled>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="transfer_tiba_suhu" name="transfer_tiba_suhu" disabled>
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="transfer_tiba_frekuensiNafas" name="transfer_tiba_frekuensiNafas" disabled>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="transfer_tiba_spo2" name="transfer_tiba_spo2" disabled>
                            <small class="form-control-feedback">%</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tinggi Fundus Uteri</label>
                            <input type="text" class="form-control" id="transfer_tinggiPundusUteri_tiba" name="transfer_tinggiPundusUteri_tiba" disabled>

                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Kontraksi Uterus</label>
                            <input type="text" class="form-control" id="transfer_kontraksi_kontraksiUterus_tiba" name="transfer_kontraksi_kontraksiUterus_tiba" disabled>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Denyut Jantung Janin</label>
                            <input type="text" class="form-control" id="transfer_janin_tiba" name="transfer_janin_tiba" disabled>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perdarahan</label>
                            <input type="text" class="form-control" id="transfer_perdarahan_tiba" name="transfer_perdarahan_tiba" disabled>
                        </div>
                    </div>
                    <hr class="hr25">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Dokter IGD/DPJP Pemberi Keputusan</label>
                            <input type="text" class="form-control" id="transfer_dpjp" name="transfer_dpjp" required value="<?= $doktername; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Perawat Yang Memindahkan</label>
                            <input type="text" class="form-control" id="transfer_perawat_pemindah" name="transfer_perawat_pemindah" required value="<?= session()->get('firstname'); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Perawat Yang Menerma</label>
                            <input type="text" class="form-control" id="transfer_perawat_penerima" name="transfer_perawat_penerima" disabled>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
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
        $('.formtransfer').submit(function(e) {
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
                        datatransferHasil();

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
    function totalGCSTransfer() {
        var eye6 = document.getElementById('transfer_eye').value;
        var verbal6 = document.getElementById('transfer_verbal').value;
        var motorik6 = document.getElementById('transfer_motorik').value;

        var nilai_eye6 = parseInt(eye6);
        var nilai_verbal6 = parseInt(verbal6);
        var nilai_motorik6 = parseInt(motorik6);
        var totalGCS6 = nilai_eye6 + nilai_verbal6 + nilai_motorik6;
        document.getElementById('transfer_pindah_gcs').value = totalGCS6;
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