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
        content: '§';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<div id="modalbatalRanap" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pendaftaran Rawat Inap</h4>
                <div class="col-md-6">
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-outline btn piutang"><i class="fas fa-search"></i> PIUTANG</button>
                            <button class="btn btn-info btn-outline cekspri" type="button" onclick="cariSPRI('<?= $pasien['noSPRI'] ?>')"> <i class="fas fa-search"></i> SPRI</button>
                            <button class="btn btn-success btn-outline cekspri" type="button" onclick="cariSEP('<?= $pasien['id'] ?>')"> <i class="fas fa-search"></i> SEP IGD/RAJAL</button>
                            <button type="button" class="btn btn-success btn-outline " onclick="histori('<?= $pasien['pasienid'] ?>','<?= $pasien['pasienid'] ?>')"> <i class="fas fa-hospital"></i> HISTORI PELAYANAN</button>
                        </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->

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
                                    <span class="badge badge-info">No SPRI : <?= $pasien['noSPRI']; ?></span>

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
                            <?= form_open('PendaftaranRanap/simpandata', ['class' => 'formperawat']); ?>
                            <?= csrf_field(); ?>
                            <div class="modal-body">

                                <from class="form-horizontal form-material" id="form-filter" method="post">
                                    <div class="form-body">

                                        <div class="row pt-1">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Norm</label>
                                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>">
                                                    <input type="hidden" id="nomorSuratPerintahRawat" name="nomorSuratPerintahRawat" class="form-control" value="<?= $pasien['noSPRI']; ?>">

                                                    <?php
                                                    helper('text');
                                                    $token = random_string('alnum', 8);
                                                    ?>
                                                    <input type="hidden" id="token_ranap" name="token_ranap" class="form-control" value="<?= $token; ?>">
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
                                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Cara Bayar</label>
                                                    <select name="paymentmethodname" id="paymentmethodname" class="select2" style="width: 100%;">
                                                        <?php foreach ($cabar as $cb) : ?>
                                                            <option value="<?php echo $cb['name']; ?>" <?php if ($cb['name'] == $paymentmethodname) { ?> selected="selected" <?php } ?>><?php echo $cb['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row pt-1">


                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">No Asuransi</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="paymentcardnumber" name="paymentcardnumber" value="<?= $paymentcardnumber; ?>">
                                                        <input type="hidden" class="form-control" id="registerdate" name="registerdate" value="<?= date('Y-m-d'); ?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info btncardbpjs" id="btn-card" type="button">Cek!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Dokter Asal Pelayanan</label>
                                                    <input type="text" id="doktername" name="doktername" class="form-control" value="<?= $doktername; ?>" readonly>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row pt-1">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Diagnosa</label>
                                                    <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                                    <input type="text" id="diagnosa" name="diagnosa" class="form-control" autocomplete="off" value="<?= $icdxname; ?>">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row pt-1">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Titipan</label>
                                                    <select class="select2" name="titipan" id="titipan" style="width: 100%">
                                                        <option value="TIDAK">TIDAK</option>
                                                        <option value="YA">YA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal SPR</label>
                                                    <input type="text" id="datepicker-autoclose" autocomplete="off" name="tglspr" class="form-control" value="<?= date('d/m/Y'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="text" id="email" name="email" class="form-control" value="deniapriali@gmail.com">
                                                </div>
                                                <div class="form-control-feedback errorEmail">

                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Memo</label>
                                                    <input type="text" id="memo" name="memo" class="form-control" value="-">

                                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" readonly>
                                                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                    <input type="hidden" id="validation" name="validation" class="form-control" readonly>
                                                    <input type="hidden" id="cash" name="cash" class="form-control" value="0.00" readonly>
                                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="PORTIR-RI" readonly>
                                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="SENTRAL OPNAME" readonly>
                                                    <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $paymentmethodnameori; ?>" readonly>
                                                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                                    <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $paymentmethodori; ?>" readonly>
                                                    <input type="hidden" id="paymentmethod_payment" name="paymentmethod_payment" class="form-control" value="<?= $paymentmethod_payment; ?>" readonly>
                                                    <input type="hidden" id="paymentmethodname_payment" name="paymentmethodname_payment" class="form-control" value="<?= $paymentmethodname_payment; ?>" readonly>
                                                    <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>" readonly>
                                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="REGISTRASI" readonly>
                                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                                    <input type="hidden" id="dokter" name="dokter" class="form-control" value="<?= $dokter; ?>" readonly>
                                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>" readonly>
                                                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>" readonly>
                                                    <input type="hidden" id="types" name="types" class="form-control" value="BARU" readonly>
                                                    <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="NONE" readonly>
                                                    <input type="hidden" id="transferjournalnumber" name="transferjournalnumber" class="form-control" value="NONE" readonly>
                                                    <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" readonly>
                                                    <input type="hidden" id="noantrian" name="noantrian" class="form-control" readonly>
                                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>" readonly>
                                                    <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>" readonly>
                                                    <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokter; ?>" readonly>
                                                    <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $doktername; ?>" readonly>
                                                    <input type="hidden" id="datein" name="datein" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                    <input type="hidden" id="timein" name="timein" class="form-control" value="<?= date('H:i:s'); ?>" readonly>

                                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM" readonly>
                                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" readonly>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </from>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Batalkan</button>
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Column -->
                </div>


            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalpiutang" style="display:none;"></div>


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

                    } else if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.pesan,
                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaldaftarRanapNew').modal('hide');

                                dataperawat();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.js"></script>
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


<!-- <script type="text/javascript" src="<?= base_url(); ?>/js/jquery.js"></script> -->
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


        $('#ibsanestesiname').on('change', function() {
            $.ajax({
                'type': "POST",

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

        $('#smfname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_smf') ?>",
                'data': {
                    key: $('#smfname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#smfname').val(data.name);
                    $('#smf').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#classroom').on('change', function() {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('PendaftaranRanap/ajax_kelas') ?>",
                data: {
                    kelas: $(this).val()
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    // mengosongkan option pada select ke 2
                    $('#roomname').empty();

                    if (data[0] == null) {

                        $('#roomname').append("<option>Pilihan kosong</option>");
                        $('#roomname').attr('disabled', 'disabled');
                    } else {
                        data.forEach(appendRoomName);
                        $('#roomname').append("<option>Pilihan kamar</option>");

                        function appendRoomName(item) {

                            $('#roomname').append("<option value='" + item.roomname + "' data-room='" + item.room + "'>" + item.roomname + "</option>");
                        }
                        // menghilangkan atribut disable
                        $('#roomname').removeAttr('disabled');
                    }

                    // isi value input hidden
                    //data-id="<?= $kelas['id']; ?>"
                    $('#classroomname').val($('#classroom option:selected').data('name'));
                    $('#classroomname').attr('type', 'hidden');

                    // disable dan emptyselect ke 3
                    $('#bednumber').empty();
                    $('#bednumber').attr('disabled', 'disabled');
                    // hidden input dibawah select 2
                    $('#room').attr('type', 'hidden');
                }
            })
        });



        $('#roomname').on('change', function() {
            // url disesuaikan
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('PendaftaranRanap/ajax_roomname') ?>",
                data: {
                    room: $(this).val(),
                    kelas: $('#classroom').val()
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    $('#bednumber').empty();

                    if (data[0] == null) {
                        $('#bednumber').append("<option>Pilihan kosong</option>");
                        $('#bednumber').attr('disabled', 'disabled');
                    } else {
                        data.forEach(appendRoomName);

                        function appendRoomName(item) {
                            $('#bednumber').append("<option value='" + item.code + "'>" + item.code + "</option>");
                        }

                        $('#bednumber').removeAttr('disabled');
                    }

                    // isi value input hidden
                    $('#room').val($('#roomname option:selected').data('room'));
                    $('#room').attr('type', 'hidden');

                }
            })
        })

        $('.btncardbpjs').on('click', function() {

            if ($('#paymentcardnumber').val() == '' || $('#registerdate').val == '') {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'No Asuransi Tidak Boleh Kosong'

                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Bpjs/check_card') ?>",
                    data: {
                        card: $('#paymentcardnumber').val(),
                        date: $('#documentdate').val()
                    },
                    success: function(response) {
                        let parseResponse = JSON.parse(response);
                        if (parseResponse.metaData.code == 200) {

                            Swal.fire({
                                html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                    '<br>Hak Kelas: ' + parseResponse.response.peserta.hakKelas.kode + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                    '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT + '<br>NIK: ' + parseResponse.response.peserta.nik,

                                icon: 'success',
                                text: parseResponse.metaData.message,
                            });
                            //$('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                            //$('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                            $('#hakkelaspasien').val(parseResponse.response.peserta.hakKelas.kode);
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

    });
</script>

<script>
    $('.piutang').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('Pendaftaranranap/historipiutang') ?>",
            data: {
                pasienid: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalpiutang').html(response.suksespiutang).show();
                $('#modalhistoripiutang').modal('show');

            }
        });

    });
</script>


<script>
    function cariSPRI(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CariSPRI'); ?>",
            data: {
                id: id,
                nomorSuratPerintahRawat: $('#nomorSuratPerintahRawat').val()
            },
            dataType: "json",
            success: function(response) {
                //let parseResponse = JSON.parse(response);
                if (response.metaData.code == 200) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan + '<br>No.SPRI: ' + response.response.noSuratKontrol + '<br>Tanggal Rencana Rawat: ' + response.response.tglRencanaKontrol +
                            '<br>Dokter: ' + response.response.namaDokter + '<br>Tanggal terbit SPRI: ' + response.response.tglTerbit +
                            '<br>No Sep: ' + response.response.sep.noSep,
                        icon: 'success',
                        //text: response.metaData.message
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.metaData.message

                    });
                }
            }

        });
    }
</script>


<script>
    function cariSEP(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CariSep'); ?>",
            data: {
                id: id,
                nomorSep: $('#bpjs_sep_poli').val()
            },
            dataType: "json",
            success: function(response) {

                if (response.metaData.code == 200) {

                    Swal.fire({
                        html: 'Nama: ' + response.response.peserta.nama + '<br>No.Kartu: ' + response.response.peserta.noKartu + '<br>No.Sep: ' + response.response.noSep +
                            '<br>Tanggal Sep: ' + response.response.tglSep + '<br>Jenis Pelayanan: ' + response.response.jnsPelayanan + '<br>Diagnosa: ' + response.response.diagnosa +
                            '<br>No.Rujukan: ' + response.response.noRujukan + '<br>Poli: ' + response.response.poli,
                        icon: 'success',
                        text: response.metaData.message
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        //title: 'Error',
                        text: response.metaData.message

                    });
                }
            }

        });
    }
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

    function histori(id, code) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PendaftaranRanap/HistoriPasienLama'); ?>",
            data: {
                id: id,
                pasienid: code
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseshistori) {
                    $('.viewmodalpiutang').html(response.sukseshistori).show();
                    $('#modalhistoripasienlama').modal();
                }
            }
        });
    }
</script>