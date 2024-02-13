<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    ;
</style>

<div id="modaldaftaribsrajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pendaftaran Pelayanan Bedah Sentral Dari Pasien Rawat Jalan</h4>
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
                                        <h6 class="card-subtitle"><?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>

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
                                <?= form_open('rawatinap/simpandataIBSRajal', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">

                                    <div class="row pt-1">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Norm</label>
                                                <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="IBS_200724-000001" readonly>
                                                <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>

                                                <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                                <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                <input type="hidden" id="validation" name="validation" class="form-control" value="BELUM" readonly>
                                                <?php
                                                helper('text');
                                                $token = random_string('alnum', 8);
                                                ?>
                                                <input type="hidden" id="token_ibs" name="token_ibs" class="form-control" value="<?= $token; ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nama Pasien</label>
                                                <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Lahir</label>
                                                <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Alamat</label>
                                                <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                                <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                                <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Penanggung Jawab</label>
                                                <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Alamat / Kontak Penanggung Jawab</label>
                                                <input type="text" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Pelayanan</label>
                                                <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $documentdate; ?>" readonly>
                                                <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Poliklinik</label>
                                                <input type="text" id="roomname" name="roomname" class="form-control" value="<?= $roomfisikname; ?>" readonly>
                                                <input type="hidden" id="room" name="room" class="form-control" value="<?= $roomfisik; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">KLS</label>
                                                    <select name="classroom" id="classroom" class="select2" style="width: 100%">
                                                        <?php foreach ($KR as $kelas) : ?>
                                                            <option data-id="<?= $kelas['id']; ?>" class="select-classroom" <?php if ($kelas['code'] == $classroom) { ?> selected="selected" <?php } ?>><?php echo $kelas['code']; ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>">


                                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="IBS" readonly>
                                                <input type="hidden" id="locationname" name="locationname" class="form-control" value="OK IBS" readonly>
                                                <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="NONE" readonly>
                                                <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM" readonly>
                                                <input type="hidden" id="parentname" name="parentname" class="form-control" value="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Cara Bayar</label>
                                                <input type="text" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">No. Asuransi/Jaminan</label>
                                                <input type="text" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">SMF</label>
                                                <input type="text" id="smfname" name="smfname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                                <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Dokter Penanggung Jawab</label>
                                                <input type="text" id="doktername" name="doktername" class="form-control" value="<?= $doktername; ?>" readonly>
                                                <input type="hidden" id="dokter" name="dokter" class="form-control" value="<?= $dokter; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Dokter Operator</label>
                                                <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                                    <option></option>
                                                    <?php foreach ($list as $dokter) { ?>
                                                        <option data-id="<?= $dokter['id']; ?>" class="select-dokter"><?= $dokter['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="ibsdokter" id="ibsdokter">
                                                <div class="form-control-feedback erroribsdoktername">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Dokter Anestesi</label>
                                                <select name="ibsanestesiname" id="ibsanestesiname" class="select2" style="width: 100%">
                                                    <option></option>
                                                    <?php foreach ($listdokteranestesi as $dokteranestesi) { ?>
                                                        <option data-id="<?= $dokteranestesi['id']; ?>" class="select-dokter"><?= $dokteranestesi['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="form-control-feedback erroribsanestesiname">

                                                </div>
                                            </div>
                                            <input type="hidden" name="ibsanestesi" id="ibsanestesi">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Perawat Bedah</label>
                                                <select name="ibsnursename" id="ibsnursename" class="select2" style="width: 100%">

                                                    <?php
                                                    foreach ($perawatpenataibs as $asistenoperator) {
                                                        echo "<option value='$asistenoperator->name'";
                                                        echo ">$asistenoperator->name</option>";
                                                    }
                                                    ?>

                                                </select>
                                                <input type="hidden" name="ibsnurse" id="ibsnurse" value="IBS_00001">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Penata Anestesi</label>
                                                <select name="ibspenataname" id="ibspenataname" class="select2" style="width: 100%">

                                                    <?php
                                                    foreach ($perawatpenataibs2 as $asistenpenata) {
                                                        echo "<option value='$asistenpenata->name'";
                                                        echo ">$asistenpenata->name</option>";
                                                    }
                                                    ?>

                                                </select>
                                                <input type="hidden" name="ibspenata" id="ibspenata" value="IBS_00002">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Diagnosa</label>
                                                <input type="text" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                                <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kamar Operasi</label>
                                                <select class="select2" name="operatorroom" id="operatorroom" style="width: 100%">
                                                    <option>--Pilih Kamar Operasi--</option>
                                                    <?php
                                                    foreach ($kamarok as $k) {
                                                        echo "<option value='$k->room'";
                                                        echo ">$k->room</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kategori Operasi</label>
                                                <select class="select2" name="cases" id="cases" style="width: 100%">
                                                    <option value="ELEKTIF">ELEKTIF</option>
                                                    <option value="CYTO">CYTO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Teknik Anestesi</label>
                                                <select class="select2" name="anestesi" id="anestesi" style="width: 100%">

                                                    <?php
                                                    foreach ($teknikanestesi as $anestesi) {
                                                        echo "<option value='$anestesi->deskripsi'";
                                                        echo ">$anestesi->deskripsi</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label class="control-label">Types</label>
                                                <select class="select2" name="types" id="types" style="width: 100%;" required>
                                                    <option value="">Pilih Type Operasi</option>
                                                    <option value="IBS">IBS</option>
                                                    <option value="CAT">CAT</option>
                                                    <option value="VK">VK</option>
                                                    <option value="ODS">ODS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label class="control-label">Kelompok</label>
                                                <select class="select2" name="groups" id="groups" style="width: 100%;">
                                                    <option></option>
                                                    <?php
                                                    foreach ($groups_ibs as $g) {
                                                        echo "<option value='$g->groups'";
                                                        echo ">$g->deskripsi</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label class="control-label">Tanggal AO</label>
                                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="tglspr" class="form-control" value="<?= date('d/m/Y'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label class="control-label">E-mail</label>
                                                <input type="text" id="email" name="email" class="form-control" value="simrs@gmail.com">
                                            </div>
                                            <div class="form-control-feedback errorEmail">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Memo</label>
                                                <input type="text" id="memo" name="memo" class="form-control" value="-">
                                                <input type="hidden" id="asal_pasien" name="asal_pasien" class="form-control" value="IRJ" readonly>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Daftarkan</button>
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                                    </div>
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

        $('#classroom').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_kelas') ?>",
                'data': {
                    key: $('#classroom option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#classroomname').val(data.name);
                    $('#classroom').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#ibsanestesiname').on('change', function() {
            $.ajax({
                'type': "POST",
                //'url': "http://localhost/simrs/public/index.php/autocomplete/fill_dokter",
                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#ibsanestesiname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#ibsanestesiname').val(data.name);
                    $('#ibsanestesi').val(data.code);

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


<script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("token_ibs").value;
        window.location.href = "<?php echo base_url('rawatinap/inputdetailibs'); ?>?page=" + page;
    }
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

                        if (response.error.ibsanestesiname) {
                            $('#ibsanestesiname').addClass('form-control-danger');
                            $('.erroribsanestesiname').html(response.error.ibsanestesiname);
                        } else {
                            $('#ibsanestesiname').removeClass('form-control-danger');
                            $('.errorKelompok').html('');
                        }

                        if (response.error.email) {
                            $('#email').addClass('form-control-danger');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('form-control-danger');
                            $('.errorEmail').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaldaftaribs').modal('hide');
                                berangkat();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>