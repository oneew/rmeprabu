<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">




<div id="modaldaftarigd" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pendaftaran Instalasi Gawat Darurat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <form action="#">
                            <div class="form-body">

                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="code" id="code" class="form-control filter-input" placeholder="No.Rm" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="namapasien" id="namapasien" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="alamat" id="alamat" class="form-control filter-input" placeholder="alamat" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatapasien">


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Pendaftaran Pasien Lama</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Pendaftaran Pasien Baru</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <?= form_open('IGD/simpandataregister', ['class' => 'formperawat']); ?>
                                        <?= csrf_field(); ?>

                                        <div class="modal-body">
                                            <from class="form-horizontal form-material" id="form-filter" method="post">
                                                <div class="form-body">


                                                    <div class="row pt-1">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Norm</label>
                                                                <input type="text" id="pasienid" name="pasienid" class="form-control" readonly>
                                                                <input type="hidden" id="oldcode" name="oldcode" class="form-control" readonly>

                                                                <?php
                                                                helper('text');
                                                                $token = random_string('alnum', 8);
                                                                ?>
                                                                <input type="hidden" id="token_rajal" name="token_rajal" value="<?= $token; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Nama Pasien</label>
                                                                <input type="text" id="pasienname" name="pasienname" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Tanggal Lahir</label>
                                                                <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Alamat</label>
                                                                <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" readonly>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->

                                                    <div class="row pt-1">

                                                        <div class="col-md-3">
                                                            <div class="form-group">

                                                                <select name="paymentmethodname" id="paymentmethodname" class="form-control" style="width: 100%">

                                                                    <?php foreach ($cabar as $carabayar) : ?>
                                                                        <option data-id="<?= $carabayar['id']; ?>" class="select-cabar" value="<?= $carabayar['name']; ?>"><?= $carabayar['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control">
                                                                <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control">
                                                                <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control">
                                                                <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control">
                                                                <input type="hidden" id="groups" name="groups" class="form-control" value="IGD">
                                                                <input type="hidden" id="visited" name="visited" class="form-control" value="K1">
                                                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                                                                <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>">
                                                                <input type="hidden" id="noantrian" name="noantrian" class="form-control">
                                                                <input type="hidden" id="pasiengender" name="pasiengender" class="form-control">
                                                                <input type="hidden" id="pasienmaritalstatus" name="pasienmaritalstatus" class="form-control">
                                                                <input type="hidden" id="pasienage" name="pasienage" class="form-control">

                                                                <input type="hidden" id="registerdate" name="registerdate" class="form-control">
                                                                <input type="hidden" id="pasienarea" name="pasienarea" class="form-control">
                                                                <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control">
                                                                <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control">
                                                                <input type="hidden" id="pasienparentname" name="pasienparentname" class="form-control">
                                                                <input type="hidden" id="pasientelephone" name="pasientelephone" class="form-control">
                                                                <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control">
                                                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="PORTIR-IGD">
                                                                <input type="hidden" id="locationname" name="locationname" class="form-control" value="PENDAFTARAN INSTALASI GAWAT DARURAT (IGD)">
                                                                <input type="hidden" id="cretedip" name="cretedip" value="<?= $ip; ?>" class="form-control">
                                                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="pasiencard" name="pasiencard" placeholder="No.Kartu Asuransi">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-info" id="btn-card" type="button">Cek!</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="pasienssn" name="pasienssn" placeholder="No.NIK">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-info" id="btn-nik" type="button">Cek!</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="faskesname" name="faskesname" placeholder="Nama Faskes">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-info" id="btn-rujukan" type="button">CR</button>
                                                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="NONE">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>

                                                    <div class="row pt-1">
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="noRujukan" name="noRujukan" placeholder="No.Rujukan">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-info" id="btn-no-rujukan" type="button">CNR</button>
                                                                    <input type="hidden" id="faskes1" name="faskes1" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">TglRujukan</label>
                                                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="referencedate" class="form-control" value="<?= date('m/d/Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">DiagnosaMasuk</label>
                                                                <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off">
                                                                <input type="hidden" id="icdx" name="icdx" class="form-control">
                                                                <input type="hidden" id="icdxname" name="icdxname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="control-label">Jenis Pelayanan</label>
                                                                    <select name="pelayanan" id="pelayanan" class="select2" style="width: 100%">
                                                                        <option>Pilih Pelayanan</option>
                                                                        <?php foreach ($pelayanan as $PL) : ?>

                                                                            <option data-id="<?= $PL['id']; ?>" class="select-pelayanan"><?= $PL['name']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <input type="hidden" id="code_pelayanan" name="code_pelayanan" class="form-control" readonly>
                                                                    <input type="hidden" id="description" name="description" class="form-control" readonly>
                                                                    <input type="hidden" id="price" name="price" class="form-control" readonly>
                                                                    <input type="hidden" id="share1" name="share1" class="form-control" readonly>
                                                                    <input type="hidden" id="share2" name="share2" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Sebab Masuk</label>
                                                                <select name="reasoncode" id="reasoncode" class="select2" style="width: 100%">
                                                                    <option>Pilih Sebab Masuk</option>
                                                                    <?php foreach ($sebabsakit as $SK) : ?>
                                                                        <option value="<?= $SK['name']; ?>" class="select-code"><?= $SK['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Pelayanan</label>
                                                                <input type="text" id="poliklinikname" name="poliklinikname" class="form-control" value="INSTALASI GAWAT DARURAT" readonly>
                                                                <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="IGD" readonly>
                                                                <input type="hidden" id="bpjscode" name="bpjscode" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Dokter Pemeriksa</label>
                                                                <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                                                    <option>Pilih Dokter Pemeriksa</option>
                                                                    <?php foreach ($list as $dpjp) { ?>
                                                                        <option data-id="<?= $dpjp['id']; ?>" class="select-dokter"><?= $dpjp['name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" name="ibsdokter" id="ibsdokter">
                                                                <div class="form-control-feedback erroribsdoktername">
                                                                </div>
                                                                <input type="hidden" id="email2" value="pasien@gmail.com" name="email2" class="form-control">
                                                                <div class="form-control-feedback errorEmail">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Memo</label>
                                                                <input type="text" id="memo" name="memo" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Email</label>
                                                                <input type="email" id="email" name="email" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </from>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Daftarkan</button>
                                        </div>
                                        <?= form_close() ?>

                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row" id="validation">
                                            <div class="col-12">

                                                <div class="card wizard-content">

                                                    <div class="card-body">

                                                        <form class="validation-wizard wizard-circle pasienbaru" id="form-pasien-baru" method="post" action="IGD/simpandataregisterpasienbaru">
                                                            <!-- Step 1 -->
                                                            <h6>Data Dasar</h6>
                                                            <section>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="initial"> Inisial
                                                                                <span class="danger"></span>
                                                                            </label>
                                                                            <select name="initial" id="initial" class="select2" style="width: 100%;">
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

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="nik"> NIK
                                                                                <span class="danger"></span>
                                                                            </label>
                                                                            <input type="text" class="form-control required" id="nik" name="nik" onkeypress="return hanyaAngka(event)">
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
                                                                            <input type="text" id="mdate" autocomplete="off" name="tanggallahir" class="form-control">
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
                                                                                <option value="+">+</option>
                                                                                <option value="-">-</option>
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
                                                            </section>
                                                            <!-- Step 2 -->
                                                            <h6>Alamat/ Kontak</h6>
                                                            <section>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="telepon">Telepon</label>
                                                                            <input type="tel" class="form-control" id="telepon" name="telepon" onkeypress="return hanyaAngka(event)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="teleponseluler">Telepon Seluler</label>
                                                                            <input type="text" class="form-control" id="teleponseluler" name="teleponseluler" onkeypress="return hanyaAngka(event)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namaorangtua">Nama Ibu Kandung</label>
                                                                            <input name="namaorangtua" id="namaorangtua" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="penanggungjawab">PJB</label>
                                                                            <input name="penanggungjawab" id="penanggungjawab" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
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
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="alamat"> Alamat
                                                                                <span class="danger"></span>
                                                                            </label>
                                                                            <input name="alamat" id="alamat" class="form-control" onkeyup="this.value = this.value.toUpperCase()">

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
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="kecamatan">Kecamatan</label>
                                                                            <input type="text" id="kecamatan" name="kecamatan" class="form-control required" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="kelurahan"> Kelurahan
                                                                                <span class="danger"></span>
                                                                            </label>
                                                                            <input name="kelurahan" id="kelurahan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namakecamatan">Kecamatan</label>
                                                                            <input name="namakecamatan" id="namakecamatan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="kabupaten">Kabupaten</label>
                                                                            <input name="kabupaten" id="kabupaten" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="propinsi">Propinsi</label>
                                                                            <input type="text" id="propinsi" name="propinsi" class="form-control required" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="area"> Area
                                                                                <span class="danger"></span>
                                                                            </label>
                                                                            <input name="area" id="area" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="subarea">Sub Area</label>
                                                                            <input name="kodewilayah" id="kodewilayah" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namasubarea">Nama subarea</label>
                                                                            <input name="namasubarea" id="namasubarea" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="kodepos">Kodepos</label>
                                                                            <input type="text" id="kodepos" name="kodepos" class="form-control required" onkeypress="return hanyaAngka(event)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <!-- Step 3 -->
                                                            <h6>Metode Pembayaran & Pelayanan</h6>
                                                            <section>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="metodepembayaran">Metode Pembayaran</label>
                                                                            <select name="carabayar" id="carabayar" class="select2" style="width: 100%;">
                                                                                <?php foreach ($metodepembayaran as $bayar) : ?>
                                                                                    <option value="<?= $bayar['name']; ?>" class="select-inisial"><?= $bayar['name']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nomorasuransi">Nomor Asuransi</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="nomorasuransi" name="nomorasuransi" placeholder="No.Asuransi">
                                                                                <input type="hidden" id="documentdate_baru" name="documentdate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">

                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-info" id="btn-card" type="button">Cek!</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
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
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="tanggalrujuakn">Tgl Rujukan</label>
                                                                            <input type="text" id="mdate2" autocomplete="off" name="tanggalrujukan" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namafaskes">Nama Faskes</label>
                                                                            <input type="text" class="form-control" id="namafaskes" name="namafaskes" placeholder="Nama Faskes">
                                                                            <input type="hidden" class="form-control" id="kodefaskes" name="kodefaskes" placeholder="Nama Faskes" value="NONE">

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Diagnosa Masuk</label>
                                                                            <input type="text" id="diagnosamasuk" name="diagnosamasuk" class="form-control" autocomplete="off">
                                                                            <input type="hidden" id="kodeicdx" name="kodeicdx" class="form-control">
                                                                            <input type="hidden" id="namaicdx" name="namaicdx" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
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
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="sebabmasuk">Sebab Masuk</label>
                                                                            <select name="sebabmasuk" id="sebabmasuk" class="select2" style="width: 100%">
                                                                                <option>Pilih Sebab Masuk</option>
                                                                                <?php foreach ($sebabsakit as $sebab) : ?>
                                                                                    <option value="<?= $sebab['name']; ?>" class="select-code"><?= $sebab['name']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namapoliklinik">Poliklinik</label>
                                                                            <input type="text" id="namapoliklinik" name="namapoliklinik" class="form-control" value="INSTALASI GAWAT DARURAT" readonly>
                                                                            <input type="hidden" id="kodepoliklinik" name="kodepoliklinik" class="form-control" value="IGD" readonly>

                                                                            <input type="hidden" id="kodebpjs" name="kodebpjs" class="form-control" readonly>
                                                                            <div class="form-control-feedback errornamapoliklinik">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="namadokterpoli">Dokter Pemeriksa</label>
                                                                            <select name="namadokterpoli" id="namadokterpoli" class="select2" style="width: 100%">
                                                                                <option>Pilih Dokter Pemeriksa</option>
                                                                                <?php foreach ($list as $dokterpoli) { ?>
                                                                                    <option data-id="<?= $dokterpoli['id']; ?>" class="select-dokterpoli"><?= $dokterpoli['name']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            <input type="hidden" name="kodedokterpoli" id="kodedokterpoli">
                                                                            <div class="form-control-feedback errornamadokterpoli">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="catatan">Memo</label>
                                                                            <input type="text" id="catatan" name="catatan" class="form-control">
                                                                            <input type="hidden" id="registerdate_baru" name="registerdate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                            <input type="hidden" id="code_baru" name="code_baru" class="form-control">
                                                                            <input type="hidden" id="oldcode_baru" name="oldcode_baru" class="form-control" value="">
                                                                            <input type="hidden" id="createddate_baru" name="createddate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                            <input type="hidden" id="createdby_baru" name="createdby_baru" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                                                            <input type="hidden" id="groups_baru" name="groups_baru" class="form-control" value="IGD">
                                                                            <input type="hidden" id="visited_baru" name="visited_baru" class="form-control" value="K1">
                                                                            <input type="hidden" id="bpjs_sep_baru" name="bpjs_sep_baru" class="form-control">
                                                                            <input type="hidden" id="documentyear_baru" name="documentyear_baru" class="form-control" value="<?= date('Y'); ?>">
                                                                            <input type="hidden" id="documentmonth_baru" name="documentmonth_baru" class="form-control" value="<?= date('m'); ?>">
                                                                            <input type="hidden" id="locationcode_baru" name="locationcode_baru" class="form-control" value="PORTIR-IGD">
                                                                            <input type="hidden" id="locationname_baru" name="locationname_baru" class="form-control" value="PENDAFTARAN INSTALASI GAWAT DARURAT (IGD)">
                                                                            <input type="hidden" id="cretedip_baru" name="cretedip_baru" value="<?= $ip; ?>" class="form-control">
                                                                            <?php
                                                                            helper('text');
                                                                            $token_rajal = random_string('alnum', 8);
                                                                            ?>
                                                                            <input type="hidden" id="token_rajal_baru" name="token_rajal_baru" value="<?= $token_rajal; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="email_baru">Email</label>
                                                                            <input type="email" id="email_baru" name="email_baru" class="form-control" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary btnsimpanpasienbaru"><i class="fa fa-check"></i> Daftarkan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </section>
                                                        </form>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function datapasienlama() {
        $.ajax({

            url: "<?php echo base_url('IGD/ambildatapasienlama') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdatapasien').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datapasienlama();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let namapasien = $('#namapasien').val();
        let code = $('#code').val();
        let alamat = $('#alamat').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/caridatapasienlama') ?>",
            dataType: "json",
            data: {
                namapasien: namapasien,
                code: code,
                alamat: alamat
            },
            success: function(response) {
                $('.viewdatapasien').html(response.data);
            }
        });
    });
</script>


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

                'url': "<?php echo base_url('Autocomplete2/fill_jenis_pelayanan_igd') ?>",
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

                'url': "<?php echo base_url('Autocomplete2/fill_jenis_pelayanan_igd') ?>",
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

                    $('#autocomplete-dokter').html('');
                }
            })
        })




    });


    $('#btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
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
                    card: $('#pasiencard').val(),
                    date: $('#documentdate').val()
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
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
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


    $('#btn-nik').on('click', function() {

        if ($('#pasienssn').val() == '' || $('#registerdate').val == '') {

            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_nik') ?>",
                data: {
                    nik: $('#pasienssn').val(),
                    date: $('#registerdate').val()
                },
                success: function(response) {

                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            //type: 'success',
                            icon: 'success',
                            title: parseResponse.metaData.message,
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                        });
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

    $('#btn-rujukan').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_rujukan_kartu') ?>",
                data: {
                    card: $('#pasiencard').val(),
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
    $('#btn-card2').on('click', function() {

        if ($('#nomorasuransi').val() == '' || $('#registerdate2').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card_baru') ?>",
                data: {
                    card: $('#nomorasuransi').val(),
                    date: $('#documentdate2').val()
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
                        $('#faskesname2').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes2').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',

                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
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
                                $('#modaldaftarigd').modal('hide');
                                dataRegisterPoli();


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
                                $('#modaldaftarigd').modal('hide');
                                dataRegisterPoli();


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
<script src="<?= base_url(); ?>/assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/wizard/jquery.validate.min.js"></script>
<script>
    //Custom design form example
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Done"
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

        }
    });


    var form = $(".validation-wizard").show();

    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Done"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function(event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    }), $(".validation-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })
</script>

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
    $('.daterange').daterangepicker();

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