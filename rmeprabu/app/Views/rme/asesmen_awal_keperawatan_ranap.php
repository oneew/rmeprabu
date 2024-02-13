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
        content: '&&';
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

    .hr50 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr50:after {
        background: #fff;
        content: 'Riwayat Kehamilan Dan Kelahiran';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr51 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr51:after {
        background: #fff;
        content: 'Riwayat Imunisasi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr52 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr52:after {
        background: #fff;
        content: 'Riwayat Psikologis';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr53 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr53:after {
        background: #fff;
        content: 'Keluhan Utama & Keadaan Umum';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr54 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr54:after {
        background: #fff;
        content: 'Pemeriksaan Fisik';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr55 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr55:after {
        background: #fff;
        content: 'Kebutuhan Dan Hambatan Edukasi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr30 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr30:after {
        background: #fff;
        content: ' Asemen Resiko Jatuh ( MORSE ) ';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr31:after {
        background: #fff;
        content: ' Asemen Resiko Jatuh ( Humpty Dumpty ) ';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr56 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr56:after {
        background: #fff;
        content: 'Skrining Nutrisi';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr57 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr57:after {
        background: #fff;
        content: 'Penilaian Tingkat Nyeri';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>
<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatRanap', ['class' => 'formasesmenRanap']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>TJ Masuk Ruangan</label>
                            <input type="text" class="form-control" id="admissionDateTime" name="admissionDateTime" required value="<?= $admissionDateTime; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tiba Di Ruangan Dengan Cara</label>
                            <select name="caraTiba" id="caraTiba" class="select2" style="width: 100%" required>
                                <?php foreach ($transport_transfer as $trans) : ?>
                                    <option value="<?php echo $trans['name']; ?>" <?php if ($trans['name'] == $alat_transport) { ?> selected="selected" <?php } ?>><?php echo $trans['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Macam Kasus Trauma</label>
                            <select name="kasusTrauma" id="kasusTrauma" class="select2" style="width: 100%">
                                <option value="">-</option>
                                <?php foreach ($kasus_trauma as $kasus) : ?>
                                    <option value="<?php echo $kasus['name']; ?>"><?php echo $kasus['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Penyakit Dahulu</label>
                            <select name="riwayatPenyakitDahulu" id="riwayatPenyakitDahulu" class="select2" style="width: 100%">
                                <option value="-">-</option>
                                <?php foreach ($rpd as $rpd) : ?>
                                    <option value="<?php echo $rpd['name']; ?>"><?php echo $rpd['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>RPD</label>
                            <input type="text" class="form-control" id="rpdLain" name="rpdLain" disabled>
                            <small class="form-control-feedback text-danger">Ditulis Jika RPD Lain-lain</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Operasi</label>
                            <input type="text" class="form-control" id="riwayatOperasi" name="riwayatOperasi" value="-">
                            <small class="form-control-feedback text-danger">Ditulis Jika ada</small>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Obat Yang Saat Ini Digunakan</label>
                            <input type="text" class="form-control" id="obatSaatIni" name="obatSaatIni" value="-">
                            <small class="form-control-feedback text-danger">Ditulis Jika ada</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Terapi Komplementari</label>
                            <select name="terapiKomplementari" id="terapiKomplementari" class="select2" style="width: 100%">
                                <option value="-">-</option>
                                <?php foreach ($komplementari as $kom) : ?>
                                    <option value="<?php echo $kom['name']; ?>"><?php echo $kom['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>terapi Komplementari Lain</label>
                            <input type="text" class="form-control" id="terapiKomplementariLain" name="terapiKomplementariLain" disabled>
                            <small class="form-control-feedback text-danger">Ditulis Jika terapiKLain-lain</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Alergi Obat/ Makanan ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isialergi" id="isialergi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian Alergi</label>
                            <input type="text" class="form-control" id="uraianAlergi" name="uraianAlergi" disabled>
                            <input type="hidden" class="form-control" id="alergi" name="alergi">
                            <small class="form-control-feedback text-danger">Ditulis Jika Ada Alergi</small>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Kebiasaan Merokok ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isimerokok" id="isimerokok" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian merokok</label>
                            <input type="number" class="form-control" id="uraianMerokok" name="uraianMerokok" disabled>
                            <input type="hidden" class="form-control" id="merokok" name="merokok">
                            <small class="form-control-feedback text-danger">Batang/Hari</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kebiasaan Alkohol ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isialkohol" id="isialkohol" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian alkohol</label>
                            <input type="number" class="form-control" id="uraianAlkohol" name="uraianAlkohol" disabled>
                            <input type="hidden" class="form-control" id="alkohol" name="alkohol">
                            <small class="form-control-feedback text-danger">Gelas/Hari</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kebiasaan Obat Tidur/Narkoba ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="obatTidur" id="obatTidur" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kebiasaan Olah Raga ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="olahRaga" id="olahRaga" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr50">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Apakah Dalam Keadaan Hamil ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isihamil" id="isihamil" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perkiraan Kelahiran</label>
                            <input type="text" class="form-control" id="perkiraanKelahiran" name="perkiraanKelahiran" disabled>
                            <input type="hidden" class="form-control" id="hamil" name="hamil">
                            <small class="form-control-feedback text-danger"></small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Apakah Sedang Menyusui ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="menyusui" id="menyusui" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Kelahiran Spontan ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="spontan" id="spontan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Kelahiran Operasi ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="caesar" id="caesar" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Kelahiran Kurang Bulan ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="kurangBulan" id="kurangBulan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Kelahiran Cukup Bulan ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="cukupBulan" id="cukupBulan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Abortus / Keguguran ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="Keguguran" id="Keguguran" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Kelahiran Kembar / Gemeli ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="Kembar" id="Kembar" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr51">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>BCG</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="bcg" id="bcg" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>DPT</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="dpt" id="dpt" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Polio</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="polio" id="polio" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Campak</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="campak" id="campak" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hepatitis B</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="hepatitisB" id="hepatitisB" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>PCV</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="pcv" id="pcv" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Varicela</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="varicela" id="varicela" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Rotavirus</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="rotavirus" id="rotavirus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Typoid</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="typoid" id="typoid" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>HIB</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="hib" id="hib" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>MMR</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="mmr" id="mmr" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Influenza</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="influenza" id="influenza" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pneoumokokus</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="pneumokokus" id="pneumokokus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>HPV</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="hpv" id="hpv" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tetanus</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="tetantus" id="tetantus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Zooster</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="zooster" id="zooster" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Yellow Fever</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="yellowFever" id="yellowFever" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Ca Cervix</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="caCervix" id="caCervix" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hepatitis A</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="hepatitisA" id="hepatitisA" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hepatitis B Dewasa</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="hepatitisBDewasa" id="hepatitisBDewasa" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Polio Dewasa</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="polioDewasa" id="polioDewasa" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr52">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Tidak Semangat</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="tidakSemangat" id="tidakSemangat" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Rasa Tertekan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="rasaTertekan" id="rasaTertekan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Depresi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="depresi" id="depresi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sulit Tidur</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="sulitTidur" id="sulitTidur" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Cepat Lelah</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="cepatLelah" id="cepatLelah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sulit Berbicara</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="sulitBerbicara" id="sulitBerbicara" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kurang Nafsu Makan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="kurangNafsuMakan" id="kurangNafsuMakan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sulit Konsentrasi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="sulitKonsentrasi" id="sulitKonsentrasi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Menggunakan Obat Penenang</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="obatPenenang" id="obatPenenang" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Merasa Bersalah</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="merasaBersalah" id="merasaBersalah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr53">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label><b>Keluhan Utama</b></label>
                            <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required>
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
                            <label>Lingkar Kepala</label>
                            <input type="number" class="form-control" id="lingkarKepala" name="lingkarKepala" value="0" require>
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Lingkar Lengan Atas</label>
                            <input type="number" class="form-control" id="lingkarLengan" name="lingkarLengan" value="0">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                    </div>
                    <hr class="hr54">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Kepala</label>
                            <select name="kepala" id="kepala" class="select2" style="width: 100%" required>
                                <?php foreach ($kepala as $kepala) : ?>
                                    <option value="<?php echo $kepala['name']; ?>"><?php echo $kepala['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Rambut</label>
                            <select name="rambut" id="rambut" class="select2" style="width: 100%" required>
                                <?php foreach ($rambut as $rambut) : ?>
                                    <option value="<?php echo $rambut['name']; ?>"><?php echo $rambut['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Muka</label>
                            <select name="muka" id="muka" class="select2" style="width: 100%" required>
                                <?php foreach ($muka as $muka) : ?>
                                    <option value="<?php echo $muka['name']; ?>"><?php echo $muka['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Mata</label>
                            <select name="mata" id="mata" class="select2" style="width: 100%" required>
                                <?php foreach ($mata as $mata) : ?>
                                    <option value="<?php echo $mata['name']; ?>"><?php echo $mata['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Telinga</label>
                            <select name="telinga" id="telinga" class="select2" style="width: 100%" required>
                                <?php foreach ($telinga as $telinga) : ?>
                                    <option value="<?php echo $telinga['name']; ?>"><?php echo $telinga['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hidung</label>
                            <select name="hidung" id="hidung" class="select2" style="width: 100%" required>
                                <?php foreach ($hidung as $hidung) : ?>
                                    <option value="<?php echo $hidung['name']; ?>"><?php echo $hidung['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Gigi</label>
                            <select name="gigi" id="gigi" class="select2" style="width: 100%" required>
                                <?php foreach ($gigi as $gigi) : ?>
                                    <option value="<?php echo $gigi['name']; ?>"><?php echo $gigi['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Lidah</label>
                            <select name="lidah" id="lidah" class="select2" style="width: 100%" required>
                                <?php foreach ($lidah as $lidah) : ?>
                                    <option value="<?php echo $lidah['name']; ?>"><?php echo $lidah['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Mulut</label>
                            <select name="mulut" id="mulut" class="select2" style="width: 100%" required>
                                <?php foreach ($mulut as $mulut) : ?>
                                    <option value="<?php echo $mulut['name']; ?>"><?php echo $mulut['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tenggorokan</label>
                            <select name="tenggorokan" id="tenggorokan" class="select2" style="width: 100%" required>
                                <?php foreach ($tenggorokan as $tenggorokan) : ?>
                                    <option value="<?php echo $tenggorokan['name']; ?>"><?php echo $tenggorokan['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Leher</label>
                            <select name="leher" id="leher" class="select2" style="width: 100%" required>
                                <?php foreach ($leher as $leher) : ?>
                                    <option value="<?php echo $leher['name']; ?>"><?php echo $leher['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Punggung</label>
                            <select name="punggung" id="punggung" class="select2" style="width: 100%" required>
                                <?php foreach ($punggung as $punggung) : ?>
                                    <option value="<?php echo $punggung['name']; ?>"><?php echo $punggung['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Payudara</label>
                            <select name="payudara" id="payudara" class="select2" style="width: 100%" required>
                                <?php foreach ($payudara as $payudara) : ?>
                                    <option value="<?php echo $payudara['name']; ?>"><?php echo $payudara['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Dada</label>
                            <select name="dada" id="dada" class="select2" style="width: 100%" required>
                                <?php foreach ($dada as $dada) : ?>
                                    <option value="<?php echo $dada['name']; ?>"><?php echo $dada['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Perut</label>
                            <select name="perut" id="perut" class="select2" style="width: 100%" required>
                                <?php foreach ($perut as $perut) : ?>
                                    <option value="<?php echo $perut['name']; ?>"><?php echo $perut['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Genital</label>
                            <select name="genital" id="genital" class="select2" style="width: 100%" required>
                                <?php foreach ($genital as $genital) : ?>
                                    <option value="<?php echo $genital['name']; ?>"><?php echo $genital['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Anus</label>
                            <select name="anus" id="anus" class="select2" style="width: 100%" required>
                                <?php foreach ($anus as $anus) : ?>
                                    <option value="<?php echo $anus['name']; ?>"><?php echo $anus['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Integumen</label>
                            <select name="integumen" id="integumen" class="select2" style="width: 100%" required>
                                <?php foreach ($integumen as $integumen) : ?>
                                    <option value="<?php echo $integumen['name']; ?>"><?php echo $integumen['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Ekstremitas</label>
                            <select name="ekstremitas" id="ekstremitas" class="select2" style="width: 100%" required>
                                <?php foreach ($ektstremitas as $ektstremitas) : ?>
                                    <option value="<?php echo $ektstremitas['name']; ?>"><?php echo $ektstremitas['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>CRT</label>
                            <input type="text" class="form-control" id="crt" name="crt">
                            <small class="form-control-feedback">Detik</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kekuatan Otot(Kanan Atas)</label>
                            <input type="text" class="form-control" id="kananAtas" name="kananAtas">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kekuatan Otot(Kiri Atas)</label>
                            <input type="text" class="form-control" id="kiriAtas" name="kiriAtas">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kekuatan Otot(Kanan Bawah)</label>
                            <input type="text" class="form-control" id="kananBawah" name="kananBawah">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kekuatan Otot(Kiri Bawah)</label>
                            <input type="text" class="form-control" id="kiriBawah" name="kiriBawah">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Ginekologi</label>
                            <select name="ginekologi" id="ginekologi" class="select2" style="width: 100%" required>
                                <?php foreach ($ginekologi as $ginekologi) : ?>
                                    <option value="<?php echo $ginekologi['name']; ?>"><?php echo $ginekologi['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Obstetri</label>
                            <select name="obstetri" id="obstetri" class="select2" style="width: 100%" required>
                                <?php foreach ($obstetri as $obstetri) : ?>
                                    <option value="<?php echo $obstetri['name']; ?>"><?php echo $obstetri['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Obstetri</label>
                            <label>TFU</label>
                            <input type="text" class="form-control" id="ObTFU" name="ObTFU">
                            <small class="form-control-feedback">Detik</small>
                        </div>
                    </div>
                    <hr class="hr55">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Kebutuhan Edukasi</label>
                            <select name="kebutuhanEdukasi" id="kebutuhanEdukasi" class="select2" style="width: 100%" required>
                                <?php foreach ($kebutuhan_edukasi as $kebutuhan_edukasi) : ?>
                                    <option value="<?php echo $kebutuhan_edukasi['name']; ?>"><?php echo $kebutuhan_edukasi['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Bahasa Sehari-hari</label>
                            <select name="bahasaSehari" id="bahasaSehari" class="select2" style="width: 100%" required>
                                <?php foreach ($bahasa as $bahasa) : ?>
                                    <option value="<?php echo $bahasa['name']; ?>"><?php echo $bahasa['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perlu Penterjemah ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="perluPenterjemah" id="perluPenterjemah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tingkat Pendidikan</label>
                            <select name="tingkatPendidikan" id="tingkatPendidikan" class="select2" style="width: 100%" required>
                                <?php foreach ($pendidikan as $pendidikan) : ?>
                                    <option value="<?php echo $pendidikan['pendidikan']; ?>"><?php echo $pendidikan['pendidikan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Dapat Membaca ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="dapatMembaca" id="dapatMembaca" value="1" type="checkbox" checked><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Keyakinan/Nilai-nilai Terhadap Penyakitnya</label>
                            <select name="keyakinanPenyakit" id="keyakinanPenyakit" class="select2" style="width: 100%">
                                <option value="Positif">Positif</option>
                                <option value="Negatif">Negatif</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Uraian</label>
                            <input type="text" class="form-control" id="uraianKeyakinanPenyakit" name="uraianKeyakinanPenyakit">
                            <small class="form-control-feedback">Disi uraian keyakinan terhadap penyakit</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Gaya Pembelajaran (visual)</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="visual" id="visual" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Gaya Pembelajaran (Audio)</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="audio" id="audio" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Gaya Pembelajaran (Kinestesik)</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="kinestetik" id="kinestetik" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Hambatan Edukasi</label>
                            <select name="hambatanEdukasi" id="hambatanEdukasi" class="select2" style="width: 100%" required>
                                <?php foreach ($hambatan as $hambatan) : ?>
                                    <option value="<?php echo $hambatan['name']; ?>"><?php echo $hambatan['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Kesediaan Menerima Informasi ?</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="kesediaanMenerimaInformasi" id="kesediaanMenerimaInformasi" value="1" type="checkbox" checked><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr56">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Penurunan BB Tanpa Direncakan</label>
                            <select name="penurunanBBRencana" id="penurunanBBRencana" class="select2" style="width: 100%" required>
                                <?php foreach ($penurunanBb as $penurunanBb) : ?>
                                    <option value="<?php echo $penurunanBb['name']; ?>"><?php echo $penurunanBb['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Penurunan BB 5% dalam Waktu 3 Bulan Terakhir ?</label>
                            <select name="nutrisiTurunBb" id="nutrisiTurunBb" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Asupan Makan Berkurang ?</label>
                            <select name="asupanMakananDewasa" id="asupanMakananDewasa" class="select2" style="width: 100%" required>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nafsu makan berkurang/ muntah > 3 kali/ diare > 5 kali ?</label>
                            <select name="nutrisiMuntahDiare" id="nutrisiMuntahDiare" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Anak Tampak Kurus ?</label>
                            <select name="nutrisiKurus" id="nutrisiKurus" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Penyakit mengakibatkan resiko malnutrisi ?</label>
                            <select name="penyakitMalnutrisi" id="penyakitMalnutrisi" class="select2" style="width: 100%" required onchange="totalnutrisiAnak()">
                                <option value="0">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Apakah Pasien Menderita Penyakit Berat</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="penyakitBerat" id="penyakitBerat" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian Kondisi Khusus</label>
                            <input type="text" class="form-control" id="uraianKondisiKhusus" name="uraianKondisiKhusus" disabled>
                            <input type="hidden" class="form-control" id="nutrisiKondisiKhusus" name="nutrisiKondisiKhusus">
                            <small class="form-control-feedback">Ditulis Jika Kondisi Khusus</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Skor</b></label>
                            <input type="number" class="form-control" id="skorNutrisi" name="skorNutrisi" value="0">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Dirujuk Ke Ahli Gizi<input name="rujukAhliGizi" id="rujukAhliGizi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr30">
                    <div class="row">
                        <div class="col-md-3 mb-3">
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
                        <div class="col-md-4 mb-3">
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
                            <label>Kondisi Melakukan Mobilisasi</label>
                            <select name="mobilisasi" id="mobilisasi" class="select2" style="width: 100%" onchange="total4()">
                                <?php foreach ($mobilisasi as $mobilisasi) : ?>
                                    <option value="<?php echo $mobilisasi['nilai']; ?>"><?php echo $mobilisasi['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Status Mental (Baik)</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    ?<input name="statusMental" id="statusMental" value="15" type="checkbox" onchange="total4()"><span class="lever switch-col-red"></span></label>
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

                    <hr class="hr31">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Umur</label>
                            <select name="umur" id="umur" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($umur as $umur) : ?>
                                    <option value="<?php echo $umur['nilai']; ?>"><?php echo $umur['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenisKL" id="jenisKL" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($jenisKL as $jenisKL) : ?>
                                    <option value="<?php echo $jenisKL['nilai']; ?>"><?php echo $jenisKL['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Diagnosis</label>
                            <select name="DiagAnak" id="DiagAnak" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($DiagAnak as $DiagAnak) : ?>
                                    <option value="<?php echo $DiagAnak['nilai']; ?>"><?php echo $DiagAnak['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Gangguan Kognitif</label>
                            <select name="Kognitif" id="Kognitif" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($Kognitif as $Kognitif) : ?>
                                    <option value="<?php echo $Kognitif['nilai']; ?>"><?php echo $Kognitif['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Faktor Lingkungan</label>
                            <select name="Lingkungan" id="Lingkungan" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($Lingkungan as $Lingkungan) : ?>
                                    <option value="<?php echo $Lingkungan['nilai']; ?>"><?php echo $Lingkungan['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Respon Terhadap Obat/Operasi</label>
                            <select name="ResponObat" id="ResponObat" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($ResponObat as $ResponObat) : ?>
                                    <option value="<?php echo $ResponObat['nilai']; ?>"><?php echo $ResponObat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Penggunaan Obat</label>
                            <select name="PenggunaanObat" id="PenggunaanObat" class="select2" style="width: 100%" onchange="total5()">
                                <?php foreach ($PenggunaanObat as $PenggunaanObat) : ?>
                                    <option value="<?php echo $PenggunaanObat['nilai']; ?>"><?php echo $PenggunaanObat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Kriteria Hasil Penilaian</b></label>
                            <input type="number" class="form-control" id="kriteriaHasilAnak" name="kriteriaHasilAnak" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>** Note</b></label><br>
                            <label>Skor 7-11 Risiko Rendah</label>
                            <label>Skor > 12 Risiko Tinggi</label>
                        </div>
                    </div>


                    <hr class="hr57">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
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
                            <label>Sosiologis</label>
                            <select name="sosiologis" id="sosiologis" class="select2" style="width: 100%">
                                <?php foreach ($sosiologis as $sosiologis) : ?>
                                    <option value="<?php echo $sosiologis['name']; ?>"><?php echo $sosiologis['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                    </div>
                    <hr class="hr3">
                    <div class="form-row">
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
                        <div class="col-md-4 mb-3">
                            <label><strong>Diagnosa Kebidanan</strong></label>
                            <input type="text" class="form-control" id="Diagnosakebidanan" name="Diagnosakebidanan" value="-" required>
                            <small class="form-control-feedback text-danger">Jika Pasien Kebidanan</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label></label>
                            <div class="input-group-append">
                                <button class="btn btn-info" id="cariaskepigd" type="button"><i class="fas fa-search"></i>Rencana Keperawatan</button>
                                &nbsp;<button class="btn btn-success" id="cariimplementasiigd" type="button"><i class="fas fa-search"></i> Pilih Implemntasi</button>
                                &nbsp;<button class="btn btn-warning" id="cariobservasiigd" type="button"><i class="fas fa-search"></i>Observasi</button>
                                &nbsp;<button class="btn btn-danger" id="cariterapeutikigd" type="button"><i class="fas fa-search"></i>Terapeutik</button>
                                &nbsp;<button class="btn btn-dark" id="cariedukasiigd" type="button"><i class="fas fa-search"></i>Edukasi</button>
                                &nbsp;<button class="btn btn-warning" id="carikolaborasiigd" type="button"><i class="fas fa-search"></i>Kolaborasi</button>
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
                        <div class="col-md-3 mb-3">
                            <label><b>Observasi</b></label>
                            <textarea id="observasi" name="observasi" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label><b>Terapeutik</b></label>
                            <textarea id="terapeutik" name="terapeutik" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label><b>Edukasi</b></label>
                            <textarea id="edukasi" name="edukasi" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label><b>Kolaborasi</b></label>
                            <textarea id="kolaborasi" name="kolaborasi" class="form-control" rows="8"></textarea>
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
            $('#isialergi').val(1);
            $('#alergi').val(1);
        } else {
            $('#uraianAlergi').attr('disabled', 'disabled');
            $('#uraianAlergi').val('');
            $('#isialergi').val(0);
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
        $('.formasesmenRanap').submit(function(e) {
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
                        // dataCPPT();
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
    function total5() {
        var umur = document.getElementById('umur').value;
        var jenisKL = document.getElementById('jenisKL').value;
        var DiagAnak = document.getElementById('DiagAnak').value;
        var Kognitif = document.getElementById('Kognitif').value;
        var Lingkungan = document.getElementById('Lingkungan').value;
        var ResponObat = document.getElementById('ResponObat').value;
        var PenggunaanObat = document.getElementById('PenggunaanObat').value;

        var nilai_umur = parseInt(umur);
        var nilai_jenisKL = parseInt(jenisKL);
        var nilai_DiagAnak = parseInt(DiagAnak);
        var nilai_Kognitif = parseInt(Kognitif);
        var nilai_Lingkungan = parseInt(Lingkungan);
        var nilai_ResponObat = parseInt(ResponObat);
        var nilai_PenggunaanObat = parseInt(PenggunaanObat);
        var totalkriteriaHasilAnak = nilai_umur + nilai_jenisKL + nilai_DiagAnak + nilai_Kognitif + nilai_Lingkungan + nilai_ResponObat + nilai_PenggunaanObat;
        document.getElementById('kriteriaHasilAnak').value = totalkriteriaHasilAnak;
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

<script type="text/javascript">
    $('#riwayatPenyakitDahulu').on('change', function() {
        if ($('#riwayatPenyakitDahulu').val() == "Lain lain") {
            $('#rpdLain').removeAttr('disabled');
            $('#rpdLain').val('');

        } else {
            $('#rpdLain').attr('disabled', 'disabled');
            $('#rpdLain').val('');
        }
    })
</script>

<script type="text/javascript">
    $('#terapiKomplementari').on('change', function() {
        if ($('#terapiKomplementari').val() == "Lain lain") {
            $('#terapiKomplementariLain').removeAttr('disabled');
            $('#terapiKomplementariLain').val('');

        } else {
            $('#terapiKomplementariLain').attr('disabled', 'disabled');
            $('#terapiKomplementariLain').val('');
        }
    })
</script>



<script type="text/javascript">
    $('#isimerokok').on('change', function() {
        if ($('#isimerokok').val() == 1) {
            $('#uraianmerokok').removeAttr('disabled');
            $('#isimerokok').val(0);
            $('#merokok').val(1);
        } else {
            $('#uraianmerokok').attr('disabled', 'disabled');
            $('#uraianmerokok').val('');
            $('#isimerokok').val(1);
            $('#merokok').val(0);

        }

    })
</script>




<script type="text/javascript">
    $('#isialkohol').on('change', function() {
        if ($('#isialkohol').val() == 1) {
            $('#uraianalkohol').removeAttr('disabled');
            $('#isialkohol').val(0);
            $('#alkohol').val(1);
        } else {
            $('#uraianalkohol').attr('disabled', 'disabled');
            $('#uraianalkohol').val('');
            $('#isialkohol').val(1);
            $('#alkohol').val(0);

        }

    })
</script>




<script type="text/javascript">
    $('#isihamil').on('change', function() {
        if ($('#isihamil').val() == 1) {
            $('#perkiraanKelahiran').removeAttr('disabled');
            $('#isihamil').val(0);
            $('#hamil').val(1);
        } else {
            $('#uraianhamil').attr('disabled', 'disabled');
            $('#perkiraanKelahiran').val('');
            $('#isihamil').val(1);
            $('#hamil').val(0);

        }

    })
</script>



<script>
    $('#cariobservasiigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariObservasi'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_observasi').modal('show');

                }
            }
        })
    })
</script>


<script>
    $('#cariterapeutikigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariTerapeutik'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_terapeutik').modal('show');

                }
            }
        })
    })
</script>


<script>
    $('#cariedukasiigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariEdukasi'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_edukasi').modal('show');

                }
            }
        })
    })
</script>


<script>
    $('#carikolaborasiigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariKolaborasi'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_kolaborasi').modal('show');

                }
            }
        })
    })
</script>