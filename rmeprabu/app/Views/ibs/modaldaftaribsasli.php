<link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet">
<!-- You can change the theme colors from here -->
<link href="../css/colors/default-dark.css" id="theme" rel="stylesheet">
<link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modaldaftaribs" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Form Pendafaran Pelayanan Bedah Sentral</h4>
            </div>

            <?= form_open('rawatinap/simpandata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">

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
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
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
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Wilayah</label>
                                    <input type="text" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kabupaten / Kota</label>
                                    <input type="text" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Penanggung Jawab</label>
                                    <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alamat / Kontak Penanggung Jawab</label>
                                    <input type="text" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>|<?= $telppjb; ?>" readonly>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Masuk Rawat Inap</label>
                                    <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>" readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Journal Number Rawat Inap</label>
                                    <input type="text" id="registernumber" name="registernumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Reference Number Rawat Inap</label>
                                    <input type="text" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Ruang Perawatan</label>
                                    <input type="text" id="roomname" name="roomname" class="form-control" value="<?= $roomfisikname; ?>" readonly>
                                    <input type="hidden" id="room" name="room" class="form-control" value="<?= $roomfisik; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">KLS</label>
                                    <input type="text" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>" readonly>
                                    <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="IBS" readonly>
                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="OK IBS" readonly>
                                    <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="NONE" readonly>
                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM" readonly>
                                    <input type="hidden" id="parentname" name="parentname" class="form-control" value="" readonly>

                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <!--/row-->


                        <div class="row pt-1">
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
                                    <input type="text" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>
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
                            <!--/span-->
                        </div>

                        <!--/row-->

                        <!--/row-->
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dokter Operator</label>
                                    <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                        <option></option>
                                        <?php
                                        foreach ($dokterspesialis as $key) {
                                            echo "<option value='$key->name'";
                                            echo ">$key->name</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="ibsdokter" id="ibsdokter" value="D_00002">
                                    <div class="form-control-feedback erroribsdoktername">

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dokter Anestesi</label>
                                    <select name="ibsanestesiname" id="ibsanestesiname" class="select2" style="width: 100%">
                                        <option></option>
                                        <?php
                                        foreach ($dokteranestesi as $da) {
                                            echo "<option value='$da->name'";
                                            echo ">$da->name</option>";
                                        }
                                        ?>

                                    </select>
                                    <div class="form-control-feedback erroribsanestesiname">

                                    </div>
                                </div>
                                <input type="hidden" name="ibsanestesi" id="ibsanestesi" value="D_00041">
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
                            <!--/span-->


                        </div>

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa</label>
                                    <input type="text" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>" readonly>
                                </div>
                            </div>
                            <!--/span-->

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


                            <!--/span-->
                        </div>

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label class="control-label">Types</label>
                                    <select class="form-control custom-select" name="types" id="types">
                                        <option>--Pilih Type Operasi--</option>
                                        <option value="IBS">IBS</option>
                                        <option value="CAT">CAT</option>
                                        <option value="VK">VK</option>
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
                            <div class="col-md-1">
                                <div class="form-group">

                                    <label class="control-label">Tanggal SPR</label>
                                    <input type="text" id="datepicker-autoclose" autocomplete="off" name="tglspr" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">

                                    <label class="control-label">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                                <div class="form-control-feedback errorEmail">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Memo</label>
                                    <input type="text" id="memo" name="memo" class="form-control">
                                </div>

                            </div>
                        </div>

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Daftarkan</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
                                window.location.href = ("<?php echo base_url('icd/index') ?>");
                            }
                        });



                        //dataperawat();

                    }
                }


            });
            return false;
        });
    });
</script>

<script src="../assets/plugins/switchery/dist/switchery.min.js"></script>
<script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="../assets/plugins/dff/dff.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
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