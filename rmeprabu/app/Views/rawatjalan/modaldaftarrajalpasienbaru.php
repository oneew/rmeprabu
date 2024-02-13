<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">

<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />





<div id="modaldaftarrajalpasienbaru" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pendaftaran Poliklinik Pasien Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card-body">
                            <div class="row" id="validation">
                                <div class="col-12">
                                    <form class="pasienbaru" id="form-pasien-baru" method="post" action="<?= base_url(); ?>/RawatJalan/simpandataregisterpasienbaru">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="initial"> Inisial
                                                        <span class="danger"></span>
                                                    </label>
                                                    <select name="initial" id="initial" class="select2" style="width: 100%;">
                                                        <option value="-">-</option>
                                                        <?php foreach ($inisial as $ins) : ?>
                                                            <option value="<?= $ins['inisial']; ?>" class="select-inisial"><?= $ins['inisial']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name"> Nama
                                                        <span class="danger"></span>
                                                    </label>
                                                    <input type="text" class="form-control required" id="name" name="name" onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="nomorasuransi">NIK</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control required" id="nik" name="nik" onkeypress="return hanyaAngka(event)">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" id="btn-carinik" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                    <div id="form-filter-cek" style="display: none;">
                                                        <span class="badge badge-info"><small class="form-control-feedback text-white"><b>#Sudah Cek</b></small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="nomorasuransi">Koreksi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <button disabled class="btn btn-warning" id="btn-update-nik" type="button"><span><i class="fas fa-eye-dropper"></i></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="name"> IncorrectNik</label>
                                                    <div class="switch">
                                                        <label>
                                                            <input name="tandaNik" id="tandaNik" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jeniskelamin"> Jenis Kelamin
                                                        <span class="danger"></span>
                                                    </label>
                                                    <select class="select2" style="width:100%;" id="jeniskelamin" name="jeniskelamin">
                                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                        <option value="PEREMPUAN">PEREMPUAN</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tempatlahir"> Tempat Lahir
                                                        <span class="danger"></span>
                                                    </label>
                                                    <input type="text" class="form-control required" id="tempatlahir" name="tempatlahir" onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tanggallahir"> Tanggal Lahir
                                                        <span class="danger"></span>
                                                    </label>
                                                    <input type="text" id="datepicker-autoclose" autocomplete="off" name="tanggallahir" class="form-control" value="<?= date('d/m/Y'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="agama">Agama</label>
                                                    <select name="agama" id="agama" class="select2" style="width: 100%;">
                                                        <?php foreach ($agama as $agm) : ?>
                                                            <option value="<?= $agm['agama']; ?>" class="select-inisial"><?= $agm['agama']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="statusnikah">Status</label>
                                                    <select name="statusnikah" id="statusnikah" class="select2" style="width: 100%;">
                                                        <?php foreach ($statusnikah as $status) : ?>
                                                            <option value="<?= $status['marital_status']; ?>" class="select-inisial"><?= $status['marital_status']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="citizenship"> Warga Negara
                                                        <span class="danger"></span>
                                                    </label>
                                                    <select class="select2 required" style="width: 100%;" id="citizenship" name="citizenship">
                                                        <option value="WNI">WNI</option>
                                                        <option value="WNA">WNA</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="golongandarah"> Golongan Darah
                                                        <span class="danger"></span>
                                                    </label>
                                                    <select class="select2 required" style="width: 100%;" id="golongandarah" name="golongandarah">
                                                        <option value="NONE">NONE</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="rhesus">Rhesus</label>
                                                    <select class="select2 required" style="width: 100%;" id="rhesus" name="rhesus">
                                                        <option value="NONE">NONE</option>
                                                        <option value="+">+</option>
                                                        <option value="-">-</option>
                                                        <option value="RH-">RH-</option>
                                                        <option value="RH">RH</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pendidikan">Pendidikan</label>
                                                    <select name="pendidikan" id="pendidikan" class="select2" style="width: 100%;">
                                                        <?php foreach ($pendidikan as $edu) : ?>
                                                            <option value="<?= $edu['pendidikan']; ?>" class="select-inisial"><?= $edu['pendidikan']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pekerjaan">Pekerjaan</label>
                                                    <select name="pekerjaan" id="pekerjaan" class="select2" style="width: 100%;">
                                                        <?php foreach ($pekerjaan as $work) : ?>
                                                            <option value="<?= $work['pekerjaan']; ?>" class="select-inisial"><?= $work['pekerjaan']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="telepon">Telepon</label>
                                                    <input type="tel" class="form-control" id="telepon" name="telepon" onkeypress="return hanyaAngka(event)" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="teleponseluler">Telepon Seluler</label>
                                                    <input type="text" class="form-control" id="teleponseluler" name="teleponseluler" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="namaorangtua">Nama Ibu Kandung</label>
                                                    <input name="namaorangtua" id="namaorangtua" class="form-control required" onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="penanggungjawab">Penanggung Jawab</label>
                                                    <input name="penanggungjawab" id="penanggungjawab" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="-">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="couplename">Hubungan</label>
                                                    <select name="couplename" id="couplename" class="select2" style="width: 100%;">
                                                        <?php foreach ($HPJB as $pjb) : ?>
                                                            <option value="<?= $pjb['hubunganpjb']; ?>" class="select-inisial"><?= $pjb['hubunganpjb']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="alamat"> Alamat
                                                        <span class="danger"></span>
                                                    </label>
                                                    <input name="alamat" id="alamat" class="form-control required" onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="rt">RT</label>
                                                    <input name="rt" id="rt" class="form-control" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="rw">RW</label>
                                                    <input name="rw" id="rw" class="form-control" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control required" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kelurahan"> Kelurahan
                                                        <span class="danger"></span>
                                                    </label>
                                                    <input name="kelurahan" id="kelurahan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="namakecamatan">Kecamatan</label>
                                                    <input name="namakecamatan" id="namakecamatan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <input name="kabupaten" id="kabupaten" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="propinsi">Propinsi</label>
                                                    <input type="text" id="propinsi" name="propinsi" class="form-control required" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                    <input type="hidden" name="kodewilayah" id="kodewilayah" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                    <input type="hidden" name="namasubarea" id="namasubarea" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                    <input type="hidden" name="area" id="area" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="kodepos">Kodepos</label>
                                                    <input type="text" id="kodepos" name="kodepos" class="form-control required" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="metodepembayaran">Metode Pembayaran</label>
                                                    <select name="carabayar" id="carabayar" class="select2 required" style="width: 100%;">
                                                        <?php foreach ($metodepembayaran as $bayar) : ?>
                                                            <option value="<?= $bayar['name']; ?>" class="select-inisial"><?= $bayar['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nomorasuransi">Nomor Asuransi</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="nomorasuransi" name="nomorasuransi" placeholder="No.Asuransi">
                                                        <input type="hidden" id="documentdate_baru" name="documentdate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" id="btn-cardbaruBPJS" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="nomorasuransi">Nomor Rujukan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="nomorrujukan" name="nomorrujukan" placeholder="No.rujukan">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" id="btn-card2" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tanggalrujuakn">Tgl Rujukan</label>
                                                    <input type="text" id="datepicker-autoclose" autocomplete="off" name="tanggalrujukan" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="namafaskes">Nama Faskes</label>
                                                    <input type="text" class="form-control" id="namafaskes" name="namafaskes" placeholder="Nama Faskes">
                                                    <input type="hidden" class="form-control" id="kodefaskes" name="kodefaskes" placeholder="Nama Faskes" value="NONE">

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Diagnosa Masuk</label>
                                                    <input type="text" id="diagnosamasuk" name="diagnosamasuk" class="form-control" autocomplete="off">
                                                    <input type="hidden" id="kodeicdx" name="kodeicdx" class="form-control" value="NONE">
                                                    <input type="hidden" id="namaicdx" name="namaicdx" class="form-control" value="NONE">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="pilihpelayanan">Pelayanan</label>
                                                        <select name="pilihpelayanan" id="pilihpelayanan" class="select2" style="width: 100%">
                                                            <option>Pilih Pelayanan</option>
                                                            <?php foreach ($pelayanan as $PLY) : ?>

                                                                <option data-id="<?= $PLY['id']; ?>" class="select-pilihpelayanan"><?= $PLY['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <input type="hidden" id="kode_pelayanan" name="kode_pelayanan" class="form-control" readonly>
                                                        <input type="hidden" id="nama_pelayanan" name="nama_pelayanan" class="form-control" readonly>
                                                        <input type="hidden" id="price_pelayanan" name="price_pelayanan" class="form-control" readonly>
                                                        <input type="hidden" id="share1_pelayanan" name="share1_pelayanan" class="form-control" readonly>
                                                        <input type="hidden" id="share2_pelayanan" name="share2_pelayanan" class="form-control" readonly>
                                                        <input type="hidden" id="code_triase" name="code_triase" class="form-control" readonly value="NONE">
                                                        <input type="hidden" id="kelompok_triase" name="kelompok_triase" class="form-control" readonly value="NONE">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="sebabmasuk">Sebab Masuk</label>
                                                    <select name="sebabmasuk" id="sebabmasuk" class="select2" style="width: 100%" required>
                                                        <option value="">Pilih Sebab Masuk</option>
                                                        <?php foreach ($sebabsakit as $sebab) : ?>
                                                            <option value="<?= $sebab['name']; ?>" class="select-code"><?= $sebab['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="namapoliklinik">Poliklinik</label>
                                                    <select name="namapoliklinik" id="namapoliklinik" class="select2" style="width: 100%">
                                                        <option>Pilih Poliklinik</option>
                                                        <?php foreach ($namasmf as $poli) : ?>
                                                            <option data-id="<?= $poli['id']; ?>" class="select-namapoliklinik"><?= $poli['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" id="kodepoliklinik" name="kodepoliklinik" class="form-control" readonly>
                                                    <input type="hidden" id="kodebpjs" name="kodebpjs" class="form-control" readonly>
                                                    <div class="form-control-feedback errornamapoliklinik">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dokter">Dokter Pemeriksa</label>
                                                    <select name="dokter" id="dokter" class="select2" style="width: 100%" required>
                                                        <option value="">Pilih Dokter Pemeriksa</option>
                                                        <?php foreach ($list as $dpjp) : ?>
                                                            <option value="<?= $dpjp['code'] . '|' . $dpjp['name'] . '|' . $dpjp['kode_bpjs'] ;?>" class="select-dokter"><?= $dpjp['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <div class="form-control-feedback errornamadokterpoli">
                                                    </div>
                                                    <input type="hidden" id="email_baru" name="email_baru" class="form-control" autocomplete="off" value="deniapriali@gmail.com">
                                                    <input type="hidden" id="catatan" name="catatan" class="form-control" value="-">
                                                    <input type="hidden" id="registerdate_baru" name="registerdate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                    <input type="hidden" id="code_baru" name="code_baru" class="form-control">
                                                    <input type="hidden" id="oldcode_baru" name="oldcode_baru" class="form-control" value="">
                                                    <input type="hidden" id="createddate_baru" name="createddate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                    <input type="hidden" id="createdby_baru" name="createdby_baru" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                    <input type="hidden" id="groups_baru" name="groups_baru" class="form-control" value="IRJ">
                                                    <input type="hidden" id="visited_baru" name="visited_baru" class="form-control" value="K1">
                                                    <input type="hidden" id="bpjs_sep_baru" name="bpjs_sep_baru" class="form-control">
                                                    <input type="hidden" id="documentyear_baru" name="documentyear_baru" class="form-control" value="<?= date('Y'); ?>">
                                                    <input type="hidden" id="documentmonth_baru" name="documentmonth_baru" class="form-control" value="<?= date('m'); ?>">
                                                    <input type="hidden" id="locationcode_baru" name="locationcode_baru" class="form-control" value="PORTIR-RJ">
                                                    <input type="hidden" id="locationname_baru" name="locationname_baru" class="form-control" value="PENDAFTARAN INSTALASI RAWAT JALAN (IRJ)">
                                                    <input type="hidden" id="cretedip_baru" name="cretedip_baru" value="<?= $ip; ?>" class="form-control">
                                                    <?php
                                                    helper('text');
                                                    $token_rajal = random_string('alnum', 8);
                                                    ?>
                                                    <input type="hidden" id="token_rajal_baru" name="token_rajal_baru" value="<?= $token_rajal; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right" id="form-filter-simpan" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btnsimpanpasienbaru"><i class="fa fa-check"></i> Daftarkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div id="form-filter-bawah-pasienbaru" style="display: none;">
                                        <div class="text-right">
                                            <input type="hidden" id="journalnumberhasilpasienbaru" name="journalnumberhasilpasienbaru" class="form-control">
                                            <button id="print" class="btn btn-info btn-outline btn btninputsep" type="button"> <span><i class="fas fa-calendar-check"></i></span> INSERT SEP </button>
                                            <button id="print" class="btn btn-warning btn-outline btn btncetaksep" type="button"> <span><i class="fas fa-calendar-check"></i></span> CETAK SEP </button>
                                            <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprintkarcispasienbaru" type="button"> <span><i class="fa fa-print"></i></span> </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalceknik" style="display:none;"></div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#ibsdoktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#ibsdoktername option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#ibsdoktername').val(data.name);
                    $('#ibsdokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('#pelayanan').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_jenis_pelayanan') ?>",
                'data': {
                    key: $('#pelayanan option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#pelayanan').val(data.code);
                    $('#code_pelayanan').val(data.code);
                    $('#description').val(data.name);
                    $('#price').val(data.price);
                    $('#share1').val(data.share1);
                    $('#share2').val(data.share2);

                    $('#autocomplete-dokter').html('');
                }
            })
        })




        $('#poliklinikname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_poli') ?>",
                'data': {
                    key: $('#poliklinikname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#poliklinikname').val(data.name);
                    $('#poliklinik').val(data.code);
                    $('#bpjscode').val(data.bpjscode);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#paymentmethodname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_payment') ?>",
                'data': {
                    key: $('#paymentmethodname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#paymentmethodname').val(data.name);
                    $('#paymentmethod').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#pilihpelayanan').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_jenis_pelayanan') ?>",
                'data': {
                    key: $('#pilihpelayanan option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#pilih_pelayanan').val(data.code);
                    $('#kode_pelayanan').val(data.code);
                    $('#nama_pelayanan').val(data.name);
                    $('#price_pelayanan').val(data.price);
                    $('#share1_pelayanan').val(data.share1);
                    $('#share2_pelayanan').val(data.share2);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#namapoliklinik').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete2/fill_poli') ?>",
                'data': {
                    key: $('#namapoliklinik option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#namapoliklinik').val(data.name);
                    $('#kodepoliklinik').val(data.code);
                    $('#kodebpjs').val(data.bpjscode);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#namadokterpoli').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#namadokterpoli option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#namadokterpoli').val(data.name);
                    $('#kodedokterpoli').val(data.code);
                    $('#kodedokter').val(data.kode_bpjs);

                    $('#autocomplete-dokter').html('');
                }
            })
        })




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
                $('#kodepos').val(ui.item.zipcode);
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
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.ibsdoktername) {
                            $('#ibsdoktername').addClass('form-control-danger');
                            $('.erroribsdoktername').html(response.error.ibsdoktername);
                        } else {
                            $('#ibsdoktername').removeClass('form-control-danger');
                            $('.erroribsdoktername').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                dataRegisterPoli();
                                $('#form-filter-bawah-pasienbaru').css('display', 'block');
                                $('#form-filter-simpan').css('display', 'none');
                                $('#journalnumberhasilpasienbaru').val(response.JN);


                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-cardbaruBPJS').on('click', function() {

            if ($('#nomorasuransi').val() == '' || $('#documentdate_baru').val == '') {
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
                        card: $('#nomorasuransi').val(),
                        date: $('#documentdate_baru').val()
                    },
                    success: function(response) {
                        let parseResponse = JSON.parse(response);
                        if (parseResponse.metaData.code == 200) {

                            Swal.fire({
                                html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                    '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                    '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                                icon: 'success',
                                text: parseResponse.metaData.message,
                            });
                            $('#namafaskes').val(parseResponse.response.peserta.provUmum.nmProvider);
                            $('#kodefaskes').val(parseResponse.response.peserta.provUmum.kdProvider);
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

    });
</script>

<script>
    $(document).ready(function() {
        $('.pasienbaru').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanpasienbaru').attr('disable', 'disabled');
                    $('.btnsimpanpasienbaru').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanpasienbaru').removeAttr('disable');
                    $('.btnsimpanpasienbaru').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.namadokterpoli) {
                            $('#namadokterpoli').addClass('form-control-danger');
                            $('.namadokterpoli').html(response.error.namadokterpoli);
                        } else {
                            $('#namadokterpoli').removeClass('form-control-danger');
                            $('.errornamadokterpoli').html('');
                        }

                        if (response.error.namapoliklinik) {
                            $('#namapoliklinik').addClass('form-control-danger');
                            $('.namapoliklinik').html(response.error.namapoliklinik);
                        } else {
                            $('#namapoliklinik').removeClass('form-control-danger');
                            $('.errornamapoliklinik').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //$('#modaldaftarigd').modal('hide');
                                dataRegisterPoli();
                                //$('#form-filter-bawah').css('display', 'block');
                                $('#form-filter-bawah-pasienbaru').css('display', 'block');
                                $('#form-filter-simpan').css('display', 'none');
                                $('#journalnumberhasilpasienbaru').val(response.JN);
                                $('#modaldaftarpasienbaru').modal('hide');

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>



<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/dff/dff.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
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
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
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
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
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
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/


    /*******************************************/
    // Date & Time
    /*******************************************/
    $('.datetime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });

    /*******************************************/
    //Calendars are not linked
    /*******************************************/
    $('.timeseconds').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        timePickerSeconds: true,
        locale: {
            format: 'MM-DD-YYYY h:mm:ss'
        }
    });

    /*******************************************/
    // Single Date Range Picker
    /*******************************************/
    $('.singledate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });

    /*******************************************/
    // Auto Apply Date Range
    /*******************************************/
    $('.autoapply').daterangepicker({
        autoApply: true,
    });

    /*******************************************/
    // Calendars are not linked
    /*******************************************/
    $('.linkedCalendars').daterangepicker({
        linkedCalendars: false,
    });

    /*******************************************/
    // Date Limit
    /*******************************************/
    $('.dateLimit').daterangepicker({
        dateLimit: {
            days: 7
        },
    });

    /*******************************************/
    // Show Dropdowns
    /*******************************************/
    $('.showdropdowns').daterangepicker({
        showDropdowns: true,
    });

    /*******************************************/
    // Show Week Numbers
    /*******************************************/
    $('.showweeknumbers').daterangepicker({
        showWeekNumbers: true,
    });

    /*******************************************/
    // Date Ranges
    /*******************************************/
    $('.dateranges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    /*******************************************/
    // Always Show Calendar on Ranges
    /*******************************************/
    $('.shawCalRanges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    });

    /*******************************************/
    // Top of the form-control open alignment
    /*******************************************/
    $('.drops').daterangepicker({
        drops: "up" // up/down
    });

    /*******************************************/
    // Custom button options
    /*******************************************/
    $('.buttonClass').daterangepicker({
        drops: "up",
        buttonClasses: "btn",
        applyClass: "btn-info",
        cancelClass: "btn-danger"
    });

    /*******************************************/
    // Language
    /*******************************************/
    $('.localeRange').daterangepicker({
        ranges: {
            "Aujourd'hui": [moment(), moment()],
            'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Les 7 derniers jours': [moment().subtract('days', 6), moment()],
            'Les 30 derniers jours': [moment().subtract('days', 29), moment()],
            'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
            'le mois dernier': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        locale: {
            applyLabel: "Vers l'avant",
            cancelLabel: 'Annulation',
            startLabel: 'Date initiale',
            endLabel: 'Date limite',
            customRangeLabel: 'SÃ©lectionner une date',
            // daysOfWeek: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi','Samedi'],
            daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
            monthNames: ['Janvier', 'fÃ©vrier', 'Mars', 'Avril', 'ÐœÐ°i', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            firstDay: 1
        }
    });
</script>
<script>
    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#mdate2').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
    $('#date-format').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm'
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {


            days: 6
        }
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-carinik').on('click', function() {

            if ($('#nik').val() == '') {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'Nik Tidak Boleh Kosong'

                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('RawatJalan/check_nik') ?>",
                    data: {
                        nik: $('#nik').val()
                    },
                    success: function(response) {
                        let parseResponse = JSON.parse(response);
                        if (parseResponse) {

                            Swal.fire({
                                html: 'Nama: ' + parseResponse.name + '<br>Norm: ' + parseResponse.code + '<br>Nik: ' + parseResponse.ssn + '<br>Jenis Kelamin: ' + parseResponse.gender + '<br>Tanggal Lahir: ' + parseResponse.dateofbirth + '<br>Alamat: ' + parseResponse.address,
                                icon: 'success',
                                text: 'Data Ditemukan',
                            });
                            $('#form-filter-simpan').css('display', 'none');
                            $('#btn-update-nik').removeAttr('disabled');
                            $('#form-filter-cek').css('display', 'block');

                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Data Tidak Ditemukan'

                            });
                            $('#form-filter-simpan').css('display', 'block');
                            $('#btn-update-nik').attr('disabled', 'disabled');
                            $('#form-filter-cek').css('display', 'block');
                        }
                    }
                })
            }

        })

    });
</script>

<script>
    $('#btn-update-nik').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('RawatJalan/UbahMasterPasienNik') ?>",
            data: {
                nomorinduk: $('#nik').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalceknik').html(response.data).show();
                $('#modalupdatenik').modal('show');

            }
        });

    });
</script>


<script>
    $('.btninputsep').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/CreateSepDirect'); ?>",
            data: {
                id: $('#journalnumberhasilpasienbaru').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalceknik').html(response.suksesmodalsep).show();
                    $('#modalcreatesep').modal();


                }
            }

        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btncetaksep').on('click', function() {
            let id = $('#journalnumberhasilpasienbaru').val()
            window.open("<?php echo base_url('RawatJalan/printsep') ?>?page=" + id, target = "_blank");
        })
    });
</script>