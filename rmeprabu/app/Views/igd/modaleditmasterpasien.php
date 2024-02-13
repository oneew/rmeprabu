<div id="modaleditmasterpasien" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Update Master Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card-body">
                            <div class="row" id="validation">
                                <div class="col-12">
                                    <?php
                                    foreach ($pasienlama as $pasien) :
                                    ?>
                                        <div class="card wizard-content">
                                            <form class="validation-wizard wizard-circle pasienbaru" id="form-pasien-baru" method="post" action="<?= base_url(); ?>/IGD/updatedatamasterpasien">
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
                                                                        <option value="<?= $ins['inisial']; ?>" class="select-inisial" <?php if ($ins['inisial'] == $pasien['initial']) { ?> selected="selected" <?php } ?>><?= $ins['inisial']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="name"> Norm
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="code" name="code" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['code']; ?>" readonly>
                                                                <input type="hidden" class="form-control required" id="idpasien" name="idpasien" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['id']; ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="name"> Nama
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="name" name="name" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['name']; ?>">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">

                                                            <div class="form-group">
                                                                <label for="nik"> NIK
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control required" id="nik" name="nik" onkeypress="return hanyaAngka(event)" value="<?= $pasien['ssn']; ?>">

                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-info" id="btn-ceknik" type="button">Cek!</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="jeniskelamin"> Jenis Kelamin
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <select class="select2" style="width:100%;" id="jeniskelamin" name="jeniskelamin">
                                                                    <option value="LAKI-LAKI" <?php if ($pasien['gender'] == 'LAKI-LAKI') echo "selected"; ?>>LAKI-LAKI</option>
                                                                    <option value="PEREMPUAN" <?php if ($pasien['gender'] == 'PEREMPUAN') echo "selected"; ?>>PEREMPUAN</option>

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
                                                                <input type="text" class="form-control required" id="tempatlahir" name="tempatlahir" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['placeofbirth']; ?>">
                                                            </div>
                                                        </div>

                                                        <?php

                                                        $datedari = $pasien['dateofbirth'];
                                                        $DateAwal = date("d/m/Y", strtotime($datedari));

                                                        ?>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="tanggallahir"> Tanggal Lahir
                                                                    <span class="danger"></span>
                                                                </label>

                                                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="tanggallahir" class="form-control" value="<?= $DateAwal; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="agama">Agama</label>
                                                                <select name="agama" id="agama" class="select2" style="width: 100%;">
                                                                    <?php foreach ($agama as $agm) : ?>
                                                                        <option value="<?= $agm['agama']; ?>" class="select-inisial" <?php if ($agm['agama'] == $pasien['religion']) { ?> selected="selected" <?php } ?>><?= $agm['agama']; ?></option>

                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="statusnikah">Status</label>
                                                                <select name="statusnikah" id="statusnikah" class="select2" style="width: 100%;">
                                                                    <?php foreach ($statusnikah as $status) : ?>
                                                                        <option value="<?= $status['marital_status']; ?>" class="select-inisial" <?php if ($status['marital_status'] == $pasien['maritalstatus']) { ?> selected="selected" <?php } ?>><?= $status['marital_status']; ?></option>
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
                                                                    <option value="WNI" <?php if ($pasien['citizenship'] == 'WNI') echo "selected"; ?>>WNI</option>
                                                                    <option value="WNA" <?php if ($pasien['citizenship'] == 'WNA') echo "selected"; ?>>WNA</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="golongandarah"> Golongan Darah
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <select class="select2 required" style="width: 100%;" id="golongandarah" name="golongandarah">
                                                                    <option value="NONE" <?php if ($pasien['bloodtype'] == 'NONE') echo "selected"; ?>>NONE</option>
                                                                    <option value="A" <?php if ($pasien['bloodtype'] == 'A') echo "selected"; ?>>A</option>
                                                                    <option value="B" <?php if ($pasien['bloodtype'] == 'B') echo "selected"; ?>>B</option>
                                                                    <option value="AB" <?php if ($pasien['bloodtype'] == 'AB') echo "selected"; ?>>AB</option>
                                                                    <option value="O" <?php if ($pasien['bloodtype'] == 'O') echo "selected"; ?>>O</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="rhesus">Rhesus</label>
                                                                <select class="select2 required" style="width: 100%;" id="rhesus" name="rhesus">
                                                                    <option value="NONE" <?php if ($pasien['bloodrhesus'] == 'NONE') echo "selected"; ?>>NONE</option>
                                                                    <option value="+" <?php if ($pasien['bloodrhesus'] == '+') echo "selected"; ?>>+</option>
                                                                    <option value="-" <?php if ($pasien['bloodrhesus'] == '-') echo "selected"; ?>>-</option>
                                                                    <option value="RH-" <?php if ($pasien['bloodrhesus'] == 'RH-') echo "selected"; ?>>RH-</option>
                                                                    <option value="RH" <?php if ($pasien['bloodrhesus'] == 'RH') echo "selected"; ?>>RH</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pendidikan">Pendidikan</label>
                                                                <select name="pendidikan" id="pendidikan" class="select2" style="width: 100%;">
                                                                    <?php foreach ($pendidikan as $edu) : ?>
                                                                        <option value="<?= $edu['pendidikan']; ?>" class="select-inisial" <?php if ($edu['pendidikan'] == $pasien['education']) { ?> selected="selected" <?php } ?>><?= $edu['pendidikan']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pekerjaan">Pekerjaan</label>
                                                                <select name="pekerjaan" id="pekerjaan" class="select2" style="width: 100%;">
                                                                    <?php foreach ($pekerjaan as $work) : ?>
                                                                        <option value="<?= $work['pekerjaan']; ?>" class="select-inisial" <?php if ($work['pekerjaan'] == $pasien['work']) { ?> selected="selected" <?php } ?>><?= $work['pekerjaan']; ?></option>
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
                                                                <input type="tel" class="form-control" id="telepon" name="telepon" onkeypress="return hanyaAngka(event)" value="<?= $pasien['telephone']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="teleponseluler">Telepon Seluler</label>
                                                                <input type="text" class="form-control" id="teleponseluler" name="teleponseluler" onkeypress="return hanyaAngka(event)" value="<?= $pasien['mobilephone']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="namaorangtua">Nama Ibu Kandung</label>
                                                                <input name="namaorangtua" id="namaorangtua" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['namaibukandung']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="penanggungjawab">PJB</label>
                                                                <input name="penanggungjawab" id="penanggungjawab" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="-" readonly>
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
                                                                <input name="alamat" id="alamat" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['address']; ?>">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="rt">RT</label>
                                                                <input name="rt" id="rt" class="form-control" onkeypress="return hanyaAngka(event)" value="<?= $pasien['rt']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="rw">RW</label>
                                                                <input name="rw" id="rw" class="form-control" onkeypress="return hanyaAngka(event)" value="<?= $pasien['rw']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="kecamatan">Kecamatan</label>
                                                                <input type="text" id="kecamatan" name="kecamatan" class="form-control required" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['kecamatan']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="kelurahan"> Kelurahan
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <input name="kelurahan" id="kelurahan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['district']; ?>">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="namakecamatan">Kecamatan</label>
                                                                <input name="namakecamatan" id="namakecamatan" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['subareaname']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="kabupaten">Kabupaten</label>
                                                                <input name="kabupaten" id="kabupaten" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['area']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="propinsi">Propinsi</label>
                                                                <input type="text" id="propinsi" name="propinsi" class="form-control required" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['propinsi']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="area"> Area
                                                                    <span class="danger"></span>
                                                                </label>
                                                                <input name="area" id="area" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['area']; ?>">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="subarea">Sub Area</label>
                                                                <input name="kodewilayah" id="kodewilayah" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['subarea']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="namasubarea">Nama subarea</label>
                                                                <input name="namasubarea" id="namasubarea" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['subareaname']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="kodepos">Kodepos</label>
                                                                <input type="text" id="kodepos" name="kodepos" class="form-control required" onkeypress="return hanyaAngka(event)" value="<?= $pasien['postalcode']; ?>">
                                                                <input type="hidden" id="cretedip_baru" name="cretedip_baru" value="<?= $ip; ?>" class="form-control">
                                                                <input type="hidden" id="createdby_baru" name="createdby_baru" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                                <input type="hidden" id="modifieddate" name="modifieddate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <!-- Step 3 -->
                                                <h6>Metode Pembayaran</h6>
                                                <section>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="metodepembayaran">Metode Pembayaran</label>
                                                                <select name="carabayar" id="carabayar" class="select2" style="width: 100%;">
                                                                    <?php foreach ($metodepembayaran as $bayar) : ?>
                                                                        <option value="<?= $bayar['name']; ?>" class="select-inisial" <?php if ($bayar['name'] == $pasien['paymentmethod']) { ?> selected="selected" <?php } ?>><?= $bayar['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nomorasuransi">Nomor Asuransi</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="cardnumber" name="cardnumber" placeholder="No.Asuransi" value="<?= $pasien['cardnumber']; ?>">
                                                                    <input type="hidden" id="documentdate_baru" name="documentdate_baru" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-info" id="btn-cardmaster" type="button">Cek!</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary btnsimpanpasienbaru"><i class="fa fa-check"></i> Update</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </section>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-cardmaster').on('click', function() {

            if ($('#cardnumber').val() == '' || $('#documentdate_baru').val == '') {
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
                        card: $('#cardnumber').val(),
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
                            $('#name').addClass('form-control-danger');
                            $('.name').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //$('#modaleditmasterpasien').modal('hide');
                                //datapasienlama();


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