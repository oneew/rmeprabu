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
        content: 'Asesmen & Riwayat Obstetri';
        padding: 0 4px;
        position: relative;
        top: -13px;
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
        content: 'Riwayat Haid';
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
        content: 'Keluhan Lain';
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
        content: 'Riwayat ANC';
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
        content: 'Pemeriksaan Obstetri';
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
        content: 'Pemeriksaan Ginekologi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr8 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr8:after {
        background: #fff;
        content: '&&';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatGinekologi', ['class' => 'formasesmen']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="bb" name="bb" required>
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="tb" name="tb" required>
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="suhu" name="suhu" required>
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-1 mb-3">
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
                        <div class="col-md-2 mb-3">
                            <label>Skala Nyeri</label>
                            <select name="skalaNyeri" id="skalaNyeri" class="select2" style="width: 100%">
                                <?php foreach ($skala_nyeri as $skala) : ?>
                                    <option value="<?php echo $skala['code']; ?>"><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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

                    </div>
                    <hr class="hr2">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Nama Suami</label>
                            <input type="text" class="form-control" id="namaSuami" name="namaSuami" required>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>Umur Suami</label>
                            <input type="number" class="form-control" id="umurSuami" name="umurSuami" required>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pendidikanSuami">Pendidikan</label>
                                <select name="pendidikanSuami" id="pendidikanSuami" class="select2" style="width: 100%;">
                                    <?php foreach ($pendidikan as $edu) : ?>
                                        <option value="<?= $edu['pendidikan']; ?>" class="select-inisial"><?= $edu['pendidikan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pekerjaanSuami">Pekerjaan</label>
                                <select name="pekerjaanSuami" id="pekerjaanSuami" class="select2" style="width: 100%;">
                                    <?php foreach ($pekerjaan as $work) : ?>
                                        <option value="<?= $work['pekerjaan']; ?>" class="select-inisial"><?= $work['pekerjaan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Alamat Suami</label>
                            <input type="text" class="form-control" id="alamatSuami" name="alamatSuami" required>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>LLA</label>
                            <input type="text" class="form-control" id="lla" name="lla">
                            <small class="form-control-feedback">cm</small>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>IMT/BMT</label>
                            <input type="text" class="form-control" id="bmt" name="bmt">
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>HPHT</label>
                            <input type="text" class="form-control" id="hpht" name="hpht">
                        </div>
                        <div class="col-md-1 mb-3">
                            <label>U-Kehamilan</label>
                            <input type="text" class="form-control" id="usiaKehamilan" name="usiaKehamilan">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="riwayatKb">Riwayat KB</label>
                                <select name="riwayatKb" id="riwayatKb" class="select2" style="width: 100%;">
                                    <?php foreach ($KB as $kb) : ?>
                                        <option value="<?= $kb['name']; ?>" class="select-inisial"><?= $kb['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tanggal Kunjungan Pertama</label>
                            <input type="date" class="form-control" id="tanggalKunjunganPertama" name="tanggalKunjunganPertama">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kehamilan</label>
                            <input type="text" class="form-control" id="kehamilan" name="kehamilan">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tempat Penolong Persalinan</label>
                            <input type="text" class="form-control" id="penolongPersalinan" name="penolongPersalinan">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jenis Persalinan</label>
                            <input type="text" class="form-control" id="jenisPersalinan" name="jenisPersalinan">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Masalah Persalinan</label>
                            <input type="text" class="form-control" id="masalahPersalinan" name="masalahPersalinan">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Keterangan Keadaan Bayi</label>
                            <input type="text" class="form-control" id="keadaanBayi" name="keadaanBayi">
                        </div>
                    </div>
                    <hr class="hr3">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Menarche</label>
                            <input type="text" class="form-control" id="menarche" name="menarche">
                            <small class="form-control-feedback">tahun</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Lama Haid</label>
                            <input type="text" class="form-control" id="lamaHaid" name="lamaHaid">
                            <small class="form-control-feedback">hari</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Siklus Haid</label>
                            <input type="text" class="form-control" id="siklusHaid" name="siklusHaid">
                            <small class="form-control-feedback">hari</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jumlah Darah</label>
                            <input type="text" class="form-control" id="jumlahDarah" name="jumlahDarah">
                            <small class="form-control-feedback">ccc</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Keluhan Haid</label>
                            <input type="text" class="form-control" id="keluhanHaid" name="keluhanHaid">
                        </div>
                    </div>
                    <hr class="hr4">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Fluor Albus</label>
                            <input type="text" class="form-control" id="keluhanFluorAlbus" name="keluhanFluorAlbus">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perdarahan</label>
                            <input type="text" class="form-control" id="keluhanperdarahan" name="keluhanperdarahan">

                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BAB, BAK</label>
                            <input type="text" class="form-control" id="keluhanBabBak" name="keluhanBabBak">

                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Air-air</label>
                            <input type="text" class="form-control" id="keluhanAir" name="keluhanAir">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>HIS</label>
                            <input type="text" class="form-control" id="keluhanHis" name="keluhanHis">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Gerak Anak</label>
                            <input type="text" class="form-control" id="keluhanGerakAnak" name="keluhanGerakAnak">
                        </div>
                    </div>
                    <hr class="hr5">
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label>ANC</label>
                            <input type="text" class="form-control" id="anc" name="anc">
                            <small class="form-control-feedback">kali</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>DJJ</label>
                            <input type="text" class="form-control" id="djj" name="djj">

                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Lokasi Pemeriksaan ANC</label>
                            <input type="text" class="form-control" id="lokasiAnc" name="lokasiAnc">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pemeriksaan Triple Eliminasi</label>
                                <select name="tripleEliminasi" id="tripleEliminasi" class="select2" style="width: 100%;">
                                    <option value="" class="select-inisial">Pilih</option>
                                    <option value="HIV" class="select-inisial">HIV</option>
                                    <option value="Sifilis" class="select-inisial">Sifilis</option>
                                    <option value="Hepatitis" class="select-inisial">Hepatitis</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <hr class="hr6">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>TFU</label>
                            <input type="text" class="form-control" id="tfuObstetri" name="tfuObstetri">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BJA</label>
                            <input type="text" class="form-control" id="bjaObstetri" name="bjaObstetri">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>HIS</label>
                            <input type="text" class="form-control" id="hisObstetri" name="hisObstetri">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Leopold I</label>
                            <input type="text" class="form-control" id="leopold1" name="leopold1">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Leopold II</label>
                            <input type="text" class="form-control" id="leopold2" name="leopold2">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Leopold III</label>
                            <input type="text" class="form-control" id="leopold3" name="leopold3">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Leopold IV</label>
                            <input type="text" class="form-control" id="leopold4" name="leopold4">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Pemeriksaan Inspekulo</label>
                            <input type="text" class="form-control" id="pemeriksaanInspekulo" name="pemeriksaanInspekulo">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Pemeriksaan Dalam</label>
                            <input type="text" class="form-control" id="pemeriksaanDalam" name="pemeriksaanDalam">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Pemeriksaan Panggul</label>
                            <input type="text" class="form-control" id="pemeriksaanPanggul" name="pemeriksaanPanggul">
                        </div>
                    </div>
                    <hr class="hr7">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Inspeksi</label>
                            <input type="text" class="form-control" id="inspeksiGinekologi" name="inspeksiGinekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Palpasi</label>
                            <input type="text" class="form-control" id="palpasiGinekologi" name="palpasiGinekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perkusi</label>
                            <input type="text" class="form-control" id="perkusiGinekologi" name="perkusiGinekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Auskyltasi</label>
                            <input type="text" class="form-control" id="auskyltasiGinekologi" name="auskyltasiGinekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Deksripsi Tumor</label>
                            <input type="text" class="form-control" id="deskripsiTumorGinekologi" name="deskripsiTumorGinekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Letak Besar</label>
                            <input type="text" class="form-control" id="letakBesarGinekologi" name="letakBesarGInekologi">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Batas Permukaan</label>
                            <input type="text" class="form-control" id="batasPermukaanGinekologi" name="batasPermukaanGinekologi">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Pergerakan</label>
                            <input type="text" class="form-control" id="PergerakanGinekologi" name="PergerakanGinekologi">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Nyeri Tekan</label>
                            <input type="text" class="form-control" id="nyeriTekanGinekologi" name="nyeriTekanGinekologi">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Lain-lain</label>
                            <input type="text" class="form-control" id="lainGinekologi" name="lainGinekologi">
                        </div>
                    </div>
                    <hr class="hr8">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Penurunan berat badan tanpa direncanakan<input name="nutrisiTurunBb" id="nutrisiTurunBb" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tampak Kurus<input name="nutrisiKurus" id="nutrisiKurus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Nafsu makan berkurang atau anak muntah > 3 kali atau diare > 5 kali<input name="nutrisiMuntahDiare" id="nutrisiMuntahDiare" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Kondisi Khusus Pasien ?<input name="isinutrisiKondisiKhusus" id="isinutrisiKondisiKhusus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
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
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Perlu Alat Bantu<input name="isifungsionalAlatBantu" id="isifungsionalAlatBantu" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Uraian Alat Bantu</label>
                            <input type="text" class="form-control" id="fungsionalNamaAlatBantu" name="fungsionalNamaAlatBantu" disabled>
                            <input type="hidden" class="form-control" id="fungsionalAlatBantu" name="fungsionalAlatBantu">
                            <small class="form-control-feedback">Ditulis Jika Perlu ALat Bantu</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Prothesis<input name="fungsionalProthesis" id="fungsionalProthesis" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Cacat Tubuh<input name="fungsionalCacatTubuh" id="fungsionalCacatTubuh" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>ADL</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Dibantu ?<input name="fungsionalAdl" id="fungsionalAdl" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                        <div class="col-md-3 mb-3">
                            <label>Riwayat Jatuh</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Riwayat Jatuh Dalam 3 Bulan terkahir<input name="fungsionalRiwayatJatuh" id="fungsionalRiwayatJatuh" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Cara Berjalan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Sempoyongan ?<input name="caraBerjalan" id="caraBerjalan" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Posisi Duduk</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Menopang Saat Duduk ?<input name="dudukMenopang" id="dudukMenopang" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Skoring Jatuh</label>
                            <div class="input-group">
                                <select name="skoringJatuh" id="skoringJatuh" class="select2" style="width: 100%">
                                    <option value="Tidak Beresiko">Tidak Beresiko</option>
                                    <option value="Resiko Rendah">Resiko Rendah</option>
                                    <option value="Resiko Tinggi">Resiko Tinggi</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                        <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                        <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                        <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                        <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                        <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                        <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">

                        <div class="col-md-4 mb-3">
                            <label>Keluhan Utama</label>
                            <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><strong>Diagnosa Kebidanan</strong></label>
                            <input type="text" class="form-control" id="Diagnosakebidanan" name="Diagnosakebidanan" value="-" required>
                            <small class="form-control-feedback text-danger">Jika Pasien Kebidanan</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kesadaran</label>
                            <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Rencana Keperawatan</label>
                                <textarea id="mymce2" name="uraianAskep" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sasaran Rencana Asuhan</label>
                                <textarea id="mymce3" name="sasaranRencana" class="form-control" rows="2"></textarea>
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