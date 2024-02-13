<link href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- Page plugins css -->
<link href="<?= base_url(); ?>/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<!-- Color picker plugins css -->
<link href="<?= base_url(); ?>/assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">

<?php
$attr_eksisi = $eksisi == 1 ? 'checked' : '';
$attr_pa = $pa == 1 ? 'checked' : '';
$attr_lab = $lab == 1 ? 'checked' : '';
$attr_transfusi = $transfusi == 1 ? 'checked' : '';
$attr_wb = $wb == 1 ? 'checked' : '';
$attr_prc = $prc == 1 ? 'checked' : '';
?>

<?php
$db = db_connect();
$query = $db->query("SELECT *  FROM transaksi_pelayanan_rawatinap_operasi_header WHERE journalnumber='$journalnumber' LIMIT 1");
$jadwal = $db->query("SELECT *  FROM book_operasi WHERE journalnumber='$journalnumber' LIMIT 1");

foreach ($query->getResult() as $row) {
    $ibsanestesiname = $row->ibsanestesiname;
    $cases = $row->cases;
    $ibspenataname = $row->ibspenataname;
    $ibsnursename = $row->ibsnursename;
    $icdxname = $row->icdxname;
    $types = $row->types;
    $pasiengender = $row->pasiengender;
    $pasiendateofbirth = $row->pasiendateofbirth;
    $pasienname = $row->pasienname;
}

foreach ($jadwal->getResult() as $j) {

    $jenis_anestesi = $j->jenis_anestesi;
    $room = $j->room;
    $dt_advice_op = $j->dt_advice_op;
}
?>

<div id="modallaporanoperasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Laporan Jalan Operasi [<?= $relation; ?> | <?= $relationname; ?>]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <?php helper('form') ?>
                <?= form_open('PascaBedah/simpanlaporanoperasi', ['class' => 'formlaporanoperasi']); ?>
                <?= csrf_field(); ?>
                <from method="post" id="form-filter">
                    <div class="form-body">
                        <div class="row mt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruang Operasi</label>
                                    <input type="text" id="ruang" name="ruang" class="form-control" value="<?= $types; ?>">
                                    <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>">
                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>">
                                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>">
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $relation; ?>">
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kamar</label>
                                    <input type="text" id="operatorroom" name="operatorroom" class="form-control" value="<?= $room; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal operasi</label>
                                    <input type="text" id="tanggaloperasi" name="tanggaloperasi" class="form-control" value="<?= $dt_advice_op; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kategori</label>
                                    <input type="text" id="cases" name="cases" class="form-control" value="<?= $cases; ?>">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row mt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Dokter Operator</label>
                                    <input type="text" id="ibsdoktername" name="ibsdoktername" class="form-control" value="<?= $doktername; ?>">

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Dokter Anestesi</label>
                                    <input type="text" id="ibsanestesiname" name="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>">

                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Perawat Instrumen</label>
                                    <input type="text" id="perawatinstrumen" name="perawatinstrumen" class="form-control" value="<?= $ibsnursename; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Penata Anestesi</label>
                                    <input type="text" id="penataanestesi" name="penataanestesi" class="form-control" value="<?= $ibspenataname; ?>">

                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jenis Anestesi</label>
                                    <input type="text" id="jenisanestesi" name="jenisanestesi" class="form-control" value="<?= $jenis_anestesi; ?>">

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Obat-obat Anestesi</label>
                                    <input type="text" id="obatanestesi" name="obatanestesi" class="form-control" value="<?= $obatanestesi; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa Pra Bedah</label>
                                    <input type="text" id="diagnosaprabedah" name="diagnosaprabedah" class="form-control" value="<?= $icdxname; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Dignosa Pasca Bedah</label>
                                    <input type="text" id="diagnosapascabedah" name="diagnosapascabedah" class="form-control" value="<?= $diagnosapascabedah; ?>">
                                    <input type="hidden" id="diagnosapascabedah_tanda" name="diagnosapascabedah_tanda" class="form-control" value="<?= $diagnosapascabedah; ?>">
                                    <div class="form-control-feedback errordiagnosapascabedah">

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Indikasi Operasi</label>
                                    <input type="text" id="indikasioperasi" name="indikasioperasi" class="form-control" value="<?= $indikasioperasi; ?>">
                                    <div class="form-control-feedback errorindikasioperasi">

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jenis Operasi</label>
                                    <input type="text" id="jenisoperasi" name="jenisoperasi" class="form-control" value="<?= $groupname; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Disinfeksi Kulit</label>
                                    <input type="text" id="disinfeksikulit" name="disinfeksikulit" class="form-control" value="<?= $disinfeksikulit; ?>">

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Eksisi</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_eksisi; ?> id="eksisi" name="eksisi" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Ke PA</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_pa; ?> id="pa" name="pa" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Ke Lab</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_lab; ?> id="lab" name="lab" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jenis Bahan</label>
                                    <input type="text" id="jenisbahan" name="jenisbahan" class="form-control" value="<?= $jenisbahan; ?>">

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Mulai Operasi</label>
                                    <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" name="mulaioperasi" class="form-control" value="<?= $mulaioperasi; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="far fa-clock"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Selesai</label>
                                    <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" name="selesaioperasi" class="form-control" value="<?= $selesai; ?>">
                                        <input type="hidden" id="durasi" name="durasi" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="far fa-clock"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jumlah Pendarahan</label>
                                    <input type="text" id="jumlahpendarahan" name="jumlahpendarahan" class="form-control" value="<?= $jumlahpendarahan; ?>">

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Transfusi</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_transfusi; ?> name="transfusi" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">PRC</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_prc; ?> id="prc" name="prc" name="prc" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">WB</label>
                                    <div class="switchery-demo mb-4">
                                        <input type="checkbox" <?= $attr_wb; ?> id="wb" name="wb" class="js-switch" data-color="#009efb" value="1" />
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <button class="button-jalanoperasi"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label>Jalannya Operasi</label>
                                    <textarea class="textarea_editor form-control" rows="5" name="jalanoperasi" id="jalanoperasi" placeholder="Enter text ..."><?= $jalanoperasi; ?></textarea>
                                    <div class="form-control-feedback errorjalanoperasi">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <p><b>Sign in :</b></p>
                                    <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                                    <div class="js-signatureDokterOperator" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                    <p><button id="clearBtnDokterOperator" class="btn btn-default">Clear Canvas</button></p>
                                    <div id="signature">

                                    </div>
                                </div>
                            </div>
                            <?php if ($signature_dokteroperator <> '') { ?>
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <p>Sign Dokter Operator :</p>
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"> <img src="<?= $signature_dokteroperator ?>" alt="user" />
                                                <div class="el-overlay">
                                                    <ul class="el-info">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btnsimpan"><i class="fa fa-check"></i> Simpan</button>
                    </div>

                    </form>

            </div>

            <?= form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        $('.formlaporanoperasi').submit(function(e) {
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
                        if (response.error.diagnosapascabedah) {
                            $('#diagnosapascabedah').addClass('form-control-danger');
                            $('.errordiagnosapascabedah').html(response.error.diagnosapascabedah);
                        } else {
                            $('#diagnosapascabedah').removeClass('form-control-danger');
                            $('.errordiagnosapascabedah').html('');
                        }

                        if (response.error.indikasioperasi) {
                            $('#indikasioperasi').addClass('form-control-danger');
                            $('.errorindikasioperasi').html(response.error.indikasioperasi);
                        } else {
                            $('#indikasioperasi').removeClass('form-control-danger');
                            $('.errorindikasioperasi').html('');
                        }

                        if (response.error.jalanoperasi) {
                            $('#jalanoperasi').addClass('form-control-danger');
                            $('.errorjalanoperasi').html(response.error.jalanoperasi);
                        } else {
                            $('#jalanoperasi').removeClass('form-control-danger');
                            $('.errorjalanoperasi').html('');
                        }


                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#modallaporanoperasi').modal('hide');
                        datalaporanoperasi();


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
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="<?= base_url(); ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>




<script src="<?= base_url(); ?>/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
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

<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
</script>

<script>
    $(document).ready(function() {
        if ($('.js-signatureDokterOperator').length) {
            $('.js-signatureDokterOperator').jqSignature();
        }

        $('#clearBtnDokterOperator').on('click', function(e) {
            e.preventDefault();
            $('.js-signatureDokterOperator').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);

        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signatureDokterOperator').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });

        });

        $('.js-signatureDokterOperator').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.button-jalanoperasi').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }

                    $('#jalanoperasi').html(finalTranscripts);
                    $('#jalanoperasi').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#jalanoperasi').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
</script>