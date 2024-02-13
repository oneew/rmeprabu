<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style>
    .remove-btn::-webkit-file-upload-button {
        visibility: hidden;
    }

    /* hidden arrow in input number */
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
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
        content: 'Glasgow Coma Scale (GCS)';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    textarea {
        border: none;
        padding: 10px;
        margin: 0;
        box-sizing: border-box;
        resize: none;
    }

    /* Container styles */
    .textarea-container {
        width: 80%;
        margin: 0 auto;
    }

    /* Justify the text within the textarea */
    #justified-textarea {
        text-align: justify;
        white-space: normal;
    }
</style>


<style type="text/css">
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
        content: 'Subjektif';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Objektif';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Asesmen';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>



<style type="text/css">
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
        content: 'Perencanaan';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Permasalahan Keperawatan';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Riwayat Penggunaan Obat';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Rencana Asuhan dan Terapi';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 15px;
    }
</style>



<?= form_open('PelayananRawatJalanRME/simpanAsesmenMedisRanap', ['class' => 'formasesmenmedis']); ?>
<?= csrf_field(); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="row align-items-end">
                <div class="col-md-2 px-1 mb-2">
                    <label>Tanggal Jam Kedatangan</label>
                    <input type="text" class="form-control" id="admissionDateTime" name="admissionDateTime" required value="<?= $admissionDateTime; ?>">
                </div>
                <div class="col-md-2 px-1 mb-2">
                    <label>Tanggal Jam Mulai Asesmen</label>
                    <input type="text" class="form-control" id="admissionDateTimeAsesmen" name="admissionDateTimeAsesmen" required value="<?= date('d-m-Y G:i:s') ?>">
                </div>
                <div class="col-md-2 px-1 mb-2">
                    <label>DPJP/Dokter Pemeriksa</label>
                    <select name="doktername" id="doktername" class="select2">
                        <option value="">Pilih dokter DPJP/Dokter Pemeriksa</option>
                        <?php foreach ($list as $item) : ?>
                            <option value="<?= $item['name']; ?>" <?= $item['name'] == $doktername ? 'selected' : null; ?>><?= $item['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">ANAMNESA</a> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 px-1 mb-2">
                                <label>BB</label>
                                <input type="number" class="form-control" id="bb" name="bb" required value="<?= $asesmen_bb; ?>">

                                <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                                <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                                <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                                <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                                <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                                <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                                <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>TB</label>
                                <input type="number" class="form-control" id="tb" name="tb" required value="<?= $asesmen_tb; ?>">
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Nadi</label>
                                <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required value="<?= $asesmen_frekuensiNadi; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Sistolik</label>
                                <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required value="<?= $asesmen_tdSistolik; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Diastolik</label>
                                <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required value="<?= $asesmen_tdDiastolik; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Suhu</label>
                                <input type="number" class="form-control" id="suhu" name="suhu" required value="<?= $asesmen_suhu; ?>">
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>RR</label>
                                <input type="number" class="form-control" id="pernapasan" name="pernapasan" required value="<?= $asesmen_frekuensiNafas; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Kesadaran</label>
                                <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                    <?php foreach ($kesadaran as $kes) : ?>
                                        <option value="<?php echo $kes['name']; ?>" <?php if ($kes['name'] == $asesmen_kesadaran) { ?> selected="selected" <?php } ?>><?php echo $kes['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 px-1 mb-2">
                                <label>Sp02</label>
                                <input type="number" class="form-control" id="spo2" name="spo2" required value="<?= $asesmen_spo2; ?>">
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 px-1 mb-2">
                                <label>Eye</label>
                                <select name="eye" id="eye" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($eye as $eye) : ?>
                                        <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $asesmen_eye) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 px-1 mb-2">
                                <label>Verbal</label>
                                <select name="verbal" id="verbal" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($verbal as $verbal) : ?>
                                        <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $asesmen_verbal) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 px-1 mb-2">
                                <label>Motorik</label>
                                <select name="motorik" id="motorik" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($motorik as $motorik) : ?>
                                        <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $asesmen_motorik) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 px-1 mb-2">
                                <label><b>Total GCS</b></label>
                                <input type="number" class="form-control" id="totalGcs" name="totalGcs" required value="<?= $asesmen_totalGcs; ?>">
                            </div>
                            <div class="col-md-12 px-1 mb-12">
                                <label>Keadaan Umum</label>
                                <select name="keadaanUmum" id="keadaanUmum" class="select2" style="width: 100%">
                                    <option value="Baik" <?php if ($keadaanUmum == 'Baik') echo "selected"; ?>>Baik</option>
                                    <option value="Sedang <?php if ($keadaanUmum == 'Sedang') echo "selected"; ?>">Sedang</option>
                                    <option value="Buruk <?php if ($keadaanUmum == 'Buruk') echo "selected"; ?>">Buruk</option>
                                </select>
                            </div>
                        </div>
                        <hr class="hr2">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>
                                    Keluhan Utama
                                    <div class="input-group-append">
                                        <button class="btn btn-info" id="caridiagnosa" type="button"><i class="fas fa-search"></i> Lihat Template</button>
                                    </div>

                                </label>
                                <textarea id="keluhanUtama" name="keluhanUtama" class="form-control" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Riwayat Penyakit Sekarang</label>
                                <textarea id="riwayatPenyakitSekarang" name="riwayatPenyakitSekarang" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Riwayat Penyakit Dahulu</label>
                                <textarea id="riwayatPenyakitDahulu" name="riwayatPenyakitDahulu" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Riwayat Penyakit Keluarga</label>
                                <textarea id="riwayatPenyakitKeluarga" name="riwayatPenyakitKeluarga" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">PEMERIKSAAN FISIK</a> </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body px-0">
                        <div class="d-block">
                            <hr class="hr3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label>
                                                Objective
                                                <textarea id="objective" name="objective" class="form-control" rows="5" cols="80"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLokalis" aria-expanded="false" aria-controls="collapseLokalis">
                                            Status Lokalis
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseLokalis" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <button type="button" id="newCanvas" class="btn btn-primary btn-sm">Canvas Baru</button>
                                        <div class="d-flex flex-column">
                                            <input type="hidden" name="anatomi" id="pathAnatomi" readonly>
                                            <img src="<?= base_url('assets/images/anatomi_tubuh/statuslokalis.jpeg'); ?>" alt="anatomi" class="img-fluid" id="sampleAnatomi">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Pemeriksaan Fisik Pasien (Detail)
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-0">
                                                <label>Kepala</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isikepala" id="isikepala" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiankepala" name="uraiankepala" disabled value="0">
                                                <input type="hidden" class="form-control" id="kepala" name="kepala">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Mata</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isimata" id="isimata" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianmata" name="uraianmata" disabled value="0">
                                                <input type="hidden" class="form-control" id="mata" name="mata">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Telinga</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isitelinga" id="isitelinga" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiantelinga" name="uraiantelinga" disabled value="0">
                                                <input type="hidden" class="form-control" id="telinga" name="telinga">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Hidung</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isihidung" id="isihidung" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianhidung" name="uraianhidung" disabled value="0">
                                                <input type="hidden" class="form-control" id="hidung" name="hidung">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Rambut</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isirambut" id="isirambut" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianrambut" name="uraianrambut" disabled value="0">
                                                <input type="hidden" class="form-control" id="rambut" name="rambut">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Bibir</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isibibir" id="isibibir" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianbibir" name="uraianbibir" disabled value="0">
                                                <input type="hidden" class="form-control" id="bibir" name="bibir">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Gigi Geligi</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isigigiGeligi" id="isigigiGeligi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiangigiGeligi" name="uraiangigiGeligi" disabled value="0">
                                                <input type="hidden" class="form-control" id="gigiGeligi" name="gigiGeligi">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Lidah</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isilidah" id="isilidah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianlidah" name="uraianlidah" disabled value="0">
                                                <input type="hidden" class="form-control" id="lidah" name="lidah">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Langit Langit</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isiLangitLangit" id="isiLangitLangit" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianLangitLangit" name="uraianLangitLangit" disabled value="0">
                                                <input type="hidden" class="form-control" id="LangitLangit" name="langitLangit">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Leher</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isileher" id="isileher" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianleher" name="uraianleher" disabled value="0">
                                                <input type="hidden" class="form-control" id="leher" name="leher">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Tenggorokan</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isitenggorokan" id="isitenggorokan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiantenggorokan" name="uraiantenggorokan" disabled value="0">
                                                <input type="hidden" class="form-control" id="tenggorokan" name="renggorokan">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>dada</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isidada" id="isidada" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiandada" name="uraiandada" disabled value="0">
                                                <input type="hidden" class="form-control" id="dada" name="dada">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Tonsil</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isitonsil" id="isitonsil" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiantonsil" name="uraiantonsil" disabled value="0">
                                                <input type="hidden" class="form-control" id="tonsil" name="tonsil">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Payudara</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isipayudara" id="isipayudara" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianpayudara" name="uraianpayudara" disabled value="0">
                                                <input type="hidden" class="form-control" id="payudara" name="payudara">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Punggung</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isipunggung" id="isipunggung" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianpunggung" name="uraianpunggung" disabled value="0">
                                                <input type="hidden" class="form-control" id="punggung" name="punggung">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Perut</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isiperut" id="isiperut" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianperut" name="uraianperut" disabled value="0">
                                                <input type="hidden" class="form-control" id="perut" name="perut">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Genital</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isigenital" id="isigenital" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiangenital" name="uraiangenital" disabled value="0">
                                                <input type="hidden" class="form-control" id="genital" name="genital">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Anus</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isianus" id="isianus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiananus" name="uraiananus" disabled value="0">
                                                <input type="hidden" class="form-control" id="anus" name="anus">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Lengan Atas</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isilenganAtas" id="isilenganAtas" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianlenganAtas" name="uraianlenganAtas" disabled value="0">
                                                <input type="hidden" class="form-control" id="lenganAtas" name="lenganAtas">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Lengan Bawah</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isilenganBawah" id="isilenganBawah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianlenganBawah" name="uraianlenganBawah" disabled value="0">
                                                <input type="hidden" class="form-control" id="lenganBawah" name="lenganBawah">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Jari Tangan</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isijariTangan" id="isijariTangan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianjariTangan" name="uraianjariTangan" disabled value="0">
                                                <input type="hidden" class="form-control" id="jariTangan" name="jariTangan">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kuku Tangan</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isikukuTangan" id="isikukuTangan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiankukuTangan" name="uraiankukuTangan" disabled value="0">
                                                <input type="hidden" class="form-control" id="kukuTangan" name="kukuTangan">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Persendian Tangan</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isipersendianTangan" id="isipersendianTangan" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianpersendianTangan" name="uraianpersendianTangan" disabled value="0">
                                                <input type="hidden" class="form-control" id="persendianTangan" name="persendianTangan">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Tungkai Atas</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isitungkaiAtas" id="isitungkaiAtas" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiantungkaiAtas" name="uraiantungkaiAtas" disabled value="0">
                                                <input type="hidden" class="form-control" id="tungkaiAtas" name="tungkaiAtas">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Tungkai Bawah</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isitungkaiBawah" id="isitungkaiBawah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiantungkaiBawah" name="uraiantungkaiBawah" disabled value="0">
                                                <input type="hidden" class="form-control" id="tungkaiBawah" name="tungkaiBawah">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Jari Kaki</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isijariKaki" id="isijariKaki" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianjariKaki" name="uraianjariKaki" disabled value="0">
                                                <input type="hidden" class="form-control" id="jariKaki" name="jariKaki">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kuku Kaki</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isikukuKaki" id="isikukuKaki" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraiankukuKaki" name="uraiankukuKaki" disabled value="0">
                                                <input type="hidden" class="form-control" id="kukuKaki" name="kukuKaki">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Persendian Kaki</label>
                                                <div class="switch">
                                                    <label>
                                                        <input name="isipersendianKaki" id="isipersendianKaki" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <label>Kelainan</label>
                                                <input type="text" class="form-control" id="uraianpersendianKaki" name="uraianpersendianKaki" disabled value="0">
                                                <input type="hidden" class="form-control" id="persendianKaki" name="persendianKaki">
                                                <small class="form-control-feedback">Ditulis JAK</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFisik" aria-expanded="false" aria-controls="collapseFisik">
                                            Pemeriksaan Fisik Pasien (Free Text)
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFisik" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-0">
                                                <textarea id="pemeriksaanFisik" name="pemeriksaanFisik" class="form-control" rows="3" cols="80"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAudio" aria-expanded="false" aria-controls="collapseTwo">
                                            Rekam Audio Wawancara
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseAudio" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-0">
                                                <label for="audData">Rekam audio</label>
                                                <div class="d-flex mb-1">
                                                    <button type="button" class="mr-3 btn btn-danger" id="recordButton">Record</button>
                                                    <button type="button" class="mr-3 btn btn-danger" id="pauseButton" disabled>Pause</button>
                                                    <button type="button" class="mr-3 btn btn-danger" id="stopButton" disabled>Stop</button>
                                                </div>
                                                <div id="resultRecording"></div>
                                                <input type="file" name="audData" id="audData" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr6">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Diagnosis Keperawatan IGD</label>
                                            <div class="input-group">
                                                <select name="DiagnosaAskep" id="DiagnosaAskep" class="select2" style="width: 100%">
                                                    <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                                                        <option value="<?php echo $diagnosa['diagnosa']; ?>" <?php if ($diagnosa['diagnosa'] == $DiagnosaAskep) { ?> selected="selected" <?php } ?>><?php echo $diagnosa['diagnosa']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label></label>
                                            <div class="input-group-append">
                                                <button class="btn btn-info" id="cariaskep" type="button"><i class="fas fa-search"></i>Rencana</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label></label>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" id="cariimplementasi" type="button"><i class="fas fa-search"></i> Implemntasi</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label><b>Rencana Keperawatan</b></label>
                                            <textarea id="mymce2" name="hasil_uraianAskep" class="form-control" rows="8"><?php $dataUraianAskep = '';
                                                                                                                            $cleanedText = strip_tags($uraianAskep);
                                                                                                                            $dataUraianAskep .= $cleanedText . "\n";
                                                                                                                            echo $dataUraianAskep; ?></textarea>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label><b>Sasaran Rencana Asuhan</b></label>
                                            <textarea id="mymce4" name="hasil_sasaranRencana" class="form-control" rows="8"> <?= $sasaranRencana; ?></textarea>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label><b>Tindakan & Evaluasi</b></label>
                                            <textarea id="mymce3" name="hasil_tindakanEvaluasi" class="form-control" rows="8"><?php $dataEvaluasiAskep = '';
                                                                                                                                $cleanedText2 = strip_tags($implementasiAskep);
                                                                                                                                $dataEvaluasiAskep .= $cleanedText2 . "\n";
                                                                                                                                echo $dataEvaluasiAskep; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr7">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Riwayat Penggunaan Obat Rutin ?</label>
                                            <select name="obatRutin" id="obatRutin" class="select2" style="width: 100%">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 px-1 mb-2">
                                            <label>Nama Obat</label>
                                            <input type="text" class="form-control" id="namaObatRutin" name="namaObatRutin" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">DIAGNOSIS & PEMERIKSAAN PENUNJANG & TATA LAKSANA</a> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">

                        <hr class="hr4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>Diagnosis</label>
                                <textarea id="diagnosis" name="diagnosis" class="form-control" rows="2" cols="80" required></textarea>

                            </div>
                            <!-- <div class="col-md-12 mb-3">
                                <label>Diagnosis Banding</label>
                                <input type="text" class="form-control" id="diagnosisBanding" name="diagnosisBanding">
                            </div> -->
                        </div>
                        <hr class="hr5">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Planning</label>
                                <textarea id="objective_medis" name="objective_medis" class="form-control" rows="4" cols="80">-</textarea>
                            </div>
                        </div>
                        <hr class="hr8">

                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pemeriksaan Penunjang
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="#" onclick="pesanRAD('<?= $nomorreferensi ?>')">Radiologi</a>
                                <a class="dropdown-item" href="#" onclick="pesanLPK('<?= $nomorreferensi ?>')">Patologi Klinik</a>
                                <a class="dropdown-item" href="#" onclick="pesanLPA('<?= $nomorreferensi ?>')">Patologi Anatomi</a>
                                <a class="dropdown-item" href="#" onclick="pesanRHM('<?= $nomorreferensi ?>')">Rehabilitasi Medik</a>
                                <a class="dropdown-item" href="#" onclick="resumeOrder('<?= $nomorreferensi ?>')">Resume Order</a>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <!-- <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle mb-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tata Laksana
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="RiwayatResep('<?= $pasienid ?>')">Riwayat Resep</a>
                                        <a class="dropdown-item" href="#" onclick="eResep('<?= $nomorreferensi ?>')">eResep</a>
                                        <a class="dropdown-item" href="#" onclick="TNORajal('<?= $nomorreferensi ?>')">Tindakan</a>
                                    </div>
                                </div> -->
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-warning">
                                        Kodifikasi Diagnosa
                                    </button>
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a class="dropdown-item" href="#" onclick="codingDiagnosa('<?= $nomorreferensi ?>')">Catat Diagnosa</a>
                                        <a class="dropdown-item" href="#">Referensi Icd 10</a>
                                        <a class="dropdown-item" href="#">Referensi Icd 9</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label>Tindak Lanjut</label>
                                <select name="tindakLanjut" id="tindakLanjut" class="select2" style="width: 100%">
                                    <?php foreach ($tindaklanjut as $tindak) : ?>
                                        <option value="<?php echo $tindak['name']; ?>"><?php echo $tindak['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Tujuan Rujuk</label>
                                <input type="text" class="form-control" id="tujuanRujuk" name="tujuanRujuk" disabled>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Alasan Rujuk</label>
                                <select name="indikasiRujuk" id="indikasiRujuk" class="select2" style="width: 100%">
                                    <option value="">Pilih</option>
                                    <?php foreach ($alasanRujuk as $alasanRujuk) : ?>
                                        <option value="<?php echo $alasanRujuk['name']; ?>"><?php echo $alasanRujuk['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Transportasi Keluar</label>
                                <select name="transportasi" id="transportasi" class="select2" style="width: 100%">
                                    <option value="">Pilih</option>
                                    <?php foreach ($mobil as $mob) : ?>
                                        <option value="<?php echo $mob['name']; ?>"><?php echo $mob['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseKonsultasi" aria-expanded="false" aria-controls="collapseTwo">
                                        Konsultasi
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseKonsultasi" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-1">
                                            <label>Deskripsi / Alasan Konsultasi</label>
                                            <textarea id="mymce" name="deskripsiKonsultasi" class="form-control" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <label>Tujuan Konsultasi</label>
                                            <select name="tujuanKonsultasi" id="tujuanKonsultasi" class="select2" style="width: 100%">
                                                <?php foreach ($konsultasi as $kos) : ?>
                                                    <option value="0">Tidak Dikonsulkan</option>
                                                    <option value="<?php echo $kos['name']; ?>"><?php echo $kos['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <label>Konsultasi</label>
                                            <select name="konsulen" id="konsulen" class="select2" style="width: 100%">
                                                <option value="">Pilih Dokter Konsulen</option>
                                                <?php foreach ($list as $dokterpoli) { ?>
                                                    <option value="<?= $dokterpoli['name']; ?>" class="select-dokterpoli"><?= $dokterpoli['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan Catatan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?= form_close() ?>



    <script src="https://unpkg.com/markerjs2/markerjs2.js"></script>
    <script>
        var imageAnatomi = document.getElementById("sampleAnatomi");

        $('#sampleAnatomi').click(function() {
            var markerArea = new markerjs2.MarkerArea(imageAnatomi);
            markerArea.settings.displayMode = 'popup';
            markerArea.settings.defaultColorSet = ['red', 'green', 'blue', 'white', 'black'];
            markerArea.settings.defaultColor = 'black';
            markerArea.settings.defaultFillColor = 'green';
            markerArea.settings.defaultHighlightColor = 'green';
            markerArea.addEventListener("render", event => {
                imageAnatomi.src = event.dataUrl;
                document.getElementById("pathAnatomi").value = event.dataUrl;
            });
            markerArea.uiStyleSettings.zIndex = "99999";
            markerArea.show();
        });

        $('#newCanvas').click(function() {
            $('#sampleAnatomi').attr('src', '<?= base_url('assets/images/anatomi_tubuh/statuslokalis.jpeg'); ?>');
        });
    </script>


    <script src="<?= base_url('assets/plugins/audio-js/app.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/audio-js/recorder.js'); ?>"></script>


    <script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script>
        $(function() {

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
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
        $('#isikepala').on('change', function() {
            if ($('#isikepala').val() == 1) {
                $('#uraiankepala').removeAttr('disabled');
                $('#uraiankepala').val('Ada#');
                $('#isikepala').val(0);
                $('#kepala').val(1);
            } else {
                $('#uraiankepala').attr('disabled', 'disabled');
                $('#uraiankepala').val(0);
                $('#isikepala').val(1);
                $('#kepala').val(0);
            }
        })
        $('#isimata').on('change', function() {
            if ($('#isimata').val() == 1) {
                $('#uraianmata').removeAttr('disabled');
                $('#uraianmata').val('Ada#');
                $('#isimata').val(0);
                $('#mata').val(1);
            } else {
                $('#uraianmata').attr('disabled', 'disabled');
                $('#uraianmata').val(0);
                $('#isimata').val(1);
                $('#mata').val(0);
            }
        })
        $('#isitelinga').on('change', function() {
            if ($('#isitelinga').val() == 1) {
                $('#uraiantelinga').removeAttr('disabled');
                $('#uraiantelinga').val('Ada#');
                $('#isitelinga').val(0);
                $('#telinga').val(1);
            } else {
                $('#uraiantelinga').attr('disabled', 'disabled');
                $('#uraiantelinga').val(0);
                $('#isitelinga').val(1);
                $('#telinga').val(0);
            }
        })
        $('#isihidung').on('change', function() {
            if ($('#isihidung').val() == 1) {
                $('#uraianhidung').removeAttr('disabled');
                $('#uraianhidung').val('Ada#');
                $('#isihidung').val(0);
                $('#hidung').val(1);
            } else {
                $('#uraianhidung').attr('disabled', 'disabled');
                $('#uraianhidung').val(0);
                $('#isihidung').val(1);
                $('#hidung').val(0);
            }
        })
        $('#isibibir').on('change', function() {
            if ($('#isibibir').val() == 1) {
                $('#uraianbibir').removeAttr('disabled');
                $('#uraianbibir').val('Ada#');
                $('#isibibir').val(0);
                $('#bibir').val(1);
            } else {
                $('#uraianbibir').attr('disabled', 'disabled');
                $('#uraianbibir').val(0);
                $('#isibibir').val(1);
                $('#bibir').val(0);
            }
        })
        $('#isirambut').on('change', function() {
            if ($('#isirambut').val() == 1) {
                $('#uraianrambut').removeAttr('disabled');
                $('#uraianrambut').val('Ada#');
                $('#isirambut').val(0);
                $('#rambut').val(1);
            } else {
                $('#uraianrambut').attr('disabled', 'disabled');
                $('#uraianrambut').val(0);
                $('#isirambut').val(1);
                $('#rambut').val(0);
            }
        })

        $('#isigigiGeligi').on('change', function() {
            if ($('#isigigiGeligi').val() == 1) {
                $('#uraiangigiGeligi').removeAttr('disabled');
                $('#uraiangigiGeligi').val('Ada#');
                $('#isigigiGeligi').val(0);
                $('#gigiGeligi').val(1);
            } else {
                $('#uraiangigiGeligi').attr('disabled', 'disabled');
                $('#uraiangigiGeligi').val(0);
                $('#isigigiGeligi').val(1);
                $('#gigiGeligi').val(0);
            }
        })
        $('#isilidah').on('change', function() {
            if ($('#isilidah').val() == 1) {
                $('#uraianlidah').removeAttr('disabled');
                $('#uraianlidah').val('Ada#');
                $('#isilidah').val(0);
                $('#lidah').val(1);
            } else {
                $('#uraianlidah').attr('disabled', 'disabled');
                $('#uraianlidah').val(0);
                $('#isilidah').val(1);
                $('#lidah').val(0);
            }
        })

        $('#isiLangitLangit').on('change', function() {
            if ($('#isiLangitLangit').val() == 1) {
                $('#uraianLangitLangit').removeAttr('disabled');
                $('#uraianLangitLangit').val('Ada#');
                $('#isiLangitLangit').val(0);
                $('#LangitLangit').val(1);
            } else {
                $('#uraianLangitLangit').attr('disabled', 'disabled');
                $('#uraianLangitLangit').val(0);
                $('#isiLangitLangit').val(1);
                $('#LangitLangit').val(0);
            }
        })
        $('#isileher').on('change', function() {
            if ($('#isileher').val() == 1) {
                $('#uraianleher').removeAttr('disabled');
                $('#uraianleher').val('Ada#');
                $('#isileher').val(0);
                $('#leher').val(1);
            } else {
                $('#uraianleher').attr('disabled', 'disabled');
                $('#uraianleher').val(0);
                $('#isileher').val(1);
                $('#leher').val(0);
            }
        })
        $('#isitenggorokan').on('change', function() {
            if ($('#isitenggorokan').val() == 1) {
                $('#uraiantenggorokan').removeAttr('disabled');
                $('#uraiantenggorokan').val('Ada#');
                $('#isitenggorokan').val(0);
                $('#tenggorokan').val(1);
            } else {
                $('#uraiantenggorokan').attr('disabled', 'disabled');
                $('#uraiantenggorokan').val(0);
                $('#isitenggorokan').val(1);
                $('#tenggorokan').val(0);
            }
        })
        $('#isidada').on('change', function() {
            if ($('#isidada').val() == 1) {
                $('#uraiandada').removeAttr('disabled');
                $('#uraiandada').val('Ada#');
                $('#isidada').val(0);
                $('#dada').val(1);
            } else {
                $('#uraiandada').attr('disabled', 'disabled');
                $('#uraiandada').val(0);
                $('#isidada').val(1);
                $('#dada').val(0);
            }
        })
        $('#isitonsil').on('change', function() {
            if ($('#isitonsil').val() == 1) {
                $('#uraiantonsil').removeAttr('disabled');
                $('#uraiantonsil').val('Ada#');
                $('#isitonsil').val(0);
                $('#tonsil').val(1);
            } else {
                $('#uraiantonsil').attr('disabled', 'disabled');
                $('#uraiantonsil').val(0);
                $('#isitonsil').val(1);
                $('#tonsil').val(0);
            }
        })
        $('#isipayudara').on('change', function() {
            if ($('#isipayudara').val() == 1) {
                $('#uraianpayudara').removeAttr('disabled');
                $('#uraianpayudara').val('Ada#');
                $('#isipayudara').val(0);
                $('#payudara').val(1);
            } else {
                $('#uraianpayudara').attr('disabled', 'disabled');
                $('#uraianpayudara').val(0);
                $('#isipayudara').val(1);
                $('#payudara').val(0);
            }
        })
        $('#isiperut').on('change', function() {
            if ($('#isiperut').val() == 1) {
                $('#uraianperut').removeAttr('disabled');
                $('#uraianperut').val('Ada#');
                $('#isiperut').val(0);
                $('#perut').val(1);
            } else {
                $('#uraianperut').attr('disabled', 'disabled');
                $('#uraianperut').val(0);
                $('#isiperut').val(1);
                $('#perut').val(0);
            }
        })
        $('#isipunggung').on('change', function() {
            if ($('#isipunggung').val() == 1) {
                $('#uraianpunggung').removeAttr('disabled');
                $('#uraianpunggung').val('Ada#');
                $('#isipunggung').val(0);
                $('#punggung').val(1);
            } else {
                $('#uraianpunggung').attr('disabled', 'disabled');
                $('#uraianpunggung').val(0);
                $('#isipunggung').val(1);
                $('#punggung').val(0);
            }
        })
        $('#isigenital').on('change', function() {
            if ($('#isigenital').val() == 1) {
                $('#uraiangenital').removeAttr('disabled');
                $('#uraiangenital').val('Ada#');
                $('#isigenital').val(0);
                $('#genital').val(1);
            } else {
                $('#uraiangenital').attr('disabled', 'disabled');
                $('#uraiangenital').val(0);
                $('#isigenital').val(1);
                $('#genital').val(0);
            }
        })
        $('#isianus').on('change', function() {
            if ($('#isianus').val() == 1) {
                $('#uraiananus').removeAttr('disabled');
                $('#uraiananus').val('Ada#');
                $('#isianus').val(0);
                $('#anus').val(1);
            } else {
                $('#uraiananus').attr('disabled', 'disabled');
                $('#uraiananus').val(0);
                $('#isianus').val(1);
                $('#anus').val(0);
            }
        })
        $('#isilenganAtas').on('change', function() {
            if ($('#isilenganAtas').val() == 1) {
                $('#uraianlenganAtas').removeAttr('disabled');
                $('#uraianlenganAtas').val('Ada#');
                $('#isilenganAtas').val(0);
                $('#lenganAtas').val(1);
            } else {
                $('#uraianlenganAtas').attr('disabled', 'disabled');
                $('#uraianlenganAtas').val(0);
                $('#isilenganAtas').val(1);
                $('#lenganAtas').val(0);
            }
        })
        $('#isilenganBawah').on('change', function() {
            if ($('#isilenganBawah').val() == 1) {
                $('#uraianlenganBawah').removeAttr('disabled');
                $('#uraianlenganBawah').val('Ada#');
                $('#isilenganBawah').val(0);
                $('#lenganBawah').val(1);
            } else {
                $('#uraianlenganBawah').attr('disabled', 'disabled');
                $('#uraianlenganBawah').val(0);
                $('#isilenganBawah').val(1);
                $('#lenganBawah').val(0);
            }
        })
        $('#isijariTangan').on('change', function() {
            if ($('#isijariTangan').val() == 1) {
                $('#uraianjariTangan').removeAttr('disabled');
                $('#uraianjariTangan').val('Ada#');
                $('#isijariTangan').val(0);
                $('#jariTangan').val(1);
            } else {
                $('#uraianjariTangan').attr('disabled', 'disabled');
                $('#uraianjariTangan').val(0);
                $('#isijariTangan').val(1);
                $('#jariTangan').val(0);
            }
        })
        $('#isikukuTangan').on('change', function() {
            if ($('#isikukuTangan').val() == 1) {
                $('#uraiankukuTangan').removeAttr('disabled');
                $('#uraiankukuTangan').val('Ada#');
                $('#isikukuTangan').val(0);
                $('#kukuTangan').val(1);
            } else {
                $('#uraiankukuTangan').attr('disabled', 'disabled');
                $('#uraiankukuTangan').val(0);
                $('#isikukuTangan').val(1);
                $('#kukuTangan').val(0);
            }
        })
        $('#isipersendianTangan').on('change', function() {
            if ($('#isipersendianTangan').val() == 1) {
                $('#uraianpersendianTangan').removeAttr('disabled');
                $('#uraianpersendianTangan').val('Ada#');
                $('#isipersendianTangan').val(0);
                $('#persendianTangan').val(1);
            } else {
                $('#uraianpersendianTangan').attr('disabled', 'disabled');
                $('#uraianpersendianTangan').val(0);
                $('#isipersendianTangan').val(1);
                $('#persendianTangan').val(0);
            }
        })
        $('#isitungkaiAtas').on('change', function() {
            if ($('#isitungkaiAtas').val() == 1) {
                $('#uraiantungkaiAtas').removeAttr('disabled');
                $('#uraiantungkaiAtas').val('Ada#');
                $('#isitungkaiAtas').val(0);
                $('#tungkaiAtas').val(1);
            } else {
                $('#uraiantungkaiAtas').attr('disabled', 'disabled');
                $('#uraiantungkaiAtas').val(0);
                $('#isitungkaiAtas').val(1);
                $('#tungkaiAtas').val(0);
            }
        })
        $('#isitungkaiBawah').on('change', function() {
            if ($('#isitungkaiBawah').val() == 1) {
                $('#uraiantungkaiBawah').removeAttr('disabled');
                $('#uraiantungkaiBawah').val('Ada#');
                $('#isitungkaiBawah').val(0);
                $('#tungkaiBawah').val(1);
            } else {
                $('#uraiantungkaiBawah').attr('disabled', 'disabled');
                $('#uraiantungkaiBawah').val(0);
                $('#isitungkaiBawah').val(1);
                $('#tungkaiBawah').val(0);
            }
        })
        $('#isijariKaki').on('change', function() {
            if ($('#isijariKaki').val() == 1) {
                $('#uraianjariKaki').removeAttr('disabled');
                $('#uraianjariKaki').val('Ada#');
                $('#isijariKaki').val(0);
                $('#jariKaki').val(1);
            } else {
                $('#uraianjariKaki').attr('disabled', 'disabled');
                $('#uraianjariKaki').val(0);
                $('#isijariKaki').val(1);
                $('#jariKaki').val(0);
            }
        })
        $('#isikukuKaki').on('change', function() {
            if ($('#isikukuKaki').val() == 1) {
                $('#uraiankukuKaki').removeAttr('disabled');
                $('#uraiankukuKaki').val('Ada#');
                $('#isikukuKaki').val(0);
                $('#kukuKaki').val(1);
            } else {
                $('#uraiankukuKaki').attr('disabled', 'disabled');
                $('#uraiankukuKaki').val(0);
                $('#isikukuKaki').val(1);
                $('#kukuKaki').val(0);
            }
        })
        $('#isipersendianKaki').on('change', function() {
            if ($('#isipersendianKaki').val() == 1) {
                $('#uraianpersendianKaki').removeAttr('disabled');
                $('#uraianpersendianKaki').val('Ada#');
                $('#isipersendianKaki').val(0);
                $('#persendianKaki').val(1);
            } else {
                $('#uraianpersendianKaki').attr('disabled', 'disabled');
                $('#uraianpersendianKaki').val(0);
                $('#isipersendianKaki').val(1);
                $('#persendianKaki').val(0);
            }
        })
    </script>


    <script>
        $(document).ready(function() {
            $('#audData').change(function() {
                var fileInput = $.trim($('#audData').val());
                if (fileInput != '') {
                    $('#audData').addClass('remove-btn');
                } else {
                    $('#audData').removeClass('remove-btn');
                }
            });

            $('.formasesmenmedis').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
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
                            dataCPPT();


                            // $('#form-filter-atas').css('display', 'none');
                            // $('#form-filter-bawah').css('display', 'block');
                            // $('#journalnumber').val(response.JN);
                            // $('#kode').val(response.JN);
                            // $('#dokter').val(response.dokter);
                            // $('#doktername').val(response.doktername);
                            // $('#documentdate').val(response.tanggalpelayanan);

                        }
                    }


                });
                return false;
            });
        });
    </script>


    <script>
        $('#caridiagnosa').click(function(e) {
            e.preventDefault();
            let referencenumber = $('#nomorreferensi').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/cariTemplateRMERanap'); ?>",

                data: {
                    referencenumber: referencenumber
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalpilihtemplaterme').modal('show');

                    }
                }

            })


        })
    </script>

    <script>
        function pesanRAD(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderRADRanap'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalorderRADrme_rajal').modal('show');
                    }
                }
            });
        }

        function pesanLPK(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderLPKRanap'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalorderLPKrme_rajal').modal('show');
                    }
                }
            });
        }

        function pesanLPA(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderLPARajal'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalorderLPArme_rajal').modal('show');
                    }
                }
            });
        }

        function pesanRHM(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderRHMRajal'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalorderRHMrme_rajal').modal('show');
                    }
                }
            });
        }

        function resumeOrder(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/resumeOrderPenunjangRanap'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalresumeorder_ranap').modal('show');
                    }
                }
            });
        }

        function TNORajal(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderTNOIGD'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalinputTNOigd_rme').modal('show');
                    }
                }
            });
        }

        function eResep(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/orderEresepIGD'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalinputeresepRajal_rme').modal('show');
                    }
                }
            });
        }

        function codingDiagnosa(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/KodifikasiDiagnosaIGD'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalinputDiagnosa_rme').modal('show');
                    }
                }
            });
        }
    </script>

    <script>
        function RiwayatResepxxx(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('PelayananRawatJalanRME/riwayatPelayananResepxxxx'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalriwayatpelayananresepxxx').modal('show');
                    }
                }
            });
        }
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
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalpilihaskep').modal('show');

                    }
                }
            })
        })
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
                        $('.viewmodalmedis').html(response.sukses).show();
                        $('#modalpilihaskep_implementasi').modal('show');

                    }
                }
            })
        })
    </script>
    <script>
        $('#kondisiPasien').on('change', function() {
            $.ajax({
                'type': "POST",
                'url': "<?php echo base_url('PelayananRawatJalanRME/fill_ats') ?>",
                'data': {
                    key: $('#kondisiPasien option:selected').data('id')
                },
                'success': function(response) {
                    let data = JSON.parse(response);
                    $('#kondisiPasien').val(data.id);
                    $('#ats').val(data.nilai);

                }
            })
        })
    </script>



    <script type="text/javascript">
        $('#hamil').on('change', function() {
            if ($('#hamil').val() == "Ya") {
                $('#grapida').removeAttr('disabled');
                $('#partus').removeAttr('disabled');
                $('#abortus').removeAttr('disabled');
                $('#umurKehamilan').removeAttr('disabled');


            } else {
                $('#grapida').attr('disabled', 'disabled');
                $('#partus').attr('disabled', 'disabled');
                $('#abortus').attr('disabled', 'disabled');
                $('#umurKehamilan').attr('disabled', 'disabled');
                $('#grapida').val('');
                $('#partus').val('');
                $('#abortus').val('');
                $('#umurKehamilan').val('');
            }

        })
    </script>

    <script type="text/javascript">
        $('#alergi').on('change', function() {
            if ($('#alergi').val() == "Ya") {
                $('#alergiObat').removeAttr('disabled');
            } else {
                $('#alergiObat').attr('disabled', 'disabled');
                $('#alergiObat').val('');

            }
        })
    </script>


    <script type="text/javascript">
        $('#obatRutin').on('change', function() {
            if ($('#obatRutin').val() == "Ya") {
                $('#namaObatRutin').removeAttr('disabled');
            } else {
                $('#namaObatRutin').attr('disabled', 'disabled');
                $('#namaObatRutin').val('');

            }
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
            document.getElementById('totalGcs').value = totalGCS2;
        }
    </script>



    <script type="text/javascript">
        $('#tindakLanjut').on('change', function() {
            if ($('#tindakLanjut').val() == "Rujuk Faskes Tingkat Lanjut") {
                $('#tujuanRujuk').removeAttr('disabled');
                $('#indikasiRujuk').removeAttr('disabled');

            } else {
                $('#tujuanRujuk').attr('disabled', 'disabled');
                $('#indikasiRujuk').attr('disabled', 'disabled');
                $('#tujuanRujuk').val('');
            }

        })
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $("#tujuanRujuk").autocomplete({
                source: "<?php echo base_url('PelayananRanap/ajax_rujuk'); ?>",
                select: function(event, ui) {
                    $('#tujuanRujuk').val(ui.item.value);

                }
            });
        });
    </script>