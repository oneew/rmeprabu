<div id="modalvalidasipasienmasukranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Validasi Pasien Masuk Rawat Inap => Token Bill Rawat Inap (<?= $token_ranap; ?>)</h4>
            </div>

            <?= form_open('ValidasiDaftarRanap/SimpanValidasiPasienMasuk', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Norm</label>
                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" readonly>
                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" readonly>
                                    <input type="hidden" id="types" name="types" class="form-control" value="<?= $types; ?>" readonly>
                                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>" readonly>
                                    <input type="hidden" id="validationgroup" name="validationgroup" class="form-control" value="<?= $types; ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                    <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="<?= $parentjournalnumber; ?>" readonly>
                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                    <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>" readonly>
                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="<?= $parentid; ?>" readonly>
                                    <input type="hidden" id="parentname" name="parentname" class="form-control" value="<?= $parentname; ?>" readonly>

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
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <div class="row pt-1">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Penanggung Jawab</label>
                                    <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alamat Pjb</label>
                                    <input type="text" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Telp</label>
                                    <input type="text" id="telppjb" name="telppjb" class="form-control" value="<?= $telppjb; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Hubungan Penanggung Jawab</label>
                                    <select name="hubunganpjb" id="hubunganpjb" class="form-control filter-input">

                                        <?php foreach ($HPJB as $hub) : ?>
                                            <option value="<?php echo $hub['hubunganpjb']; ?>" <?php if ($hub['hubunganpjb'] == $hubunganpjb) { ?> selected="selected" <?php } ?>><?php echo $hub['hubunganpjb']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row pt-1">
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Masuk</label>
                                    <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>">
                                    <input type="text" id="datein" name="datein" class="form-control" value="<?= $datein; ?>">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Jam Masuk</label>
                                    <input type="text" id="timein" name="timein" class="form-control" value="<?= $timein; ?>">

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelas Perawatan</label>
                                    <select name="classroom" id="classroom" class="select2" style="width: 100%">
                                        <?php foreach ($KR as $kelas) : ?>
                                            <option data-id="<?= $kelas['id']; ?>" data-name="<?= $kelas['name']; ?>" class="select-classroom" <?php if ($kelas['code'] == $classroom) { ?> selected="selected" <?php } ?>><?php echo $kelas['code']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruang Perawatan</label>
                                    <select name="roomname" id="roomname" class="select2" style="width: 100%">
                                        <?php foreach ($kamar as $kmr) : ?>
                                            <option data-id="<?= $kmr['id']; ?>" class="select-classroom" <?php if ($kmr['roomname'] == $roomname) { ?> selected="selected" <?php } ?>><?php echo $kmr['roomname']; ?></option>


                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nomor Bed</label>
                                    <select name="bednumber" id="bednumber" class="select2" style="width: 100%">

                                        <?php foreach ($bed as $B) : ?>
                                            <option value="<?= $B['code']; ?>" <?php if ($B['code'] == $bednumber) { ?> selected="selected" <?php } ?>><?php echo $B['code']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="bedname" name="bedname" class="form-control" value="<?= $bedname; ?>" readonly>

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
                                    <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $paymentmethodnameori; ?>" readonly>
                                    <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $paymentmethodori; ?>" readonly>
                                    <input type="hidden" id="paymentcardnumberori" name="paymentcardnumberori" class="form-control" value="<?= $paymentcardnumberori; ?>" readonly>
                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>" readonly>
                                    <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>" readonly>
                                    <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokterpoli; ?>" readonly>
                                    <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $dokterpoliname; ?>" readonly>
                                    <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $dokterpoliname; ?>" readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">No. Asuransi/Jaminan</label>
                                    <input type="text" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>">
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
                                    <label>DPJP</label>
                                    <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                        <option></option>
                                        <?php foreach ($list as $dpjp) { ?>
                                            <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?php echo $dpjp['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $dokter; ?>">
                                    <div class="form-control-feedback erroribsdoktername">
                                    </div>
                                </div>
                            </div>

                            <!--/span-->
                        </div>

                        <!--/row-->

                        <!--/row-->
                        <div class="row pt-1">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa</label>
                                    <input type="text" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>">
                                </div>
                            </div>

                            <?php

                            $datedari = $tglspr;
                            $DateAwal = date("m/d/Y", strtotime($datedari));

                            ?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal SPR</label>
                                    <input type="text" id="datepicker-autoclose" value="<?= $DateAwal; ?>" autocomplete="off" name="tglspr" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?= $email; ?>">
                                </div>
                                <div class="form-control-feedback errorEmail">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Memo</label>
                                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="text" id="memo2" name="memo2" class="form-control" value="<?= $memo; ?>">
                                    <input type="hidden" id="memo" name="memo" class="form-control" value="VALIDASI RUANGAN DAN TEMPAT TIDUR">
                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                    <input type="hidden" id="validation" name="validation" class="form-control" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                    <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep_poli; ?>" readonly>



                                    <input type="hidden" id="validationdate" name="validationdate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="<?= $statuspasien; ?>" readonly>
                                    <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>" readonly>
                                    <input type="hidden" id="lakalantas" name="lakalantas" class="form-control" value="<?= $lakalantas; ?>" readonly>
                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                    <input type="hidden" id="pasienclassroom" name="pasienclassroom" class="form-control" value="<?= $pasienclassroom; ?>" readonly>
                                    <input type="hidden" id="bumil" name="bumil" class="form-control" value="<?= $bumil; ?>" readonly>

                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                    <input type="hidden" id="roomfisik" name="roomfisik" class="form-control" value="<?= $roomfisik; ?>" readonly>
                                    <input type="hidden" id="roomfisikname" name="roomfisikname" class="form-control" value="<?= $roomfisikname; ?>" readonly>
                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                    <input type="hidden" id="pasienclassroomchange" name="pasienclassroomchange" class="form-control" value="<?= $pasienclassroomchange; ?>" readonly>
                                    <input type="hidden" id="paymentchange" name="paymentchange" class="form-control" value="<?= $paymentchange; ?>" readonly>
                                    <input type="hidden" id="paymentchangenumber" name="paymentchangenumber" class="form-control" value="<?= $paymentchangenumber; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Titipan</label>
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
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Validasi</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("token_ranap").value;

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



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalvalidasipasienmasukranap').modal('hide');
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
                    $('#roomname').val(data.roomname);
                    $('#room').val(data.room);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>