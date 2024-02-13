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
        content: 'ASSESMEN HEMODIALISA';
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

    .hr4 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr4:after {
        background: #fff;
        content: 'Gizi (Dikaji tiap 3-6 bulan sekali atau di ulang jika terjadi perburukan asupan gizi)';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr5 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr5:after {
        background: #fff;
        content: 'RENCANA KEPERAWATAN';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr6 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr6:after {
        background: #fff;
        content: 'INTERVENSI KOLABORASI';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr7 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr7:after {
        background: #fff;
        content: 'INSTRUKSI MEDIK';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<div class="col-lg-12 col-md-12 px-0">
    <div class="modal-body px-0">
        <div class="form-body">
            <form action="<?= base_url('PelayananRawatJalanRME/simpanAsesmenPerawatHD'); ?>" method="POST" class="formasesmenhemodialisa">
                <?= csrf_field(); ?>
                <hr>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label>Tanggal Masuk</label>
                        <input type="text" class="form-control" id="admissionDate" name="admissionDate" required value="<?= date('Y-m-d G:i:s'); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>DPJP</label>
                        <input type="text" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>PPJP</label>
                        <input type="text" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>No Mesin</label>
                        <input type="text" class="form-control" id="nomesin" name="nomesin" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Hemodialisa Ke</label>
                        <input type="text" class="form-control" id="hdke" name="hdke" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Diagnosa HD</label>
                        <input type="text" class="form-control" id="diagnosahd" name="diagnosahd" value="CKD Stage 5 on HD" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Tipe Dialiser</label>
                        <input type="text" class="form-control" id="tipeDL" name="tipeDL" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Tipe Dialiser</label>
                        <select name="tipedialiser" id="tipedialiser" class="select2" style="width: 100%" required onchange="">
                            <option value="0">New</option>
                            <option value="1">Reuse</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Alergi</label>
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
                        <label><b>Keluhan Utama</b></label>
                        <textarea id="keluhanUtama" name="keluhanUtama" required class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <img src="https://kliniknyeritulangbelakang.com/wp-content/uploads/2020/07/Skala-nyeri-wajah.png" alt="" width="100%">
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
                        <label>Kesadaran</label>
                        <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                            <?php foreach ($kesadaran as $kes) : ?>
                                <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Keadaan Umum</label>
                        <select name="keadaanumum" id="keadaanumum" class="select2" style="width: 100%">
                            <option value="Baik">Baik</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Buruk">Buruk</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Riwayat Penyakit Dahulu</label>
                        <input type="text" class="form-control" id="riwayatPenyakitDahulu" name="riwayatPenyakitDahulu" value="-">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>BB</label>
                        <input type="text" class="form-control" id="bb" name="bb" required>
                        <small class="form-control-feedback">Kg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TB</label>
                        <input type="text" class="form-control" id="tb" name="tb" required>
                        <small class="form-control-feedback">Cm</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Frekuensi Nadi</label>
                        <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required value="">
                        <small class="form-control-feedback">x/menit</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TD Sistolik</label>
                        <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required value="">
                        <small class="form-control-feedback">mmHg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TD Diastolik</label>
                        <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required value="">
                        <small class="form-control-feedback">mmHg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Suhu</label>
                        <input type="text" class="form-control" id="suhu" name="suhu" required value="">
                        <small class="form-control-feedback">oC</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Frekuensi Nafas</label>
                        <input type="number" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required value="">
                        <small class="form-control-feedback">x/menit</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Konjugtiva</label>
                        <select name="Konjugtiva" id="Konjugtiva" class="select2" style="width: 100%">
                            <option value="anemis">Anemis</option>
                            <option value="Tidakanemis">Tidak</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Ektremitas</label>
                        <select name="Ektremitas" id="Ektremitas" class="select2" style="width: 100%">
                            <option value="normal">Normal</option>
                            <option value="dehidrasi">Dehidrasi</option>
                            <option value="edema">Edema</option>
                            <option value="edemaanasarka">Edema Anasarka</option>
                            <option value="Pucat">Pucat & Dingin</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Berat Badan</label>
                        <label>Pre HD</label>
                        <input type="number" class="form-control" id="bbprehd" name="bbprehd" required value="">
                        <small class="form-control-feedback">Kg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Berat Badan</label>
                        <label>BB Kering</label>
                        <input type="number" class="form-control" id="bbkering" name="bbkering" required value="">
                        <small class="form-control-feedback">Kg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Berat Badan</label>
                        <label>BB Post HD Kemarin</label>
                        <input type="number" class="form-control" id="bbposthd" name="bbposthd" required value="">
                        <small class="form-control-feedback">Kg</small>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label><b>Akses Vaskular</b></label>
                        <select name="akvaskular" id="akvaskular" class="select2" style="width: 100%">
                            <option value="avfistula">AV fistula</option>
                            <option value="hdkateter">HD kateter</option>
                            <option value="avalinya">Lainya</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>HD Kateter</label>
                        <select name="hdkateter1" id="hdkateter" class="select2" style="width: 100%">
                            <option value="Subclavia">Subclavia</option>
                            <option value="Jugular">Jugular</option>
                            <option value="Femoral">Femoral</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Akses Vaskular</label>
                        <label>Lainnya</label>
                        <input type="text" class="form-control" id="avalinya" name="avalinya" value="">
                        <small class="form-control-feedback">Diisi ketika memilih HD Lainnya</small>
                    </div>

                    <input type="hidden" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                    <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                    <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                    <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                    <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                    <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                    <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                    <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                    <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<= $admissionDate; ?>">
                    <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">


                    <div class="col-md-2 mb-3">
                        <label>Riwayat Jatuh</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Riwayat Jatuh Dalam 3 Bulan terkahir<input name="fungsionalRiwayatJatuh" id="fungsionalRiwayatJatuh" value="25" type="checkbox" onchange="total4()">
                                <span class="lever switch-col-red"></span>
                            </label>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Memiliki</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Diagnosis Sekunder ?<input name="diagnosisSekunder" id="diagnosisSekunder" value="15" type="checkbox" onchange="total4()"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Alat Bantu Berjalan</label>
                        <select name="alatBantuBerjalan" id="alatBantuBerjalan" class="select2" style="width: 100%" onchange="total4()">
                            <?php foreach ($alatBantuBerjalan as $as) : ?>
                                <option value="<?php echo $as['nilai']; ?>"><?php echo $as['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Terpasang Infus</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Pemberian Antikoagulan ?<input name="heparin" id="heparin" value="20" type="checkbox" onchange="total4()"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Kondisi Melakukan Mobilisasi</label>
                        <select name="mobilisasi" id="mobilisasi" class="select2" style="width: 100%" onchange="total4()">
                            <?php foreach ($mobilisasi as $mobilisasi) : ?>
                                <option value="<?php echo $mobilisasi['nilai']; ?>"><?php echo $mobilisasi['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Status Mental (Baik) ?</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="statusMental" id="statusMental" value="15" type="checkbox" onchange="total4()"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label><b>Kriteria Hasil Penilaian</b></label>
                        <input type="number" class="form-control" id="kriteriaHasil" name="kriteriaHasil" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label><b>** Note</b></label><br>
                        <label>Skor 0-24 Tidak Ada Risiko</label>
                        <label>Skor 25-50 Risiko Rendah</label>
                        <label>Skor > 51 Risiko Tinggi</label>
                    </div>

                </div>
                <hr class="hr4">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" id="tglgizi" name="tglgizi" required value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>MIS Score</label>
                        <input type="number" class="form-control" id="misscore" name="misscore" required value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Kesimpulan</label>
                        <select name="kesimpulannutrisi" id="kesimpulannutrisi" class="select2" style="width: 100%">
                            <option value="TpMalnutrisi">Tanpa Malnutrisi</option>
                            <option value="Malnutrisi">Malnutrisi</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label><b>Riwayat Psikososial</b></label><br>
                        <label>Keyakinan/tradisi dengan pelayanan kesehatan yang di berikan</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Psikososial" id="Psikososial" value="0" type="checkbox"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Kendala Komunikasi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="isiKomunikasi" id="isiKomunikasi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Ada, Jelaskan</label>
                        <input type="text" class="form-control" id="uraianKomunikasi" name="uraianKomunikasi" disabled>
                        <input type="hidden" class="form-control" id="Komunikasi" name="Komunikasi">
                        <small class="form-control-feedback">Ditulis Jika Ada</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Yang merawat dirumah</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="isimerawat" id="isimerawat" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Ada, Jelaskan</label>
                        <input type="text" class="form-control" id="uraianmerawat" name="uraianmerawat" disabled>
                        <input type="hidden" class="form-control" id="merawat" name="merawat">
                        <small class="form-control-feedback">Ditulis Jika Ada</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Kondisi saat Ini</label>
                        <select name="kondisi" id="kondisi" class="select2" style="width: 100%">
                            <option value="tenang">Tenang</option>
                            <option value="gelisah">Gelisah</option>
                            <option value="takut">Takut tindakan</option>
                            <option value="marah">Marah</option>
                            <option value="tersinggung">Mudah Tersinggung</option>
                        </select>
                    </div>
                </div>
                <hr class="hr7">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>TD</label>
                        <input type="number" class="form-control" id="tdmedik" name="tdmedik" required value="">
                        <small class="form-control-feedback">mmHg</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>QB</label>
                        <input type="number" class="form-control" id="QB" name="QB" required value="">
                        <small class="form-control-feedback">ml/mnt</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>QD</label>
                        <input type="number" class="form-control" id="QD" name="QD" required value="">
                        <small class="form-control-feedback">ml/mnt</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>UF Goal</label>
                        <input type="number" class="form-control" id="UFG" name="UFG" required value="">
                        <small class="form-control-feedback">ml</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label>Progr.Profiling Na</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Profiling" id="Profiling" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label>UF</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="UF" id="UF" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Bicarbonat</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Bicarbonat" id="Bicarbonat" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Dialisat</label>
                        <label>Asetat</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Asetat" id="Asetat" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Bicarbonat</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="DLBicarbonat" id="DLBicarbonat" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label>Condativity</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Condativity" id="Condativity" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Temperatur</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="Temperatur" id="Temperatur" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label>Heparinisasi</label><br>
                        <label>Dosis Sirkulasi</label>
                        <input type="number" class="form-control" id="Sirkulasi" name="Sirkulasi" required value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Heparinisasi</label><br>
                        <label>Dosis Awal</label>
                        <input type="number" class="form-control" id="Heparinisasiawal" name="Heparinisasiawal" required value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Dosis Maintenance</label><br>
                        <label>Continue</label>
                        <input type="number" class="form-control" id="Continue" name="Continue" required value="">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Dosis Maintenance</label><br>
                        <label>Intermitten</label>
                        <input type="number" class="form-control" id="Intermitten" name="Intermitten" required value="">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label>LMWH</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="LMWH" id="LMWH" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tanpa Heparin, Penyebab</label>
                        <input type="input" class="form-control" id="TpHeparin" name="TpHeparin" required value="">
                        <small class="form-control-feedback">Program Bilas Na Cl 0,9 % 100 cc tiap jam /1/2 jam</small>
                    </div>
                </div>
        </div>
        <hr class="hr5">
        <div class="row">
            <div class="col-md-2 mb-3">
                <label>Diagnosis Keperawatan</label>
                <div class="input-group">
                    <select name="DiagnosaAskep" id="DiagnosaAskep" class="select2" style="width: 100%">
                        <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                            <option value="<?php echo $diagnosa['diagnosa']; ?>"><?php echo $diagnosa['diagnosa']; ?> [<?php echo $diagnosa['code']; ?>]</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label></label>
                <div class="input-group-append">
                    <button class="btn btn-info" id="cariaskep" type="button"><i class="fas fa-search"></i>Rencana Keperawatan</button>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label class="control-label">Dokter Pemeriksa</label>
                    <input type="text" class="form-control" id="doktername" name="doktername" value="<?= $doktername; ?>" required>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label>Perawat/Bidan</label>
                <input type="text" class="form-control" id="paramedicName" name="paramedicName" value="<?= session()->get('firstname'); ?>" required>
                <small class="form-control-feedback">Nama Perawat/Bidan</small>
            </div>
            <div class="col-md-6 mb-3">
                <label><b>Rencana Keperawatan</b></label>
                <textarea id="mymce2" name="uraianAskep" class="form-control" rows="8"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label><b>Sasaran Rencana Asuhan</b></label>
                <textarea id="mymce3" name="sasaranRencana" class="form-control" rows="8"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
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
    function total4() {
        var fungsionalRiwayatJatuh = document.getElementById('fungsionalRiwayatJatuh').checked ? 25 : 0;
        var diagnosisSekunder = document.getElementById('diagnosisSekunder').checked ? 15 : 0;
        var alatBantuBerjalan = document.getElementById('alatBantuBerjalan').value;
        var heparin = document.getElementById('heparin').checked ? 20 : 0;
        var mobilisasi = document.getElementById('mobilisasi').value;
        var statusMental = document.getElementById('statusMental').checked ? 15 : 0;

        var nilai_alatBantuBerjalan = parseInt(alatBantuBerjalan);
        var nilai_mobilisasi = parseInt(mobilisasi);
        var totalkriteriaHasil = fungsionalRiwayatJatuh + diagnosisSekunder + nilai_alatBantuBerjalan + heparin + nilai_mobilisasi + statusMental;

        document.getElementById('kriteriaHasil').value = totalkriteriaHasil;
    }
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
    $('#isiKomunikasi').on('change', function() {
        if ($('#isiKomunikasi').val() == 1) {
            $('#uraianKomunikasi').removeAttr('disabled');
            $('#isiKomunikasi').val(0);
            $('#Komunikasi').val(1);
        } else {
            $('#uraianKomunikasi').attr('disabled', 'disabled');
            $('#uraianKomunikasi').val('');
            $('#isiKomunikasi').val(1);
            $('#Komunikasi').val(0);
        }
    })
</script>
<script type="text/javascript">
    $('#isimerawat').on('change', function() {
        if ($('#isimerawat').val() == 1) {
            $('#uraianmerawat').removeAttr('disabled');
            $('#isimerawat').val(0);
            $('#merawat').val(1);
        } else {
            $('#uraianmerawat').attr('disabled', 'disabled');
            $('#uraianmerawat').val('');
            $('#isimerawat').val(1);
            $('#merawat').val(0);
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

<!-- 
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
</script> -->



<script>
    $(document).ready(function() {
        $('.formasesmenhemodialisa').submit(function(e) {
            console.log('di klik');
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });

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

<!-- <script>
    $('#carimasalahkeperawatan').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<php echo base_url('PelayananRawatJalanRME/carimasalahkeperawatan'); ?>",

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
<script>
    $('#cariintervensikeperawatan').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<php echo base_url('PelayananRawatJalanRME/cariintervensikeperawatan'); ?>",

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
<script>
    $('#cariintervensikolaborasi').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<php echo base_url('PelayananRawatJalanRME/cariintervensikolaborasi'); ?>",

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
</script> -->