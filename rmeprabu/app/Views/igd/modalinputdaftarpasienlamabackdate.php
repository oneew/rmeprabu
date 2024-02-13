<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }
</style>

<div id="modalinputdaftarpasienlamabackdate" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-danger">
                    <h4 class="modal-title" id="fullWidthModalLabel">Pendaftaran Instalasi Gawat Darurat (BackDate)</h4>
                </span>
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
                                    $tanggallahir = $pasien['dateofbirth'];
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
                                    if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['name']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['code']; ?></h6>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['address']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['ssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['cardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['dateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <?= form_open('IGD/simpandataregisterBackDate', ['class' => 'formpasienlama']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <from class="form-horizontal form-material" id="form-filter" method="post">
                                        <div class="form-body">
                                            <div class="row pt-1">

                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <select name="paymentmethodname" id="paymentmethodname" class="form-control" style="width: 100%" required>
                                                            <option value="">Pilih Pembayaran</option>
                                                            <?php foreach ($cabar as $carabayar) : ?>
                                                                <option data-id="<?= $carabayar['id']; ?>" class="select-cabar" <?php if ($carabayar['name'] == $pasien['paymentmethodname']) { ?> selected="selected" <?php } ?>><?php echo $carabayar['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php
                                                        helper('text');
                                                        $token = random_string('alnum', 8);
                                                        ?>
                                                        <input type="hidden" id="token_rajal" name="token_rajal" value="<?= $token; ?>" class="form-control">
                                                        <input type="hidden" id="pasienid" name="pasienid" class="form-control" readonly value="<?= $pasien['code']; ?>">
                                                        <input type="hidden" id="oldcode" name="oldcode" class="form-control" readonly value="<?= $pasien['code']; ?>">
                                                        <input type="hidden" id="pasienname" name="pasienname" class="form-control" readonly value="<?= $pasien['name']; ?>">
                                                        <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" readonly value="<?= $pasien['dateofbirth']; ?>">
                                                        <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" readonly value="<?= $pasien['address']; ?>">
                                                        <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $pasien['paymentmethodname']; ?>">
                                                        <?php if ($pasien['paymentmethod'] == "") {
                                                            $cabarasli = 'NONE';
                                                        } else {
                                                            $cabarasli = $pasien['paymentmethod'];
                                                        }
                                                        ?>
                                                        <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $cabarasli; ?>">
                                                        <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $cabarasli; ?>">
                                                        <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control" value="<?= $pasien['cardnumber']; ?>">
                                                        <input type="hidden" id="groups" name="groups" class="form-control" value="IGD">
                                                        <input type="hidden" id="visited" name="visited" class="form-control" value="K1">

                                                        <input type="hidden" id="noantrian" name="noantrian" class="form-control">
                                                        <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasien['gender']; ?>">
                                                        <input type="hidden" id="pasienmaritalstatus" name="pasienmaritalstatus" class="form-control" value="<?= $pasien['maritalstatus']; ?>">
                                                        <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $umur; ?>">

                                                        <input type="hidden" id="registerdate" name="registerdate" class="form-control" value="<?= $pasien['registerdate']; ?>">
                                                        <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasien['area']; ?>">
                                                        <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasien['subarea']; ?>">
                                                        <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasien['subareaname']; ?>">
                                                        <input type="hidden" id="pasienparentname" name="pasienparentname" class="form-control" value="<?= $pasien['parentname']; ?>">
                                                        <input type="hidden" id="pasientelephone" name="pasientelephone" class="form-control" value="<?= $pasien['telephone']; ?>">
                                                        <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control">
                                                        <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="PORTIR-IGD">
                                                        <input type="hidden" id="locationname" name="locationname" class="form-control" value="PENDAFTARAN INSTALASI GAWAT DARURAT (IGD)">
                                                        <input type="hidden" id="cretedip" name="cretedip" value="<?= $ip; ?>" class="form-control">
                                                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                                        <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="pasiencard" name="pasiencard" placeholder="No.Kartu Asuransi" value="<?= $pasien['cardnumber']; ?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" id="btn-cardbpjs" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="pasienssn" name="pasienssn" placeholder="No.NIK" value="<?= $pasien['ssn']; ?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" id="btn-nik" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-1">
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="faskesname" name="faskesname" placeholder="Nama Faskes">
                                                        <input type="hidden" id="faskes" name="faskes" class="form-control" value="NONE">

                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="noRujukan" name="noRujukan" placeholder="No.Rujukan">
                                                        <input type="hidden" id="faskes1" name="faskes1" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <input type="text" id="datepicker-autoclose" autocomplete="off" name="referencedate" class="form-control" value="<?= date('d/m/Y'); ?>">
                                                        <small class="form-control-feedback text-danger"> Tanggal rujukan. </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Diagnosa Masuk</label>
                                                        <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off" value="NONE">
                                                        <input type="hidden" id="icdx" name="icdx" class="form-control" value="NONE">
                                                        <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="NONE">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis Pelayanan</label>
                                                            <select name="pelayanan" id="pelayanan" class="select2" style="width: 100%">
                                                                <option>Pilih Pelayanan</option>
                                                                <?php foreach ($pelayanan as $PL) : ?>
                                                                    <option data-id="<?= $PL['id']; ?>" class="select-pelayanan"><?= $PL['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>


                                                            <input type="hidden" id="price" name="price" class="form-control" readonly>
                                                            <input type="hidden" id="share1" name="share1" class="form-control" readonly>
                                                            <input type="hidden" id="share2" name="share2" class="form-control" readonly>
                                                            <div class="form-control-feedback pelayanan">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Kode Pelayanan</label>
                                                        <input type="hidden" id="description" name="description" class="form-control" required readonly>
                                                        <input type="text" id="code_pelayanan" name="code_pelayanan" class="form-control required" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Sebab Masuk</label>
                                                        <select name="reasoncode" id="reasoncode" class="select2" style="width: 100%" required>
                                                            <option value="">Pilih Sebab Masuk</option>
                                                            <?php foreach ($sebabsakit as $SK) : ?>
                                                                <option value="<?= $SK['name']; ?>" class="select-code"><?= $SK['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Kelompok Pelayanan</label>
                                                        <input type="text" id="poliklinikname" name="poliklinikname" class="form-control" value="INSTALASI GAWAT DARURAT" readonly>
                                                        <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="IGD" readonly>
                                                        <input type="hidden" id="bpjscode" name="bpjscode" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Dokter Pemeriksa</label>
                                                        <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%" required>
                                                            <option value="">Pilih Dokter Pemeriksa</option>
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
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Kelompok Triase</label>
                                                        <select name="kelompok_triase" id="kelompok_triase" class="select2" style="width: 100%">
                                                            <option value="NONE">NONE</option>
                                                            <?php foreach ($triase as $triase) { ?>
                                                                <option data-id="<?= $triase['id']; ?>" class="select-dokter"><?= $triase['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" name="code_triase" id="code_triase">
                                                        <input type="hidden" name="triase" id="triase">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Memo</label>
                                                        <input type="text" id="memo" name="memo" class="form-control" value="-">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="email" id="email" name="email" class="form-control" value="deniapriali@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><span class="badge badge-danger"> Tanggal BackDate</span></label>
                                                        <input type="text" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                        <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                                                        <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>">
                                                        <input type="hidden" id="backdate" name="backdate" class="form-control" value="1">
                                                        <small class="form-control-feedback text-danger"> Format (Tahun-Bulan-Tanggal) </small>
                                                    </div>
                                                </div>
                                            </div>
                                    </from>
                                </div>
                                <div class="modal-footer">
                                    <div id="form-filter-simpan" style="display: block">
                                        <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Daftar</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                                <div id="form-filter-bawah" style="display: none">
                                    <div class="text-right">
                                        <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                        <button id="print" class="btn btn-info btn-outline btn btninputsep" type="button"> <span><i class="fas fa-calendar-check"></i></span> INSERT SEP </button>
                                        <button id="print" class="btn btn-warning btn-outline btn btncetaksep" type="button"> <span><i class="fas fa-calendar-check"></i></span> CETAK SEP </button>
                                        <button id="print" class="btn btn-success btn-outline  btnprintkarcis" type="button"> <span><i class="fa fa-print"></i></span></button>
                                    </div>
                                </div>



                            </div>
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

<div class="viewmodaldeniap" style="display:none;"></div>
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

        $('#kelompok_triase').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_triase') ?>",
                'data': {
                    key: $('#kelompok_triase option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#kelompok_triase').val(data.name);
                    $('#code_triase').val(data.code);
                    $('#triase').val(data.name);

                    $('#autocomplete-dokter').html('');
                }
            })
        })






    });


    $('#btn-cardbpjs').on('click', function() {

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
        $('.formpasienlama').submit(function(e) {
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

                        if (response.error.description) {
                            $('#description').addClass('form-control-danger');
                            $('.errordescription').html(response.error.description);
                        } else {
                            $('#description').removeClass('form-control-danger');
                            $('.errordescription').html('');
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
                                $('#form-filter-bawah').css('display', 'block');
                                $('#form-filter-simpan').css('display', 'none');
                                $('#journalnumberhasil').val(response.JN);
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


<script>
    $('.btninputsep').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CreateSepDirect'); ?>",
            data: {
                id: $('#journalnumberhasil').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodaldeniap').html(response.suksesmodalsep).show();
                    $('#modalcreatesepugd').modal();


                }
            }

        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btncetaksep').on('click', function() {
            let id = $('#journalnumberhasil').val()
            window.open("<?php echo base_url('IGD/printsep') ?>?page=" + id, target = "_blank");
        })
    });
</script>