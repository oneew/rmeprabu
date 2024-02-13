<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    ;
</style>

<div id="modalubahcabarrajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Ubah Data Register Pelayanan Rawat Jalan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $tanggallahir = $pasien['pasiendateofbirth'];
                                    $dob = strtotime($tanggallahir);
                                    $current_time = time();
                                    $age_years = date('Y', $current_time) - date('Y', $dob);
                                    $age_months = date('m', $current_time) - date('m', $dob);
                                    $age_days = date('d', $current_time) - date('d', $dob);

                                    if ($age_days < 0) {
                                        $days_in_month = date('t', $current_time);
                                        $age_months--;
                                        $age_days = $days_in_month + $age_days;
                                    }

                                    if ($age_months < 0) {
                                        $age_years--;
                                        $age_months = 12 + $age_months;
                                    }

                                    $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                                    if (($pasien['pasiengender'] == 'L') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['pasienname']; ?></h4>
                                        <h4 class="card-title mt-2"><?= $pasien['pasienid']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>
                                        <?php if ($pasien['cancel'] == 0.00) { ?>
                                            <button id="print" class="btn btn-danger btn-outline btn btnbatalperiksa" type="button" onclick="BatalPeriksa('<?= $pasien['id'] ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batal Periksa ?</button>
                                        <?php } ?>
                                        <?php if ($pasien['cancel'] == 1.00) { ?>
                                            <button id="print" class="btn btn-info btn-outline btn btnupdatesep" type="button" onclick="restore('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> Restore ? </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['pasienssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['pasiendateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <?= form_open('KasirRJ/ValidasiUbahCabar', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="row pt-1">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <input type="hidden" id="pasienid" name="pasienid" class="form-control" readonly value="<?= $pasien['code']; ?>">
                                                <input type="hidden" id="oldcode" name="oldcode" class="form-control" readonly value="<?= $pasien['oldcode']; ?>">

                                                <?php
                                                helper('text');
                                                $token = random_string('alnum', 8);
                                                ?>
                                                <input type="hidden" id="token_rajal" name="token_rajal" value="<?= $token; ?>" class="form-control">

                                                <select name="paymentmethodname" id="paymentmethodname" class="form-control" style="width: 100%" required>

                                                    <?php foreach ($cabar as $carabayar) : ?>
                                                        <option data-id="<?= $carabayar['id']; ?>" class="select-cabar" <?php if ($carabayar['name'] == $pasien['paymentmethodname']) { ?> selected="selected" <?php } ?>><?php echo $carabayar['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if ($pasien['paymentmethod'] == "") {
                                                    $cabarasli = 'NONE';
                                                } else {
                                                    $cabarasli = $pasien['paymentmethod'];
                                                }
                                                ?>
                                                <input type="hidden" id="iddaftar" name="iddaftar" class="form-control" value="<?= $pasien['id']; ?>">
                                                <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $pasien['paymentmethodname']; ?>">
                                                <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $cabarasli; ?>">
                                                <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $cabarasli; ?>">
                                                <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control">
                                                <input type="hidden" id="groups" name="groups" class="form-control" value="IRJ">
                                                <input type="hidden" id="visited" name="visited" class="form-control" value="K1">
                                                <input type="hidden" id="paymentcahange" name="paymentcahange" class="form-control" value="1">
                                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                                                <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>">
                                                <input type="hidden" id="noantrian" name="noantrian" class="form-control">



                                                <input type="hidden" id="registerdate" name="registerdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasien['pasienarea']; ?>">
                                                <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasien['pasiensubarea']; ?>">
                                                <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasien['pasiensubareaname']; ?>">

                                                <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control">
                                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="PORTIR-RJ">
                                                <input type="hidden" id="locationname" name="locationname" class="form-control" value="PENDAFTARAN INSTALASI RAWAT JALAN (IRJ)">

                                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="pasiencard" name="pasiencard" placeholder="No.Kartu Asuransi" value="<?= $pasien['paymentcardnumber']; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="btn-cardrajal" type="button">Cek!</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="pasienssn" name="pasienssn" placeholder="No.NIK" value="<?= $pasien['pasienssn']; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="btn-nik" type="button">Cek!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="faskesname" name="faskesname" placeholder="Nama Faskes" value="<?= $pasien['faskesname']; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="btn-rujukan" type="button">CR</button>
                                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $pasien['faskes']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="noRujukan" name="noRujukan" placeholder="No.Rujukan" value="<?= $pasien['referencenumber']; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="btn-no-rujukan" type="button">CNR</button>
                                                    <input type="hidden" id="faskes1" name="faskes1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                        $datedari = $pasien['referencedate'];
                                        $DateAwal = date("d/m/Y", strtotime($datedari));

                                        ?>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="referencedate" class="form-control" value="<?= $DateAwal; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">DiagnosaMasuk</label>
                                                <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off" value="<?= $pasien['icdxname']; ?>">
                                                <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $pasien['icdx']; ?>">
                                                <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $pasien['icdxname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Pelayanan</label>
                                                    <select name="pelayanan" id="pelayanan" class="select2" style="width: 100%">
                                                        <option>Pilih Pelayanan</option>
                                                        <?php foreach ($pelayanan as $PL) : ?>

                                                            <option data-id="<?= $PL['id']; ?>" class="select-pelayanan" <?php if ($PL['name'] == $pasien['description']) { ?> selected="selected" <?php } ?>><?= $PL['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" id="code_pelayanan" name="code_pelayanan" class="form-control" readonly value="<?= $pasien['code']; ?>">
                                                    <input type="hidden" id="description" name="description" class="form-control" readonly value="<?= $pasien['description']; ?>">
                                                    <input type="hidden" id="price" name="price" class="form-control" readonly value="<?= $pasien['price']; ?>">
                                                    <input type="hidden" id="share1" name="share1" class="form-control" readonly value="<?= $pasien['share1']; ?>">
                                                    <input type="hidden" id="share2" name="share2" class="form-control" readonly value="<?= $pasien['share2']; ?>">
                                                    <input type="hidden" id="code_triase" name="code_triase" class="form-control" readonly value="NONE">
                                                    <input type="hidden" id="kelompok_triase" name="kelompok_triase" class="form-control" readonly value="NONE">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Sebab Masuk</label>
                                                <select name="reasoncode" id="reasoncode" class="select2" style="width: 100%" required>
                                                    <option value="">Pilih Sebab Masuk</option>
                                                    <?php foreach ($sebabsakit as $SK) : ?>
                                                        <option value="<?= $SK['name']; ?>" class="select-code" <?php if ($SK['name'] == $pasien['reasoncode']) { ?> selected="selected" <?php } ?>><?= $SK['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="poliklinikname" id="poliklinikname" class="select2" style="width: 100%" required>
                                                    <option value="">Pilih Poli</option>
                                                    <?php foreach ($namasmf as $NSMF) : ?>

                                                        <option data-id="<?= $NSMF['id']; ?>" class="select-smf" <?php if ($NSMF['name'] == $pasien['poliklinikname']) { ?> selected="selected" <?php } ?>><?= $NSMF['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" readonly value="<?= $pasien['poliklinik']; ?>">
                                                <input type="hidden" id="email" name="email" class="form-control" value="deniapriali@gmail.com">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                                    <option value>Pilih Dokter Pemeriksa</option>
                                                    <?php foreach ($list as $dpjp) { ?>
                                                        <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $pasien['doktername']) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $pasien['dokter']; ?>">
                                                <div class="form-control-feedback erroribsdoktername">
                                                </div>
                                                <input type="hidden" id="email2" value="pasien@gmail.com" name="email2" class="form-control">
                                                <div class="form-control-feedback errorEmail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" id="memo" name="memo" class="form-control" autocomplete="off" value="<?= $pasien['memo']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Nama Pasien</label>
                                                <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $pasien['pasienname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Tanggal lahir</label>
                                                <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasien['pasiendateofbirth']; ?>">
                                                <small class="form-control-feedback text-danger">* Format (0000-00-00)(Tahun-Bulan-Tanggal)</small>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Alamat</label>
                                                <input type="hidden" id="norm" name="norm" class="form-control" readonly value="<?= $pasien['pasienid']; ?>">
                                                <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasien['pasienaddress']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning btnsimpanperubahan"><i class="fa fa-check"></i> Ubah </button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                        <div class="modal-footer">

                        </div>
                    <?php endforeach; ?>
                    <!-- Column -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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



        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
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
            },
            minimumInputLength: 1,

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


    $('#btn-cardrajalpasienlama').on('click', function() {

        if ($('#pasiencardpasienlama').val() == '' || $('#documentdate').val == '') {
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
                    card: $('#pasiencardpasienlama').val(),
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
                        $('#form-sep').css('display', 'block');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                        $('#form-sep').css('display', 'none');
                    }
                }
            })
        }

    })


    $('#btn-nik').on('click', function() {

        if ($('#pasienssn').val() == '' || $('#documentdate').val == '') {

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
                    date: $('#documentdate').val()
                },
                success: function(response) {

                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            //type: 'success',
                            icon: 'success',
                            title: parseResponse.metaData.message,
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.hakKelas.keterangan + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
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

        if ($('#pasiencard').val() == '' || $('#documentdate').val == '') {
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
                    $('.btnsimpanperubahan').attr('disable', 'disabled');
                    $('.btnsimpanperubahan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanperubahan').removeAttr('disable');
                    $('.btnsimpanperubahan').html('Simpan');
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
                                //$('#modaleditranap').modal('hide');
                                //dataRegisterPoli();

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
    function BatalPeriksa(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan pendaftaran pasien ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('RawatJalan/BatalPeriksa'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    berangkat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function restore(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan pendaftaran pasien ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('RawatJalan/RestoreBatalPeriksa'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    berangkatrestore();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    function berangkat() {
        window.location.href = "<?php echo base_url('RawatJalan'); ?>";
    }
</script>

<script type="text/javascript">
    function berangkatrestore() {
        window.location.href = "<?php echo base_url('RawatJalan/Batal'); ?>";
    }
</script>