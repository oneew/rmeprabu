<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<!-- You can change the theme colors from here -->

<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modalpindahkamar" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pindah Kamar Pasien Rawat Inap => Token Bill Rawat Inap (<?= $token_ranap; ?>)</h4>
            </div>
            <?= form_open('PelayananRanap/SimpanPindahKamar', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Masuk Ruangan Asal</label>
                                    <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>" readonly>
                                    <?php
                                    helper('text');
                                    $token = random_string('alnum', 8);
                                    ?>
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>" readonly>
                                    <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>" readonly>

                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" readonly>
                                    <input type="hidden" id="token_ranap" name="token_ranap" class="form-control" value="<?= $token_ranap; ?>">
                                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                    <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                    <input type="hidden" id="hubunganpjb" name="hubunganpjb" class="form-control" value="<?= $hubunganpjb; ?>" readonly>
                                    <input type="hidden" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>">
                                    <input type="hidden" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>">
                                    <input type="hidden" id="telppjb" name="telppjb" class="form-control" value="<?= $telppjb; ?>">
                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelas Perawatan Asal</label>
                                    <input type="hidden" id="classroomasal" name="classroomasal" class="form-control" value="<?= $classroom; ?>" readonly>
                                    <input type="text" id="classroomnameasal" name="classroomnameasal" class="form-control" value="<?= $classroomname; ?>" readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruang Perawatan Asal</label>
                                    <input type="text" id="roomnameasal" name="roomnameasal" class="form-control" value="<?= $roomname; ?>" readonly>
                                    <input type="hidden" id="roomasal" name="roomasal" class="form-control" value="<?= $room; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nomor Bed Asal</label>
                                    <input type="text" id="bednumberasal" name="bednumberasal" class="form-control" value="<?= $bednumber; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Pindah</label>
                                    <input type="date" id="dateout" name="dateout" value="<?= date('Y-m-d'); ?>" class="form-control" required>

                                    <div class="form-control-feedback errordateout">
                                    </div>
                                    <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $dokter; ?>">
                                    <input type="hidden" name="ibsdoktername" id="ibsdoktername" value="<?= $doktername; ?>">
                                    <input type="hidden" id="smfnameasal" name="smfnameasal" class="form-control" value="<?= $smfname; ?>" readonly>
                                    <input type="hidden" id="smfasal" name="smfasal" class="form-control" value="<?= $smf; ?>" readonly>
                                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>">
                                    <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control" value="<?= $paymentcardnumberori; ?>">
                                    <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $paymentmethodori; ?>">
                                    <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $paymentmethodnameori; ?>">
                                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                    <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>">
                                    <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>">
                                    <?php
                                    $datedari = $tglspr;
                                    $DateAwal = date("m/d/Y", strtotime($datedari));
                                    ?>
                                    <input type="hidden" id="datepicker-autoclose" value="<?= $DateAwal; ?>" autocomplete="off" name="tglspr" class="form-control">
                                    <input type="hidden" id="email" name="email" class="form-control" value="<?= $email; ?>">
                                    <input type="hidden" id="memo" name="memo" class="form-control" value="<?= $memo; ?>">
                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                    <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="" readonly>
                                    <input type="hidden" id="datein" name="datein" class="form-control" value="<?= $datein; ?>" readonly>
                                    <input type="hidden" id="timein" name="timein" class="form-control" value="<?= $timein; ?>" readonly>
                                    <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>" readonly>
                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" value="RAWAT" readonly>
                                    <input type="hidden" id="validationdate" name="validationdate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                    <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="<?= $parentjournalnumber; ?>" readonly>
                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                    <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>" readonly>
                                    <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep_poli; ?>" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                    <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                    <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>" readonly>
                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>" readonly>
                                    <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokterpoli; ?>" readonly>
                                    <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $dokterpoliname; ?>" readonly>
                                    <input type="hidden" id="lakalantas" name="lakalantas" class="form-control" value="<?= $lakalantas; ?>" readonly>
                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                    <input type="hidden" id="pasienclassroom" name="pasienclassroom" class="form-control" value="<?= $pasienclassroom; ?>" readonly>
                                    <input type="hidden" id="bumil" name="bumil" class="form-control" value="<?= $bumil; ?>" readonly>

                                    <input type="hidden" id="bednameasal" name="bednameasal" class="form-control" value="<?= $bedname; ?>" readonly>
                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="<?= $parentid; ?>" readonly>
                                    <input type="hidden" id="parentname" name="parentname" class="form-control" value="<?= $parentname; ?>" readonly>
                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $room; ?>" readonly>
                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="<?= $roomname; ?>" readonly>

                                    <input type="hidden" id="pasienclassroomchange" name="pasienclassroomchange" class="form-control" value="<?= $pasienclassroomchange; ?>" readonly>
                                    <input type="hidden" id="pasienclassroomchangenumber" name="pasienclassroomchangenumber" class="form-control" value="<?= $pasienclassroomchangenumber; ?>" readonly>
                                    <input type="hidden" id="paymentchange" name="paymentchange" class="form-control" value="<?= $paymentchange; ?>" readonly>
                                    <input type="hidden" id="paymentchangenumber" name="paymentchangenumber" class="form-control" value="<?= $paymentchangenumber; ?>" readonly>
                                    <input type="hidden" id="vsstability" name="vsstability" class="form-control" value="STABIL" readonly>
                                    <input type="hidden" id="vsdifiksasi" name="vsdifiksasi" class="form-control" value="BELUM" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Jam Pindah</label>
                                    <input type="text" id="timeout" name="timeout" value="<?= date('H:i:s'); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelas Perawatan Tujuan</label>
                                    <select name="classroom" id="classroom" class="select2" style="width: 100%" required>
                                        <option>Pilih Kelas Tujuan</option>
                                        <?php foreach ($KR as $kelas) : ?>
                                            <option data-id="<?= $kelas['id']; ?>" data-name="<?= $kelas['name']; ?>" class="select-classroom"><?= $kelas['code']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruang Perawatan Tujuan</label>
                                    <select name="roomname" id="roomname" class="select2" style="width: 100%" disabled required>
                                        <option>Pilih Ruangan</option>
                                    </select>
                                    <input type="hidden" id="room" name="room" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nomor Bed Tujuan</label>
                                    <select name="bednumber" id="bednumber" class="select2" style="width: 100%" disabled required>
                                        <option>Pilih Bed</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alasan Pindah</label>
                                    <input type="text" id="transferreason" name="transferreason" class="form-control" value="-" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">SMF</label>
                                    <select name="smfname" id="smfname" class="select2" style="width: 100%">
                                        <?php foreach ($namasmf as $NSMF) : ?>
                                            <option data-id="<?= $NSMF['id']; ?>" class="select-smf" <?php if ($NSMF['name'] == $smfname) { ?> selected="selected" <?php } ?>><?php echo $NSMF['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Titipan Kelas</label>
                                    <select name="titipan" id="titipan" class="select2" style="width: 100%">
                                        <option value="TIDAK" <?php if ($titipan == 'TIDAK') echo "selected"; ?>>TIDAK</option>
                                        <option value="YA" <?php if ($titipan == 'YA') echo "selected"; ?>>YA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Pindah Kamar</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("token_ranap").value;

        window.location.href = "<?php echo base_url('rawatinap/inputdetailibs'); ?>?page=" + page;
    }
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
                    $('#roomname').append("<option>Pilihan kamar</option>");
                }
            })
        })


        $('#roomname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_room') ?>",
                'data': {
                    key: $('#roomname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    //$('#roomname').append("<option>Pilihan kamar</option>");
                    $('#roomname').val(data.roomname);
                    $('#room').val(data.room);
                    $('#roomname').append("<option>Pilihan kamar</option>");

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#rujuk").autocomplete({
            source: "<?php echo base_url('PelayananRanap/ajax_rujuk'); ?>",
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#code_rujuk').val(ui.item.code);
                $('#address_rujuk').val(ui.item.address);

            }
        });
    });

    $('#statuspulang').on('change', function() {


        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('PendaftaranRanap/ajax_pulang') ?>",
            data: {
                keterangan: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);


                $('#alasanaps').empty();

                if (data[0] == null) {

                    $('#alasanaps').append("<option>Pilihan kosong</option>");
                    $('#alasanaps').attr('disabled', 'disabled');
                    $('#rujuk').removeAttr('disabled');

                } else {

                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#alasanaps').append("<option value='" + item.name + "' data-room='" + item.name + "'>" + item.name + "</option>");
                    }

                    $('#alasanaps').removeAttr('disabled');
                    $('#rujuk').attr('disabled', 'disabled');
                }

                $('#statuspulang').val($('#statuspulang option:selected').data('name'));

            }
        })
    });
</script>

<script type="text/javascript">
    function berangkat() {
        window.location.href = "<?php echo base_url('PasienRanap/Dact'); ?>";
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
                    if (response.Gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.Gagal,

                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalpindahkamar').modal('hide');
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

                        function appendRoomName(item) {
                            $('#roomname').append("<option value='" + item.roomname + "' data-room='" + item.room + "'>" + item.roomname + "</option>");
                        }

                        $('#roomname').removeAttr('disabled');
                    }


                    //data-id="<?= $kelas['id']; ?>"
                    $('#classroomname').val($('#classroom option:selected').data('name'));
                    $('#classroomname').attr('type', 'hidden');


                    $('#bednumber').empty();
                    $('#bednumber').attr('disabled', 'disabled');

                    $('#room').attr('type', 'hidden');
                }
            })
        });



        $('#roomname').on('change', function() {

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


                    $('#room').val($('#roomname option:selected').data('room'));
                    $('#room').attr('type', 'hidden');

                }
            })
        })

    });
</script>