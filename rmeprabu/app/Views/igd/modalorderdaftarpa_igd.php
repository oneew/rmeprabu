<div id="modalorderdaftarpa_igd" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Form Order Pendafaran Patologi Anatomi</h4>
            </div>

            <?= form_open('OrderPendaftaranPA/simpandatapaigd', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <div id="form-filter-atas">
                    <from class="form-horizontal form-material" id="form-filter" method="post">
                        <div class="form-body">

                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Norm</label>
                                        <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>

                                        <?php
                                        helper('text');
                                        $token = random_string('alnum', 8);
                                        ?>
                                        <input type="hidden" id="token_radiologi" name="token_radiologi" class="form-control" value="<?= $token; ?>">
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
                                        <label class="control-label">Penanggung Jawab</label>
                                        <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Alamat Pjb</label>
                                        <input type="text" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telp</label>
                                        <input type="text" id="telppjb" name="telppjb" class="form-control" value="<?= $telppjb; ?>" onkeypress="return hanyaAngka(event)">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Hubungan Penanggung Jawab</label>
                                        <select name="hubunganpjb" id="hubunganpjb" class="select2" style="width: 100%;">
                                            <?php foreach ($HPJB as $pjb) : ?>
                                                <option value="<?= $pjb['hubunganpjb']; ?>" class="select-inisial"><?= $pjb['hubunganpjb']; ?></option>
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
                                        <label class="control-label">Tanggal Pelayanan</label>
                                        <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>" readonly>

                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kelas Perawatan</label>
                                        <input type="text" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                        <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="INSTALASI GAWAT DARURAT" readonly>


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Ruang Perawatan</label>
                                        <input type="text" id="roomname" name="roomname" class="form-control" value="<?= $roomname; ?>" readonly>
                                        <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nomor Bed</label>
                                        <input type="text" id="bednumber" name="bednumber" class="form-control" value="<?= $bednumber; ?>" readonly>

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
                                        <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">SMF</label>
                                        <input type="text" id="smfname2" name="smfname2" class="form-control" value="<?= $roomname; ?>" readonly>
                                        <input type="hidden" id="smfname" name="smfname" class="form-control" readonly>
                                        <input type="hidden" id="smf" name="smf" class="form-control" value="NONE" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Diagnosa</label>
                                        <input type="text" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Permohonan</label>
                                        <input type="text" id="datepicker-autoclose" autocomplete="off" name="tgl_order" class="form-control" value="<?= date('d/m//Y'); ?>">

                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <!--/row-->

                            <!--/row-->
                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dokter Pemohon</label>
                                        <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                            <option></option>
                                            <?php foreach ($list as $dpjp) { ?>
                                                <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $dokter; ?>">
                                        <div class="form-control-feedback erroribsdoktername">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pemeriksaan</label>
                                        <select id="orderpemeriksaan" name="orderpemeriksaan[]" class="select2 mb-2 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                            <?php foreach ($Radiologi as $rad) : ?>
                                                <option value="<?php echo $rad['name']; ?>"><?php echo $rad['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Memo</label>
                                        <input type="text" id="memo" name="memo" class="form-control" value="-">
                                        <input type="hidden" id="note" name="note" value="ORDER" class="form-control">
                                        <input type="hidden" id="status" name="status" value="ORDER" class="form-control">
                                        <input type="hidden" id="employee" name="employee" class="form-control" readonly>
                                        <input type="hidden" id="employeename" name="employeename" class="form-control" readonly>
                                        <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" readonly>
                                        <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                        <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                        <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                        <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                        <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                        <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                        <input type="hidden" id="validation" name="validation" class="form-control" value="BELUM" readonly>
                                        <input type="hidden" id="cash" name="cash" class="form-control" value="0.00" readonly>
                                        <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                        <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                        <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                        <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                        <input type="hidden" id="registernumber_rawatjalan" name="registernumber_rawatjalan" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                        <input type="hidden" id="registernumber_rawatinap" name="registernumber_rawatinap" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="LPA" readonly>
                                        <input type="hidden" id="locationname" name="locationname" class="form-control" value="LABORATORIUM PATOLOGI ANATOMI" readonly>
                                        <input type="hidden" id="employee" name="employee" class="form-control" value="LPA_00002" readonly>
                                        <input type="hidden" id="employeename" name="employeename" class="form-control" value="Petugas Patologi Anatomi" readonly>
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
                                        <input type="hidden" id="groups" name="groups" class="form-control" value="LPA" readonly>
                                        <input type="hidden" id="types" name="types" class="form-control" value="RM" readonly>
                                        <input type="hidden" id="visited" name="visited" class="form-control" value="K1" readonly>
                                        <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="transferjournalnumber" name="transferjournalnumber" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                        <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="" readonly>
                                        <input type="hidden" id="noantrian" name="noantrian" class="form-control" value="" readonly>
                                        <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                        <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                        <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>" readonly>
                                        <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>" readonly>
                                        <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokter; ?>" readonly>
                                        <input type="hidden" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $doktername; ?>" readonly>
                                        <input type="hidden" id="datein" name="datein" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                        <input type="hidden" id="timein" name="timein" class="form-control" value="<?= date('H:i:s'); ?>" readonly>
                                        <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                        <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM" readonly>
                                        <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" value="REGISTER" readonly>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </from>
                </div>
                <div class="modal-footer">
                    <div id="form-filter-bawah-simpan">
                        <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Order</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <?php helper('form') ?>
            <?= form_open('PelayananLPA/simpanpemeriksaanPaket', ['class' => 'formsimpanbanyak']); ?>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: none;">
                    <from class="form-horizontal form-material" id="form-filter1" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <div class="input-group">
                                        <select name="asalLab" id="asalLab" class="select2 filter-input" style="width: 100%">
                                            <option value="1">Lab PA Sentral</option>
                                            <option value="2">Lab PA IGD</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelompok Paket</label>
                                    <div class="input-group">
                                        <select name="kelompokLab" id="kelompokLab" class="select2 filter-input" style="width: 100%">
                                            <option>Pilih</option>
                                            <?php foreach ($kelompokLab as $kelompok) { ?>
                                                <option value="<?= $kelompok['name']; ?>" class="select-employeename"><?= $kelompok['name']; ?></option>
                                            <?php } ?>
                                        </select>

                                        <input type="hidden" id="classroom2" name="classroom2" class="form-control" value="KLS2">
                                        <input type="hidden" id="idpasien" name="idpasien" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </from>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="table-responsive viewdatapaket"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="form-filter-bawah-simpan-pemeriksaan" style="display: none;">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan Pemeriksaan</button>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
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
                                //$('#modalorderdaftarpa_igd').modal('hide');

                                //berangkat();
                                $('#form-filter-atas').css('display', 'none');
                                $('#form-filter-bawah-simpan').css('display', 'none');
                                $('#form-filter-bawah').css('display', 'block');
                                $('#form-filter-bawah-simpan-pemeriksaan').css('display', 'block');
                                $('#idpasien').val(response.JN);
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


<script>
    $('.filter-input').on('change', function() {
        let kelompokLab = $('#kelompokLab').val();
        let classroom = $('#classroom2').val();
        let id = $('#idpasien').val();
        let asal_lab = $('#asalLab').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranPA/caripaket') ?>",
            dataType: "json",
            data: {
                kelompokLab: kelompokLab,
                classroom: classroom,
                id: id,
                asal_lab: asal_lab
            },
            success: function(response) {
                $('.viewdatapaket').html(response.data);

            }
        });
    });
</script>


<script>
    $(document).ready(function(e) {
        $('.formsimpanbanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanbanyak').attr('disable', 'disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,

                        }).then((result) => {
                            if (result.value) {
                                dataresume();
                                historiradiologi();
                                resumeexpertise();
                                resumePenunjang();
                                $('#name').val('');
                                $('#price').val('');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            html: `${response.gagal}`,

                        })
                    }
                }
            });
            return false;
        });
    });
</script>