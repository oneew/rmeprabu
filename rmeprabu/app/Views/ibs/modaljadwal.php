<div id="modaljadwal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Setup Jadwal Operasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php helper('form') ?>
            <?= form_open('EdukasiBedah/simpandata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <from class="form-horizontal pt-3" id="form-filter" method="post">
                    <div class="form-group row">
                        <label for="uname" class="col-sm-3 control-label">Tindakan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-bed"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email2" class="col-sm-3 control-label">Jenis</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" id="groupname" name="groupname" value="<?= $groupname; ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-bullseye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="web1" class="col-sm-3 control-label">Kategori</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" id="cases" name="cases" value="<?= $operationgroup; ?>" readonly>
                                <input type="hidden" class="form-control" id="paymentcardnumber" name="paymentcardnumber" value="<?= $paymentcardnumber; ?>" readonly>
                                <input type="hidden" class="form-control" id="kodepoli" name="kodepoli" value="<?= $kodepoli; ?>" readonly>
                                <input type="hidden" class="form-control" id="namapoli" name="namapoli" value="<?= $namapoli; ?>" readonly>
                                <input type="hidden" class="form-control" id="id_tprod" name="id_tprod" value="<?= $id; ?>" readonly>
                                <input type="hidden" class="form-control" id="pasienid" name="pasienid" value="<?= $relation; ?>" readonly>
                                <input type="hidden" class="form-control" id="pasienname" name="pasienname" value="<?= $relationname; ?>" readonly>
                                <input type="hidden" class="form-control" id="journalnumber" name="journalnumber" value="<?= $journalnumber; ?>" readonly>
                                <input type="hidden" class="form-control" id="referencenumber" name="referencenumber" value="<?= $referencenumber; ?>" readonly>
                                <input type="hidden" class="form-control" id="paymentmethod" name="paymentmethod" value="<?= $paymentmethod; ?>" readonly>

                                <input type="hidden" class="form-control" id="diagnosaprabedah" name="diagnosaprabedah" value="" readonly>
                                <input type="hidden" class="form-control" id="user" name="user" value="<?= session()->get('email'); ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-band-aid"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email2" class="col-sm-3 control-label">Dokter operator</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" id="ibsdoktername" name="ibsdoktername" value="<?= $doktername; ?>" readonly>
                                <input type="hidden" class="form-control" id="ibsanestesiname" name="ibsanestesiname" value="" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-bullseye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass3" class="col-sm-3 control-label">Anestesi</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select class="select2" name="jenisanestesi" id="jenisanestesi" style="width: 100%">

                                    <?php
                                    foreach ($teknikanestesi as $anestesi) {
                                        echo "<option value='$anestesi->deskripsi'";
                                        echo ">$anestesi->deskripsi</option>";
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass4" class="col-sm-3 control-label">Kamar</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select class="select2" name="room" id="room" style="width: 100%">

                                    <?php
                                    foreach ($kamarok as $k) {
                                        echo "<option value='$k->room'";
                                        echo ">$k->room</option>";
                                    }
                                    ?>

                                </select>
                                <div class="form-control-feedback erroribsroom">

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pass4" class="col-sm-3 control-label">Tanggal Operasi</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="dt_advice_op" id="min-date">

                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="far fa-clock"></i>
                                    </span>
                                </div>

                            </div>
                            <div class="form-control-feedback erroribsmindate">

                            </div>
                        </div>

                    </div>

                </from>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            </div>

            <?= form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
            e.preventDefault();
            //var token_ibs = document.getElementById("token_ibs").value;
            //var pasien_id = document.getElementById("pasien_id").value;
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
                        if (response.error.ibsroom) {
                            $('#room').addClass('form-control-danger');
                            $('.erroribsroom').html(response.error.ibsroom);
                        } else {
                            $('#room').removeClass('form-control-danger');
                            $('.erroribsroom').html('');
                        }

                        if (response.error.ibsmindate) {
                            $('#min-date').addClass('form-control-danger');
                            $('.erroribsmindate').html(response.error.ibsmindate);
                        } else {
                            $('#min-date').removeClass('form-control-danger');
                            $('.erroribsmindate').html('');
                        }



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaljadwal').modal('hide');
                                datajadwalinputtim();
                                datajadwal();
                                datajadwal2();


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
        format: 'MM/DD/YYYY HH:mm',
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